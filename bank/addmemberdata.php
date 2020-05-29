<?php
	include 'includes/session.php';

	if(isset($_POST['register'])){
		$pin = $_POST['pin'];
		$amount=$_POST['amount'];
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
		$sponcerinfo=$row['sponcer_info'];
		$sponcerinfo=$sponcerinfo.','.$sponcer;

    	$sql = "INSERT INTO members (member_id, name,mobile, password, sponcer,joining_date,level,sponcer_info)
      		VALUES ('$memberid', '$name', '$phone','$password','$sponcer', NOW(),'$level','$sponcerinfo')";
		if($conn->query($sql)){
			$sql="INSERT INTO usedpins(member_id,pin,amount,register,date)
			 VALUES('$sponcer','$pin','$amount','$memberid',NOW())";
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

			// Adding provide help request
			$amount_p = $amount;
			$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			$randno = substr(str_shuffle($str_result), 0, 10);

			$sponcer_name=$user['name'];
			$sponcer_id=$user['member_id'];			
			$sql = "INSERT INTO provide_request(member_id,name,provide_help_no,sponcer_name,sponcer_id,amount,date) 
					VALUES('$memberid','$name','$randno','$sponcer_name','$sponcer_id','$amount_p',NOW())";
			$conn->query($sql);

			$_SESSION['success'] = 'Member Added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	header('location: mypins.php');
?>
