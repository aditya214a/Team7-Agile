<?php
include 'includes/session.php';
include 'includes/connection.php';
require 'vendor/autoload.php';
require_once('vendor/tecnickcom/tcpdf/tcpdf.php');

use Picqer\Barcode\BarcodeGeneratorPNG;


if (isset($_POST['add'])) {
    $waste_type = @$_POST['check'];
    $other_category_name = @$_POST['otherCategory'];
    if (empty($waste_type)) {
        $_SESSION['error'] = "Atleast One Waste Type You Need to Select!";
        header('location:sell_waste.php');
        exit;
    } else {
        try {
            $now = date('Y-m-d h:i:sa');
            #$uniqueId = substr(uniqid(), 4, 8);

            // Generate a 6-digit unique number series
            $uniqueNumber = sprintf("%06d", mt_rand(1, 999999));

            // Concatenate the string "INFIG" with the unique 6 digit number
            $uniqueId = "INFIG" . $uniqueNumber;

            // Generate barcode image
            $generator = new BarcodeGeneratorPNG();
            $barcodeImagePath = 'admin/uploaded_images/barcode/';
            file_put_contents($barcodeImagePath . $uniqueId . '.png', $generator->getBarcode($uniqueId, $generator::TYPE_CODE_128));

            // Create PDF with barcode
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->AddPage();

            // Add multiple barcodes to a single A4 page
            for ($row = 1; $row <= 12; $row++) {
                for ($col = 1; $col <= 3; $col++) {
                    // Calculate position for each cell in the grid
                    $xPosition = ($col - 1) * 60; // Adjust based on cell width
                    $yPosition = ($row - 1) * 22; // Adjust based on cell height

                    // Add barcode image
                    $pdf->Image($barcodeImagePath . $uniqueId . '.png', $xPosition + 19, $yPosition + 14, 45);

                    // Add Waste Unique ID underneath the barcode
                    $pdf->SetFont('times', '', 14);
                    $pdf->SetXY($xPosition + 34, $yPosition + 20);
                    $pdf->Cell(16, 4, "Waste ID: $uniqueId", 0, 1, 'C');
                }
            }

            // Output PDF to a file
            $pdfFilePath = 'admin/uploaded_images/pdf_data/' . $uniqueId . '_barcode.pdf';
            $pdfFilePath = __DIR__ . DIRECTORY_SEPARATOR . $pdfFilePath;

            $pdf->Output($pdfFilePath, 'F');

            // Create PDF with Waste Type
            $pdfType = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdfType->SetMargins(10, 10, 10);
            $pdfType->AddPage();
            // Set font
            $pdfType->SetFont('times', 'B', 32);

            // Add title
            $pdfType->Cell(125, 10, 'Selected Waste Categories', 0, 1, 'C');

            $pdfType->SetFont('times', 'B', 28);
            // Add selected waste categories
            $rows = 2; // Adjust based on the number of rows you want
            $cols = 2; // Adjust based on the number of columns you want

            // Calculate cell dimensions
            $cellWidth = ($pdfType->getPageWidth() - $pdfType->getMargins()['left'] - $pdfType->getMargins()['right']) / $cols;
            $cellHeight = 10; // Adjust based on the height you want for each cell

            // Add all waste categories in a grid
            for ($row = 1; $row <= $rows; $row++) {
                for ($col = 1; $col <= $cols; $col++) {
                    // Calculate position for each cell in the grid
                    $xPos = $pdfType->getMargins()['left'] + ($col - 1) * $cellWidth;
                    $yPos = $pdfType->getMargins()['top'] + ($row - 1) * $cellHeight ** $rows;
                    // Add the line to the PDF
                    foreach ($waste_type as $waste_category) {
                        $pdfType->SetXY($xPos, $yPos);
                        $pdfType->Cell($cellWidth, $cellHeight + 35, "$waste_category", 0, 1, 'L');
                        $yPos += $cellHeight + 4;
                    }
                }
            }
            // Output PDF to a file
            $PDFFile = 'admin/uploaded_images/pdf_waste_type_data/' . $uniqueId . '_type.pdf';
            $PDFFile = __DIR__ . DIRECTORY_SEPARATOR . $PDFFile;

            // Output PDF to a file
            $pdfType->Output($PDFFile, 'F');


            $waste_type_full = "";
            $count_waste = count($waste_type);
            $count_min = $count_waste - 1;
            $i = 0;
            foreach ($waste_type as $waste_type_value) {
                $i++;
                if ($i <= $count_min) {
                    $waste_type_full = $waste_type_full . $waste_type_value . ", ";
                } else {
                    $waste_type_full = $waste_type_full . $waste_type_value;
                }
            }

            $client_id = $_SESSION['client_id'];
            $insert_query = "INSERT INTO waste_deposit(client_id,waste_uniq_id,total_card_points,waste_type,waste_type_other,request_date) VALUES($client_id,'$uniqueId',0,'$waste_type_full','$other_category_name','$now')";
            mysqli_query($conn, $insert_query);

            $_SESSION['success'] = 'You Have Successfully Registered For InfiGreen Waste Card. You can Download the pdf guide for Proper Waste Disposal Process.';
            mysqli_close($conn);
            header('location: sell_waste.php');
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    }
}
