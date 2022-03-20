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
echo "Connected successfully" . "<br>";
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
         echo "looged in";
        // header("location: homepage.php");
      }else {
         echo"Your Login Name or Password is invalid";
      }
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-css/all.min.css">
    <link rel="stylesheet" href="bootstrap-css/login-style.css">
    <script src="bootstrap-js/login-js"></script>
</head>
<body>

    <div class="container">
        <div class="row content">
          <div class="col-lg-6 col-md-12 ">
          <div class="box">
            <div class="inside-box">
                <img class="img1" src="Design/Image/Untitled-1.svg" alt="image">
                <div class="Title">
                  Triibe
                </div>
            </div>
            <p class="p1">Connect With Your Friends Inside The University On Triibe</p>
            
                </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              
            <form class="form-login" action="" method="POST" >
                <div class="mb-3">
                  <input type="text" name="uname" class="form-control e-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email or Phone Number">
                </div>
                <div class="mb-3">
                  <input type="password" name="password" class="form-control e-1" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary form-control e-1 e-2">Log In</button>
                <a class="link-forgot" href="">Forgot password?</a>
                <button type="submit" class="btn btn-primary form-control e-1 e-3"> Create new Account</button>

            </form>   
            
              
              </div>
              </div>
          </div>
        </div>
      </div>  


        <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
        <script src="bootstrap-js/all.min.js"></script>
        <script src="/bootstrap-js/jquery/dist/jquery.min.js"></script>
        </body>
</html>