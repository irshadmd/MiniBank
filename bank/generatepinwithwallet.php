<?php
	include 'includes/session.php';
	if(isset($_POST['generatepinwithwallet'])){
		$memberid = $user['member_id'];
		$noofpins = $_POST['noofpins'];
		$totalcost = $noofpins*100;
    $money=0;
    $sql="SELECT * From wallet where member_id='$memberid'";
    $query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'oops!..Something went wrong.'.$memberid;
		}else{
      $sql="SELECT * From wallet where member_id='$memberid'";
      $query = $conn->query($sql);
      while($row = $query->fetch_assoc()){
        $money=$row['money'];
      }
      $newamount=$money-$totalcost;
      $sql = "UPDATE wallet SET money = '$newamount' WHERE member_id = '$memberid'";
      $query = $conn->query($sql);
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
