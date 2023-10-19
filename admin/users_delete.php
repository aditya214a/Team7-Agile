<?php
	include 'includes/session.php';
	include 'includes/connection.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		try{
			$delete_query="DELETE FROM admin_details WHERE admin_id=$id";
			mysqli_query($conn, $delete_query);
			$_SESSION['success'] = 'Admin User Deleted Successfully';
			mysqli_close($conn);
			header('location: admin_users.php');	
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['error'] = 'Select user to delete first';
	}
