<?php
include_once "connection.php";
session_start();
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
	$sql = "SELECT * FROM post WHERE post_id = '$post_id1'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if ($row["img_id"] != null) {
		$sqlimg = "DELETE FROM img WHERE img_id = '$row[img_id]'";
		$resultimg = mysqli_query($conn, $sqlimg);
	}
	if ($row["video_id"] != null) {
		$sqlvid = "DELETE FROM video WHERE video_id = '$row[video_id]'";
		$resultvid = mysqli_query($conn, $sqlvid);
	}
	if ($row["fileId"] != null) {
		$sqlvid = "DELETE FROM files WHERE fileId = '$row[fileId]'";
		$resultvid = mysqli_query($conn, $sqlvid);
	}
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
				echo "<a href='chat.php?account_id=" . $row["std_id"] . "' class='searchItem2' friend_id='" . $row["std_id"] . "'>
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
	$sql = "INSERT INTO post (content, created_date, author , form_id , img_id, video_id, share_original,share_new) VALUES ('" . $row["content"] . "', '" . $dateNow . "', '" . $row["author"] . "', '" . $row["form_id"] . "', '" . $row["img_id"] . "', '" . $row["video_id"] . "','" . $row["author"] . "','" . $_SESSION["std_id"] . "')";
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
if (isset($_POST['getcomment'])) {
	$post_id = $_POST['post_id'];
	$std_id = $_POST['std_id'];
	$author = $_POST['author'];
	$sql = "SELECT * FROM comment WHERE post_id = '$post_id' order by created_date";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$sql = "SELECT * FROM student WHERE std_id = '" . $row["post_std_id"] . "'";
			$result2 = mysqli_query($conn, $sql);
			$row2 = mysqli_fetch_assoc($result2);
			$sql = "SELECT * FROM img WHERE img_id = '" . $row2["img_id"] . "'";
			$result4 = mysqli_query($conn, $sql);
			$row4 = mysqli_fetch_assoc($result4);
			if (isset($row4["img_name"])) {
				$imgname = $row4["img_name"];
			} else {
				if ($row2["gender"] == 1) {
					$imgname = "Design\Image\LogoPic0.jpg";
				} else {
					$imgname = "Design\Image\LogoPic1.jpg";
				}
			}
			echo "<p>'" . $row2['std_fname'] . "" . $row2['std_lname'] . "'</p><img src='" . $imgname . "'><p>'" . $row['content'] . "'</p><p>'" . $row['created_date'] . "'</p>";
		}
	}
}
if (isset($_POST['commentsend'])) {
	$post_id = $_POST['post_id'];
	$std_id = $_POST['std_id'];
	$author = $_POST['author'];
	$commentContent = $_POST['comment'];
	$date = date("Y-m-d H:i:s", time());
	$sql = "INSERT INTO comment (content , post_id, post_std_id, author,  created_date) VALUES ('" . $commentContent . "' , '" . $post_id . "' , '" . $std_id . "' , '" . $author . "' ,  '" . $date . "')";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST['MPContact'])) {
	$MPID = $_POST['MPID'];
	$sql = "SELECT phone_number FROM market_post WHERE market_post_id = '$MPID'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (isset($row["phone_number"])) {
		echo "<p> Phone Number : " . $row['phone_number'] . "</p>";
	} else {
		echo " <p>No Phone Number</p>";
	}
}
if (isset($_POST['SRGS'])) {
	$sql = "SELECT id FROM students WHERE Std_No = '" . $_SESSION['std_id'] . "'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$_SESSION["userid"] = $row['id'];
}
if (isset($_POST['add_friends'])) {
	$user_id = $_POST['user_id'];
	$date = date("Y-m-d H:i:s");
	$sql = "INSERT INTO friends_request (sender,receiver,date) VALUES ('" . $_SESSION['std_id'] . "','" . $user_id . "','$date')";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST['RequestSent'])) {
	$user_id = $_POST['user_id'];
	$sql = "DELETE FROM friends_request WHERE sender = '" . $_SESSION['std_id'] . "' AND receiver = '" . $user_id . "'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
}
if (isset($_POST['checkFriendStatus'])) {
	$user_id = $_POST['user_id'];
	$sqlIsFriendRequestACD = "SELECT * FROM friends_request WHERE sender = '$user_id' AND receiver = '" . $_SESSION["std_id"] . "'";
	$resultIsFriendRequestACD = mysqli_query($conn, $sqlIsFriendRequestACD);
	$rowIsFriendRequestACD = mysqli_fetch_assoc($resultIsFriendRequestACD);
	if (isset($rowIsFriendRequestACD)) {
		$IsFriend = 3;
		echo $IsFriend;
	} else {
		$sqlIsFriendRequest = "SELECT * FROM friends_request WHERE sender = '" . $_SESSION["std_id"] . "' AND receiver = '$user_id'";
		$resultIsFriendRequest = mysqli_query($conn, $sqlIsFriendRequest);
		$rowIsFriendRequest = mysqli_fetch_assoc($resultIsFriendRequest);
		if (isset($rowIsFriendRequest)) {
			$IsFriend = 2;
			echo $IsFriend;
		} else {
			$sqlIsFriend = "SELECT * FROM friends WHERE user_id = '" . $user_id . "' AND friend_id = '" . $_SESSION["std_id"] . "'";
			$resultIsFriend = mysqli_query($conn, $sqlIsFriend);
			$rowIsFriend = mysqli_fetch_assoc($resultIsFriend);
			if (isset($rowIsFriend)) {
				$IsFriend = 1;
				echo $IsFriend;
			} else {
				$IsFriend = 0;
				echo $IsFriend;
			}
		}
	}
}
if (isset($_POST["AcceptRequest"])) {
	$user_id = $_POST['user_id'];
	$sql = "DELETE FROM friends_request  WHERE sender = '$user_id' AND receiver = '" . $_SESSION["std_id"] . "'";
	$result = mysqli_query($conn, $sql);
	$sql = "INSERT INTO friends (user_id,friend_id) VALUES ('$user_id','" . $_SESSION["std_id"] . "')";
	$result = mysqli_query($conn, $sql);
	$sql = "INSERT INTO friends (user_id,friend_id) VALUES ('" . $_SESSION["std_id"] . "','$user_id')";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST["RejectRequest"])) {
	$user_id = $_POST['user_id'];
	$sql = "DELETE FROM friends_request  WHERE sender = '$user_id' AND receiver = '" . $_SESSION["std_id"] . "'";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST['Friends'])) {
	$user_id = $_POST['user_id'];
	$sql = "DELETE FROM friends  WHERE user_id = '$user_id' AND friend_id = '" . $_SESSION["std_id"] . "'";
	$result = mysqli_query($conn, $sql);
	$sql = "DELETE FROM friends  WHERE user_id = '" . $_SESSION["std_id"] . "' AND friend_id = '$user_id'";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST['logout'])) {
	unset($_SESSION);
	session_destroy();
	session_write_close();
}
if (isset($_POST['notificationsClear'])) {
	$sql = "UPDATE friends_request SET status = 1 WHERE receiver = '" . $_SESSION['std_id'] . "'";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST['editPost'])) {
	$editContent = $_POST['editContent'];
	$post_id = $_POST['post_id'];
	$author_id = $_POST['author_id'];
	if ($author_id == $_SESSION['std_id']) {
		if ($editContent != "") {
			$sql = "UPDATE post SET content = '$editContent' WHERE post_id = '$post_id' AND author = '$author_id'";
			$result = mysqli_query($conn, $sql);
			echo "success";
		} else {
			echo "<script>alert('Please Enter Content');</script>";
		}
	} else {
		echo "<script>alert('You are not the author of this post');</script>";
	}
}
if (isset($_POST["getStory"])) {
	$author_id = $_POST['author_id'];
	$storyArray = array();
	$sql = "SELECT * FROM story WHERE author = '$author_id'";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($storyArray, $row);
	}
  $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "' AND friend_id != $author_id";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row1 = mysqli_fetch_assoc($result)) {
	$sql1 = "SELECT * FROM story WHERE author = '" . $row1["friend_id"] . "' order by author ";
	$result1 = mysqli_query($conn, $sql1);
	while ($row2 = mysqli_fetch_assoc($result)) {
			array_push($storyArray, $row2);
		}
	}
}
	echo json_encode($storyArray);
}
