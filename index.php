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
   <title>Triibe login</title>
   <link rel="icon" href="Design/Image/whiteLogo.svg" type="image/x-icon">
   <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
   <link rel="stylesheet" href="bootstrap-css/all.min.css" />
   <link rel="stylesheet" href="node_modules/animate.css/animate.css">
   <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
   <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
   <link href="node_modules/hover.css/css/hover-min.css" rel="stylesheet">
   <link rel="stylesheet" href="bootstrap-css/login-style.css" />
   <script src="node_modules/alertifyjs/build/alertify.min.js"></script>
   <script type="text/javascript">
      function alert(message) {
         alertify.defaults.glossary.title = 'My Title';
         alertify.alert("Triibe", message);
      }
   </script>
</head>

<body>
   <div class="container1">
      <div class="left">
         <div class="box">
            <img class="svg-img LeftLogo animate__animated animate__rollIn" src="Design/Image/logo.svg" alt="Triibe" />
            <h1>Triibe</h1>
         </div>
         <p>
            <span class="typed"></span>
         </p>
      </div>
      <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $student_number = mysqli_real_escape_string($conn, $_POST["stNo"]);
         $mypassword = mysqli_real_escape_string($conn, $_POST["password"]);
         $sql = "SELECT * FROM student WHERE std_id = '$student_number' and std_pass = '$mypassword'";
         $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
         $count = mysqli_num_rows($result);
         if ($count == 1) {
            $imgid = $row["img_id"];
            $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
            $resultimg = mysqli_query($conn, $sqlimg);
            $rowimg = mysqli_fetch_assoc($resultimg);
            $sqlfriends = "SELECT * FROM friends WHERE user_id = '$student_number'";
            $resultfriends = mysqli_query($conn, $sqlfriends);
            $rowfriends = mysqli_fetch_assoc($resultfriends);
            $sqlcover = "SELECT img_name FROM profile_info WHERE std_id = '$student_number'";
            $resultcover = mysqli_query($conn, $sqlcover);
            $rowcover = mysqli_fetch_assoc($resultcover);
            $_SESSION["std_id"] = $row["std_id"];
            $_SESSION["std_fname"] = $row["std_fname"];
            $_SESSION["std_lname"] = $row["std_lname"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["loc"] = $row["loc"];
            $_SESSION["collage"] = $row["collage"];
            $_SESSION["gender"] = $row["gender"];
            $_SESSION["account_id"] = $row["account_id"];
            $_SESSION["created_date"] = $row["created_date"];
            $_SESSION["account_type"] = $row["account_type"];
            $statusSQL = "UPDATE student SET status = 1 WHERE std_id = '$student_number'";
            $statusResult = mysqli_query($conn, $statusSQL);
            if (isset($rowimg["img_name"])) {
               $_SESSION["personalProfile"] = $rowimg["img_name"];
            } else {
               if ($row["gender"] == 1) {
                  $_SESSION["personalProfile"] = "Design\Image\LogoPic0.jpg";
               } else {
                  $_SESSION["personalProfile"] = "Design\Image\LogoPic1.jpg";
               }
            }
            if (isset($rowcover["img_name"])) {
               $_SESSION["coverimg_name"] = $rowcover["img_name"];
            } else {
               if ($row["gender"] == 1) {
                  $_SESSION["coverimg_name"] = "Design\Image\LogoPic0.jpg";
               } else {
                  $_SESSION["coverimg_name"] = "Design\Image\LogoPic1.jpg";
               }
            }
            $_SESSION["friends"] = $rowfriends;
            if ($row["account_type"] == 1) {
               echo "<script>window.location.href='home.php';</script>";
            } else if ($row["account_type"] == 2) {
               echo "<script>window.location.href='home.php';</script>";
            } else {
               echo "<script>window.location.href='home.php';</script>";
            }
         } else {
            echo '<script type="text/javascript">alert("Invalid Information, Try again!");</script>';
         }
      } ?>
      <div class="right animate__animated animate__backInDown">
         <form action="" method="POST" class="form1">
            <input type="text" name="stNo" placeholder="Student number" required />
            <input class="password" type="password" name="password" placeholder="Password" required />
            <img class="closedEye" src="Design/Image/Password-ClosedEye.svg" alt="eye" />
            <img class="openEye" src="Design/Image/Password-OpenEye.svg" alt="eye" />
            <button type="submit" href="" class="loginBtn hvr-underline-from-center">Log In</button>
            <div class="sign-up">
               <a href="newaccount.php" class="sign-up-btn hvr-underline-from-center">Create New Account</a>
            </div>
         </form>
      </div>
   </div>
   <div>
      <svg class="waves animate__animated animate__fadeInUp" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
         <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
         </defs>
         <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="#ABAAAA" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="#CFCFCF" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="#DADADA" />
            <use xlink:href="#gentle-wave" x="30" y="7" fill="#EEEEEE" />
         </g>
      </svg>
   </div>
   </div>
   <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
   <script src="bootstrap-js/all.min.js"></script>
   <script src="node_modules/jquery/dist/jquery.min.js"></script>
   <script type="module" src="node_modules/typed.js/src/typed.js"></script>
   <script type="module" src="bootstrap-js/login.js"></script>
</body>

</html>
