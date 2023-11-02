<?php
	include 'includes/session.php';
	include 'includes/connection.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		try{
			$delete_query="DELETE FROM client_card_details WHERE card_id=$id";
			mysqli_query($conn, $delete_query);

			$_SESSION['success'] = 'Client Card Deleted Successfully';
			mysqli_close($conn);
			header('location: client_card_details.php');	
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['error'] = 'Select Client Card to Delete First';
	}
	
?>