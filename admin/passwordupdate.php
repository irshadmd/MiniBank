<?php
	include 'includes/session.php';
	if(isset($_POST['adminpassupdate'])){
		$newpassword = $_POST['newpassword'];
		$confirmpassword = $_POST['confirmpassword'];
		$currentpassword = $_POST['currentpassword'];
		$username=$user['username'];
		if($currentpassword==$user['password']){
			$sql = "UPDATE admin SET password = '$newpassword' WHERE username = '$username'";
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
