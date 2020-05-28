<?php
	include 'includes/session.php';
	if(isset($_POST['addpack'])){
        $amount = $_POST['amount'];
		
		$sql = "INSERT INTO pack (amount) VALUES('$amount')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Pack added';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	header('location: addpack.php');
