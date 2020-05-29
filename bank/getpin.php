<?php
include 'includes/session.php';

$pack_val = $_POST['pack_val'];

$ops = "";

$member = $user['member_id'];
$sql = "SELECT * FROM pins WHERE member_id = '$member' AND amount='$pack_val'";
$query = $conn->query($sql);
$total_pin= $query->num_rows;
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $ops.='<option value="'. $row["pin"] .'">'. $row["pin"] .'</option>';
    }
} else {
    $ops .= "No categories were found!";
}
$json = array("ops" => $ops, "total_pin" => $total_pin);
echo json_encode($json);

?>