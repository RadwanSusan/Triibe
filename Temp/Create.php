<?php include_once "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up</title>
    <link rel="icon" href="Design/Image/whiteLogo.svg" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap-css/all.min.css" />
    <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
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
    <div class="container2">
      <div class="left">
        <div class="box">
          <img class="svg-img animate__animated animate__rollIn" src="Design/Image/logo.svg" alt="Triibe"/>
          <h1>Triibe</h1>
        </div>
        <p>
          <span class="typed"></span>
        </p>
      </div>
        <div class="right-1  animate__animated animate__backInDown">
            <?php
            $exists = false; // variable to check if the account already exists
            if ($_SERVER["REQUEST_METHOD"] == "POST") { // if the form has been submitted
                $username = $_POST["id"]; // get the username
                $password = $_POST["pass"]; // get the password
                $fname = $_POST["fname"]; // get the first name
                $lname = $_POST["lname"]; // get the last name
                $gender = $_POST["gender"]; // get the gender
                $year = $_POST["year"]; // get the year
                $email = $_POST["email"]; // get the email
                $city = $_POST["city"]; // get the city
                $collage = $_POST["collage"]; // get the collage
                $date = date("Y-m-d", time()); // get the date
                $sql = "Select * from student where std_id='$username'"; // query the database
                $result = mysqli_query($conn, $sql); // execute the query
                $row = mysqli_fetch_assoc($result); // fetch the result
                $num = mysqli_num_rows($result); // count the number of rows in the result
                if ($num == 0) {
                    // if there is no account with the same ID
                    if ($exists == false) { // if the account doesn't exist
                        $account_id = rand(100000000, 999999999); // generate an account ID for the new account
                        while ($account_id == $row["account_id"]) { // if the generated account ID is the same as the one in the database generate a new one
                            $account_id = rand(100000000, 999999999); // generate another account ID
                        }
                        // $hashedPassword = password_hash($password,PASSWORD_DEFAULT); // password hash for the password to be stored in the database
                        $sql = "INSERT INTO student (std_id,std_pass,std_fname,std_lname,loc,collage,gender,College_Year,email,created_date,account_id) VALUES ('$username','$password','$fname','$lname','$city','$collage','$gender','$year','$email','$date','$account_id')";
                        $result = mysqli_query($conn, $sql);
                        echo '<script type="text/javascript">alert("Account Created Successfully");</script>';
                        // header("Location: login.php"); // redirect to the login page
                    }
                } else {
                    echo '<script type="text/javascript">alert("Account already exists!");</script>';
                }
            }
            ?>
            <form action="" method="POST" class="form2">
                <div class="user-details">
                    <div class="input-box">
                        <input type="text" placeholder="Enter your First name" name="fname" required/>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Enter your Last name" name="lname" required/>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Enter your Email" name="email" required/>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Enter your Student Number" name="id" required/>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Enter your Password" name="pass" required/>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Confirm your password" name="pass2" required/>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Enter your collage" name="collage" required/>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Enter your city" name="city" required/>
                    </div>
                    <div class="input-box">
                      <select class="select-1" name="year" required>
                        <option value="none" disabled selected>Collage year</option>
                        <option value="1">First Year</option>
                        <option value="2">Second Year</option>
                        <option value="3">Third Year</option>
                        <option value="4">Fourth Year</option>
                        <option value="5">Fifth Year</option>
                      </select>
                    </div>
                    <div class="input-box">
                        <input type="radio" name="gender" id="dot-1" value="1"/>
                        <input type="radio" name="gender" id="dot-2" value="0"/>
                        <div class="category">
                          <span class="gender-title">Gender:</span>
                        <label for="dot-1">
                          <span class="gender">Male</span>
                          <span class="dot one"></span>
                      </label>
                        <label for="dot-2">
                          <span class="gender">Female</span>
                          <span class="dot two"></span>
                      </label>
                        </div>
                    </div>
                    <div class="Line1"></div>
                    <div class="Line2"></div>
                </div>
                <div class="button-1">
                    <button class="hvr-underline-from-center" type="submit">Create your Account</button>
                </div>
            </form>
        </div>
    </div>
     <div class="wave animate__animated animate__fadeInUp">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
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