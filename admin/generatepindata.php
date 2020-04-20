<?php
	include 'includes/session.php';
	if(isset($_POST['generatepin'])){
		$memberid = $_POST['memberid'];
		$noofpins = $_POST['noofpins'];
    $sql="SELECT * From members where member_id='$memberid'";
    $query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Incorrect Member Id';
		}else{
      for ($i = 0; $i <$noofpins; $i++){
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $pin=substr(str_shuffle($str_result),0,8);
        $sql="INSERT INTO pins(member_id,pin) VALUES('$memberid','$pin')";
        $query = $conn->query($sql);
      }
      $_SESSION['success'] = 'Pin Generated successfully';
    }
	}
	header('location: generatepin.php');
?>
