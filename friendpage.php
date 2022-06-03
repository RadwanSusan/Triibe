<?php
include_once "connection.php";
session_start();
$id = $_GET['account_id'];
$sql = "SELECT * FROM student WHERE account_id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sqlimg = "SELECT * FROM img WHERE img_id = '$row[img_id]'";
$resultimg = mysqli_query($conn, $sqlimg);
$rowimg = mysqli_fetch_assoc($resultimg);
if (isset($rowimg["img_name"])) {
  $FriendImgName = $rowimg["img_name"];
} else {
  if ($row["gender"] == 1) {
    $FriendImgName = "Design\Image\LogoPic0.jpg";
  } else {
    $FriendImgName = "Design\Image\LogoPic1.jpg";
  }
}
$sqlcover = "SELECT img_name FROM profile_info WHERE std_id = '" . $row["std_id"] . "'";
$resultcover = mysqli_query($conn, $sqlcover);
$rowcover = mysqli_fetch_assoc($resultcover);
if (isset($rowcover["img_name"])) {
  $FriendcoverName = $rowcover["img_name"];
} else {
  if ($row["gender"] == 1) {
    $FriendcoverName = "Design\Image\LogoPic0.jpg";
  } else {
    $FriendcoverName = "Design\Image\LogoPic1.jpg";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Triibe profile</title>
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
  <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
  <link rel="stylesheet" href="bootstrap-css/all.min.css" />
  <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
  <link id="theme" rel="stylesheet" href="bootstrap-css/personal.css" />
  <script src="node_modules/alertifyjs/build/alertify.min.js"></script>
  <script type="text/javascript">
    function alert(message) {
      alertify.defaults.glossary.title = 'My Title';
      alertify.alert("Triibe", message);
    }

    function confirm(message, function1, function2) {
      alertify.defaults.glossary.title = 'My Title';
      alertify.confirm("Triibe", message, function1, function2);
    }
  </script>
</head>

<body>
  <nav class="nav">
    <div class="nav-left">
      <div class="box">
        <img src="Design/Image/home-images/images/logo.svg" alt="logoLight" class="logoLight" /> <img src="Design/Image/home-images/images/logo2.svg" alt="logoDark" class="logoDark" />
        <p>Triibe</p>
      </div>
      <div class="search-box"> <img src="Design/Image/home-images/images/Search-Icon.svg" alt="search" />
        <input type="text" placeholder="Search" id="search" autocomplete="off" std_id="<?php echo $_SESSION['std_id']; ?>" />
      </div>
      <div class="searchArea"></div>
    </div>
    <div class="nav-right">
      <ul>
        <a class="list2" href="list.php">
          <li class="more-list">
            <img class="SettingsIcon-Light" src="Design/Image/home-images/images/more-list.svg" alt="settingIcon" />
          </li>
        </a>
        <li class="settingsList">
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/Settings-icon.svg" alt="settingIcon" />
          <img class="SettingsIcon-Dark" src="Design/Image/home-images/images/Settings-icon2.svg" alt="settingIcon" />
        </li>
        <div class="settings" style="display: none;">
          <p>Settings</p>
          <div class="forget-pass">
            <p>Change password</p>
          </div>
          <div class="Logout">
            <p>Logout</p>
          </div>
        </div>

        <li class="map">
          <img class="mapIcon-Light" src="Design/Image/home-images/images/mapIcon.svg" alt="mapIcon" />
          <img class="mapIcon-Dark" src="Design/Image/home-images/images/mapIcon2.svg" alt="mapIcon" />
        </li>

        <li class="theme">
          <img class="themeLight" src="Design/Image/home-images/images/theme-light.svg" alt="themeLight" />
          <img class="themeDark" src="Design/Image/home-images/images/theme-dark.svg" alt="themeDark" />
        </li>
        <li class="NotificationsList">
          <?php
          $sql = "SELECT * FROM friends_request WHERE receiver = '" . $_SESSION["std_id"] . "' AND status = '0' ";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            $count = mysqli_num_rows($result);
            echo "<span class='notificationCount'>$count</span>";
          }
          ?>
          <img class="notificationIcon-light" src="Design/Image/home-images/images/notification-logo.svg" alt="notificationIcon" />
          <img class="notificationIcon-dark" src="Design/Image/home-images/images/notification-logo2.svg" alt="notificationIcon1" />
        </li>
        <div class="Notifications" style="display: none;">
          <p>Notifications</p>
          <?php
          $sql = "SELECT * FROM friends_request WHERE receiver = '" . $_SESSION["std_id"] . "'order by date desc";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row1 = mysqli_fetch_assoc($result)) {
              $sql1 = "SELECT * FROM student WHERE std_id = '" . $row1["sender"] . "'";
              $result1 = mysqli_query($conn, $sql1);
              if (mysqli_num_rows($result1) > 0) {
                while ($row2 = mysqli_fetch_assoc($result1)) {
                  $now = new DateTime();
                  $post = new DateTime($row1["date"]);
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
                  echo "<a href='friendpage.php?account_id=" . $row2["account_id"] . "'><div class='NotificationBox'>
                  <p>$difftime</p>
                        <p>" . $row2['std_fname'] . " " . $row2["std_lname"] . " sent you a friend request </p>
                 </div></a>";
                }
              }
            }
          }

          ?>
        </div>
        <li class="chat">
          <img class="chatLight" src="Design/Image/home-images/images/chat-icon.svg" alt="image" />
          <img class="chatDark" src="Design/Image/home-images/images/chat-icon2.svg" alt="image" />
        </li>
        <li class="more-list">
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/more2.svg" alt="settingIcon" />
        </li>
      </ul>
      <div class="nav-user-icon online">
        <a href='personal.php'><img src="<?php echo $_SESSION["personalProfile"] ?>" /></a>
        <a href='personal.php'>
          <div class="name">
            <?php echo $_SESSION["std_fname"]; ?>
          </div>
        </a>
      </div>
    </div>
  </nav>
  <div class="content1">
    <div class="top">
      <div>
        <img class="coverImage" src="<?php echo $FriendcoverName ?> " alt="">
      </div>
      <!-- <img src="Design/Image/home-images/images/Linear_Layer.svg" alt=""> -->
    </div>
    <div class="bottom-content">
      <div class="bottom">
        <div class="left-bottom">
          <img class="left-bottom-img" src="<?php echo $FriendImgName ?>" alt="">
          <div class="info">
            <div class="name-bottom">
              <p><?php echo $row["std_fname"] . " " . $row["std_lname"] ?></p>
            </div>
            <div class="number-friends"><?php
                                        $sqlfriend = "SELECT * FROM friends WHERE user_id = '" . $row["std_id"] . "'";
                                        $resultfriend = mysqli_query($conn, $sqlfriend);
                                        $countfriend = mysqli_num_rows($resultfriend);
                                        echo $countfriend . " Friends";
                                        ?>
            </div>
          </div>
        </div>
        <div class="right-bottom">
          <?php
          echo '
          <div class="add-friends" data-user_id="' . $row["std_id"] . '">
            <img src="Design/Image/home-images/images/Group-add.svg" alt="">
            <p>Add Friends</p>
          </div>
          <div class="RequestSent"  data-user_id="' . $row["std_id"] . '">
            <img src="Design/Image/home-images/images/Group-add.svg" alt="">
            <p>Cancel Request</p>
          </div>
            <div class="Friends" data-user_id="' . $row["std_id"] . '">
            <img src="Design/Image/home-images/images/Group-add.svg" alt="">
            <p>Friends</p>
          </div>
          <div class="AcceptRequest" data-user_id="' . $row["std_id"] . '">
            <img src="Design/Image/home-images/images/Group-add.svg" alt="">
            <p>Accept Request</p>
          </div>
          <div class="RejectRequest" data-user_id="' . $row["std_id"] . '">
          <img src="Design/Image/home-images/images/Group-add.svg" alt="">
          <p>Reject Request</p>
        </div>
          ';
          ?>
        </div>
      </div>
    </div>
    <div class="line-content">
      <div class="line"></div>
    </div>
    <div class="list-photo-content">
      <div class="list">
        <a href="<?php echo " friendpage.php?account_id=" . $id; ?>" class="list-posts">Posts</a>
        <a href="<?php echo " friendpage.php?account_id=" . $id; ?>" class="list-friends">Friends</a>
        <a href="<?php echo " friendpage.php?account_id=" . $id; ?>" class="list-photos">Photos</a>
        <a href="<?php echo " friendpage.php?account_id=" . $id; ?>" class="list-videos">Videos</a>
      </div>
    </div>
    <div class="content-personal-post">
      <div class="content-left">
        <?php
        $sql = "SELECT * FROM profile_info WHERE std_id = '" . $row["std_id"] . "'";
        $result = mysqli_query($conn, $sql);
        $rowinfo = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result)) {
          echo ' <div class="left-post">
          <h1>Bio</h1>
          <div class="title-bio">
            <div class="name">' . $rowinfo["discerption"] . '</div>
            <img src="Design/Image/home-images/images/bio-title.svg" alt="">
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio1.svg" alt="">
            <div class="name name2">' . $rowinfo["uni"] . '</div>
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio2.svg" alt="">
            <div class="name">Lives in ' . $rowinfo["lives_in"] . '</div>
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio3.png" alt="">
            <div class="name">From ' . $rowinfo["fromto"] . '</div>
          </div>';

          if (!isset($rowinfo['instagram']) || $rowinfo['instagram'] == "") {
            echo "";
          } else {
            echo "<div class='bio bio5'>
            <a href='" . $rowinfo['instagram'] . "'><img src='Design/Image/home-images/images/bio4.png' alt=''></a>
          </div>";
          }


          if (!isset($rowinfo["github"]) || $rowinfo["github"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["github"] . '><img src="Design/Image/home-images/images/bio5.png" alt=""></a>
          </div>';
          }
          if (!isset($rowinfo["facebook"]) || $rowinfo["facebook"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["facebook"] . '><img src="Design/Image/home-images/images/iconmonstr-facebook-4.svg" alt=""></a>
          </div>';
          }
          if (!isset($rowinfo["twitter"]) || $rowinfo["twitter"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["twitter"] . '><img src="Design/Image/home-images/images/iconmonstr-twitter-4.svg" alt=""></a>
          </div>';
          }
          if (!isset($rowinfo["linkedin"]) || $rowinfo["linkedin"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["linkedin"] . '><img src="Design/Image/home-images/images/iconmonstr-linkedin-3" alt=""></a>
          </div>';
          }
          if (!isset($rowinfo["snapchat"]) || $rowinfo["snapchat"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["snapchat"] . '><img src="Design/Image/home-images/images/iconmonstr-snapchat-1" alt=""></a>
          </div>';
          }

          echo '</div>';
        } else {
          echo '<div class="left-post">
          <h1>Bio</h1>
          <div class="title-bio">
            <div class="name">No Bio</div>
            <img src="Design/Image/home-images/images/bio-title.svg" alt="">
            </div>
            </div>';
        }
        ?>
        <div class="left-post">
          <div class="photo-see">

            <h1>Photo</h1>
            <a href="<?php echo " friendpage.php?account_id=" . $id; ?>">
              <div class="see-more seeMorePhoto">See more</div>
            </a>
          </div>
          <div class="Photo">
            <?php
            $sql = "SELECT * FROM img WHERE album_id = '" . $row["std_id"] . "' LIMIT 4";
            $result = mysqli_query($conn, $sql);
            while ($rowimg = mysqli_fetch_assoc($result)) {
              echo "<img src='" . $rowimg["img_name"] . "' alt='image'>";
            }

            ?>
          </div>
        </div>
        <div class="left-post">
          <div class="photo-see">
            <h1>Friends</h1>
            <a href="<?php echo " friendpage.php?account_id=" . $id; ?>">
              <div class="see-more seeMoreFriends">See more</div>
            </a>
          </div>
          <div class="Friends">
            <?php $sql = "SELECT * FROM friends WHERE user_id = '" . $row["std_id"] . "'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row1 = mysqli_fetch_assoc($result)) {
                $sql1 = "SELECT * FROM student WHERE std_id = '" . $row1["friend_id"] . "'";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                  while ($row2 = mysqli_fetch_assoc($result1)) {
                    $imgid = $row2["img_id"];
                    $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                    $resultimg = mysqli_query($conn, $sqlimg);
                    $rowimg2 = mysqli_fetch_assoc($resultimg);
                    if (isset($rowimg2["img_name"])) {
                      $imgName = $rowimg2["img_name"];
                    } else {
                      if ($row2["gender"] == 1) {
                        $imgName = "Design\Image\LogoPic0.jpg";
                      } else {
                        $imgName = "Design\Image\LogoPic1.jpg";
                      }
                    }
                    echo " <a href='friendpage.php?account_id=" . $row2["account_id"] . "'>
                      <div class='namePhoto'>
                              <img src='" . $imgName . "' alt='image'>
                              <div class='names'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</div>
                            </div></a>";
                  }
                }
              }
            }
            ?>
          </div>
        </div>
      </div>
      <div class="right-post">
        <?php
        if (isset($_COOKIE["Personal_id"]) == false) {
          $_COOKIE["Personal_id"] = 1;
        }
        if ($_COOKIE["Personal_id"] == 1) {
          $likenum = 0;
          $sql = "SELECT * FROM post where author = " . $row["std_id"] . " order by created_date desc";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row1 = mysqli_fetch_assoc($result)) {
              $sql1 = "SELECT * FROM student WHERE std_id = '" . $row1["author"] . "'";
              $sql2 = "SELECT * FROM img WHERE img_id = '" . $row1["img_id"] . "'";
              $sql3 = "SELECT * FROM video WHERE video_id  = '" . $row1["video_id"] . "'";
              $sql9 = "SELECT * FROM files WHERE fileId = '" . $row1["fileId"] . "'";
              $result1 = mysqli_query($conn, $sql1);
              $result2 = mysqli_query($conn, $sql2);
              $result3 = mysqli_query($conn, $sql3);
              $result9 = mysqli_query($conn, $sql9);
              $sqllikenum = "SELECT COUNT(*) FROM post_likes WHERE post_id = '" . $row1["post_id"] . "'";
              $resultlikenum = mysqli_query($conn, $sqllikenum);
              $rowlikenum = mysqli_fetch_assoc($resultlikenum);
              $likenum = $rowlikenum["COUNT(*)"];
              if (mysqli_num_rows($result1) > 0) {
                while ($row2 = mysqli_fetch_assoc($result1)) {
                  $imgid = $row2["img_id"];
                  $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                  $resultimg = mysqli_query($conn, $sqlimg);
                  $rowimg = mysqli_fetch_assoc($resultimg);
                  if (isset($rowimg["img_name"])) {
                    $postImage = $rowimg["img_name"];
                  } else {
                    if ($row2["gender"] == 1) {
                      $postImage = "Design\Image\LogoPic0.jpg";
                    } else {
                      $postImage = "Design\Image\LogoPic1.jpg";
                    }
                  }
                  $now = new DateTime();
                  $post = new DateTime($row1["created_date"]);
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
                  if ($row2["std_id"] == $row["std_id"]) {
                    $href = "personal.php";
                  } else {
                    $href = "friendpage.php?account_id=" . $row2["account_id"];
                  }
                  if (($row1["share_original"] == NULL || $row1["share_original"] == "") && ($row1["share_new"] == NULL || $row1["share_new"] == "")) { // NOTE - THIS IS FOR POST WITHOUT SHARE
                    echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$href'>
                                 <img src='$postImage'>
                                    <div class='name'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</div>
                              </a>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/ball.svg'>
                              </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row1["content"] . "</p>
                                 ";
                  } else if (($row1["share_original"] == $row1["share_new"])) { // if the person shared his own post
                    $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row1["share_new"] . "'";
                    $shareResult = mysqli_query($conn, $shareSQL);
                    $shareRow = mysqli_fetch_assoc($shareResult);
                    $shareImg = "SELECT * FROM img WHERE img_id = '" . $shareRow["img_id"] . "'";
                    $shareImgResult = mysqli_query($conn, $shareImg);
                    $shareImgRow = mysqli_fetch_assoc($shareImgResult);
                    if (isset($shareImgRow["img_name"])) {
                      $shareImage = $shareImgRow["img_name"];
                    } else {
                      if ($shareRow["gender"] == 1) {
                        $shareImage = "Design\Image\LogoPic0.jpg";
                      } else {
                        $shareImage = "Design\Image\LogoPic1.jpg";
                      }
                    }
                    if ($row1["share_new"] == $row["std_id"]) {
                      $shareHref = "personal.php";
                    } else {
                      $shareHref = "friendpage.php?account_id=" . $shareRow["account_id"];
                    }
                    echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$href'>
                                 <img src='$postImage'>
                                    <div class='name'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</div>
                                    </a>
                                    <div class = 'shareDesc'>Shared His Post</div>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/ball.svg'>
                              </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row1["content"] . "</p>
                                 ";
                  } else if (($row1["share_original"] != $row1["share_new"])) { // if the person shared onother person post
                    $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row1["share_new"] . "'";
                    $shareResult = mysqli_query($conn, $shareSQL);
                    $shareRow = mysqli_fetch_assoc($shareResult);
                    $shareImg = "SELECT * FROM img WHERE img_id = '" . $shareRow["img_id"] . "'";
                    $shareImgResult = mysqli_query($conn, $shareImg);
                    $shareImgRow = mysqli_fetch_assoc($shareImgResult);
                    if (isset($shareImgRow["img_name"])) {
                      $shareImage = $shareImgRow["img_name"];
                    } else {
                      if ($shareRow["gender"] == 1) {
                        $shareImage = "Design\Image\LogoPic0.jpg";
                      } else {
                        $shareImage = "Design\Image\LogoPic1.jpg";
                      }
                    }
                    if ($row1["share_new"] == $row["std_id"]) {
                      $shareHref = "personal.php";
                    } else {
                      $shareHref = "friendpage.php?account_id=" . $shareRow["account_id"];
                    }
                    echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$shareHref'>
                                 <img src='$shareImage'>
                                  <div class='name'>" .  $shareRow["std_fname"] . " " . $shareRow["std_lname"] . "</div>
                              </a>
                                    <div class = 'shareDesc'>Shared<a href='$href'><p class='shareDesc' style='display:inline'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</p></a> post</div>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/ball.svg'>
                              </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row1["content"] . "</p>
                                 ";
                  }
                  if (mysqli_num_rows($result9) > 0) {
                    while ($row9 = mysqli_fetch_assoc($result9)) {
                      echo "
                              <span>
                                  The file:
                                  <a href='" . $row9["fileName"] . "' download='" . $row9["fileOriginalName"] . "'>" . $row9["fileOriginalName"] . "</a>
                              </span>
                              ";
                    }
                  }
                  echo "
                              </div> ";
                }
              }
              if (mysqli_num_rows($result2) > 0) {
                while ($row3 = mysqli_fetch_assoc($result2)) {
                  echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <img class='post-image' src='" . $row3["img_name"] . "'>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                       <div class='like'>
                                          <img class='show_Likes' data-post_id='" . $row1["post_id"] . "' src='Design/Image/home-images/images/card-down.svg'>
                                       ";
                  $sql4 = "SELECT * FROM post_likes WHERE post_id = '" . $row1["post_id"] . "' AND std_id = '" . $row["std_id"] . "'";
                  $result3 = mysqli_query($conn, $sql4);
                  if (mysqli_num_rows($result3) > 0) {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                                  ";
                    if ($likenum == 1) {
                      echo "<p class='LikeCount' post_id='" . $row1["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>like</p>
                                                  ";
                    } else {
                      echo "
                                                    <p class='LikeCount' post_id='" . $row1["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                                  ";
                    }
                  } else {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                                  <p class='LikeCount' post_id='" . $row1["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                            ";
                  }
                  echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row1["post_id"] . "' data-std_id='" . $row["std_id"] . "' data-author='" . $row1["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row1["post_id"] . "' data-author_id='" . $row["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                  $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $row["std_id"] . "' AND post_id = '" . $row1["post_id"] . "'";
                  $result8 = mysqli_query($conn, $sql8);
                  if (mysqli_num_rows($result8) > 0) {
                    echo "<div class='save' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                  } else {
                    echo "<div class='save' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "' style='display: none;'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                  }
                  echo "
                                 </div>
                                 </div>
                                 </div>";
                }
              } else if (mysqli_num_rows($result3) > 0) {
                while ($row3 = mysqli_fetch_assoc($result3)) {
                  echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <video width='800px' controls class='video-js vjs-theme-forest vjs-fluid' data-setup='{}'>
                                         <source src='" . $row3["video_name"] . "' type='video/mp4'>
                                      </video>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                        <div class='like'>
                                          <img class='show_Likes' data-post_id='" . $row1["post_id"] . "' src='Design/Image/home-images/images/card-down.svg'>
                                        ";
                  $sql7 = "SELECT * FROM post_likes WHERE post_id = '" . $row1["post_id"] . "' AND std_id = '" . $row["std_id"] . "'";
                  $result7 = mysqli_query($conn, $sql7);
                  if (mysqli_num_rows($result7) > 0) {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                                  ";
                    if ($likenum == 1) {
                      echo "<p class='LikeCount' post_id='" . $row1["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>like</p>
                                                  ";
                    } else {
                      echo "<p class='LikeCount' post_id='" . $row1["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                                  ";
                    }
                  } else {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                                  <p class='LikeCount' post_id='" . $row1["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                            ";
                  }
                  echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row1["post_id"] . "' data-std_id = '" . $row["std_id"] . "' data-author ='" . $row1["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row1["post_id"] . "' data-author_id='" . $row["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                  $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $row["std_id"] . "' AND post_id = '" . $row1["post_id"] . "'";
                  $result8 = mysqli_query($conn, $sql8);
                  if (mysqli_num_rows($result8) > 0) {
                    echo "<div class='save' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                  } else {
                    echo "<div class='save' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "' style='display: none;'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                  }
                  echo "
                                 </div>
                                 </div>
                                 </div>";
                }
              } else {
                echo "<div class='end-post'>
                              <div class='likes'>
                                 <div class='like'>
                                          <img class='show_Likes' data-post_id='" . $row1["post_id"] . "' src='Design/Image/home-images/images/card-down.svg'>
                                  ";
                $sql5 = "SELECT * FROM post_likes WHERE post_id = '" . $row1["post_id"] . "' AND std_id = '" . $row["std_id"] . "'";
                $result4 = mysqli_query($conn, $sql5);
                if (mysqli_num_rows($result4) > 0) {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                              ";
                  if ($likenum == 1) {
                    echo "<p class='LikeCount' post_id='" . $row1["post_id"] . "'>$likenum</p>
                                                        <p class='LikeParagraph' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>like</p>
                                                        <p class='UnLikeParagraph' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>like</p>
                                              ";
                  } else {
                    echo "
                                                        <p class='LikeCount' post_id='" . $row1["post_id"] . "'>$likenum</p>
                                                        <p class='LikeParagraph' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                                        <p class='UnLikeParagraph' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                              ";
                  }
                } else {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>
                                              <p class='LikeCount' post_id='" . $row1["post_id"] . "'>$likenum</p>
                                              <p class='LikeParagraph' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                              <p class='UnLikeParagraph' style='display: none;' post_id='" . $row1["post_id"] . "' std_id='" . $row["std_id"] . "'>likes</p>
                                        ";
                }
                echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row1["post_id"] . "' data-std_id = '" . $row["std_id"] . "' data-author ='" . $row1["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row1["post_id"] . "' data-author_id='" . $row["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $row["std_id"] . "' AND post_id = '" . $row1["post_id"] . "'";
                $result8 = mysqli_query($conn, $sql8);
                if (mysqli_num_rows($result8) > 0) {
                  echo "<div class='save' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                } else {
                  echo "<div class='save' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row1["post_id"] . "' data-keeper_id='" . $row["std_id"] . "' style='display: none;'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                }
                echo "
                                 </div>
                                 </div>
                                 </div>";
              }
            }
          }
        } else if ($_COOKIE["Personal_id"] == 2) {
          $sql = "SELECT * FROM friends WHERE user_id = '" . $row["std_id"] . "'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            echo "<div class='FCont'>";
            while ($row = mysqli_fetch_assoc($result)) {
              $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["friend_id"] . "'";
              $result1 = mysqli_query($conn, $sql1);
              if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                  $imgid = $row1["img_id"];
                  $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                  $resultimg = mysqli_query($conn, $sqlimg);
                  $rowimg = mysqli_fetch_assoc($resultimg);
                  if (isset($rowimg["img_name"])) {
                    $imgName = $rowimg["img_name"];
                  } else {
                    if ($row1["gender"] == 1) {
                      $imgName = "Design\Image\LogoPic0.jpg";
                    } else {
                      $imgName = "Design\Image\LogoPic1.jpg";
                    }
                  }
                  echo "<div class='namePhoto'>
                            <img src='" . $imgName . "' alt='image'>
                            <div class='names'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                          </div>";
                }
              }
            }
            echo "</div>";
          }
        } else if ($_COOKIE["Personal_id"] == 3) {
          $sql = "SELECT * FROM img WHERE album_id = '" . $row["std_id"] . "'";
          $result = mysqli_query($conn, $sql);
          echo "<div class='imgContainer'>";
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<img src='" . $row["img_name"] . "' alt='image'>";
          }
          echo "</div>";
        } else {
          $sql = "SELECT * FROM video WHERE album_id = '" . $row["std_id"] . "'";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<video width='800px' controls class='video-js vjs-theme-forest vjs-fluid' data-setup='{}'>
        <source src='" . $row["video_name"] . "' type='video/mp4'>
     </video>";
          }
        }
        ?>

        <div class="commentBox">
          <p class="commentHeader">Comments</p>
          <div class="commentList">
            <!-- <div class="commentContent"></div> -->
            <textarea class="commentArea" name="commentArea" id="" cols="30" rows="10"></textarea>
            <button class="sendComment">Send</button>
          </div>
        </div>
        <button class="scrollToTopBtn">☝️</button>
        <div class="show_Likes_Box" style="display: none;"></div>
        <div class="modal">
          <span class="close">&times;</span>
          <img class="modal-content slide-in-elliptic-top-fwd">
        </div>
        <div class="modal" id="modal2">
          <span class="close" id="close2">&times;</span>
          <img class="modal-content slide-in-elliptic-top-fwd" id="modal-content">
        </div>

      </div>
    </div>
  </div>
  <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script type="module" src="bootstrap-js/friendpage.js"></script>
</body>

</html>