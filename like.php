<?php
function like($post_id){

include_once "connection.php";
session_start();

  $sql = "INSERT INTO post_likes (post_id, std_id) VALUES ('" . $post_id . "', '" . $_SESSION["login_user"] . "')";
  $result3 = mysqli_query($conn, $sql);
}
?>