<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$memberid = $_POST['memberid'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM members WHERE member_id = '$memberid'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot find account with the Member ID';
		}
		else{
			$row = $query->fetch_assoc();
			if($password == $row['password']){
				$_SESSION['members'] = $row['member_id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}

	}
	else{
		$_SESSION['error'] = 'Input member credentials first';
	}

	header('location: index.php');

?>
