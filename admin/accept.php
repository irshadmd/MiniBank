<?php
	include 'includes/session.php';

		$id = $_GET['id'];

    $sql = "SELECT * FROM request WHERE member_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $name=$row['name'];
    $pinamount=$row['pin_amount'];
    $sql = "INSERT INTO money (member_id, name, amount, date) VALUES('$id','$name','$pinamount',NOW()) ";
		if($conn->query($sql)){
      $sql="DELETE FROM request WHERE member_id = '$id'";
      $query = $conn->query($sql);
			$_SESSION['success'] = 'Request accepted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	header('location: pinrequests.php');
?>
