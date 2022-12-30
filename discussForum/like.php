<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: ../login.php');
}
// connect the datbase
include('../connectDB/config.php');

// print_r($_POST);

$type = mysqli_real_escape_string($conn, $_POST['type']);
$forum_id = mysqli_real_escape_string($conn, $_POST['forum_id']);

$sql = "SELECT * FROM forumpost WHERE forum_id = $forum_id";
$result = mysqli_query($conn, $sql) or die("Query Failed.");
$row = mysqli_fetch_assoc($result);

// if setlikes = 0, then the user has not liked the post
// if setlikes = 1, then the user has liked the post
// if dislikes = 0, then the user has not disliked the post
// if dislikes = 1, then the user has disliked the post

if ($type == 'like') {
    if ($row['setlikes'] == 0) {
        $sql = "UPDATE forumpost SET likes = likes + 1, setlikes = 1 WHERE forum_id = $forum_id";
        // echo '<script>alert("You have liked this post")</script>';
    } else{
        // $sql = "UPDATE forumpost SET likes = likes - 1, setlikes = 0 WHERE forum_id = $forum_id";
        echo '<script>alert("You have liked this post")</script>';
    }
}

if ($type == 'dislike') {
    if ($row['setdislikes'] == 0) {
        $sql = "UPDATE forumpost SET dislikes = dislikes - 1, setdislikes = 1 WHERE forum_id = $forum_id";
        //echo '<script>alert("You have disliked this post")</script>';
    } else {
        // $sql = "UPDATE forumpost SET dislikes = dislikes + 1, setdislikes = 0 WHERE forum_id = $forum_id";
        echo '<script>alert("You have disliked this post")</script>';
    }
}

$result = mysqli_query($conn, $sql) or die("Query Failed.");

echo '<script>window.location.href = "index.php";</script>';

// print_r($type);
// print_r($forum_id);

// if(isset($_POST['type']) &&  $_POST['type'] != '' && isset($_POST['forum_id']) && $_POST['forum_id'] > 0){
//     $type = mysqli_real_escape_string($conn, $_POST['type']);
//     $forum_id = mysqli_real_escape_string($conn, $_POST['forum_id']);
    
//     if ($type == 'like') {
//         if(isset($_COOKIE['like_'.$forum_id])){
//             setcookie('dislike_'.$forum_id, "yes", time() + 60 );
//             $sql = "UPDATE forumpost SET likes = likes - 1 WHERE forum_id = $forum_id";
//             echo '<script>alert("You have already liked this post")</script>' ;
//         }else{
//             setcookie('dislike_'.$forum_id, "yes", time() + 60 );
//             $sql = "UPDATE forumpost SET likes = likes + 1 WHERE forum_id = $forum_id";
//             echo '<script>alert("You have liked this post")</script>' ;
//         }
//     }
    
//     if($type == 'dislike'){
//         if(isset($_COOKIE['dislike_'.$forum_id])){
//             setcookie('dislike_'.$forum_id, "yes", time() + 60 );
//             $sql = "UPDATE forumpost SET dislikes = dislikes - 1 WHERE forum_id = $forum_id";
//             echo '<script>alert("You have already disliked this post")</script>' ;
//         }else{
//             setcookie('dislike_'.$forum_id, "yes", time() + 60 );
//             $sql = "UPDATE forumpost SET dislikes = dislikes + 1 WHERE forum_id = $forum_id";
//             echo '<script>alert("You have disliked this post")</script>' ;
//         }
//     }

//     $result = mysqli_query($conn, $sql) or die("Query Failed.");

// }
    

?>