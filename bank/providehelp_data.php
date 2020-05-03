<?php
    include 'includes/session.php';

	if(isset($_POST['providehelp'])){
		$memberid = $user['member_id'];
        $membername=$user['name'];
        $selectedPin = $_POST['selectPin'];

        $sql="INSERT INTO provide_help(member_id,name,date) VALUES('$memberid','$membername',NOW())";
        if($conn->query($sql)){
            $sql="INSERT INTO provide_request(member_id,name,date) VALUES('$memberid','$membername',NOW())";
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