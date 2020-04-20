<?php
	include 'includes/session.php';

	if(isset($_POST['pinrequest'])){
		$pinamount = $_POST['pinamount'];
		$name = $user['name'];
    $memberid=$user['member_id'];
    $message= $memberid.' '.$name.' sent request for '.$pinamount;
    $sql = "INSERT INTO request (member_id, name, pin_amount, message)
      VALUES ('$memberid', '$name', '$pinamount','$message')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Request sent successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	header('location: pinrequest.php');
?>
