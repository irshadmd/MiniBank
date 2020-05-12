<?php
    include 'includes/session.php';
    
	if(isset($_POST['sendlink'])){

		$sendmember = $_POST['sendmember'];
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

        $sql = "UPDATE provide_help SET complete = 'true' WHERE provide_help_no = '$provideno'";
        if ($conn->query($sql)) {
            $sql = "INSERT INTO send_donation (member_id,send_id,name,phoneno,amount,date) 
                VALUES('$id','$sendmember','$getname','$getphoneno','$amount',NOW())";
            $conn->query($sql); 
            $sql = "INSERT INTO get_donation (member_id,get_id,name,phoneno,amount,date) 
                VALUES('$sendmember','$id','$sendname','$sendphoneno','$amount',NOW())";
            $conn->query($sql);
                $_SESSION['success'] = 'successfully';
        }else{
            $_SESSION['error'] = "Error";
        }
	}else{
        $_SESSION['error'] = "Error";
    }

	header('location: sendlinks.php');
