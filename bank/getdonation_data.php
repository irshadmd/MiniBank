<?php
include 'includes/session.php';

if (isset($_POST['getdonation'])) {
    $senddonationid = $_GET['id'];
    $status = $_POST['status'];

    $sql = "UPDATE donation_reciept SET status = '$status' WHERE send_donation_id = '$senddonationid'";
    if ($conn->query($sql)) {
        $sql = "UPDATE get_donation SET status = 'approved' WHERE id = '$senddonationid'";
        $conn->query($sql);

        $sql="SELECT * FROM get_donation WHERE id='$senddonationid'";
        $query=$conn->query($sql);
        $row=$query->fetch_assoc();
        $proid=$row['provide_id'];

        $prevdate = date("Y-m-d H:i:s");
        $date = new DateTime($prevdate);
        $date->add(new DateInterval('P4DT4H'));
        $date = $date->format('Y-m-d H:i:s');

        $sql="UPDATE provide_help SET status='pendingGet',approved_datetime = '$date' WHERE id='$proid'";
        $conn->query($sql);
        $_SESSION['success'] = 'Approved Successfully.';
    } else {
        $_SESSION['error'] = 'Error!!';
    }
}
header('location: home.php');
