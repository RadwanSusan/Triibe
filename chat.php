<?php
include_once "connection.php";
session_start();
$idAttr = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <link rel="stylesheet" href="bootstrap-css/chat-light.css">
</head>

<body>
  <div class="container clearfix">
    <div class="people-list" id="people-list">
      <div class="search">
        <input type="text" placeholder="search" />
        <i class="fa fa-search svg_img"></i>
      </div>
      <ul class="list">
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
              $status = "<i class='fa fa-circle online'></i> online";
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
          <div class='name'>" . $row2["std_fname"] . " " . $row2["std_lname"] . " </div>
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
              $status = "<i class='fa fa-circle online'></i> online";
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
          <div class='name'>" . $row2["std_fname"] . " " . $row2["std_lname"] . " </div>
          <div class='status'>
            " . $status . "
          </div>
        </div>
      </li>";
          }
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
          <div class='chat-with'>" . $row["std_fname"] . " " . $row["std_lname"] . " </div>
          <div class='chat-num-messages'>already " . $count . " messages</div>
        </div>";
        ?>
        <i class="fa fa-star"></i>
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

              echo "<li>
    <div class='message-data'>
      <span class='message-data-name'><i class='fa fa-circle online'></i>" . $row3["std_fname"] . "</span>
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
        <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
        <i class="fa fa-file-image-o"></i>
        <button class='send' type="submit" data-std_id='<?php echo $_SESSION["std_id"] ?>' data-idAttr='<?php echo $_COOKIE["idAttr"] ?>' data-fname='<?php echo $_SESSION["std_fname"] ?>'>Send</button>
      </div>
      <script id="message-template" type="text/x-handlebars-template">

      </script>
      <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
      <script src="bootstrap-js/all.min.js"></script>
      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script src="https:"></script>
      <script type="module" src="bootstrap-js/chat.js" defer></script>
</body>

</html>
