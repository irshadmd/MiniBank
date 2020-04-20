<?php
	include 'includes/session.php';

		$id = $_GET['id'];

		$sql = "DELETE FROM request WHERE member_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Request rejected successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	header('location: pinrequests.php');
?>
