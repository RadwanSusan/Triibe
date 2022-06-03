<?php
include_once "connection.php";
session_start();
$idAttr = null;
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="Design/Image/whiteLogo.svg" type="image/x-icon" />
  <title>Triibe Chat</title>
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
  <link id="theme" rel="stylesheet" href="bootstrap-css/chat-light.css" />
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
  <div class="chatImageDiv">
    <img class="chatImage" src="#" alt="">
  </div>
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
  <div class="container clearfix">
    <p class="noUserSelectedPara">Select a user to chat with</p>
    <div class="people-list" id="people-list">
      <div class="search">
        <input class="chatSearch" type="text" placeholder="search" std_id="<?php echo $_SESSION['std_id']; ?>" />
        <i class="fa fa-search svg_img"></i>
      </div>
      <ul class="list">
        <div class="searchArea2"></div>
        <?php
        $sql = "SELECT distinct from_user FROM messages where to_user = '" . $_SESSION["std_id"] . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            $sql2 = "SELECT * FROM student where std_id = '" . $row["from_user"] . "'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2);
            $idAttr = "id='active'";
            $img_id = $row2["img_id"];
            $status = $row2["status"];
            if ($status == "0") {
              $status = "<i class='fa fa-circle offline'></i> offline";
            } else {
              $status = "<i class='fa fa-circle online2'></i> online";
            }
            $sql3 = "SELECT * FROM img where img_id = '" . $img_id . "'";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_array($result3);
            if (isset($row3["img_name"])) {
              $img_name = $row3["img_name"];
            } else {
              if ($row2["gender"] == 1) {
                $img_name = "Design\Image\LogoPic0.jpg";
              } else {
                $img_name = "Design\Image\LogoPic1.jpg";
              }
            }
            echo "<li class='clearfix chatfriend' data-id='" . $row2["std_id"] . "'>
        <img src='" . $img_name . "' alt='avatar'/>
        <div class='about'>
          <div class='name2'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</div>
          <div class='status'>
            " . $status . "
          </div>
        </div>
      </li>";
          }
        } else {
          $sql = "SELECT distinct to_user FROM messages where from_user = '" . $_SESSION["std_id"] . "'";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($result)) {
            $sql2 = "SELECT * FROM student where std_id = '" . $row["to_user"] . "'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2);
            $img_id = $row2["img_id"];
            $status = $row2["status"];
            if ($status == "0") {
              $status = "<i class='fa fa-circle offline'></i> offline";
            } else {
              $status = "<i class='fa fa-circle online2'></i> online";
            }
            $sql3 = "SELECT * FROM img where img_id = '" . $img_id . "'";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_array($result3);
            if (isset($row3["img_name"])) {
              $img_name = $row3["img_name"];
            } else {
              if ($row2["gender"] == 1) {
                $img_name = "Design\Image\LogoPic0.jpg";
              } else {
                $img_name = "Design\Image\LogoPic1.jpg";
              }
            }
            echo "<li class='clearfix chatfriend' data-id='" . $row2["std_id"] . "'>
        <img src='" . $img_name . "' alt='avatar'/>
        <div class='about'>
          <div class='name2'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</div>
          <div class='status'>
            " . $status . "
          </div>
        </div>
      </li>";
          }
        }
        if (isset($_GET["account_id"])) {
          $sql = "SELECT * FROM student where std_id = '" . $_GET["account_id"] . "'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);
          $img_id = $row["img_id"];
          $status = $row["status"];
          if ($status == "0") {
            $status = "<i class='fa fa-circle offline'></i> offline";
          } else {
            $status = "<i class='fa fa-circle online2'></i> online";
          }
          $sql3 = "SELECT * FROM img where img_id = '" . $img_id . "'";
          $result3 = mysqli_query($conn, $sql3);
          $row3 = mysqli_fetch_array($result3);
          if (isset($row3["img_name"])) {
            $img_name = $row3["img_name"];
          } else {
            if ($row["gender"] == 1) {
              $img_name = "Design\Image\LogoPic0.jpg";
            } else {
              $img_name = "Design\Image\LogoPic1.jpg";
            }
          }
          echo "<li class='clearfix chatfriend' data-id='" . $row["std_id"] . "'>
        <img src='" . $img_name . "' alt='avatar'/>
        <div class='about'>
          <div class='name2'>" . $row["std_fname"] . " " . $row["std_lname"] . "</div>
          <div class='status'>
            " . $status . "
          </div>
        </div>
      </li>";
        }
        ?>
      </ul>
    </div>

    <div class="chat">
      <div class="chat-header clearfix">
        <?php
        $sql = "SELECT * FROM student where std_id = '" . $_COOKIE["idAttr"] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $img_id = $row["img_id"];
        $sql2 = "SELECT * FROM img where img_id = '" . $img_id . "'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        if (isset($row2["img_name"])) {
          $img_name = $row2["img_name"];
        } else {
          if ($row["gender"] == 1) {
            $img_name = "Design\Image\LogoPic0.jpg";
          } else {
            $img_name = "Design\Image\LogoPic1.jpg";
          }
        }
        $sql4 = "SELECT COUNT(*) FROM messages WHERE from_user = '" . $_COOKIE["idAttr"] . "' OR to_user = '" . $_COOKIE["idAttr"] .   "' ORDER BY time DESC";
        $result4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_array($result4);
        $count = $row4[0];
        echo " <img src='" . $img_name . "' alt='avatar' />
        <div class='chat-about'>
          <div class='chat-with'>" . $row["std_fname"] . " " . $row["std_lname"] . "</div>
          <div class='chat-num-messages'>already " . $count . " messages</div>
        </div>";
        ?>
      </div>
      <div class="chat-history">
        <ul class='ulList'>
          <?php
          $sql = "SELECT * FROM messages WHERE (from_user = '" . $_COOKIE["idAttr"] . "' OR to_user = '" . $_COOKIE["idAttr"] .   "') AND (to_user = '" . $_SESSION["std_id"] . "' OR from_user = '" . $_SESSION["std_id"] . "') ORDER BY time ";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($result)) {
            $now = new DateTime();
            $post = new DateTime($row["time"]);
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
            if ($row["from_user"] == $_SESSION["std_id"]) {
              $sql2 = "SELECT * FROM student WHERE std_id = '" . $row["from_user"] . "'";
              $result2 = mysqli_query($conn, $sql2);
              $row2 = mysqli_fetch_array($result2);
              echo "<li class='clearfix'>
          <div class='message-data align-right'>
            <span class='message-data-time'>" . $difftime . "</span> &nbsp; &nbsp;
            <span class='message-data-name'>" . $row2["std_fname"] . "</span> <i class='fa fa-circle me'></i>

          </div>
          <div class='message other-message float-right'>
            " . $row["message"] . "
          </div>
        </li>";
            } else {
              $sql3 = "SELECT * FROM student WHERE std_id = '" . $row["from_user"] . "'";
              $result3 = mysqli_query($conn, $sql3);
              $row3 = mysqli_fetch_array($result3);
              $chatMessage2 = nl2br($row["message"]);

              echo "<li>
    <div class='message-data'>
      <span class='message-data-name'><i class='fa fa-circle online2'></i>" . $row3["std_fname"] . "</span>
      <span class='message-data-time'>" . $difftime . "</span>
    </div>
    <div class='message my-message'>
      " . $row["message"] . "
    </div>
  </li>";
            }
          }
          ?>
          </li>
        </ul>
      </div>
      <div class="chat-message clearfix">
        <textarea class='messagetxt' name="message-to-send" id="message-to-send" placeholder="Type your message" rows="3"></textarea>
        <button class='send' type="submit" data-std_id='<?php echo $_SESSION["std_id"] ?>' data-idAttr='<?php echo $_COOKIE["idAttr"] ?>' data-fname='<?php echo $_SESSION["std_fname"] ?>'>Send</button>
      </div>


      <script id="message-template" type="text/x-handlebars-template">
      </script>
      <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
      <script src="bootstrap-js/all.min.js"></script>
      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
      <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
      <script type="module" src="bootstrap-js/chat.js" defer></script>
</body>

</html>
