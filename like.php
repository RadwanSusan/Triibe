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
		$likenum = $likes_count;
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
		$likenum = $likes_count;
}
if (isset($_POST['checklike'])) {
		$post_id = $_POST['post_id'];
		$std_id = $_POST['std_id'];
		$sql = "SELECT * FROM post_likes WHERE post_id = '$post_id' AND std_id = '$std_id'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if ($count == 1) {
			echo "liked";
		}
		else {
			echo "NOTLiked";
		}
}
if (isset($_POST['checklikecount'])) {
		$post_id = $_POST['post_id'];
		$post_id2 = $_POST['post_id2'];
		$post_like_count = "SELECT COUNT(*) FROM post_likes WHERE post_id = '$post_id'";
		$result2 = mysqli_query($conn, $post_like_count);
		$row2 = mysqli_fetch_assoc($result2);
		$likenum = $row2['COUNT(*)'];
		echo $likenum;
}
?>
