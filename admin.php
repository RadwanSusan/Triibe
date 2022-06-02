<?php   
include_once "connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-css/admin.css">
    <title>Triibe Admin</title>
</head>
<body>
    <nav class="nav">
    <div class="nav-left">
      <div class="box">
        <img src="Design/Image/home-images/images/logo.svg" alt="logoLight" class="logoLight" /> <img src="Design/Image/home-images/images/logo2.svg" alt="logoDark" class="logoDark" />
        <p>Triibe</p>
      </div>
      <div class="search-box"> <img src="Design/Image/home-images/images/Search-Icon.svg" alt="search" />
        <input type="text" placeholder="Search" id="search" autocomplete="off" std_id="<?php echo $_SESSION['std_id']; ?>" />
      </div>
      <div class="searchArea"></div>
    </div>
    <div class="nav-right">
      <ul>
        <li class="settingsList">
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/Settings-icon.svg" alt="settingIcon" />
          <img class="SettingsIcon-Dark" src="Design/Image/home-images/images/Settings-icon2.svg" alt="settingIcon" />
        </li>
        <div class="settings" style="display: none;">
          <p>Settings</p>
          <div class="forget-pass">
            <p>Change password</p>
          </div>
          <div class="Logout">
            <p>Logout</p>
          </div>
        </div>

        

        <li class="theme">
          <img class="themeLight" src="Design/Image/home-images/images/theme-light.svg" alt="themeLight" />
          <img class="themeDark" src="Design/Image/home-images/images/theme-dark.svg" alt="themeDark" />
        </li>
        
        <div class="Notifications" style="display: none;">
          <p>Notifications</p>
          <?php
          $sql = "SELECT * FROM friends_request WHERE receiver = '" . $_SESSION["std_id"] . "'order by date desc";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["sender"] . "'";
              $result1 = mysqli_query($conn, $sql1);
              if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                  $now = new DateTime();
                  $post = new DateTime($row["date"]);
                  $diff = $now->diff($post);
                  $diff->format("%a");
                  $diffday = $diff->format("%a");
                  $diffhour = $diff->format("%h");
                  $diffminute = $diff->format("%i");
                  $diffsecond = $diff->format("%s");
                  $diffdaystr = (string)$diffday;
                  $diffhourstr = (string)$diffhour;
                  $diffminutestr = (string)$diffminute;
                  $diffsecondstr = (string)$diffsecond;
                  $difftime = $diffsecondstr . "second ago";
                  if ($diffdaystr == "0") {
                    if ($diffhourstr == "0") {
                      if ($diffminutestr == "0") {
                        $difftime = $diffsecondstr . "s ago";
                      } else {
                        $difftime = $diffminutestr . "m ago";
                      }
                    } else {
                      $difftime = $diffhourstr . "h ago";
                    }
                  } else {
                    $difftime = $diffdaystr . "d ago";
                  }
                  echo "<a href='friendpage.php?account_id=" . $row1["account_id"] . "'><div class='NotificationBox'>
                  <p>$difftime</p>
                        <p>" . $row1['std_fname'] . " " . $row1["std_lname"] . " sent you a friend request </p>
                 </div></a>";
                }
              }
            }
          }

          ?>
        </div>
        
      </ul>
      <div class="nav-user-icon online">
        <a href='personal.php'><img src="<?php echo $_SESSION["personalProfile"] ?>" /></a>
        <a href='personal.php'>
          <div class="name">
            <?php echo $_SESSION["std_fname"]; ?>
          </div>
        </a>
      </div>
    </div>
  </nav>
    <div class="container-admin">
       <div class="left-Admin">
           <h2>Website Info</h2>
           <div class="name2-number2">
               <div class="name">Total Users:</div>
               <div class="number">411</div>
           </div>
           <div class="name2-number2">
               <div class="name">Total Posts:</div>
               <div class="number">411</div>
           </div>
           <div class="name2-number2">
               <div class="name">Total Likes:</div>
               <div class="number">411</div>
           </div>
           <div class="name2-number2">
               <div class="name">Total Groups:</div>
               <div class="number">411</div>
           </div>
       </div>

       <div class="main-Admin">
           <h2>Manage Profiles</h2>
           <div class="search-profile">
              <div class="name-search"> Search for a profile:</div>
               <div class="search-box m-s"> <img src="Design/Image/home-images/images/Search-Icon.svg" alt="search">
        <input type="text" placeholder="Search" id="search" autocomplete="off" std_id="120180612114">
      </div>
           </div>
           <div class="profile-info-image">
               <div class="profile-info">Profile Info:</div>
                <div class="profile-image"> <img src="Design/Image/home-images/images/Group-profile.svg" alt="image"> </div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Student name:</div>
                <div class="student-know one">Radwan Susan</div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Student Number:</div>
                <div class="student-know two">120180612122</div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Account Id:</div>
                <div class="student-know three">882342624</div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Password:</div>
                <div class="student-know four">Blackbox@007</div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Date of birth:</div>
                <div class="student-know five">04/11/2000</div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Gender:</div>
                <div class="student-know six">Male</div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Birth-Location:</div>
                <div class="student-know seven">Irbid / Jordan</div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Collage:</div>
                <div class="student-know eight">information technology collage</div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Specialization:</div>
                <div class="student-know nine">Software Engineering</div>
           </div>
           <div class="profile-info-know">
               <div class="student-info">Role:</div>
                <div class="student-know ten">Student</div>
           </div>
           <div class="delete-lock">
               <div class="delete-account">Delete Account</div>
               <div class="lock-account eleven">Lock Account</div>
           </div>
       </div>

       <div class="right-Admin">
           <p>Create a new Admin Acc</p>
           <form action="">
               <input type="number" placeholder="Account id" >
                <input type="number"  placeholder="Password">
                <button>Create</button>
           </form>
       </div> 


    </div>
    
</body>
</html>