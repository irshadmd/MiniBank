<?php
	include 'includes/session.php';

	if(isset($_POST['update'])){
		$memberid = $_POST['memberid'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$phonepay = $_POST['phonepay'];
		$googlepay = $_POST['googlepay'];
		$paytmno = $_POST['paytmno'];
		$bankname = $_POST['bankname'];
		$accno = $_POST['accno'];
		$branch = $_POST['branch'];
		$ifsccode = $_POST['ifsccode'];

		$sql = "UPDATE members SET mobile = '$mobile', email = '$email', gender = '$gender', phone_pay_no = '$phonepay', google_pay_no = '$googlepay', paytm_no = '$paytmno', bank_name = '$bankname', acc_no='$accno', branch='$branch',ifsc_code='$ifsccode' WHERE member_id = '$memberid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Profile updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}

	header('location: myprofile.php');
?>
