<?php
	include 'includes/session.php';
	if(isset($_POST['sendlink'])){

		$sendmember = $_POST['sendmember'];
        $id=$_GET['id'];
        $provideno=$_GET['pno'];
        
        

	}

	header('location: sendlinks.php');
