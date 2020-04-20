<?php
	include 'includes/session.php';
	if(isset($_POST['passupdate'])){
		$newpassword = $_POST['newpassword'];
		$confirmpassword = $_POST['confirmpassword'];
		$currentpassword = $_POST['currentpassword'];
		$memberid=$user['member_id'];
		if($currentpassword==$user['password']){
			$sql = "UPDATE members SET password = '$newpassword' WHERE member_id = '$memberid'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Password updated successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}else{
			$_SESSION['success'] = 'Incorrect password';
		}
	}

	header('location: changepassword.php');
?>
