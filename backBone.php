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
if (isset($_POST['friendclick'])) {
	$friend_id = $_POST['friend_id'];
	echo $friend_id;
}
if (isset($_POST['delete'])) {
	$post_id1 = $_POST['post_id1'];
	$sql = "DELETE FROM post WHERE post_id = '$post_id1'";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST['search'])) {
	$sql = "SELECT * FROM student WHERE std_fname LIKE '%" . $_POST['name'] . "%' OR std_lname LIKE '%" . $_POST['name'] . "%'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['std_id'] != $_POST['std_id']) {
				$imgid = $row["img_id"];
				$sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
				$resultimg = mysqli_query($conn, $sqlimg);
				$rowimg = mysqli_fetch_assoc($resultimg);
				if ($rowimg == null) {
					if ($row['gender'] == 1) {
						$imgname	= "Design/Image/LogoPic0.jpg";
					} else {
						$imgname	= "Design/Image/LogoPic1.jpg";
					}
				} else {
					$imgname = $rowimg['img_name'];
				}
				echo "<a href='friendpage.php?account_id=" . $row["account_id"] . "' class='searchItem' friend_id='" . $row["std_id"] . "'>
							<img src='" . $imgname . "' alt=''/>
							<p>" . $row["std_fname"] . " " . $row["std_lname"] . "</p>
						</a>";
			}
		}
	} else {
		echo "<div class='notFound'><p>Not Found</p></div>";
	}
}
if (isset($_POST['search2'])) {
	$sql = "SELECT * FROM student WHERE std_fname LIKE '%" . $_POST['name'] . "%' OR std_lname LIKE '%" . $_POST['name'] . "%'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['std_id'] != $_POST['std_id']) {
				$imgid = $row["img_id"];
				$sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
				$resultimg = mysqli_query($conn, $sqlimg);
				$rowimg = mysqli_fetch_assoc($resultimg);
				if ($rowimg == null) {
					if ($row['gender'] == 1) {
						$imgname	= "Design/Image/LogoPic0.jpg";
					} else {
						$imgname	= "Design/Image/LogoPic1.jpg";
					}
				} else {
					$imgname = $rowimg['img_name'];
				}
				echo "<a href='friendpage.php?account_id=" . $row["account_id"] . "' class='searchItem2' friend_id='" . $row["std_id"] . "'>
							<img src='" . $imgname . "' alt=''/>
							<p>" . $row["std_fname"] . " " . $row["std_lname"] . "</p>
						</a>";
			}
		}
	} else {
		echo "<div class='notFound2'><p>Not Found</p></div>";
	}
}

if (isset($_POST['share'])) {
	$post_id = $_POST['sh_post_id'];
	$std_id = $_POST['sh_author_id'];
	$dateNow = date("Y-m-d H:i:s", time());
	$sql = "SELECT * FROM post WHERE post_id = '$post_id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sql = "INSERT INTO post (content, created_date, author , form_id , img_id, video_id) VALUES ('" . $row["content"] . "', '" . $dateNow . "', '" . $row["author"] . "', '" . $row["form_id"] . "', '" . $row["img_id"] . "', '" . $row["video_id"] . "')";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST['save'])) {
	$save_post_id = $_POST['save_post_id'];
	$save_keeper_id = $_POST['save_keeper_id'];
	$sql = "INSERT INTO saved_post (keeper_id , post_id) VALUES ('$save_keeper_id','$save_post_id')";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST['unSave'])) {
	$unSave_post_id = $_POST['unSave_post_id'];
	$unSave_keeper_id = $_POST['unSave_keeper_id'];
	$sql = "DELETE FROM saved_post WHERE keeper_id = '$unSave_keeper_id' AND post_id = '$unSave_post_id'";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST['tag'])) {
	echo 1;
}
if (isset($_POST['chatMessage'])) {
	$message = $_POST['message'];
	$message = nl2br($message);
	$std_id = $_POST['std_id'];
	$idAttr = $_POST['idAttr'];
	$fname = $_POST['fname'];
	$date = date("Y-m-d H:i:s", time());
	$sql = "INSERT INTO messages (id,from_user, to_user, message, time) VALUES ( '" . $std_id . "','" . $std_id . "', '" . $idAttr  . "', '" . $message . "','" . $date . "')";
	$result = mysqli_query($conn, $sql);
	$now = new DateTime();
	$post = new DateTime($date);
	$diff = $now->diff($post);
	$diff->format("%a");
	$diffday = $diff->format("%a");
	$diffhour = $diff->format("%h");
	$diffminute = $diff->format("%i");
	$diffsecond = $diff->format("%s");
	$diffdaystr = (string)$diffday;
	$diffhourstr = (string)$diffhour;
	$diffminutestr = (string)$diffminute;
	$diffsecondstr = (string)$diffsecond;
	$difftime = $diffsecondstr . "second ago";
	if ($diffdaystr == "0") {
		if ($diffhourstr == "0") {
			if ($diffminutestr == "0") {
				$difftime = $diffsecondstr . "s ago";
			} else {
				$difftime = $diffminutestr . "m ago";
			}
		} else {
			$difftime = $diffhourstr . "h ago";
		}
	} else {
		$difftime = $diffdaystr . "d ago";
	}
	echo '
	<div class="message-data align-right">
		<span class="message-data-time">' . $difftime . '</span> &nbsp; &nbsp;
		<span class="message-data-name">' . $fname . '</span> <i class="fa fa-circle me"></i>

	</div>
	<div class="message other-message float-right">' . $message . '</div>';
}