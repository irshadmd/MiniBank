<?php
	include 'includes/session.php';

	if(isset($_POST['adminaddmember'])){
		$memberid = $_POST['memberid'];
		$name = $_POST['name'];
    	$sponcer=$_POST['sponcer'];
    	$phone=$_POST['phone'];
		$password = $_POST['password'];
		$money=0;
    $sql = "INSERT INTO members (member_id, name,mobile, password, sponcer,joining_date,level)
      VALUES ('$memberid', '$name', '$phone','$password','$sponcer', NOW(),0)";
		if($conn->query($sql)){

			$sql="INSERT INTO wallet(member_id,money)
			 VALUES('$memberid','$money')";
			$query = $conn->query($sql);

			$_SESSION['success'] = 'Member Added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	header('location: addmember.php');
?>
