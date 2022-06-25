<?php
include_once "connection.php";
session_start();
$badwords = ["fuck", "shit", "bitch", "asshole", "dick", "pussy", "كس", "كس امك", "قحبة", "شرموطة", "منيك", "شرمط"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="Design/Image/whiteLogo.svg" type="image/x-icon" />
  <title>Triibe Market</title>
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
  <div class="post-card slide-in-elliptic-top-fwd">
    <div class="top-card">
      <div class="left-top-card">
        <div class="card-name-photo">
          <img class="card-user-photo" src="<?php echo $_SESSION["personalProfile"] ?>" alt="">
          <div class="card-name"><?php echo $_SESSION["std_fname"] . " " . $_SESSION["std_lname"] ?></div>
        </div>
        <div class="card-inside-top">
          <img class="PublicChoice" src="Design/Image/home-images/images/ball2.svg" alt="" style="display:inline-block;">
          <img class="FriendChoice" src="Design/Image/home-images/images/friends_Post.svg" alt="" style="display:none;">
          <img src="Design/Image/home-images/images/card-down.svg" alt="">
        </div>
      </div>
      <div class="right-top-card">
        <img class="exitCard" src="Design/Image/home-images/images/exit-card.svg" alt="">
      </div>
    </div>
    <?php
    $img_id = null;
    $video_id = null;
    $fileId = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $content = explode(" ", $_POST["content"]);
      $usingBadWords = false;
      foreach ($content as $word) {
        foreach ($badwords as $badword) {
          if ($word == $badword) {
            $usingBadWords = true;
            break;
          }
        }
      }
      if ($usingBadWords == false) {
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $ext = $fileActualExt;
        $content = $_POST['content'];
        $price = $_POST['price'];
        $phone = $_POST['phone'];
        $date = date("Y-m-d H:i:s", time());
        if ($price != "") {
          if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
            if ($fileError === 0) {
              if ($fileSize < 100000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'db_images/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "INSERT INTO market_post (content,created_date, author , img_name , price, phone_number) VALUES ('$content','$date','" . $_SESSION["std_id"] . "','$fileDestination','$price','$phone')";
                mysqli_query($conn, $sql);
              } else {
                echo "<script>alert('Your file is too big!')</script>";
              }
            } else {
              echo "<script>alert('There was an error uploading your file!')</script>";
            }
          } else {
            echo "<script>alert('please insert a new image')</script>";
          }
        } else {
          echo "<script>alert('Please insert price')</script>";
        }
      } else {
        echo "<script>alert('لا تسب')</script>";
      }
    }
    ?>
    <form method="POST" enctype="multipart/form-data">
      <div class="mid-card">
        <div class="my-textarea" contenteditable="true">Write something here...</div>
        <textarea class="card-write-post" rows="3" placeholder="Write A Post ..." name="content"></textarea>
      </div>
      <div class="formIdSelector animate__animated animate__fadeIn animate__faster" style="display: none;">
        <p>Choose where to post:</p>
        <div class="radioInputBox">
          <input class="formIdInput1" type="radio" name="formId" id="formId1" value="1" checked />
          <label class="formIdLabel1" for="formId1">Public</label>
        </div>
        <span></span>
        <div class="radioInputBox">
          <input class="formIdInput2" type="radio" name="formId" id="formId2" value="2" />
          <label class="formIdLabel2" for="formId2">Friends</label>
        </div>
        <button type="button" class="btn-primary hvr-underline-from-center">close</button>
      </div>
      <div class="down-card">
        <div class="left-down-card">
          <p>Add to your post</p>
          <div class="icon-down">
            <input type="text" class="priceInput" placeholder="Price" name="price">
            <input type="text" class="phone" placeholder="Phone Number" name="phone">
            <label class="uploadLabel" for="uploadfile">
              <img class="imgIcon" src="Design/Image/home-images/images/ImageIcon.svg" alt="">
            </label>
            <input class="fileUpload_Button" type="file" name="file" id="uploadfile" accept=".gif,.jpg,.jpeg,.png,.doc,.mp4,.mkv">
            <div class="form-popup arrow-div animate__animated animate__fadeIn animate__faster" id="myForm">
            </div>
            <input type="submit" class="post-write" value="POST" name="post">
    </form>
  </div>
  </div>
  </div>
  </div>
  </div>
  <div class="container1">
    <div class="main">
      <div class="left">
        <div class="left-top">
          <h1 class="h2">Market place</h2>
        </div>
        <div class="bio bio1">
          <img src="Design/image market/browse.svg" alt="">
          <div class="name1 name3 browseAll">Browse all</div>
        </div>
        <div class="bio bio5">
          <img src="Design/image market/buying.svg" alt="">
          <div class="name1 yourProduct">your Product</div>
        </div>
        <div class="bio bio2">
          <img src="Design/image market/selling.svg" alt="">
          <div class="name1 addProduct">Add a product</div>
        </div>
      </div>
      <div class="contactBox">
        <div class="chatlink">
          <p class="chatPage">chat</p>
          <button class="closeContact">close</button>
        </div>
      </div>
      <div class="right">
        <h1>Today picks</h1>
        <div class="all-Ele">
          <div class="all-Ele-top">
            <?php
            if (isset($_COOKIE["yourProduct"]) == false) {
              $yourProduct = 2;
            } else {
              $yourProduct = $_COOKIE["yourProduct"];
            }
            if ($yourProduct == 2) {
              $sql = "SELECT * FROM market_post order by created_date desc";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($result)) {
                $sql2 = "SELECT * FROM student where std_id = '" . $row["author"] . "'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_array($result2);
                $imgid = $row2["img_id"];
                $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                $resultimg = mysqli_query($conn, $sqlimg);
                $rowimg = mysqli_fetch_assoc($resultimg);
                if (isset($rowimg["img_name"])) {
                  $userImage = $rowimg["img_name"];
                } else {
                  if ($row2["gender"] == 1) {
                    $userImage = "Design\Image\LogoPic0.jpg";
                  } else {
                    $userImage = "Design\Image\LogoPic1.jpg";
                  }
                }
                $imgPost = $row["img_name"];
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
                echo " <div class='img1-card1'>
              <div class='img1'>
                <img src='$imgPost' alt='img'>
              </div>
              <div class='card1'>
                <div class='left-post'>
                  <div class='top'>
                    <a class='name-photo' href='friendpage.php?account_id=" . $row2["account_id"] . "'>
                      <img src='" . $userImage . "'>
                      <div class='name'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</div>
                    </a>
                    <div class='inside-top'>
                      $difftime
                      <img src='Design/Image/home-images/images/ball.svg'>
                    </div>
                  </div>
                </div>
                <div class='mid'>
                  <p>" . $row["content"] . "</p>
                </div>
                <div class='bottom'>
                  <div class='price'>" . $row["price"] . "</div>
                  <div class='contact' data-MPID='" . $row["market_post_id"] . "' >Contact</div>
                </div>
              </div>
            </div>";
              }
            } else {
              $sql = "SELECT * FROM market_post WHERE author =" . $_SESSION["std_id"] . " order by created_date desc";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($result)) {
                $sql2 = "SELECT * FROM student where std_id = '" . $row["author"] . "'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_array($result2);
                $imgid = $row2["img_id"];
                $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                $resultimg = mysqli_query($conn, $sqlimg);
                $rowimg = mysqli_fetch_assoc($resultimg);
                if (isset($rowimg["img_name"])) {
                  $userImage = $rowimg["img_name"];
                } else {
                  if ($row2["gender"] == 1) {
                    $userImage = "Design\Image\LogoPic0.jpg";
                  } else {
                    $userImage = "Design\Image\LogoPic1.jpg";
                  }
                }
                $imgPost = $row["img_name"];
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
                echo " <div class='img1-card1'>
              <div class='img1'>
                <img src='$imgPost' alt='img'>
              </div>
              <div class='card1'>
                <div class='left-post'>
                  <div class='top'>
                    <a class='name-photo' href='friendpage.php?account_id=" . $row2["account_id"] . "'>
                      <img src='" . $userImage . "'>
                      <div class='name'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</div>
                    </a>
                    <div class='inside-top'>
                      $difftime
                      <img src='Design/Image/home-images/images/ball.svg'>
                    </div>
                  </div>
                </div>
                <div class='mid'>
                  <p>" . $row["content"] . "</p>
                </div>
                <div class='bottom'>
                  <div class='price'>" . $row["price"] . "</div>
                  <div class='contact' data-MPID='" . $row["market_post_id"] . "' >Contact</div>
                </div>
              </div>
            </div>";
              }
            }
            ?>

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
