<?php

$datenow = date("Y-m-d H:i:s");
$timenow = date("H:i:s");
$nineam = "09:01:00";
$ninepm = "20:59:00";
if (($timenow > $nineam) and ($timenow < $ninepm)) {
    $sql = "SELECT * FROM sms";
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        $name = $row['name'];
        $memberid = $row['member_id'];
        $phone = $row['phone'];
        $password = $row['password'];

        $newphone = '91' . $phone;
        // Authorisation details.
        $username = "clubminibank@gmail.com";
        $hash = "ed5bdeba90f28aa5d973bf3cb54863dd0b4ae39f3a6dd7e85087803376046499";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "TXTLCL"; // This is who the message appears to be from.
        $numbers = $newphone; // A single number or a comma-seperated list of numbers
        $message = "Dear " . $name . " ,\n" . "Welcome to Minibank.\n" . "Member Id: " . $memberid . "\nPassword: " . $password . " \nThanks:) https://minibank.tech/";
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
    //Empty table sms
    $sql = "TRUNCATE TABLE sms";
    $conn->query($sql);
}

?>