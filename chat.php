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
    <ul class="list">
      <?php
      $sql = "SELECT distinct * FROM messages where to_user = '".$_SESSION["std_id"]."'"; 
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)){
        $sql2 = "SELECT * FROM student where std_id = '".$row["from_user"]."'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        $img_id = $row2["img_id"];
        $status = $row2["status"];
        if($status == "0"){
          $status = "<i class='fa fa-circle offline'></i> offline";
        }else{
          $status = "<i class='fa fa-circle online'></i> online";
        }
        $sql3 = "SELECT * FROM img where img_id = '".$img_id."'";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($result3);
        $img_name = $row3["img_name"];
        echo "<li class='clearfix chatfriend' data-std_id='".$row2["std_id"]."'>
        <img src='".$img_name."' alt='avatar'/>
        <div class='about'>
          <div class='name'>".$row2["std_fname"]." ".$row2["std_lname"]." </div>
          <div class='status'>
            ".$status."
          </div>
        </div>
      </li>";
      }
    }else{
      $sql = "SELECT distinct * FROM messages where from_user = '".$_SESSION["std_id"]."'"; 
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_array($result)){
        $sql2 = "SELECT * FROM student where std_id = '".$row["to_user"]."'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        $img_id = $row2["img_id"];
        $status = $row2["status"];
        if($status == "0"){
          $status = "<i class='fa fa-circle offline'></i> offline";
        }else{
          $status = "<i class='fa fa-circle online'></i> online";
        }
        $sql3 = "SELECT * FROM img where img_id = '".$img_id."'";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($result3);
        $img_name = $row3["img_name"];
        echo "<li class='clearfix chatfriend' data-std_id='".$row2["std_id"]."'>
        <img src='".$img_name."' alt='avatar'/>
        <div class='about'>
          <div class='name'>".$row2["std_fname"]." ".$row2["std_lname"]." </div>
          <div class='status'>
            ".$status."
          </div>
        </div>
      </li>";
      }
    }

      ?>
    </ul>
  </div>
  </div>

  <div class="chat">
    <div class="chat-header clearfix">
      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />

      <div class="chat-about">
        <div class="chat-with">Chat with Vincent Porter</div>
        <div class="chat-num-messages">already 1 902 messages</div>
      </div>
      <i class="fa fa-star"></i>
    </div>
    <div class="chat-history">
     <ul>
     <?php
$sql = "SELECT * FROM messages WHERE from_user = '".$_SESSION["std_id"]."' OR to_user = '".$_SESSION["std_id"]."' ORDER BY time DESC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
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
                            if ($diffdaystr == "0"){
                                if ($diffhourstr == "0"){
                                    if ($diffminutestr == "0"){
                                        $difftime = $diffsecondstr . "s ago";
                                    }
                                    else{
                                        $difftime = $diffminutestr . "m ago";
                                    }
                                }
                                else{
                                    $difftime = $diffhourstr . "h ago";
                                }
                            }
                            else{
                                $difftime = $diffdaystr . "d ago";
                            }
  if($row["from_user"] == $_SESSION["std_id"]){
  $sql2 = "SELECT * FROM student WHERE std_id = '".$row["from_user"]."'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);

  echo "<li class='clearfix'>
          <div class='message-data align-right'>
            <span class='message-data-time'>".$difftime."</span> &nbsp; &nbsp;
            <span class='message-data-name'>".$row2["std_fname"]."</span> <i class='fa fa-circle me'></i>

          </div>
          <div class='message other-message float-right'>
            ".$row["message"]."
          </div>
        </li>";
  }
  else{
  $sql3 = "SELECT * FROM student WHERE std_id = '".$row["from_user"]."'";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_array($result3);  

    echo "<li>
    <div class='message-data'>
      <span class='message-data-name'><i class='fa fa-circle online'></i>".$row3["std_fname"]."</span>
      <span class='message-data-time'>".$difftime."</span>
    </div>
    <div class='message my-message'>
      ".$row["message"]."
    </div>
  </li>";
}
}
?>

     </ul>
    </div> <!-- end chat-history -->

    <div class="chat-message clearfix">
      <textarea name="message-to-send" id="message-to-send" placeholder="Type your message" rows="3"></textarea>
      <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
      <i class="fa fa-file-image-o"></i>
      <button>Send</button>
    </div>
  <script id="message-template" type="text/x-handlebars-template">
    
</script>
  <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https:"></script>
  <script type ="module" src="bootstrap-js/chat.js" defer></script>
</body>

</html>
