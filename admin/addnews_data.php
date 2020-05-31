<?php
include 'includes/session.php';
if (isset($_POST['addnews'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];

    $sql = "INSERT INTO news (title,message) VALUES('$title','$message')";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'News added';
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: addnews.php');
