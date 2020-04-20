<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['members']) || trim($_SESSION['members']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM members WHERE member_id = '".$_SESSION['members']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();

?>
