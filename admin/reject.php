<?php
	include 'includes/session.php';

		$helpno = $_GET['id'];

		$sql = "DELETE FROM provide_request WHERE provide_help_no = '$helpno'";
		if($conn->query($sql)){
			$sql = "UPDATE provide_help SET	status='rejected',approved_datetime=NOW() ";
			$conn->query($sql);
			$_SESSION['success'] = 'Request rejected successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	header('location: providerequests.php');
?>
