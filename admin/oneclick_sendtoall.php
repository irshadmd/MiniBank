<?php
include 'includes/session.php';

    $get_id="";
    $get_name="";
    $get_phone="";
    $send_id="";
    $send_name="";
    $send_phone="";
    $provide_id="";
    $amount=0;    

    $sql = "SELECT * FROM saved";
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        $get_id = $row['get_id'];
        $get_name = $row['get_name'];
        $get_phone = $row['get_phone'];
        $send_id = $row['send_id'];
        $send_name = $row['send_name'];
        $send_phone = $row['send_phone'];
        $provide_id = $row['provide_id'];
        $amount = $row['amount'];
    
        $sql = "INSERT INTO send_donation (member_id,send_id,name,phoneno,amount,date) 
                    VALUES('$send_id','$get_id','$get_name','$get_phone','$amount',NOW())";
        $conn->query($sql);
        $sql = "INSERT INTO get_donation (member_id,get_id,name,phoneno,amount,provide_id,date) 
                    VALUES('$get_id','$send_id','$send_name','$send_phone','$amount','$provide_id',NOW())";
        $conn->query($sql);
    }
    $sql = "TRUNCATE TABLE saved";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Sent successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
    
    header('location: oneclicksend.php');
