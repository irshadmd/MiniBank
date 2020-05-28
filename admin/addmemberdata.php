<?php
	include 'includes/session.php';

	if(isset($_POST['adminaddmember'])){
		$memberid = $_POST['memberid'];
		$name = $_POST['name'];
    	$sponcer=$_POST['sponcer'];
    	$phone=$_POST['phone'];
		$password = $_POST['password'];
		$money=0;

	    $sql = "INSERT INTO members (member_id, name,mobile, password, sponcer,joining_date,level,sponcer_info)
    	  VALUES ('$memberid', '$name', '$phone','$password','$sponcer', NOW(),0,'admin')";
		if($conn->query($sql)){

			$sql="INSERT INTO wallet(member_id,money)
			 VALUES('$memberid','$money')";
			$query = $conn->query($sql);

			// Adding provide help request
			$amount = 200;
			$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			$randno = substr(str_shuffle($str_result), 0, 10);

			$sponcer_name = $sponcer;
			$sponcer_id = $sponcer;
			$sql = "INSERT INTO provide_request(member_id,name,provide_help_no,sponcer_name,sponcer_id,amount,date) 
						VALUES('$memberid','$name','$randno','$sponcer_name','$sponcer_id','$amount',NOW())";
			$conn->query($sql);

				$_SESSION['success'] = 'Member Added successfully';
			}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	header('location: addmember.php');
?>
