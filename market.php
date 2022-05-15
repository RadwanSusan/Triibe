<?php
include_once "connection.php";
include_once "like.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
  <link id="theme" rel="stylesheet" href="bootstrap-css/market.css" />
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
        <li>
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
<div class="container1">
  <div class="main">
    <div class="left">
      <div class="left-top">
          <h1 class="h2">Market place</h2>
          <div class="setting">
        <img src="Design/image market/setting.svg" alt="settingIcon">
      </div>
          </div>
          
          <div class="search-box-2">
        <img src="Design/Image/home-images/images/Search-Icon.svg" alt="search">
        <input class="input" type="text" placeholder="Search">
      </div>
          <div class="bio bio1">
            <img src="Design/image market/browse.svg" alt="">
            <div class="name1 name3">Browse all</div>
          </div>
          <div class="bio bio3">
            <img src="Design/image market/notification.svg" alt="">
            <div class="name1">Notifiactions</div>
          </div>
          <div class="bio bio4">
            <img src="Design/image market/inbox.svg" alt="">
            <div class="name1">Inbox</div>
          </div>
          <div class="bio bio5">
            <img src="Design/image market/buying.svg" alt="">
            <div class="name1">Buying</div>
          </div>
          <div class="bio bio2">
            <img src="Design/image market/selling.svg" alt="">
            <div class="name1">Selling</div>
          </div>
        </div>
    <div class="right">
      <h1>Today picks</h1>
      <div class="all-Ele">
        <div class="all-Ele-top">
          <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/lab1.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
        <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/lab1.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
          <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/oven.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
          <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/table.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
          <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/lab3.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
          </div>


          <div class="all-Ele-bottom">
          <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/lab2.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
          <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/flat.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
          <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/lab1.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
          <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/food.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
          <div class="img1-card1">
          <div class="img1">
            <img src="Design/image market/lab1.svg" alt="img">
          </div>
          <div class="card1">
            <div class="left-post">
              <div class="top">
                              <a class="name-photo" href="friendpage.php?account_id=547594119">
                                 <img src="Design\Image\LogoPic0.jpg">
                                    <div class="name">radwan susan</div>
                              </a>
                                 <div class="inside-top">
                                  1d ago
                                 <img src="Design/Image/home-images/images/ball.svg">
                              </div>
                              </div>
  </div>
  <div class="mid">
    <p>غاز قياس 90 فوق وتحت مع بعض</p>
  </div>
  <div class="bottom">
    <div class="price">60 JD</div>
    <div class="contact">Contact</div>
  </div>
          </div>

            
          </div>
          </div>

    </div>
  </div>




    
    <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
  <script type="module" src="bootstrap-js/market.js" defer></script>
</body>
</html>