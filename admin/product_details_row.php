<?php 
	include 'includes/session.php';
	include 'includes/connection.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$select_query_ch = "SELECT *,p_name as productname, p_details as details, p_benefits as benefits from product_details WHERE p_id=$id";
		$exec_query= mysqli_query($conn,$select_query_ch);
		$row = mysqli_fetch_array($exec_query);
		
		mysqli_close($conn);
		
		echo json_encode($row);
	}
?>