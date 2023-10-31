<?php
include 'includes/session.php';
include 'includes/connection.php';


if (isset($_POST['add'])) {
    $passport_no = @$_POST['passport_number'];
    $filename = @$_FILES['passport_photo']['name'];
    $waste_type = @$_POST['check'];
    $waste_details = @$_POST['waste_details'];

    $target_dir = "admin/uploaded_images/passport_photo/";
    $target_file = $target_dir . basename($_FILES["passport_photo"]["name"]);
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");


    if (!in_array($imageFileType, $extensions_arr)) {
        $_SESSION['error'] = "Extension Supported: jpg, jpeg, png, gif";
        header('location:sell_waste.php');
        exit;
    } else if (empty($waste_type)) {
        $_SESSION['error'] = "Atleast One Waste Type You Need to Select!";
        header('location:sell_waste.php');
        exit;
    } else if (!preg_match('/^[a-zA-Z]*$/', $waste_details)) {
        $_SESSION['error'] = " No Special Character or Numbers Allowed!";
        header('location:sell_waste.php');
        exit;
    } else {
        try {

            move_uploaded_file($_FILES['passport_photo']['tmp_name'], $target_dir . $filename);
            $now = date('m/d/Y');
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
            if (empty($waste_details)) {
                $waste_details = "NULL";
            }
            $insert_query = "INSERT INTO waste_deposit(client_id,passport_photo,passport_number,waste_deposit_type,waste_details,status,request_date) VALUES(" . $client_query['client_id'] . ",'$filename',$passport_no,'$waste_type_full','$waste_details','Not Approved','$now')";
            mysqli_query($conn, $insert_query);


            $_SESSION['success'] = 'You Have Successfully Registered For InfiGreen Card. We Have Mailed you All Details. As of know Card is Inactive, Our team will first Verify the details.';
            mysqli_close($conn);
            header('location: sell_waste.php');
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    }
}
