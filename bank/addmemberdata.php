<?php
	include 'includes/session.php';

	if(isset($_POST['register'])){
		$pin = $_POST['pin'];
		$memberid = $_POST['memberid'];
		$name = $_POST['name'];
    	$sponcer=$_POST['sponcer'];
    	$phone=$_POST['phone'];
		$password = $_POST['password'];
		$level=0;
		$money=0;

		$sql="SELECT * FROM members WHERE member_id='$sponcer'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		$level=$row['level'];
		$level=$level+1;

    	$sql = "INSERT INTO members (member_id, name,mobile, password, sponcer,joining_date,level)
      		VALUES ('$memberid', '$name', '$phone','$password','$sponcer', NOW(),'$level')";
		if($conn->query($sql)){
			$sql="INSERT INTO usedpins(member_id,pin,register,date)
			 VALUES('$sponcer','$pin','$memberid',NOW())";
			$query = $conn->query($sql);

			$sql="INSERT INTO wallet(member_id,money)
			 VALUES('$memberid','$money')";
			$query = $conn->query($sql);

			$sql="DELETE FROM pins WHERE pin = '$pin'";
			$query = $conn->query($sql);

			$sql="SELECT * FROM transfer_pin WHERE pin='$pin'";
			$query = $conn->query($sql);
			if($query->num_rows > 0){
				$sql = "UPDATE transfer_pin SET used_id = '$memberid', used_name='$name', used_date=NOW() WHERE pin = '$pin'";
            	$conn->query($sql);
			}

			$_SESSION['success'] = 'Member Added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	header('location: mypins.php');
?>
