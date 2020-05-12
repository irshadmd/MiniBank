<?php
include 'includes/session.php';

if (isset($_POST['getdonation'])) {
    $senddonationid = $_GET['id'];
    $status = $_POST['status'];

    $sql = "UPDATE donation_reciept SET status = '$status' WHERE send_donation_id = '$senddonationid'";
    if ($conn->query($sql)) {
        $sql = "UPDATE get_donation SET status = 'approved' WHERE id = '$senddonationid'";
        $conn->query($sql);

        $_SESSION['success'] = 'Approved Successfully.';
    } else {
        $_SESSION['error'] = 'Error!!';
    }
}
header('location: home.php');
