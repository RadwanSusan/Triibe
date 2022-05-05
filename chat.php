<?php
include_once "connection.php";
session_start();
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
        <i class="fa fa-search"></i>
      </div>
      <ul class="list">
        <?php
        $sql = "SELECT * FROM messages WHERE from_user = '" . $_SESSION["std_id"] . "' OR to_user = '" . $_SESSION["std_id"] . "' ";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
          if ($row["from_user"] == $_SESSION["std_id"]) {
            $sql2 = "SELECT * FROM student WHERE std_id = '" . $row["from_user"] . "'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2);
            $img_id = $row2["img_id"];
            $sql34 = "SELECT * FROM img WHERE img_id = '" . $img_id . "'";
            $result34 = mysqli_query($conn, $sql34);
            $row34 = mysqli_fetch_array($result34);
            $imgname = $row34["img_name"];
            echo "<li class='clearfix'>";
            echo "<div class='img'>";
            echo "<img src='" . $imgname . "' alt='' />";
            echo "</div>";
            echo "<div class='about'>";
            echo "<div class='name'>" . $row2["std_fname"] . "</div>";
            echo "<div class='status'>" . $row["message"] . "</div>";
            echo "</div>";
            echo "</li>";
          } else {
            $sql3 = "SELECT * FROM student WHERE std_id = '" . $row["to_user"] . "'";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_array($result3);
            $img_id = $row3["img_id"];
            $sql34 = "SELECT * FROM img WHERE img_id = '" . $img_id . "'";
            $result34 = mysqli_query($conn, $sql34);
            $row34 = mysqli_fetch_array($result34);
            $imgname = $row34["img_name"];
            echo "<li class='clearfix'>";
            echo "<div class='img'>";
            echo "<img src='" . $imgname . "' alt='' />";
            echo "</div>";
            echo "<div class='about'>";
            echo "<div class='name'>" . $row3["std_fname"] . "</div>";
            echo "<div class='status'>" . $row["message"] . "</div>";
            echo "</div>";
            echo "</li>";
          }
        }
        ?>
      </ul>
    </div>
    <div class="chat">
      <div class="chat-header clearfix">
        <img src="https:
        <div class=" chat-about">
        <div class="chat-with">Chat with Vincent Porter</div>
        <div class="chat-num-messages">already 1 902 messages</div>
      </div>
      <i class="fa fa-star"></i>
    </div>
    <div class="chat-history">
      <ul>
        <li class="clearfix">
          <div class="message-data align-right">
            <span class="message-data-time">10:10 AM, Today</span> &nbsp; &nbsp;
            <span class="message-data-name">Olia</span> <i class="fa fa-circle me"></i>

          </div>
          <div class="message other-message float-right">
            Hi Vincent, how are you? How is the project coming along?
          </div>
        </li>
        <li>
          <div class="message-data">
            <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
            <span class="message-data-time">10:12 AM, Today</span>
          </div>
          <div class="message my-message">
            Are we meeting today? Project has been already finished and I have results to show you.
          </div>
        </li>
        <li class="clearfix">
          <div class="message-data align-right">
            <span class="message-data-time">10:14 AM, Today</span> &nbsp; &nbsp;
            <span class="message-data-name">Olia</span> <i class="fa fa-circle me"></i>
          </div>
          <div class="message other-message float-right">
            Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so? Have you faced any problems at the last phase of the project?
          </div>
        </li>
        <li>
          <div class="message-data">
            <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
            <span class="message-data-time">10:20 AM, Today</span>
          </div>
          <div class="message my-message">
            Actually everything was fine. I'm very excited to show this to our team.
          </div>
        </li>
        <li>
          <div class="message-data">
            <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
            <span class="message-data-time">10:31 AM, Today</span>
          </div>
          <i class="fa fa-circle online"></i>
          <i class="fa fa-circle online" style="color: #AED2A6"></i>
          <i class="fa fa-circle online" style="color:#DAE9DA"></i>
        </li>
      </ul>
    </div>
    <div class="chat-message clearfix">
      <textarea name="message-to-send" id="message-to-send" placeholder="Type your message" rows="3"></textarea>
      <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
      <i class="fa fa-file-image-o"></i>
      <button>Send</button>
    </div>
  </div>
  </div>
  <script id="message-template" type="text/x-handlebars-template">
    <li class="clearfix">
    <div class="message-data align-right">
      <span class="message-data-time" >{{time}}, Today</span> &nbsp; &nbsp;
      <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
    </div>
    <div class="message other-message float-right">
      {{messageOutput}}
    </div>
  </li>
</script>
  <script id="message-response-template" type="text/x-handlebars-template">
    <li>
    <div class="message-data">
      <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
      <span class="message-data-time">{{time}}, Today</span>
    </div>
    <div class="message my-message">
      {{response}}
    </div>
  </li>
</script>
  <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https:
  <script type=" module" src="bootstrap-js/chat.js" defer></script>
</body>

</html>
