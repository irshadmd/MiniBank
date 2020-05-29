<?php
    include 'includes/session.php';

	if(isset($_POST['pintransfer'])){
		$memberid = $user['member_id'];
        $transferto = $_POST['transferto'];
        $availablepin = $_POST['availablepin'];
        $amount = $_POST['amount'];
        $transferpin = strval($_POST['transferpin']);
        $transfername="";
        $membername=$user['name'];

        $sql="SELECT name From members where member_id='$transferto'";
        $query=$conn->query($sql);
        while($row = $query->fetch_assoc()){
            $transfername=$row['name'];
        }

        $sql="SELECT * From pins where member_id='$memberid' LIMIT $transferpin";
        $query = $conn->query($sql);
        while($row = $query->fetch_assoc()){
            $pin=$row['pin'];
            $sql = "UPDATE pins SET member_id = '$transferto' WHERE pin = '$pin'";
            $conn->query($sql);
            $sql="INSERT INTO transfer_pin(member_id,transfer_to,transfer_to_name,pin,amount,date) VALUES('$memberid','$transferto','$transfername','$pin','$amount',NOW())";
            $conn->query($sql);
        }
        
        $sql="INSERT INTO pin_report(member_id,name,received_from,received_from_name,noofpins,amount,date) VALUES('$transferto','$transfername','$memberid','$membername','$transferpin','$amount',NOW())";
        $conn->query($sql);
        $_SESSION['success'] = 'Pin Transfer successfully';
	}
	header('location: pintransfer.php');
?>