<?php
include_once 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="icon" href="Design/Image/whiteLogo.svg" type="image/x-icon" />
   <title>Triibe home</title>
   <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
   <link rel="stylesheet" href="bootstrap-css/all.min.css" />
   <link rel="stylesheet" href="bootstrap-css/changePass.css">
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $oldPass = $_POST["oldPass"];
   $newPass = $_POST['newPass'];
   $newPass2 = $_POST['newPass2'];
   $user = $_SESSION['std_id'];
   $sql = "SELECT * FROM student WHERE std_id = '$user'";
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);
   if ($row['std_pass'] == $oldPass) {
      if ($newPass == $newPass2) {
         $sql = "UPDATE student SET std_pass = '$newPass' WHERE std_id = '$user'";
         mysqli_query($conn, $sql);
         echo "<script>alert('Password changed successfully');</script>";
      } else {
         echo "<script>alert('New passwords do not match');</script>";
      }
   } else {
      echo "<script>alert('Old password is incorrect');</script>";
   }
}
?>

<body>
   <div id="box">
      <form id="myform-search" method="post" autocomplete="off">
         <h1>Change Password <span>choose a good one!</span></h1>
         <form>
            <p>
               <input type="password" value="" placeholder="Enter old Password" name="oldPass" id="op" class="password">
               <button class="unmask" type="button"></button>
            </p>
            <p>
               <input type="password" value="" placeholder="Enter Password" name="newPass" id="p" class="password">
               <button class="unmask" type="button"></button>
            </p>
            <p>
               <input type="password" value="" placeholder="Confirm Password" name="newPass2" id="p-c" class="password">
               <button class="unmask" type="button"></button>
            <div id="strong"><span></span></div>
            <div id="valid"></div>
            </p>
            <button type="submit" id="submit" class="btn btn-primary">Change Password</button>
         </form>
   </div>
   <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
   <script src="bootstrap-js/all.min.js"></script>
   <script src="node_modules/jquery/dist/jquery.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   <script src="bootstrap-js/changePass.js"></script>
</body>

</html>