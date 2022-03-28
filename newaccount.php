<?php include_once "connection.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignUp</title>
    <link rel="icon" href="Design/Image/whiteLogo.svg" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap-css/all.min.css" />
    <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
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
    <div class="container2">
      <div class="right-1">
        <div class="title2">Registration</div>
          <?php
          $exists = false; // variable to check if the account already exists
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              // if the form has been submitted
              $username = $_POST["id"]; // get the username
              $password = $_POST["pass"]; // get the password
              $fname = $_POST["fname"]; // get the first name
              $lname = $_POST["lname"]; // get the last name
              $gender = $_POST["gender"]; // get the gender
              $year = $_POST["year"]; // get the year
              $email = $_POST["email"]; // get the email
              $date = date("Y-m-d", time()); // get the date
              $sql = "Select * from student where std_id='$username'"; // query the database
              $result = mysqli_query($conn, $sql); // execute the query
              $row = mysqli_fetch_assoc($result); // fetch the result
              $num = mysqli_num_rows($result); // count the number of rows in the result
              if ($num == 0) { // if there is no account with the same ID
                  if ($exists == false) { // if the account doesn't exist
                      $account_id = rand(100000000, 999999999); // generate an account ID for the new account
                      while ($account_id == $row["account_id"]) { // if the generated account ID is the same as the one in the database generate a new one
                          $account_id = rand(100000000, 999999999); // generate another account ID
                      }
                      // $hashedPassword = password_hash($password,PASSWORD_DEFAULT); // password hash for the password to be stored in the database
                      $sql = "INSERT INTO student (std_id,std_pass,std_fname,std_lname,loc,collage,gender,College_Year,email,created_date,account_id) VALUES ('$username','$password','$fname','$lname','maan','IT','$gender','$year','$email','$date','$account_id')";
                      $result = mysqli_query($conn, $sql);
                      echo '<script type="text/javascript">alert("Account Created Successfully");</script>';
                      // header("Location: login.php"); // redirect to the login page
                  }
              } else {
                  echo '<script type="text/javascript">alert("Account already exists!");</script>';
              }
          }
          ?>
        <form action="" method= "POST" class="form2">
          <div class="user-details">
            <div class="input-box">
              <span class="details">First Name</span>
              <input type="text" placeholder="Enter your First name" name="fname" required/>
            </div>
            <div class="input-box">
              <span class="details">Last Name</span>
              <input type="text" placeholder="Enter your Last name" name="lname" required/>
            </div>
            <div class="input-box">
              <span class="details">Email</span>
              <input type="text" placeholder="Enter your Email" name="email" required/>
            </div>
            <div class="input-box">
              <span class="details">Student Number</span>
              <input type="text" placeholder="Enter your Student Number" name="id" required/>
            </div>
            <div class="input-box">
              <span class="details">Password</span>
              <input type="password" placeholder="Enter your Password" name="pass" required/>
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
            <button type="submit" value="sign up" >sign up</button>
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