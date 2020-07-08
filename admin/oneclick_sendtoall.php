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

    $date = date('Y-m-d H:i:s');

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
        $provideno = $row['get_help_no'];
    
        $sql = "INSERT INTO send_donation (member_id,send_id,name,phoneno,amount,date) 
                    VALUES('$send_id','$get_id','$get_name','$get_phone','$amount','$date')";
        $conn->query($sql);
        $sql = "INSERT INTO get_donation (member_id,get_id,name,phoneno,amount,provide_id,get_help_no,date) 
                    VALUES('$get_id','$send_id','$send_name','$send_phone','$amount','$provide_id','$provideno','$date')";
        $conn->query($sql);

        //Sending PH sms
        $newphone = '91' . $send_phone;
        // Authorisation details.
        $username = "clubminibank@gmail.com";
        $hash = "ed5bdeba90f28aa5d973bf3cb54863dd0b4ae39f3a6dd7e85087803376046499";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "TXTLCL"; // This is who the message appears to be from.
        $numbers = $newphone; // A single number or a comma-seperated list of numbers
        $message = "Hello " . $send_id . " ,\n" . "You have a PH Link(200).\n" . "From  " . $get_id . ", (" . $get_phone . "). \nRegards,\n https://minibank.tech/";
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);

        //sending GH sms
        $newphone = '91' . $get_phone;
        // Authorisation details.
        $username = "clubminibank@gmail.com";
        $hash = "ed5bdeba90f28aa5d973bf3cb54863dd0b4ae39f3a6dd7e85087803376046499";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "TXTLCL"; // This is who the message appears to be from.
        $numbers = $newphone; // A single number or a comma-seperated list of numbers
        $message = "Hello " . $get_id . " ,\n" . "You have a GH Link(200).\n" . "From  " . $send_id . ", (" . $send_phone . "). \nRegards,\n https://minibank.tech/";
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);

    }
    $sql = "TRUNCATE TABLE saved";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Sent successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
    
    header('location: oneclicksend.php');
