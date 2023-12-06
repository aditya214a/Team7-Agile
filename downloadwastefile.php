<?php
include 'includes/session.php';
include 'includes/connection.php';

$unique_id_query = "SELECT waste_uniq_id FROM waste_deposit WHERE client_id={$_SESSION['client_id']} LIMIT 1";
$unique_id_res = mysqli_query($conn, $unique_id_query);
$unique_id_use = mysqli_fetch_assoc($unique_id_res);

$pdfPath = 'admin/uploaded_images/pdf_waste_type_data/' . $unique_id_use['waste_uniq_id'] . '_type.pdf';

// Check if the file exists
if (file_exists($pdfPath)) {
    // Set appropriate headers for file download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename=' . basename($pdfPath));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($pdfPath));

    // Read the file and output it to the browser
    readfile($pdfPath);
    exit;
} else {
    echo 'File not found!';
}
