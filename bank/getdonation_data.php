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
        $m_id=$row['get_id'];
        $amount=$row['amount'];
        $proid=$row['provide_id'];
        $g_amont=$amount;
        
        $sql = "INSERT INTO growth(member_id,provide_amount,growth_amount) VALUES('$m_id','$amount','$g_amont')";
        $conn->query($sql);

        $sql = "SELECT * FROM wallet WHERE member_id='$m_id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $grow_am = $row['growth'];
        $grow_am=$grow_am+$g_amont;

        $sql = "UPDATE wallet SET growth ='$grow_am' WHERE member_id='$m_id'";
        $conn->query($sql);

        $prevdate = date("Y-m-d H:i:s");
        $date = new DateTime($prevdate);
        $date->add(new DateInterval('P4DT4H'));
        $date = $date->format('Y-m-d H:i:s');

        $sql="UPDATE provide_help SET status='pendingGet',approved_datetime = '$date' WHERE id='$proid'";
        $conn->query($sql);
        
        $memberid=$user['member_id'];
        $sql = "SELECT * FROM members WHERE member_id='$memberid'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $sponcer_info = $row['sponcer_info'];
        $str = explode(",", $sponcer_info);
        
        $_SESSION['success'] = 'Approved Successfully.';
    } else {
        $_SESSION['error'] = 'Error!!';
    }
}
header('location: home.php');
