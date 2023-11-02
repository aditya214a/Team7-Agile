<?php
include 'includes/session.php';
include 'includes/connection.php';

$deposit_query = "Select * from waste_deposit";
$deposit_query_result = mysqli_query($conn, $deposit_query);

while ($row = mysqli_fetch_assoc($deposit_query_result)) {
	echo "<option value='" . $row["waste_disposal_id"] . "'>" . $row["waste_disposal_id"] . "</option>";
}

if (isset($_POST['update'])) {
	$iws_card_id = @$_POST['id'];
	$card_balance = @$_POST['card_balance'];
	$waste_weight = @$_POST['waste_weight'];
	$waste_disposal_id = @$_POST['waste_disposal_id'];

	if ($card_balance == "") {
		$_SESSION['error'] = "* Card Balance Can't be Empty!";
		header('location: iws_card_details.php');
		exit;
	} else if (!preg_match('/^[0-9,]{0,40}$/', $card_balance)) {
		$_SESSION['error'] = "* Card Balance Must Be Numeric!";
		header('location: iws_card_details.php');
		exit;
	} else if ($waste_weight == "") {
		$_SESSION['error'] = "* Weight Can't be Empty!";
		header('location: iws_card_details.php');
		exit;
	} else if (!preg_match('/^[0-9,]{0,40}$/', $waste_weight)) {
		$_SESSION['error'] = "* Weight Balance Must Be Numeric!";
		header('location: iws_card_details.php');
		exit;
	} else {
		try {
			$update_query = "UPDATE iws_card_details SET waste_disposal_id=$waste_disposal_id, waste_weight=$waste_weight, card_points='$card_balance' WHERE iws_card_id=$iws_card_id";
			mysqli_query($conn, $update_query);
			$_SESSION['success'] = 'IWS Card Balance and Weight ' . $iws_card_balance . ' and ' . $waste_weight . ' Updated Successfully.';
			mysqli_close($conn);
			header('location: iws_card_details.php');
		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	}
}
