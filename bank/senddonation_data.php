<?php
    include 'includes/session.php';

	if(isset($_POST['senddonation'])){
		$senddonationid=$_GET['id'];
        $sendid = $_POST['memberid'];
        $name=$_POST['name'];
        $phoneno=$_POST['phone'];
        $amount=$_POST['amount'];

        $sql="INSERT INTO donation_reciept(send_donation_id,member_id,name,phoneno,amount,trn_date) 
            VALUES('$senddonationid','$sendid','$name','$phoneno','$amount',NOW())";
        if($conn->query($sql)){
            $sql = "UPDATE send_donation SET status = 'approved' WHERE id = '$senddonationid'";
            $conn->query($sql);

             $_SESSION['success'] = 'Sent Successfully.';
        }else{
            $_SESSION['error'] = 'Error!!';
        }
	}
	header('location: home.php');
