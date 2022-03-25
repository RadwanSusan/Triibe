<?php

// Include file which makes the
// Database Connection.  
include "connection.php";

$showAlert = false; 
$showError = false; 
$exists=false;

    
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST["id"]; 
    $password = $_POST["pass"]; 
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $year = $_POST["year"];
    $email = $_POST["email"];
    $date = date("Y-m-d",time());
    

            
    
    $sql = "Select * from users where std_id='$username'";
    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if ($num == 0) {
        if ($exists==false) {

          $account_id = rand(100000000,999999999);
          while ($account_id == $row['account_id']){
            $account_id = rand(100000000,999999999);
          }
    
           // $hash = password_hash($password, 
             //                   PASSWORD_DEFAULT);
                
            // Password Hashing is used here. 
            $sql = "INSERT INTO `student` (`std_id`, `std_pass`, `std_fname`, `std_lname`, `loc`, `collage`, `gender`, `College_Year`, `email`, `status`, `created_date`, `account_id`) VALUES
            ( $username , $password , $fname , $lname , 'maan' , 'IT' , $gender , $year , $email , 1 , $date , $account_id )";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $showAlert = true; 
            }
        } 
        else { 
            $showError = "Passwords do not match"; 
        }      
    }// end if 
    
   if ($num>0) 
   {
      $exists="Username not available"; 
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
    <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
    <link rel="stylesheet" href="bootstrap-css/login-style.css" />
  </head>
  <body>
    <div class="container2">
      
      <div class="right-1">
        <div class="title2">Registration</div>
        <form-1 action="" method= "POST">
          <div class="user-details">
            <div class="input-box">
              <span class="details">First Name</span>
              <input type="text" placeholder="Enter your First name" name="fname" />
            </div>
            <div class="input-box">
              <span class="details">Last Name</span>
              <input type="text" placeholder="Enter your Last name" name="lname"/>
            </div>
            <div class="input-box">
              <span class="details">Email</span>
              <input type="email" placeholder="Enter your Email" name="email"/>
            </div>
            <div class="input-box">
              <span class="details">Student Number</span>
              <input type="text" placeholder="Enter your Student Number" name="id" />
            </div>
            <div class="input-box">
              <span class="details">Password</span>
              <input type="password" placeholder="Enter your Password" name="pass"/>
            </div>
            <div class="input-box">
              <span class="details">College Year</span>
              <select class="select-1" name="year" required>
                <option value="1">First Year</option>
                <option value="2">Second Year</option>
                <option value="3">Third Year</option>
                <option value="4">Fourth Year</option>
                <option value="5">Fifth Year</option>
              </select>
            </div>
            <div class="gender-details">
            <input type="radio" name="gender" id="dot-1" value="1"/>
            <input type="radio" name="gender" id="dot-2" value="0"/>
            <span class="gender-title">Gender</span>
            <div class="category">
              <label for="dot-1">
                <span class="dot one"></span>
                <span class="gender">Male</span>
              </label>
              <label for="dot-2">
                <span class="dot two"></span>
                <span class="gender">Female</span>
              </label>
            </div>
          </div>
          </div>
          <div class="button-1">
            <input type="submit" value="sign up" />
          </div>
        </form-1>
      </div>
    </div>

    <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap-js/all.min.js"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="module" src="node_modules/typed.js/src/typed.js"></script>
    <script type="module" src="bootstrap-js/login.js"></script>
  </body>
</html>
