<?php
    include 'includes/session.php';
    
	if(isset($_POST['sendlink'])){

		$sendmember = $_POST['sendmember'];
        $str = explode("_", $sendmember);
        $sendmember=$str[0];
        $proid= $str[1];

        $id=$_GET['id'];
        $provideno=$_GET['pno'];
        
        $amount=0;
        $sendname="";
        $sendphoneno="";
        $getname = "";
        $getphoneno = "";

        $sql="SELECT * FROM provide_help WHERE provide_help_no='$provideno'";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $amount = $row['amount'];
        }

        $sql = "SELECT * FROM members WHERE member_id='$id'";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $sendname = $row['name'];
            $sendphoneno=$row['mobile'];
        }
        $sql = "SELECT * FROM members WHERE member_id='$sendmember'";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $getname = $row['name'];
            $getphoneno = $row['mobile'];
        }

        $sql = "UPDATE provide_help SET complete = 'true',status='approved' WHERE provide_help_no = '$provideno'";
        if ($conn->query($sql)) {
            $sql = "INSERT INTO send_donation (member_id,send_id,name,phoneno,amount,date) 
                VALUES('$sendmember','$id','$sendname','$sendphoneno','$amount',NOW())";
            $conn->query($sql); 
            $sql = "INSERT INTO get_donation (member_id,get_id,name,phoneno,amount,provide_id,date) 
                VALUES('$id','$sendmember','$getname','$getphoneno','$amount','$proid',NOW())";
            $conn->query($sql);
                $_SESSION['success'] = 'Sent successfully';
        }else{
            $_SESSION['error'] = "Error";
        }
	}else{
        $_SESSION['error'] = "Error";
    }

	header('location: gethelpconfirm_list.php');
