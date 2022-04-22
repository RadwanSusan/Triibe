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
      <div class="left2">
          <!-- <img class="svg-img LeftImg animate__animated animate__fadeIn animate__delay-1s" src="Design/Image/SignUpIMG.svg" alt="SignUpIMG"/> -->
          <canvas class="rive1 animate__animated animate__fadeIn animate__delay-1s animate__slow" id="canvas" width="700" height="700"></canvas>
      </div>
        <div class="right-1  animate__animated animate__backInDown">
        <?php
$exists = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["id"];
    $password = $_POST["pass"];
    $password2 = $_POST["pass2"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $year = $_POST["year"];
    $email = $_POST["email"];
    $date = date("Y-m-d", time());
    $sql = "Select * from student where std_id='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $num = mysqli_num_rows($result);
    if ($password === $password2) {
        if ($num == 0) {
            if ($exists == false) {
                $account_id = rand(100000000, 999999999);
                $sql = "Select * from student where account_id='$account_id'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                while ($num != 0) {
                    $account_id = rand(100000000, 999999999);
                    $sql = "Select * from student where account_id='$account_id'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                }
                $sql = "INSERT INTO student (std_id,std_pass,std_fname,std_lname,gender,College_Year,email,created_date,account_id) VALUES ('$username','$password','$fname','$lname','$gender','$year','$email','$date','$account_id')";
                $result = mysqli_query($conn, $sql);
                echo '<script type="text/javascript">alert("Account Created Successfully");</script>';
                header("Location: login.php");
            }
        } else {
            echo '<script type="text/javascript">alert("Account already exists!");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Password does not match!");</script>';
    }
}
?>
            <form action="" method="POST" class="form2">
              <p class="TopParagraph">Registration</p>
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
                        <input class="CreatePass1" type="password" placeholder="Enter your Password" name="pass" required/>
                    </div>
                    <div class="input-box">
                        <input class="CreatePass2" type="password" placeholder="Confirm your password" name="pass2" required/>
                        <img class="closedEye2" src="Design/Image/Password-ClosedEye.svg" alt="eye" />
                        <img class="openEye2" src="Design/Image/Password-OpenEye.svg" alt="eye" />
                    </div>
                    <div class="input-box">
                      <select class="select-1" name="year">
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
                    <button class="hvr-underline-from-center" type="submit">Sign Up</button>
                </div>
                <div>
                    <p class="bottom-text">Already have an account? <a href="login.php">Login</a></p>
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
    <script src="https://unpkg.com/@rive-app/webgl"></script>
    <script type="module" src="bootstrap-js/signUp.js"></script>
</body>
</html>
