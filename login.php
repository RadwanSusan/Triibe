<?php
include "connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Triibe</title>
    <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap-css/all.min.css" />
    <link rel="stylesheet" href="node_modules/animate.css/animate.css">
    <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
    <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
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
          <img class="svg-img animate__animated animate__rollIn" src="Design/Image/logo.svg" alt="Triibe"/>
          <h1>Triibe</h1>
        </div>
        <p>
          <span class="typed"></span>
        </p>
      </div>
      <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // username and password sent from form
          $myusername = mysqli_real_escape_string($conn, $_POST["uname"]);
          $mypassword = mysqli_real_escape_string($conn, $_POST["password"]);

          $sql = "SELECT * FROM student WHERE std_id = '$myusername' and std_pass = '$mypassword'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          //$active = $row['active'];
          $count = mysqli_num_rows($result);
          // If result matched $myusername and $mypassword, table row must be 1 row
          if ($count == 1) {
              //session_register("myusername");
              $_SESSION["login_user"] = $myusername;
              // echo "<p>looged in</p>" . $row["account_id"];
              // header("location: homepage.php");
          } else {
              echo '<script type="text/javascript">alert("Invalid Information, Try again!");</script>';
          }
      } ?>
      <div class="right animate__animated animate__backInDown">
        <form action="" method="POST">
          <input type="text" name="uname" placeholder="Student number or Email" />
          <input type="password" name="password" placeholder="Password" />
          <button type="submit" href="" class="loginBtn">Log In</button>
          <a href="" class="forget">Forgotten password?</a>
          <div class="sign-up">
            <a href="newaccount.php" class="sign-up-btn">Create New Account</a>
          </div>
        </form>
      </div>
    </div>
    <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap-js/all.min.js"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="module" src="node_modules/typed.js/src/typed.js"></script>
    <script type="module" src="bootstrap-js/login.js"></script>
  </body>
  </html>