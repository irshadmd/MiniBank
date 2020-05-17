<?php
    include 'includes/session.php';

	if(isset($_POST['providehelp'])){
		$memberid = $user['member_id'];
        $membername=$user['name'];
        $selectedPin = $_POST['selectPin'];
        $amount=200;
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randno = substr(str_shuffle($str_result), 0, 10);

        $sponcer_name="";
        $sponcer_id=$user['sponcer'];
        if($sponcer_id=='admin'){
            $sponcer_name='admin';
        }else{
            $sql="SELECT * FROM members WHERE member_id='$sponcer_id'";
            $query=$conn->query($sql);
            $row=$query->fetch_assoc();
            $sponcer_name=$row['name'];
        }

        $sql = "INSERT INTO provide_request(member_id,name,provide_help_no,sponcer_name,sponcer_id,amount,date) 
					VALUES('$memberid','$membername','$randno','$sponcer_name','$sponcer_id','$amount',NOW())";
        $conn->query($sql);

        $sql="DELETE FROM pins WHERE pin = '$selectedPin'";
        $conn->query($sql);

        $_SESSION['success'] = 'Request sent! Wait for admin to approve your request.';
        
	}
	header('location: providehelp.php');
?>