<?php
	include 'includes/session.php';
	include 'includes/connection.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		try{
			$delete_query="DELETE FROM product_details WHERE p_id=$id";
			mysqli_query($conn, $delete_query);

			$_SESSION['success'] = 'Product Deleted Successfully';
			mysqli_close($conn);
			header('location: product_details.php');	
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['error'] = 'Select product to delete first';
	}
	
?>