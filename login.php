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
      <title>Triibe</title>
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
         function alert(message){
           alertify.defaults.glossary.title = 'My Title';
           alertify.alert("Triibe",message);
         }
      </script>
   </head>
   <body>
      <div class="container1">
         <div class="left">
            <div class="box">
               <img class="svg-img LeftLogo animate__animated animate__rollIn" src="Design/Image/logo.svg" alt="Triibe"/>
               <h1>Triibe</h1>
            </div>
            <p>
               <span class="typed"></span>
            </p>
         </div>
         <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $student_number = mysqli_real_escape_string($conn, $_POST["uname"]);
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
            $_SESSION["std_id"] = $row["std_id"];
            $_SESSION["std_fname"] = $row["std_fname"];
            $_SESSION["std_lname"] = $row["std_lname"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["collage"] = $row["collage"];
            $_SESSION["gender"] = $row["gender"];
            $_SESSION["account_id"] = $row["account_id"];
            $_SESSION["created_date"] = $row["created_date"];
            $_SESSION["img_name"] = $rowimg["img_name"];
            $_SESSION["friends"] = $rowfriends;
            header("location: home.php");
            } else {
              echo '<script type="text/javascript">alert("Invalid Information, Try again!");</script>';
            }
            }?>
         <div class="right animate__animated animate__backInDown">
            <form  action="" method="POST" class="form1">
               <input type="text" name="uname" placeholder="Student number" required/>
               <input class="password" type="password" name="password" placeholder="Password" required/>
               <img class="closedEye" src="Design/Image/Password-ClosedEye.svg" alt="eye" />
               <img class="openEye" src="Design/Image/Password-OpenEye.svg" alt="eye" />
               <button type="submit" href="" class="loginBtn hvr-underline-from-center">Log In</button>
               <a href="" class="forget">Forgotten password?</a>
               <div class="sign-up">
                  <a href="newaccount.php" class="sign-up-btn hvr-underline-from-center">Create New Account</a>
               </div>
            </form>
         </div>
      </div>
      <div class="wave animate__animated animate__fadeInUp">
         <svg data-name="Layer 1" xmlns="http:
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
         </svg>
      </div>
      <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
      <script src="bootstrap-js/all.min.js"></script>
      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script type="module" src="node_modules/typed.js/src/typed.js"></script>
      <script type="module" src="bootstrap-js/login.js"></script>
   </body>
</html>
