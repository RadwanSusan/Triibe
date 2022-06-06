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
  <title>Triibe Admin</title>
  <link rel="stylesheet" href="bootstrap-css/admin.css">
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
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



        <li class="theme">
          <img class="themeLight" src="Design/Image/home-images/images/theme-light.svg" alt="themeLight" />
          <img class="themeDark" src="Design/Image/home-images/images/theme-dark.svg" alt="themeDark" />
        </li>
      </ul>
      <div class="nav-user-icon online">
        <a href='admin.php'><img src="<?php echo $_SESSION["personalProfile"] ?>" /></a>
        <a href='admin.php'>
          <div class="name">
            <?php echo $_SESSION["std_fname"]; ?>
          </div>
        </a>
      </div>
    </div>
  </nav>
  <div class="container-admin">
    <div class="left-Admin">
      <h2>Website Info</h2>
      <?php
      $sql = "SELECT COUNT(*) FROM student";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='name2-number2 totalUsers'>
                <div class='name'>Total Users:</div>
                <div class='number'>" . $row["COUNT(*)"] . "</div>
            </div>";
        }
      }
      ?>
      <?php
      $sql = "SELECT COUNT(*) FROM post";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo " <div class='name2-number2 totalPosts'>
                <div class='name'>Total Posts:</div>
                <div class='number'>" . $row["COUNT(*)"] . "</div>
            </div>";
        }
      }
      ?>
    </div>

    <div class="main-Admin">
      <h2>Manage Profiles</h2>
      <div class="search-profile">
        <div class="name-search"> Search for a profile:</div>
        <div class="search-box m-s"> <img src="Design/Image/home-images/images/Search-Icon.svg" alt="search">
          <input type="text" placeholder="Search" id="searchIn" autocomplete="off" std_id="<?php echo $_SESSION['std_id']; ?>" />
        </div>
        <div class="searchArea searchArea2"></div>
      </div>
      <div class="profile-info-image">
        <div class="profile-info">Profile Info:</div>
        <!-- <div class="profile-image"> <img src="Design/Image/home-images/images/Group-profile.svg" alt="image"> </div> -->
        <?php
        if (isset($_GET["profileInfo"])) {
          $sql = "SELECT * FROM student WHERE std_id = '" . $_GET["profileInfo"] . "'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $sqlimg = "SELECT * FROM img WHERE img_id = '" . $row["img_id"] . "'";
              $resultimg = mysqli_query($conn, $sqlimg);
              $rowimg = mysqli_fetch_assoc($resultimg);
              if (isset($rowimg["img_name"])) {
                $rowimg["img_name"] =  $rowimg["img_name"];
              } else {
                if ($row["gender"] == 1) {
                  $rowimg["img_name"] = "Design\Image\LogoPic0.jpg";
                } else {
                  $rowimg["img_name"] =  "Design\Image\LogoPic1.jpg";
                }
              }
              echo "<div class='profile-image'><img src='" . $rowimg["img_name"] . "' alt='image'></div>
            </div>
              <div class='profile-info-know'>
              <div class='student-info'>Student name :</div>
            <div class='student-know one'>" . $row["std_fname"] . " " . $row["std_lname"] . "</div>
            </div>
              <div class='profile-info-know'>
              <div class='student-info'>Student Number :</div>
              <div class='student-know two'>" . $row["std_id"] . "</div>
            </div>
              <div class='profile-info-know'>
              <div class='student-info'>Account Id :</div>
              <div class='student-know three'>" . $row["account_id"] . "</div>
            </div>
            <div class='profile-info-know'>
              <div class='student-info'>Created Date :</div>
              <div class='student-know five'>" . $row["created_date"] . "</div>
            </div>";
              if ($row["gender"] == 1) {
                echo " <div class='profile-info-know'>
              <div class='student-info'>Gender :</div>
              <div class='student-know six'>Male</div>
            </div>";
              } else {
                echo " <div class='profile-info-know'>
              <div class='student-info'>Gender :</div>
              <div class='student-know six'>Female</div>
            </div>";
              }
              echo "
            <div class='profile-info-know'>
              <div class='student-info'>Birth-Location:</div>
              <div class='student-know seven'>" . $row["loc"] . "</div>
            </div> ";
              $sqlc = "SELECT Coll_Name,Coll_No FROM colleges WHERE Coll_NO = (SELECT Coll_Major_No FROM majors WHERE ID = (SELECT Std_Major_No FROM students WHERE std_No = '" . $_GET["profileInfo"] . "'))";
              $resultc = mysqli_query($conn, $sqlc);
              $rowc = mysqli_fetch_assoc($resultc);
              echo "<div class='profile-info-know'>
              <div class='student-info'>Collage:</div>
              <div class='student-know eight'>" . $rowc["Coll_Name"] . "</div>
            </div>";
              $sqlm = "SELECT Major_Name,Major_No FROM majors WHERE ID = (SELECT Std_Major_No FROM students WHERE std_No = '" . $_GET["profileInfo"] . "')";
              $resultm = mysqli_query($conn, $sqlm);
              $rowm = mysqli_fetch_assoc($resultm);
              echo "<div class='profile-info-know'>
              <div class='student-info'>Specialization:</div>
              <div class='student-know nine'>" . $rowm["Major_Name"] . "</div>
            </div>
              <div class='profile-info-know'>
              <div class='student-info'>Role :</div>
              <div class='student-know ten'>Student</div>
            </div>
            <div class='delete-lock'>
              <div class='delete-account' data-std_id='" . $row["std_id"] . "' >Delete Account</div>
              <div class='lock-account eleven'  data-std_id='" . $row["account_id"] . "'>Show Account</div>
            </div>
            </div>
            <script type='text/javascript'>
            document.querySelector('.delete-account').addEventListener('click', function(e){
              const std_id = document.querySelector('.delete-account').getAttribute('data-std_id');
              console.log(std_id);
              confirm('Are You Sure You Want To Delete This Account?', () =>{
              $.ajax({
                url : 'backBone.php',
                method : 'POST',
                data :{
                std_id,
                deleteAccount : 1,
                },
                success: (data) => {
                  window.location.href = 'admin.php';
                  },
                });
              });
            });
            document.querySelector('.lock-account').addEventListener('click', () => {
              const std_id = document.querySelector('.lock-account').getAttribute('data-std_id');
              window.location.href = 'friendpage.php?account_id=' + std_id;
            });
          </script>";
            }
          }
        } else {
          echo "<div class='profile-image'> <img src='Design/Image/home-images/images/Group-profile.svg' alt='image'> </div>";
        }
        ?>

        <!-- <div class="right-Admin">
          <p>Create a new Admin Acc</p>
          <form action="">
            <input type="number" placeholder="Account id">
            <input type="number" placeholder="Password">
            <button>Create</button>
          </form>
        </div> -->


      </div>
      <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
      <script src="bootstrap-js/all.min.js"></script>
      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
      <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
      <script type="module" src="bootstrap-js/admin.js" defer></script>

</body>

</html>
