<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: ../login.php');
}
// connect the datbase
include('../connectDB/config.php');

$user_id = $_SESSION['user_id'];
$forum_id = $_SESSION['forum_id'];



// echo "<script>alert('You have liked this post!'); window.location.href='index.php';</script>";

//print the forum id

echo $forum_id;

?>