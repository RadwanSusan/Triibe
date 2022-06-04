<?php
include_once "connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="Design/Image/whiteLogo.svg" type="image/x-icon" />
  <title>Triibe saved-posts</title>
  <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
  <link rel="stylesheet" href="bootstrap-css/all.min.css" />
  <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
  <link href="node_modules/hover.css/css/hover-min.css" rel="stylesheet">
  <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
  <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  <link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
  <link id="theme" rel="stylesheet" href="bootstrap-css/savedPosts-light.css" />
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
  <div id="particles-js"></div>
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
            while ($row = mysqli_fetch_assoc($result)) {
              $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["sender"] . "'";
              $result1 = mysqli_query($conn, $sql1);
              if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                  $now = new DateTime();
                  $post = new DateTime($row["date"]);
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
                  echo "<a href='friendpage.php?account_id=" . $row1["account_id"] . "'><div class='NotificationBox'>
                  <p>$difftime</p>
                        <p>" . $row1['std_fname'] . " " . $row1["std_lname"] . " sent you a friend request </p>
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
  <div class="container1">
    <div class="left-sidebar">
      <div class="group-page2">
        <p>Collage </p>
        <?php
        $sqlc = "SELECT Coll_Name,Coll_No FROM colleges WHERE Coll_NO = (SELECT Coll_Major_No FROM majors WHERE ID = (SELECT Std_Major_No FROM students WHERE std_No = '" . $_SESSION["std_id"] . "'))";
        $resultc = mysqli_query($conn, $sqlc);
        $rowc = mysqli_fetch_assoc($resultc);
        echo "<a href='#' class='group-list-item' data-form_id=" . "0" . $rowc["Coll_No"] . ">" . $rowc["Coll_Name"] . "</a>";
        ?>
      </div>
      <div class="group-page2">
        <p>major</p>
        <?php
        $sqlm = "SELECT Major_Name,Major_No FROM majors WHERE ID = (SELECT Std_Major_No FROM students WHERE std_No = '" . $_SESSION["std_id"] . "')";
        $resultm = mysqli_query($conn, $sqlm);
        $rowm = mysqli_fetch_assoc($resultm);
        echo "<a href='#' class='group-list-item' data-form_id=" . "1" . $rowm["Major_No"] . ">" . $rowm["Major_Name"] . "</a>";
        ?>
      </div>
      <div class="group-page2">
        <p> Subjects </p>
        <?php
        $sqlsub = "SELECT Course_Name,ID FROM courses WHERE ID IN (SELECT crs_id FROM subjects where id IN (SELECT sub_id FROM std_crs_temp WHERE std_id IN (SELECT id FROM students WHERE Std_No =" . $_SESSION["std_id"] . ")))";
        $resultsub = mysqli_query($conn, $sqlsub);
        if (mysqli_num_rows($resultsub) > 0) {
          while ($rowsub = mysqli_fetch_assoc($resultsub)) {
            echo "<a href='#' class='group-list-item' data-form_id=" . "2" . $rowsub["ID"] . ">" . $rowsub["Course_Name"] . "</a>";
          }
        }
        ?>
      </div>
      <div class="group-page">
        <p>Friends</p>
        <?php $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
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
                  $imgname = $rowimg["img_name"];
                } else {
                  if ($row1["gender"] == 1) {
                    $imgname = "Design\Image\LogoPic0.jpg";
                  } else {
                    $imgname = "Design\Image\LogoPic1.jpg";
                  }
                }
                echo "<a href='friendpage.php?account_id=" . $row1["account_id"] . "'><img src='$imgname'/>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</a>";
              }
            }
          }
        } ?>
      </div>
    </div>
    <div class="main-content animate__animated animate__fadeIn animate__slow">
      <div class="write-post-container2">
        <h1 class="savedPosts">Saved Posts</h1>
        <?php
        $likenum = 0;
        $sql = "SELECT * FROM post INNER JOIN saved_post ON post.post_id = saved_post.post_id WHERE saved_post.keeper_id = '" . $_SESSION["std_id"] . "' order by created_date desc";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["author"] . "'";
            $sql2 = "SELECT * FROM img WHERE img_id = '" . $row["img_id"] . "'";
            $sql3 = "SELECT * FROM video WHERE video_id  = '" . $row["video_id"] . "'";
            $sql9 = "SELECT * FROM files WHERE fileId = '" . $row["fileId"] . "'";
            $result1 = mysqli_query($conn, $sql1);
            $result2 = mysqli_query($conn, $sql2);
            $result3 = mysqli_query($conn, $sql3);
            $result9 = mysqli_query($conn, $sql9);
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
                $now = new DateTime();
                $post = new DateTime($row["created_date"]);
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
                if ($row1["std_id"] == $_SESSION["std_id"]) {
                  $href = "personal.php";
                } else {
                  $href = "friendpage.php?account_id=" . $row1["account_id"];
                }
                $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row["share_original"] . "'";
                $shareResult = mysqli_query($conn, $shareSQL);
                $shareRow = mysqli_fetch_assoc($shareResult);
                if (($row["share_original"] == NULL || $row["share_original"] == "") && ($row["share_new"] == NULL || $row["share_new"] == "")) { // NOTE - THIS IS FOR POST WITHOUT SHARE
                  echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$href'>
                                 <img src='$postImage'>
                                    <div class='name'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                              </a>
                                 <div class='inside-top2'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/friends_Post.svg'>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img class='modify' src='Design/Image/home-images/images/Dots.svg'>
                                 <div class='form-popup1 animate__animated animate__fadeIn animate__faster' id='myForm1' style='display: none;'>
                                  <form action='' class='form-container2'>
                                  <p>Post Settings</p>
                                  <button type='button' class='btn cancel1'>Close</button>
                                  <div class='innerTag'>
                                  <a class='edit'>Edit post</a>
                                  <div class='modifyPost' style='display:none;'>
                                    <div class='right-top-card'>
                                      <img class='exitCard editExit' src='Design/Image/home-images/images/exit-card.svg'>
                                   </div>
                                  <textarea class='edit-text' name='edit-text' placeholder='Edit your post'></textarea>
                                  <button type='button' class='btn edit-btn' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "'>Edit</button>
                                  </div>
                                  <a class='delete' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "' data-std_id='" . $_SESSION["std_id"] . "'>Delete the post</a>
                                  </div>
                                  </form>
                                  </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row["content"] . "</p>
                                 ";
                } else if (($row["share_original"] == $row["share_new"])) { // if the person shared his own post
                  $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row["share_new"] . "'";
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
                  if ($row["share_new"] == $_SESSION["std_id"]) {
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
                                    <div class='name'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                                    </a>
                                    <div class = 'shareDesc'>Shared His Post</div>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/friends_Post.svg'>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img src='Design/Image/home-images/images/Dots.svg' class='modify'>
                                 <div class='form-popup1 animate__animated animate__fadeIn animate__faster' id='myForm1' style='display: none;'>
                                  <form action='' class='form-container2'>
                                  <p>Post Settings</p>
                                  <button type='button' class='btn cancel1'>Close</button>
                                  <div class='innerTag'>
                                  <a class='edit'>Edit post</a>
                                  <div class='modifyPost' style='display:none;'>
                                                                      <div class='right-top-card'>
                                      <img class='exitCard editExit' src='Design/Image/home-images/images/exit-card.svg'>
                                   </div>
                                  <textarea class='edit-text' name='edit-text' placeholder='Edit your post'></textarea>
                                  <button type='submit' class='btn edit-btn' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "'>Edit</button>
                                  </div>
                                  <a class='delete' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "' data-std_id='" . $_SESSION["std_id"] . "'>Delete the post</a>
                                  </div>
                                  </form>
                                  </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row["content"] . "</p>
                                 ";
                } else if (($row["share_original"] != $row["share_new"])) { // if the person shared onother person post
                  $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row["share_new"] . "'";
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
                  if ($row["share_new"] == $_SESSION["std_id"]) {
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
                                    <div class = 'shareDesc'>Shared<a href='$href'><p class='shareDesc' style='display:inline'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</p></a> post</div>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/friends_Post.svg'>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img src='Design/Image/home-images/images/Dots.svg' class='modify'>
                                 <div class='form-popup1 animate__animated animate__fadeIn animate__faster' id='myForm1' style='display: none;'>
                                  <form action='' class='form-container2'>
                                  <p>Post Settings</p>
                                  <button type='button' class='btn cancel1'>Close</button>
                                  <div class='innerTag'>
                                  <a class='edit'>Edit post</a>
                                  <div class='modifyPost' style='display:none;'>
                                                                      <div class='right-top-card'>
                                      <img class='exitCard editExit' src='Design/Image/home-images/images/exit-card.svg'>
                                   </div>
                                  <textarea class='edit-text' name='edit-text' placeholder='Edit your post'></textarea>
                                  <button type='submit' class='btn edit-btn' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "'>Edit</button>
                                  </div>
                                  <a class='delete' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "' data-std_id='" . $_SESSION["std_id"] . "'>Delete the post</a>
                                  </div>
                                  </form>
                                  </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row["content"] . "</p>
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
              while ($row2 = mysqli_fetch_assoc($result2)) {
                echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <img class='post-image' src='" . $row2["img_name"] . "'>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                       <div class='like'>
                                          <img class='show_Likes' data-post_id='" . $row["post_id"] . "' src='Design/Image/home-images/images/card-down.svg'>
                                       ";
                $sql4 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                $result3 = mysqli_query($conn, $sql4);
                if (mysqli_num_rows($result3) > 0) {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  ";
                  if ($likenum == 1) {
                    echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                  } else {
                    echo "
                                                    <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                  }
                } else {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                }
                echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row["post_id"] . "' data-std_id='" . $_SESSION["std_id"] . "' data-author='" . $row["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row["post_id"] . "' data-author_id='" . $_SESSION["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $_SESSION["std_id"] . "' AND post_id = '" . $row["post_id"] . "'";
                $result8 = mysqli_query($conn, $sql8);
                if (mysqli_num_rows($result8) > 0) {
                  echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                } else {
                  echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
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
                                          <img class='show_Likes' data-post_id='" . $row["post_id"] . "' src='Design/Image/home-images/images/card-down.svg'>
                                        ";
                $sql7 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                $result7 = mysqli_query($conn, $sql7);
                if (mysqli_num_rows($result7) > 0) {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  ";
                  if ($likenum == 1) {
                    echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                  } else {
                    echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                  }
                } else {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                }
                echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row["post_id"] . "' data-std_id='" . $_SESSION["std_id"] . "' data-author='" . $row["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row["post_id"] . "' data-author_id='" . $_SESSION["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $_SESSION["std_id"] . "' AND post_id = '" . $row["post_id"] . "'";
                $result8 = mysqli_query($conn, $sql8);
                if (mysqli_num_rows($result8) > 0) {
                  echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                } else {
                  echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
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
                                          <img class='show_Likes'  data-post_id='" . $row["post_id"] . "' src='Design/Image/home-images/images/card-down.svg'>
                                  ";
              $sql5 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
              $result4 = mysqli_query($conn, $sql5);
              if (mysqli_num_rows($result4) > 0) {
                echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              ";
                if ($likenum == 1) {
                  echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                        <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                        <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                              ";
                } else {
                  echo "
                                                        <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                        <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                        <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              ";
                }
              } else {
                echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                              <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                        ";
              }
              echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row["post_id"] . "' data-std_id='" . $_SESSION["std_id"] . "' data-author='" . $row["author"] . "'>
                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row["post_id"] . "' data-author_id='" . $_SESSION["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
              $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $_SESSION["std_id"] . "' AND post_id = '" . $row["post_id"] . "'";
              $result8 = mysqli_query($conn, $sql8);
              if (mysqli_num_rows($result8) > 0) {
                echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
              } else {
                echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
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
        ?>
      </div>
    </div>
    <div class="right-sidebar">
      <div class="imp-link">
        <a href="Friends.php">
          <img class="Friends-Light" src="Design/Image/home-images/images/Groups.svg" />
          <span> Friends</span>
        </a>
        <a href="market.php">
          <img class="marketIcon-Light" src="Design/Image/home-images/images/market-Icon.svg" />
          <img class="marketIcon-Dark" src="Design/Image/home-images/images/market-Icon2.svg" />
          <span>Market</span>
        </a>
        <a href="http://elearning.ahu.edu.jo/login/index.php">
          <img class="elearningIcon-Light" src="Design/Image/home-images/images/elearning-icon.svg" />
          <img class="elearningIcon-Dark" src="Design/Image/home-images/images/elearning-icon2.svg" />
          <span>E-Learning</span>
        </a>
        <a class="SRGS" href="#">
          <img class="housingIcon-Light" src="Design/Image/home-images/images/iconmonstr-edit-9.svg" />
          <img class="housingIcon-Dark" src="Design/Image/home-images/images/iconmonstr-edit-9.svg" />
          <span>Student Reg Guidance System</span></a>
        <a href="http://sis.ahu.edu.jo/">
          <img class="infoIcon-Light" src="Design/Image/home-images/images/Info-Icon.svg" />
          <img class="infoIcon-Dark" src="Design/Image/home-images/images/Info-Icon2.svg" />
          <span>Student information system</span>
        </a>
        <a href="http://reg.ahu.edu.jo/">
          <img class="regIcon-Light" src="Design/Image/home-images/images/RegIcon.svg" />
          <img class="regIcon-Dark" src="Design/Image/home-images/images/RegIcon2.svg" />
          <span>Student registration system</span>
        </a>
      </div>
    </div>
  </div>
  <div class="commentBox">
    <div class="closeBtnComment btn">Close</div>
    <p class="commentHeader">Comments</p>
    <div class="commentList">
      <!-- <div class="commentContent"></div> -->
      <textarea class="commentArea" name="commentArea" id="" cols="30" rows="10" placeholder="Write your comment..."></textarea>
      <button class="sendComment btn">Send</button>
    </div>
  </div>
  <div class="modal">
    <span class="close">&times;</span>
    <img class="modal-content slide-in-elliptic-top-fwd" id="img01">
  </div>
  <div class="show_Likes_Box" style="display: none;"></div>
  <button class="scrollToTopBtn">☝️</button>
  <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
  <script type="module" src="bootstrap-js/savedPosts.js" defer></script>
</body>

</html>
