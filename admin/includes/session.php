<?php
	include 'includes/connection.php';

	session_start();
	if(!isset($_SESSION['users']))
	{
		header('location:./login.php');
	}
	$admin = $_SESSION['users'];
	$admin_query="SELECT * FROM admin_details WHERE username='$admin'";
	$admin_execute=mysqli_query($conn, $admin_query);
    $admin_record=mysqli_fetch_assoc($admin_execute);
	mysqli_close($conn);
?>