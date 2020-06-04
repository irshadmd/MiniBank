<?php
include 'includes/session.php';

if (isset($_POST['save'])) {

    $sendmember = $_POST['sendmember'];
    $str = explode("_", $sendmember);
    $sendmember = $str[0];
    $proid = $str[1];

    $id = $_GET['id'];
    $provideno = $_GET['pno'];

    $amount = 0;
    $sendname = "";
    $sendphoneno = "";
    $getname = "";
    $getphoneno = "";

    $sql = "SELECT * FROM provide_help WHERE provide_help_no='$provideno'";
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        $amount = $row['amount'];
    }

    $sql = "SELECT * FROM members WHERE member_id='$id'";
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        $sendname = $row['name'];
        $sendphoneno = $row['mobile'];
    }
    $sql = "SELECT * FROM members WHERE member_id='$sendmember'";
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        $getname = $row['name'];
        $getphoneno = $row['mobile'];
    }

    $sql = "UPDATE provide_help SET complete = 'true',status='approved' WHERE provide_help_no = '$provideno'";
    if ($conn->query($sql)) {
        $sql = "INSERT INTO saved (get_id,get_name,get_phone,send_id,send_name,send_phone,provide_id,amount) 
                VALUES('$id','$sendname','$sendphoneno','$sendmember','$getname','$getphoneno','$proid','$amount')";
        $conn->query($sql);
        
        $_SESSION['success'] = 'Save successfully';
    } else {
        $_SESSION['error'] = "Error";
    }
} else {
    $_SESSION['error'] = "Error";
}

header('location: oneclicksend.php');
