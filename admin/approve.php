<?php
	include 'includes/session.php';

	$helpno = $_GET['id'];

    $sql = "SELECT * FROM provide_request WHERE provide_help_no = '$helpno'";
    $query = $conn->query($sql);
	$row = $query->fetch_assoc();
	
    $sql = "UPDATE provide_help SET	status='approved',approved_datetime=NOW() ";
		if($conn->query($sql)){
			$sql="DELETE FROM provide_request WHERE provide_help_no = '$helpno'";
			$query = $conn->query($sql);
			$_SESSION['success'] = 'Request accepted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	header('location: providerequests.php');
?>
