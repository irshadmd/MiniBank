<?php
	include 'includes/session.php';

	if(isset($_POST['id'])){
        $key=$_POST['id'];
        $sql="SELECT * FROM members WHERE member_id='$key'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>
