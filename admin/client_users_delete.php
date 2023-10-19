<?php
	include 'includes/session.php';
	include 'includes/connection.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		try{
			$delete_query="DELETE FROM client_details WHERE client_id=$id";
			mysqli_query($conn, $delete_query);
			$_SESSION['success'] = 'Client User Deleted Successfully';
			mysqli_close($conn);
			header('location: client_users.php');	
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['error'] = 'Select user to delete first';
	}
	
?>