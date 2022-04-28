<?php
include_once "connection.php";
if (isset($_POST['like'])) {
		$post_id = $_POST['post_id'];
		$std_id = $_POST['std_id'];
		$sql = "SELECT * FROM post_likes WHERE post_id = '$post_id' AND std_id = '$std_id'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if ($count == 0) {
			$sql = "INSERT INTO post_likes (post_id, std_id) VALUES ('$post_id', '$std_id')";
			$result = mysqli_query($conn, $sql);
			$SQL2 = "SELECT likes_count FROM post WHERE post_id = '$post_id'";
			$result2 = mysqli_query($conn, $SQL2);
			$row2 = mysqli_fetch_assoc($result2);
			$likes_count = $row2['likes_count'];
			$likes_count++;
			$sql = "UPDATE post SET likes_count = '$likes_count' WHERE post_id = '$post_id'";
			$result = mysqli_query($conn, $sql);
		}
}
if (isset($_POST['unlike'])) {
		$post_id = $_POST['post_id'];
		$std_id = $_POST['std_id'];
		$sql = "SELECT * FROM post_likes WHERE post_id = '$post_id' AND std_id = '$std_id'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if ($count == 1) {
			$sql = "DELETE FROM post_likes WHERE post_id = '$post_id' AND std_id = '$std_id'";
			$result = mysqli_query($conn, $sql);
			$SQL2 = "SELECT likes_count FROM post WHERE post_id = '$post_id'";
			$result2 = mysqli_query($conn, $SQL2);
			$row2 = mysqli_fetch_assoc($result2);
			$likes_count = $row2['likes_count'];
			$likes_count--;
			$sql = "UPDATE post SET likes_count = '$likes_count' WHERE post_id = '$post_id'";
			$result = mysqli_query($conn, $sql);
		}
}
if (isset($_POST['refreshLikeCount'])) {
		$post_id = $_POST['post_id'];
		$post_like_count = "SELECT COUNT(*) FROM post_likes WHERE post_id = '$post_id'";
		$result = mysqli_query($conn, $post_like_count);
		$row = mysqli_fetch_assoc($result);
		$likenum = $row['COUNT(*)'];
		echo $likenum;
}

if (isset($_POST['friendclick'])){
	$friend_id = $_POST['friend_id'];
	echo $friend_id;
}

if(isset($_POST['delete'])){
	$post_id1 = $_POST['post_id1'];
	$sql = "DELETE FROM post WHERE post_id = '$post_id1'";
	$result = mysqli_query($conn, $sql);
}
?>
