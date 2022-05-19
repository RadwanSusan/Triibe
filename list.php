<?php
include_once "connection.php";
include_once "backBone.php";
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
    <div class="contant5">
     <div class="right-sidebar1">
      <div class="imp-link">
          <a href="friendpage.php?account_id=251986197"><img src="Design\Image\LogoPic0.jpg">Zaid mohamad</a>
        <a href="savedPosts.php">
          <img class="savedPosts-Light" src="Design/Image/home-images/images/saved-posts.svg" alt="" />
          <img class="savedPosts-Dark" src="Design/Image/home-images/images/saved-posts2.svg" alt="" />
          <span> Saved posts</span>
        </a>
        <a href="Friends.php">
          <img class="savedPosts-Light" src="Design/Image/home-images/images/friend.svg" alt="" />
          <span> Friends</span>
        </a>
        <a href="market.php">
          <img class="marketIcon-Light" src="Design/Image/home-images/images/market-Icon.svg" alt="" />
          <img class="marketIcon-Dark" src="Design/Image/home-images/images/market-Icon2.svg" alt="" />
          <span>Market</span>
        </a>
        <a href="#">
          <img class="housingIcon-Light" src="Design/Image/home-images/images/housing-icon.svg" alt="" />
          <img class="housingIcon-Dark" src="Design/Image/home-images/images/housing-icon2.svg" alt="" />
          <span>Housing</span></a>
        <a href="http://elearning.ahu.edu.jo/login/index.php">
          <img class="elearningIcon-Light" src="Design/Image/home-images/images/elearning-icon.svg" alt="" />
          <img class="elearningIcon-Dark" src="Design/Image/home-images/images/elearning-icon2.svg" alt="" />
          <span>E-Learning</span>
        </a>
        <a href="http://sis.ahu.edu.jo/">
          <img class="infoIcon-Light" src="Design/Image/home-images/images/Info-Icon.svg" alt="" />
          <img class="infoIcon-Dark" src="Design/Image/home-images/images/Info-Icon2.svg" alt="" />
          <span>Student information system</span>
        </a>
        <a href="http://reg.ahu.edu.jo/">
          <img class="regIcon-Light" src="Design/Image/home-images/images/RegIcon.svg" alt="" />
          <img class="regIcon-Dark" src="Design/Image/home-images/images/RegIcon2.svg" alt="" />
          <span>Student registration system</span>
        </a>
        <a href="#">
          <img class="otherLinksIcon-Light" src="Design/Image/home-images/images/otherLinks-icon.svg" alt="" />
          <img class="otherLinksIcon-Dark" src="Design/Image/home-images/images/otherLinks-icon2.svg" alt="" />
          <span class="other-link">Other links</span>
          <img class="dropDownIcon-Light" src="Design/Image/home-images/images/dropDown-icon.svg" alt="">
          <img class="dropDownIcon-Dark" src="Design/Image/home-images/images/dropDown-icon2.svg" alt="">
        </a>
      </div>
    </div>
  </div>
</div>

  <script src="bootstrap-js/list.js"></script>

</body>
</html>
