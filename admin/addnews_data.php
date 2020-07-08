<?php
include 'includes/session.php';
if (isset($_POST['addnews'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO news (title,message,date) VALUES('$title','$message','$date')";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'News added';
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: addnews.php');
