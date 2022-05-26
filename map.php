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
   <title>Triibe home</title>
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
   <link id="theme" rel="stylesheet" href="bootstrap-css/light-home.css" />
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
            <a href='personal.php'><img src="<?php echo $_SESSION["personalProfile"] ?>" alt="" /></a>
            <a href='personal.php'>
               <div class="name">
                  <?php echo $_SESSION["std_fname"]; ?>
               </div>
            </a>
         </div>
      </div>
   </nav>
   <br>
   <iframe src="https://my.atlistmaps.com/map/5af7905c-717e-4c65-9276-d7207902c5d8?share=true" allow="geolocation" width="100%" height="850PX" frameborder="0" scrolling="no" allowfullscreen></iframe>
   <button class="scrollToTopBtn">☝️</button>
   <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
   <script src="bootstrap-js/all.min.js"></script>
   <script src="node_modules/jquery/dist/jquery.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
   <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
   <script type="module" src="bootstrap-js/map.js" defer></script>
</body>

</html>
