<?php

//include "loginphp.php";
$servername = $_SERVER['SERVER_NAME'];
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, "root","" ,"triibe");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
// echo "Connected successfully" . "<br>";
}

session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($conn,$_POST['uname']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

      $sql = "SELECT * FROM student WHERE std_id = '$myusername' and std_pass = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      //$active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         echo "<p>looged in</p>";
        // header("location: homepage.php");
      }else {
         echo"Your Login Name or Password is invalid";
      }
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap-css/all.min.css" />
    <link rel="stylesheet" href="node_modules/animate.css/animate.css">
    <link rel="stylesheet" href="bootstrap-css/login-style.css" />
  </head>
  <body>
    <div class="container1">
      <div class="left">
        <div class="box">
          <img class="svg-img animate__animated animate__rollIn" src="Design/Image/logo.svg" style="transform: rotate(20deg);" alt="Triibe"/>
          <h1>Triibe</h1>
        </div>
        <p class="typed"></p>
      </div>
      <div class="right animate__animated animate__backInDown">
        <form action="" method="POST">
          <input type="text" name="uname" placeholder="Email Or student number" />
          <input type="password" name="password" placeholder="Password" />
          <button type="submit" href="" class="loginBtn">Log In</button>
          <a href="" class="forget">Forgotten password?</a>
          <div class="sign-up">
            <a href="" class="sign-up-btn">Create New Account</a>
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