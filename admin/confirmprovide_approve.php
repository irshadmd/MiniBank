<?php
	include 'includes/session.php';

	$helpno = $_GET['id'];

	$sql = "UPDATE provide_help SET status='approved' WHERE provide_help_no = '$helpno'";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Approved successfully';
	}
	else{
		$_SESSION['error'] = $conn->error;
	}

	header('location: confirmprovide_list.php');
