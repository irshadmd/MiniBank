<?php
	include 'includes/session.php';

	if(isset($_POST['id'])){
    $sql="SELECT member_id FROM members";
    $query = $conn->query($sql);
    $memstr_id="";
    $memberId="";
    $str_result = '0123456789';
    $ranid=substr(str_shuffle($str_result),0,6);
    $memberId='MB'.$ranid;
    
    $id = $_POST['id'];
		$sql = "SELECT * FROM pins WHERE id = '$id'";
		$query = $conn->query($sql);
    $pin="";
    $amount=0;
		while($row = $query->fetch_assoc()){
      $pin=$row['pin'];
      $amount=$row['amount'];
    }
    $json = array("pin"=>$pin, "mem"=>$memberId,"amount"=>$amount);
    echo json_encode($json);
	}
?>
