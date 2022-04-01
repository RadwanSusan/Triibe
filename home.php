<?php
include_once "connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap-css/all.min.css" />
    <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
    <link rel="stylesheet" href="bootstrap-css/home-style.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Triibe Home</title>
  </head>
  <body>
    <nav>
      <div class="nav-left">
        <div class="box">
          <img
            src="Design/Image/home image/images/logo.svg"
            alt="logo"
            class="logo"
          />
          <p>Triibe</p>
        </div>
        <div class="search-box">
          <img src="Design/Image/home image/images/search.png" alt="search" />
          <input type="text" placeholder="Search" />
        </div>
      </div>
      <div class="nav-right">
        <ul>
          <li>
            <img
            
              src="Design/Image/home image/images/Settings-icon.png"
              alt="image"
            />
          </li>
          <li>
            <img
              src="Design/Image/home image/images/plans.png"
              alt="image"
            />
          </li>
          <li>
            <img src="Design/Image/home image/images/Vector1.png" alt="image" />
          </li>
          <li>
            <img src="Design/Image/home image/images/Vector2.png" alt="image" />
          </li>
          <li>
            <img
              class="img3"
              src="Design/Image/home image/images/Vector3.png"
              alt="image"
            />
          </li>
        </ul>
        <div class="nav-user-icon online">
          <img src="<?php echo $_SESSION["img_name"] ?>" alt="r" />
          <div class="name"><?php echo $_SESSION["std_fname"] ?></div>
        </div>
      </div>
    </nav>
    <div class="container1">
      <div class="left-sidebar">
        <div class="group-list">
         <a href="#"><img src="Design/Image/home image/images/pages-icon.png" alt=""><span>Pages</span></a>
         <a href="#"><img src="Design/Image/home image/images/Groups.png" alt=""><span>Groups</span></a>
          <div class="group-page">
             <p>Friends</p>
             <?php
             //print all friends
              $sql = "SELECT * FROM friends WHERE user_id = '".$_SESSION["login_user"]."'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  $sql1 = "SELECT * FROM student WHERE std_id = '".$row["friend_id"]."'";
                  $result1 = mysqli_query($conn, $sql1);
                  if (mysqli_num_rows($result1) > 0) {
                    while($row1 = mysqli_fetch_assoc($result1)) {
                      
                      $imgid = $row1["img_id"];
                      $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                      $resultimg = mysqli_query($conn, $sqlimg);
                      $rowimg = mysqli_fetch_assoc($resultimg);
                      echo  "<a href='#'><img src='".$rowimg["img_name"]."' alt=''/>".$row1["std_fname"]." ".$row1["std_lname"]."</a>";
                    }
                  }
                }
              }
             
              ?>
          </div>
        </div>
      </div>
      <div class="main-content">
        <div class="story-gallery">
          <div class="story">
            <img src="Design/Image/home image/images/upload.png" alt="">
            <p>Zaid Al-Tamari</p>
          </div>
          <div class="story">
            <img src="Design/Image/home image/images/upload.png" alt="">
            <p>Ømar Thær</p>
          </div>
          <div class="story">
            <img src="Design/Image/home image/images/upload.png" alt="">
            <p>Hamza KH</p>
          </div>
          <div class="story">
            <img src="Design/Image/home image/images/upload.png" alt="">
            <p>Fadi Al-Tamari</p>
          </div>
          <div class="story">
            <img src="Design/Image/home image/images/upload.png" alt="">
            <p>Moath Smoor</p>
          </div>
        </div>
        <div class="write-post-container">
          <div class="user-profile">
            <!-- <img src="Design/Image/home image/images/profile-pic.png" alt=""> -->
          </div>
        </div>


      </div>
      <div class="right-sidebar">
        <div class="imp-link">
          <a href="#"
            ><img src="Design/Image/home image/images/Icons1.png" alt="" /><span
              >Saved posts</span
            ></a
          >
          <a href="#"
            ><img
              src="Design/Image/home image/images/MarketIcon.png"
              alt=""
            /><span>Market</span></a
          >
          <a href="#"
            ><img
              src="Design/Image/home image/images/Vector5.png"
              alt=""
            /><span>Housing</span></a
          >
          <a href="#"
            ><img
              src="Design/Image/home image/images/add-friends.png"
              alt=""
            /><span>E-Learning</span></a
          >
          <a href="#"
            ><img
              src="Design/Image/home image/images/Info-Icon.png"
              alt=""
            /><span>Student information system</span></a
          >
          <a href="#"
            ><img
              src="Design/Image/home image/images/RegIcon.png"
              alt=""
            /><span>Student registration system</span></a
          >
          <a href="#"
            ><img
              src="Design/Image/home image/images/carbon_warning-other.png"
              alt=""
            /><span class="other-link">Other links</span>
            <img src="Design/Image/home image/images/Vector7.png" alt="">
        </a>
          
          
        </div>
      </div>
    </div>

    <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap-js/all.min.js"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="module" src="node_modules/typed.js/src/typed.js"></script>
    <script type="module" src="bootstrap-js/login.js"></script>
  </body>
</html>
