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

		while($row = $query->fetch_assoc()){
      $pin=$row['pin'];
    }
    $json = array("pin"=>$pin, "mem"=>$memberId);
    echo json_encode($json);
	}
?>
