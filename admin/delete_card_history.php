<?php
include 'includes/session.php';
include 'includes/connection.php';

if (isset($_POST['delete'])) {
	$id = $_POST['id'];

	try {
		$select_card_total = "SELECT total_points, waste_disposal_id FROM iws_card_history WHERE iws_card_history_id=$id LIMIT 1";
		$card_result = mysqli_query($conn, $select_card_total);
		$card_final = mysqli_fetch_assoc($card_result);

		$update_waste_query = "UPDATE waste_deposit SET total_card_points = total_card_points - {$card_final['total_points']} WHERE waste_disposal_id = {$card_final['waste_disposal_id']}";
		$update_waste_exec = mysqli_query($conn, $update_waste_query);

		$delete_query = "DELETE FROM iws_card_history WHERE iws_card_history_id=$id";

		mysqli_query($conn, $delete_query);

		$_SESSION['success'] = 'IWS Card History Deleted Successfully';
		mysqli_close($conn);
		header('location: iws_card_history.php');
	} catch (PDOException $e) {
		$_SESSION['error'] = $e->getMessage();
	}
} else {
	$_SESSION['error'] = 'Select iws card to delete first';
}
