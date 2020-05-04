<?php
    include 'includes/session.php';

	if(isset($_POST['providehelp'])){
		$memberid = $user['member_id'];
        $membername=$user['name'];
        $selectedPin = $_POST['selectPin'];

        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randno = substr(str_shuffle($str_result), 0, 10);

        $sql="INSERT INTO provide_help(member_id,name,provide_help_no,date) VALUES('$memberid','$membername','$randno',NOW())";
        if($conn->query($sql)){
            $sql="INSERT INTO provide_request(member_id,name,provide_help_no,date) VALUES('$memberid','$membername','$randno',NOW())";
            $conn->query($sql);

            $sql="DELETE FROM pins WHERE pin = '$selectedPin'";
            $conn->query($sql);
        }else{
            $_SESSION['error'] = 'Error!!';
        }
        $_SESSION['success'] = 'Request sent! Wait for admin to approve your request.';
	}
	header('location: providehelp.php');
?>