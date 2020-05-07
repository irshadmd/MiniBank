<?php
	include 'includes/session.php';

	$helpno = $_GET['id'];

    $sql = "SELECT * FROM provide_request WHERE provide_help_no = '$helpno'";
    $query = $conn->query($sql);
	$row = $query->fetch_assoc();
	
    $sql = "UPDATE provide_help SET	status='approved',approved_datetime=NOW() WHERE provide_help_no = '$helpno' ";
		if($conn->query($sql)){
			$sql="DELETE FROM provide_request WHERE provide_help_no = '$helpno'";
			$query = $conn->query($sql);

			$sql = "SELECT * FROM provide_help WHERE provide_help_no = '$helpno'";
			$query = $conn->query($sql);
			$row = $query->fetch_assoc();
			$prevdate = $row['approved_datetime'];
			$date = new DateTime($prevdate);
			$date->add(new DateInterval('P4DT4H'));
			$date = $date->format('Y-m-d H:i:s');
			$sql = "UPDATE provide_help SET	approved_datetime = '$date' WHERE provide_help_no = '$helpno' ";
			$conn->query($sql);

			$_SESSION['success'] = 'Request accepted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	header('location: providerequests.php');
?>
