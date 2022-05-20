<?php
include_once "connection.php";
session_start();
$id = $_GET['account_id'];
$sql = "SELECT * FROM student WHERE account_id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sqlimg = "SELECT * FROM img WHERE img_id = '$row[img_id]'";
$resultimg = mysqli_query($conn, $sqlimg);
$rowimg = mysqli_fetch_assoc($resultimg);
if (isset($rowimg["img_name"])) {
  $FriendImgName = $rowimg["img_name"];
} else {
  if ($row["gender"] == 1) {
    $FriendImgName = "Design\Image\LogoPic0.jpg";
  } else {
    $FriendImgName = "Design\Image\LogoPic1.jpg";
  }
}
$sqlIsFriend = "SELECT * FROM friends WHERE user_id = '".$row["std_id"]."' AND friend_id = '".$_SESSION["std_id"]."'";
$resultIsFriend = mysqli_query($conn, $sqlIsFriend);
$rowIsFriend = mysqli_fetch_assoc($resultIsFriend);
if (isset($rowIsFriend)) {
  $IsFriend = 1;
} else {
  $IsFriend = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
  <link rel="stylesheet" href="bootstrap-css/all.min.css" />
  <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
  <link id="theme" rel="stylesheet" href="bootstrap-css/personal.css" />
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Triibe profile</title>
</head>

<body>
  <nav class="nav">
    <div class="nav-left">
      <div class="box">
        <img src="Design/Image/home-images/images/logo.svg" alt="logoLight" class="logoLight">
        <img src="Design/Image/home-images/images/logo2.svg" alt="logoDark" class="logoDark">
        <p>Triibe</p>
      </div>
      <div class="search-box">
        <img src="Design/Image/home-images/images/Search-Icon.svg" alt="search">
        <input type="text" placeholder="Search">
      </div>
    </div>
    <div class="nav-right">
      <ul>
        <li>
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/Settings-icon.svg" alt="settingIcon">
          <img class="SettingsIcon-Dark" src="Design/Image/home-images/images/Settings-icon2.svg" alt="settingIcon">
        </li>
        <li>
          <img class="mapIcon-Light" src="Design/Image/home-images/images/mapIcon.svg" alt="mapIcon">
          <img class="mapIcon-Dark" src="Design/Image/home-images/images/mapIcon2.svg" alt="mapIcon">
        </li>
        <li>
          <img class="themeLight" src="Design/Image/home-images/images/theme-light.svg" alt="themeLight">
          <img class="themeDark" src="Design/Image/home-images/images/theme-dark.svg" alt="themeDark">
        </li>
        <li>
          <img class="notificationIcon-light" src="Design/Image/home-images/images/notification-logo.svg" alt="notificationIcon">
          <img class="notificationIcon-dark" src="Design/Image/home-images/images/notification-logo2.svg" alt="notificationIcon1">
        </li>
        <li>
          <img class="chatLight" src="Design/Image/home-images/images/chat-icon.svg" alt="image">
          <img class="chatDark" src="Design/Image/home-images/images/chat-icon2.svg" alt="image">
        </li>
      </ul>
      <div class="nav-user-icon online">
        <img src="<?php echo $_SESSION["img_name"] ?>" alt="">
        <div class="name">
          <?php echo $_SESSION["std_fname"] ?>
        </div>
      </div>
    </div>
  </nav>
  <div class="content1">
    <div class="top">
      <div>
        <img src="Design/Image/home-images/images/farme.svg" alt="">
        <div class="edit-cover-content">
          <div class=".edit-cover">
            <img src="Design/Image/home-images/images/edit cover.svg" alt="">
            <p>Edit cover</p>
          </div>
        </div>
      </div>
      <!-- <img src="Design/Image/home-images/images/Linear_Layer.svg" alt=""> -->
    </div>
    <div class="bottom-content">
      <div class="bottom">
        <div class="left-bottom">
          <img src="<?php echo $FriendImgName?>" alt="">
          <div class="info">
            <div class="name-bottom">
              <p><?php echo $row["std_fname"] . " " . $row["std_lname"] ?></p>
            </div>
            <div class="number-friends"><?php
                                        $sqlfriend = "SELECT * FROM friends WHERE user_id = '".$row["std_id"]."'";
                                        $resultfriend = mysqli_query($conn, $sqlfriend);
                                        $countfriend = mysqli_num_rows($resultfriend);
                                        echo $countfriend . " Friends";
                                        ?>
            </div>
          </div>
        </div>
        <div class="right-bottom">
          <?php 
          if ($IsFriend == 0) {
            echo '
          <div class="add-friends">
            <img src="Design/Image/home-images/images/Group-add.svg" alt="">
            <p>Add Friends</p>
          </div>';
          } else {
            echo '
            <div class="add-friends">
            <img src="Design/Image/home-images/images/Group-add.svg" alt="">
            <p>Friends</p>
          </div>';
        }
          ?>
          <div class="edit-profile">
            <img src="Design/Image/home-images/images/Group-edit.svg" alt="">
            <p>Edit Profile</p>
          </div>
        </div>
      </div>
    </div>
    <div class="line-content">
      <div class="line"></div>
    </div>
    <div class="list-photo-content">
      <div class="list">
        <a href="">Posts</a>
        <a href="">Friends</a>
        <a href="">Photos</a>
        <a href="">Videos</a>
      </div>
    </div>
    <div class="content-personal-post">
      <div class="content-left">
        <div class="left-post">
          <h1>Bio</h1>
          <div class="title-bio">
            <div class="name">Stickin' to the plan 🃏</div>
            <img src="Design/Image/home-images/images/bio-title.svg" alt="">
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio1.svg" alt="">
            <div class="name name2">Studies Software Engineering at Al-Hussein
              Bin Talal University</div>
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio2.svg" alt="">
            <div class="name">Lives in <?php echo $row["loc"] ?></div>
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio3.png" alt="">
            <div class="name">From <?php echo $row["loc"] ?></div>
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio4.png" alt="">
            <div class="name">radwan_susan4</div>
          </div>
          <div class="bio">
            <img src="Design/Image/home-images/images/bio5.png" alt="">
            <div class="name">RadwanSusan</div>
          </div>
        </div>
        <div class="left-post">
          <div class="photo-see">

            <h1>Photo</h1>
            <div class="see-more">See more</div>
          </div>
          <div class="Photo">
            <img src="/Design/Image/home-images/images/p1.svg" alt="image">
            <img src="/Design/Image/home-images/images/p2.svg" alt="image">
            <img src="/Design/Image/home-images/images/p3.svg" alt="image">
            <img src="/Design/Image/home-images/images/p4.svg" alt="image">
          </div>
        </div>
        <div class="left-post">
          <div class="photo-see">
            <h1>Friends</h1>
            <div class="see-more">See more</div>
          </div>
          <div class="Friends">
            <div class="left-Friends">
              <?php $sql = "SELECT * FROM friends WHERE user_id = '$id'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row1 = mysqli_fetch_assoc($result)) {
                  $sql1 = "SELECT * FROM student WHERE std_id = '" . $row1["friend_id"] . "'";
                  $result1 = mysqli_query($conn, $sql1);
                  if (mysqli_num_rows($result1) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result1)) {
                      $imgid = $row2["img_id"];
                      $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                      $resultimg = mysqli_query($conn, $sqlimg);
                      $rowimg2 = mysqli_fetch_assoc($resultimg);
                      echo "<div class='namePhoto'>
                              <img src='" . $rowimg2["img_name"] . "' alt='image'>
                              <div class='names'>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</div>
                            </div>";
                    }
                  }
                }
              } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="right-post">
        <?php
        $sqlPost = "SELECT * FROM post WHERE author = '".$row["std_id"]."'";
        $resultPost = mysqli_query($conn, $sqlPost);
        if (mysqli_num_rows($resultPost) > 0) {
          while ($rowPost = mysqli_fetch_assoc($resultPost)) {
          }
        }
        ?>
       

      </div>
    </div>
  </div>
  <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script type="module" src="bootstrap-js/friendpage.js"></script>
</body>

</html>
