<?php
include 'includes/session.php';
include 'includes/connection.php';
header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $waste_query = "SELECT iws.*, wd.waste_uniq_id from waste_deposit as wd, iws_card_history as iws where wd.waste_disposal_id = iws.waste_disposal_id and wd.client_id = $id";
    $exec_query = mysqli_query($conn, $waste_query);
    $rows = array();
    while ($row = mysqli_fetch_array($exec_query)) {
        $rows[] = $row;
    }
    echo json_encode($rows);
    mysqli_close($conn);
}
