<?php
    $datenow=date('Y-m-d');
    $sql = "SELECT * FROM money ";
    $query = $conn->query($sql);
    while($row = $query->fetch_assoc()){
      $memberid=$row['member_id'];
      $amount=$row['amount'];
      $newamount=$amount*2;
      $amountdate=$row['date'];
      $amountdateafter4days=date('Y-m-d',strtotime($amountdate. ' + 4 days'));
      if($datenow>$amountdateafter4days){
        $sql = "UPDATE money SET amount = '$newamount' WHERE member_id = '$memberid'";
        $query = $conn->query($sql);
      }
    }
?>
