<?php
	include 'includes/session.php';
	if(isset($_POST['generatepinwithwallet'])){
		$memberid = $user['member_id'];
		$noofpins = $_POST['noofpins'];
		$totalcost = $noofpins*100;
    $money=0;
    $narration="Pin Generated";
    $sql="SELECT * From wallet where member_id='$memberid'";
    $query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'oops!..Something went wrong.';
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

      $sql = "INSERT INTO working_wallet(member_id,debit,narration) VALUES('$memberid','$totalcost','$narration')";
      if($conn->query($sql)){
        $_SESSION['success'] = 'Pin Generated successfully';
      }else{
      $_SESSION['error'] =$conn->error.'Error.';
      }

    }
	}
	header('location: generatepin.php');
?>
