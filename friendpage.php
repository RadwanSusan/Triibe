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
        <img src="Design/Image/home-images/images/logo.svg" alt="logoLight" class="logoLight">
        <img src="Design/Image/home-images/images/logo2.svg" alt="logoDark" class="logoDark">
        <p>Triibe</p>
      </div>
      <div class="search-box">
        <img src="Design/Image/home-images/images/Search-Icon.svg" alt="search">
        <input type="text" placeholder="Search">
      </div>
    </div>
    <div class="nav-right">
      <ul>
        <li>
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/Settings-icon.svg" alt="settingIcon">
          <img class="SettingsIcon-Dark" src="Design/Image/home-images/images/Settings-icon2.svg" alt="settingIcon">
        </li>
        <li>
          <img class="mapIcon-Light" src="Design/Image/home-images/images/mapIcon.svg" alt="mapIcon">
          <img class="mapIcon-Dark" src="Design/Image/home-images/images/mapIcon2.svg" alt="mapIcon">
        </li>
        <li>
          <img class="themeLight" src="Design/Image/home-images/images/theme-light.svg" alt="themeLight">
          <img class="themeDark" src="Design/Image/home-images/images/theme-dark.svg" alt="themeDark">
        </li>
        <li>
          <img class="notificationIcon-light" src="Design/Image/home-images/images/notification-logo.svg" alt="notificationIcon">
          <img class="notificationIcon-dark" src="Design/Image/home-images/images/notification-logo2.svg" alt="notificationIcon1">
        </li>
        <li>
          <img class="chatLight" src="Design/Image/home-images/images/chat-icon.svg" alt="image">
          <img class="chatDark" src="Design/Image/home-images/images/chat-icon2.svg" alt="image">
        </li>
      </ul>
      <div class="nav-user-icon online">
        <img src="<?php echo $_SESSION["img_name"] ?>" alt="">
        <div class="name">
          <?php echo $_SESSION["std_fname"] ?>
        </div>
      </div>
    </div>
  </nav>
  <div class="content1">
    <div class="top">
      <div>
        <img src="" alt="">
        <div class="edit-cover-content">
          <div class=".edit-cover">
            <img src="<?php echo $FriendcoverName ?>" alt="">
            <p>Edit cover</p>
          </div>
        </div>
      </div>
      <!-- <img src="Design/Image/home-images/images/Linear_Layer.svg" alt=""> -->
    </div>
    <div class="bottom-content">
      <div class="bottom">
        <div class="left-bottom">
          <img src="<?php echo $FriendImgName ?>" alt="">
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
        <div class="left-post">
          <h1>Bio</h1>
          <?php
          $sql = "SELECT * FROM profile_info WHERE std_id = '" . $row["std_id"] . "'";
          $result = mysqli_query($conn, $sql);
          $rowinfo = mysqli_fetch_assoc($result);
          ?>
          <div class="title-bio">
            <div class="name"><?php echo $rowinfo["discerption"] ?></div>
            <img src="Design/Image/home-images/images/bio-title.svg" alt="">
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio1.svg" alt="">
            <div class="name name2"><?php echo $rowinfo["uni"] ?></div>
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio2.svg" alt="">
            <div class="name">Lives in <?php echo $rowinfo["lives_in"] ?></div>
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio3.png" alt="">
            <div class="name">From <?php echo $rowinfo["fromto"] ?></div>
          </div>
          <?php
          if (!isset($rowinfo['instagram']) || $rowinfo['instagram'] == "") {
            echo "";
          } else {
            echo "<div class='bio bio5'>
            <a href='" . $rowinfo['instagram'] . "'><img src='Design/Image/home-images/images/bio4.png' alt=''></a>
          </div>";
          }
          ?>
          <?php
          if (!isset($rowinfo["github"]) || $rowinfo["github"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["github"] . '><img src="Design/Image/home-images/images/bio5.png" alt=""></a>
          </div>';
          }
          ?>
          <?php
          if (!isset($rowinfo["facebook"]) || $rowinfo["facebook"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["facebook"] . '><img src="Design/Image/home-images/images/iconmonstr-facebook-4.svg" alt=""></a>
          </div>';
          }
          ?>
          <?php
          if (!isset($rowinfo["twitter"]) || $rowinfo["twitter"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["twitter"] . '><img src="Design/Image/home-images/images/iconmonstr-twitter-4.svg" alt=""></a>
          </div>';
          }
          ?>
          <?php
          if (!isset($rowinfo["linkedin"]) || $rowinfo["linkedin"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["linkedin"] . '><img src="Design/Image/home-images/images/iconmonstr-linkedin-3" alt=""></a>
          </div>';
          }
          ?>
          <?php
          if (!isset($rowinfo["snapchat"]) || $rowinfo["snapchat"] == "") {
            echo "";
          } else {
            echo ' <div class="bio bio2">
            <a href=' . $rowinfo["snapchat"] . '><img src="Design/Image/home-images/images/iconmonstr-snapchat-1" alt=""></a>
          </div>';
          }
          ?>
        </div>
        <div class="left-post">
          <div class="photo-see">

            <h1>Photo</h1>
            <a href="<?php echo " friendpage.php?account_id=" . $id; ?>"> <div class="see-more seeMorePhoto">See more</div></a>
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
            <a href="<?php echo " friendpage.php?account_id=" . $id; ?>"><div class="see-more seeMoreFriends">See more</div></a>
          </div>
          <div class="Friends">
            <div class="left-Friends">
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
                      echo "<div class='namePhoto'>
                              <img src='" . $imgName . "' alt='image'>
                              <div class='names'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</div>
                            </div>";
                    }
                  }
                }
              } ?>
            </div>
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
            while ($row = mysqli_fetch_assoc($result)) {
              $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["author"] . "'";
              $sql2 = "SELECT * FROM img WHERE img_id = '" . $row["img_id"] . "'";
              $sql3 = "SELECT * FROM video WHERE video_id  = '" . $row["video_id"] . "'";
              $result1 = mysqli_query($conn, $sql1);
              $result2 = mysqli_query($conn, $sql2);
              $result3 = mysqli_query($conn, $sql3);
              $sqllikenum = "SELECT COUNT(*) FROM post_likes WHERE post_id = '" . $row["post_id"] . "'";
              $resultlikenum = mysqli_query($conn, $sqllikenum);
              $rowlikenum = mysqli_fetch_assoc($resultlikenum);
              $likenum = $rowlikenum["COUNT(*)"];
              if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                  $imgid = $row1["img_id"];
                  $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                  $resultimg = mysqli_query($conn, $sqlimg);
                  $rowimg = mysqli_fetch_assoc($resultimg);
                  if (isset($rowimg["img_name"])) {
                    $postImage = $rowimg["img_name"];
                  } else {
                    if ($row1["gender"] == 1) {
                      $postImage = "Design\Image\LogoPic0.jpg";
                    } else {
                      $postImage = "Design\Image\LogoPic1.jpg";
                    }
                  }
                  echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <div class='name-photo'>
                                 <img src='" . $postImage . "' alt=''>
                                    <div class='name'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                              </div>
                                 <div class='inside-top'>
                                    " . $row["created_date"] . "
                                 <img src='Design/Image/home-images/images/ball.svg' alt=''>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img src='Design/Image/home-images/images/Dots.svg' alt=''>
                              </div>
                              </div>
                              <div class='mid-post'>
                                 <p>" . $row["content"] . "</p>
                              </div> ";
                }
              }
              if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                  echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <img class='post-image' src='" . $row2["img_name"] . "' alt=''>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                       <div class='like'>
                                       ";
                  $sql4 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                  $result3 = mysqli_query($conn, $sql4);
                  if (mysqli_num_rows($result3) > 0) {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' alt=''>
                                                  ";
                    if ($likenum == 1) {
                      echo "<p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                    } else {
                      echo "
                                                    <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                    }
                  } else {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' alt=''>
                                                  <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                  }
                  echo "
                                       </div>
                                       <div class='comment'>
                                       <img src='Design/Image/home-images/images/Comment.svg' alt=''>
                                       <p>comment</p>
                                       </div>
                                       <div class='share'>
                                       <img src='Design/Image/home-images/images/Share.svg'' alt=''>
                                       <p>share</p>
                                       </div>
                                       <div class='save'>
                                       <img src='Design/Image/home-images/images/Save.svg' alt=''>
                                       <p>save</p>
                                       </div>
                                 </div>
                                 </div>
                                 </div>";
                }
              } else if (mysqli_num_rows($result3) > 0) {
                while ($row3 = mysqli_fetch_assoc($result3)) {
                  echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <video width='800px' controls class='video-js vjs-theme-forest' data-setup='{}'>
                                         <source src='" . $row3["video_name"] . "' type='video/mp4'>
                                      </video>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                        <div class='like'>
                                        ";
                  $sql7 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                  $result7 = mysqli_query($conn, $sql7);
                  if (mysqli_num_rows($result7) > 0) {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' alt=''>
                                                  ";
                    if ($likenum == 1) {
                      echo "<p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                    } else {
                      echo "
                                                    <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                    }
                  } else {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' alt=''>
                                                  <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                  }
                  echo "
                                        </div>
                                        <div class='comment'>
                                        <img src='Design/Image/home-images/images/Comment.svg' alt=''>
                                        <p>comment</p>
                                        </div>
                                        <div class='share'>
                                        <img src='Design/Image/home-images/images/Share.svg' alt=''>
                                        <p>share</p>
                                        </div>
                                        <div class='save'>
                                        <img src='Design/Image/home-images/images/Save.svg' alt=''>
                                        <p>save</p>
                                        </div>
                                    </div>
                                    </div>
                                    </div>";
                }
              } else {
                echo "<div class='end-post>
                              <div class='content-end'>
                              </div>
                              <div class='likes'>
                                 <div class='like'>
                                  ";
                $sql5 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                $result4 = mysqli_query($conn, $sql5);
                if (mysqli_num_rows($result4) > 0) {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' alt=''>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' alt=''>
                                              ";
                  if ($likenum == 1) {
                    echo "<p class='LikeCount'>$likenum</p>
                                                        <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                        <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                              ";
                  } else {
                    echo "
                                                        <p class='LikeCount'>$likenum</p>
                                                        <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                        <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              ";
                  }
                } else {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' alt=''>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' alt=''>
                                              <p class='LikeCount'>$likenum</p>
                                              <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                        ";
                }
                echo "
                                 </div>
                                 <div class='comment'>
                                    <img src='Design/Image/home-images/images/Comment.svg' alt=''>
                                    <p>comment</p>
                                 </div>
                                 <div class='share'>
                                    <img src='Design/Image/home-images/images/Share.svg' ' alt=' '>
                                    <p>share</p>
                                 </div>
                                 <div class='save '>
                                    <img src='Design/Image/home-images/images/Save.svg' alt=' '>
                                    <p>save</p>
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
          }
        } else if ($_COOKIE["Personal_id"] == 3) {
          $sql = "SELECT * FROM img WHERE album_id = '" . $row["std_id"]  . "'";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<img src='" . $row["img_name"] . "' alt='image'>";
          }
        } else {
          $sql = "SELECT * FROM video WHERE album_id = '" . $row["std_id"]  . "'";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<video width='800px' controls class='video-js vjs-theme-forest vjs-fluid' data-setup='{}'>
          <source src='" . $row["video_name"] . "' type='video/mp4'>
       </video>";
          }
        }
        ?>


      </div>
    </div>
  </div>
  <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script type="module" src="bootstrap-js/friendpage.js"></script>
</body>

</html>