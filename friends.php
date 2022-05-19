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
    <link rel="stylesheet" href="bootstrap-css/light-home.css">
    <title>Document</title>
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
        <a href="list.php">
        <li class="more-list">
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/more-list.svg" alt="settingIcon" />
        </li>
        <li>
          </a>
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/Settings-icon.svg" alt="settingIcon" />
          <img class="SettingsIcon-Dark" src="Design/Image/home-images/images/Settings-icon2.svg" alt="settingIcon" />
        </li>
        <li>
          <img class="mapIcon-Light" src="Design/Image/home-images/images/mapIcon.svg" alt="mapIcon" />
          <img class="mapIcon-Dark" src="Design/Image/home-images/images/mapIcon2.svg" alt="mapIcon" />
        </li>
        <li>
          <img class="themeLight" src="Design/Image/home-images/images/theme-light.svg" alt="themeLight" />
          <img class="themeDark" src="Design/Image/home-images/images/theme-dark.svg" alt="themeDark" />
        </li>
        <li>
          <img class="notificationIcon-light" src="Design/Image/home-images/images/notification-logo.svg" alt="notificationIcon" />
          <img class="notificationIcon-dark" src="Design/Image/home-images/images/notification-logo2.svg" alt="notificationIcon1" />
        </li>
        <li class="chat">
          <img class="chatLight" src="Design/Image/home-images/images/chat-icon.svg" alt="image" />
          <img class="chatDark" src="Design/Image/home-images/images/chat-icon2.svg" alt="image" />
        </li>
      </ul>
      <div class="nav-user-icon online">
        <a href='personal.php'><img src="<?php echo $_SESSION["img_name"]; ?>" alt="" /></a>
        <a href='personal.php'>
          <div class="name">
            <?php echo $_SESSION["std_fname"]; ?>
          </div>
        </a>
      </div>
    </div>
  </nav>
  <div class="content3">
    <div class="left-sidebar2">
      <div class="group-list">
        <!-- <a href="#"> <img class="pagesIcon-Light" src="Design/Image/home-images/images/pages-icon.svg" alt="pages-icon"> <img class="pagesIcon-Dark" src="Design/Image/home-images/images/pages-icon2.svg" alt="pages-icon2"> <span>Pages</span> </a>
        <a href="#"> <img class="Groups-Light" src="Design/Image/home-images/images/Groups.svg" alt=""> <img class="Groups-Dark" src="Design/Image/home-images/images/Groups2.svg" alt=""><span>Groups</span> </a> -->
        <div class="group-page">
          <p>Friends</p>
          <a href="friendpage.php?account_id=251986197"><img src="Design\Image\LogoPic0.jpg">omar thaer</a><a href="friendpage.php?account_id=547594119"><img src="Design\Image\LogoPic0.jpg">radwan susan</a>        </div>
      </div>
    </div>
    <div class="right-profile">
        <img src="Design/Image/home-images/images/friend.svg" alt="">
        <p>Select people's names to preview their profile.</p>
    </div>
    </div>
</body>
</html>