<?php
    $datenow = date("Y-m-d H:i:s");
    $sql = "SELECT * FROM provide_help ";
    $query = $conn->query($sql);
    while($row = $query->fetch_assoc()){
      $id=$row['id'];
      $status=$row['status'];
      $approvedate=$row['approved_datetime'];

      if(($datenow>$approvedate) AND ($status=='pendingGet')){
        $sql = "UPDATE provide_help SET status = 'approved' WHERE id = '$id'";
        $query = $conn->query($sql);
      }
    }
?>
