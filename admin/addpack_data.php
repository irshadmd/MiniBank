<?php
	include 'includes/session.php';
	if(isset($_POST['addpack'])){
        $amount = $_POST['amount'];
		$date = date('Y-m-d H:i:s');
		$sql = "INSERT INTO pack (amount,date) VALUES('$amount','$date')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Pack added';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	header('location: addpack.php');
