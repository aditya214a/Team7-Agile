<?php
include 'includes/connection.php';

session_start();
if (isset($_SESSION['client_users'])) {
	$client_uname = $_SESSION['client_users'];
	$fetch_client_query = "SELECT * FROM client_details WHERE username='$client_uname'";
	$client_query_run = mysqli_query($conn, $fetch_client_query);
	$client_query = mysqli_fetch_assoc($client_query_run);
	mysqli_close($conn);
}
