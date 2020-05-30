<?php
	include 'includes/session.php';

    $id=$_GET['id'];

    $sql="SELECT * FROM members WHERE member_id='$id'";
    $query=$conn->query($sql);
    $row=$query->fetch_assoc();
    $memberid = $row['member_id'];
    $password =$row['password'];
    $name = $row['name'];
    $mobile = $row['mobile'];
    $email = $row['email'];
    $gender = $row['gender'];
    $phonepay = $row['phone_pay_no'];
    $googlepay = $row['google_pay_no'];
    $paytmno = $row['paytm_no'];
    $bankname = $row['bank_name'];
    $accno = $row['acc_no'];
    $branch = $row['branch'];
    $ifsccode = $row['ifsc_code'];
    $sponcer = $row['sponcer'];
    $joiningdate = $row['joining_date'];
    $level = $row['level'];
    $sponcer_info = $row['sponcer_info'];

    $sql = "INSERT INTO block(member_id,password,name,mobile,email,gender,phone_pay_no,google_pay_no,paytm_no,bank_name,acc_no,branch,ifsc_code,sponcer,joining_date,level,sponcer_info)
        VALUES('$memberid','$password','$name','$mobile','$email','$gender','$phonepay','$googlepay','$paytmno','$bankname','$accno','$branch','$ifsccode','$sponcer','$joiningdate','$level','$sponcer_info')
    ";
	if($conn->query($sql)){
        $sql="DELETE FROM members WHERE member_id='$id'";
        $conn->query($sql);
		$_SESSION['success'] = 'User Blocked';
	}
	else{
		$_SESSION['error'] = $conn->error;
	}

header('location: users_list.php');
