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

if(isset($_POST['search'])){
	$sql = "SELECT * FROM student WHERE std_fname LIKE '%".$_POST['name']."%' OR std_lname LIKE '%".$_POST['name']."%'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			if($row['std_id'] != $_POST['std_id'] ){
				$imgid = $row["img_id"];
      		$sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
      		$resultimg = mysqli_query($conn, $sqlimg);
      		$rowimg = mysqli_fetch_assoc($resultimg);
      		// echo "<a href='#'class='friendpage' friend_id='".$row["std_id"]."' ><img src='" . $rowimg["img_name"] . "' alt=''/>" . $row["std_fname"] . " " . $row["std_lname"] . "</a>";
				echo $row['std_id'] . " " . $row['std_fname'] . " " . $row['std_lname'] . "<br/>";
			}else{
				echo "No result";
			}
	}
} else {
	echo "No result";
	}
}

if(isset($_POST['share'])){
	$post_id = $_POST['sh_post_id'];
	$std_id = $_POST['sh_author_id'];
	$dateNow = date("Y-m-d H:i:s", time());
	$sql = "SELECT * FROM post WHERE post_id = '$post_id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sql = "INSERT INTO post (content, created_date, author , form_id , img_id, video_id) VALUES ('".$row["content"]."', '".$dateNow."', '".$row["author"]."', '".$row["form_id"]."', '".$row["img_id"]."', '".$row["video_id"]."')";
	$result = mysqli_query($conn, $sql);
}
?>
