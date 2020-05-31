<?php
include 'includes/session.php';

$id = $_GET['id'];

$sql = "DELETE FROM news WHERE id='$id'";
if ($conn->query($sql)) {
    $_SESSION['success'] = 'News Deleted';
} else {
    $_SESSION['error'] = $conn->error;
}

header('location: addnews.php');
