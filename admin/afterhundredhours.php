<?php
$datenow = date("Y-m-d H:i:s");
$sql = "SELECT * FROM provide_help ";
$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
  $id = $row['id'];
  $status = $row['status'];
  $memberid = $row['member_id'];
  $amount = $row['amount'];
  $approvedate = $row['approved_datetime'];
  $bool = $row['growth'];

  if (($datenow > $approvedate) and ($status == 'pendingGet')) {
    $sql = "UPDATE provide_help SET status = 'approved' , growth = 'true' WHERE id = '$id'";
    $query = $conn->query($sql);

    $g_amont = $amount * 2;

    $sql = "INSERT INTO growth(member_id,provide_amount,growth_amount) VALUES('$memberid','$amount','$g_amont')";
    $conn->query($sql);

    $sql = "SELECT * FROM wallet WHERE member_id='$memberid'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $grow_am = $row['growth'];
    $grow_am = $grow_am + $g_amont;

    $sql = "UPDATE wallet SET growth ='$grow_am' WHERE member_id='$memberid'";
    $conn->query($sql);
  } else if (($datenow > $approvedate) and ($status == 'approved') and ($bool == 'false')) {
    $sql = "UPDATE provide_help SET growth = 'true' WHERE id = '$id'";
    $query = $conn->query($sql);

    $g_amont = $amount * 2;

    $sql = "INSERT INTO growth(member_id,provide_amount,growth_amount) VALUES('$memberid','$amount','$g_amont')";
    $conn->query($sql);

    $sql = "SELECT * FROM wallet WHERE member_id = '$memberid'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $grow_am = $row['growth'];
    $grow_am = $grow_am + $g_amont;

    $sql = "UPDATE wallet SET growth = '$grow_am' WHERE member_id='$memberid'";
    $conn->query($sql);
  }
}
