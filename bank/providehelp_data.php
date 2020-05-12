<?php
    include 'includes/session.php';

	if(isset($_POST['providehelp'])){
		$memberid = $user['member_id'];
        $membername=$user['name'];
        $selectedPin = $_POST['selectPin'];
        $amount=200;
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randno = substr(str_shuffle($str_result), 0, 10);

        $sql="INSERT INTO provide_help(member_id,name,provide_help_no,amount,date) VALUES('$memberid','$membername','$randno','$amount',NOW())";
        if($conn->query($sql)){
            $sql="INSERT INTO provide_request(member_id,name,provide_help_no,amount,date) VALUES('$memberid','$membername','$randno','$amount',NOW())";
            $conn->query($sql);

            $sql="DELETE FROM pins WHERE pin = '$selectedPin'";
            $conn->query($sql);

             $_SESSION['success'] = 'Request sent! Wait for admin to approve your request.';
        }else{
            $_SESSION['error'] = 'Error!!';
        }
	}
	header('location: providehelp.php');
?>