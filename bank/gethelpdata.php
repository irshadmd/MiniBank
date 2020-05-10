<?php
    include 'includes/session.php';

	if(isset($_POST['gethelp'])){
		$memberid = $user['member_id'];
        $membername=$user['name'];

        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randno = substr(str_shuffle($str_result), 0, 10);

        $sql="INSERT INTO get_help(member_id,name,gethelp_no,date) VALUES('$memberid','$membername','$randno',NOW())";
        if($conn->query($sql)){
        $_SESSION['success'] = 'Request sent! Wait for admin to forward your request.';
        }else{
            $_SESSION['error'] = 'Error!!';
        }
	}
	header('location: gethelp.php');
