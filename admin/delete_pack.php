<?php
include 'includes/session.php';

$id = $_GET['id'];

$sql = "DELETE FROM pack WHERE id='$id'";
if ($conn->query($sql)) {
    $_SESSION['success'] = 'Pack Deleted';
} else {
    $_SESSION['error'] = $conn->error;
}

header('location: addpack.php');
