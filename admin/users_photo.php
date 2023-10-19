<?php
include 'includes/session.php';
include 'includes/connection.php';

if (isset($_POST['upload'])) {
	$id = $_POST['id'];
	$filename = $_FILES['photo']['name'];
	$imageErr = "";

	$target_dir = "uploaded_images/admin_images/";
	$target_file = $target_dir . basename($_FILES["photo"]["name"]);
	// Select file type
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	// Valid file extensions
	$extensions_arr = array("jpg", "jpeg", "png", "gif");

	if (empty($filename)) {
		$imageErr = "* Before Updating Select File!";
	} else if (!in_array($imageFileType, $extensions_arr)) {
		$imageErr = "* Extension Supported: jpg, jpeg, png, gif!";
	} else {

		try {
			move_uploaded_file($_FILES['photo']['tmp_name'], 'uploaded_images/admin_images/' . $filename);

			$update_query = "UPDATE admin_details SET image='$filename' WHERE admin_id=$id";
			$result_update_query = mysqli_query($conn, $update_query);
			$_SESSION['success'] = 'User photo updated successfully';
			mysqli_close($conn);
			header('location: admin_users.php');
			exit;
		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
			header('location: admin_users.php');
			exit;
		}
	}

	$_SESSION['error'] = $imageErr;
	header('location: admin_users.php');
	exit;
}
