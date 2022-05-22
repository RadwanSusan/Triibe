<?php
include_once "connection.php";
session_start();
$sql1 = "SELECT * FROM student WHERE std_id = '" . $_SESSION["std_id"] . "'";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) {
  while ($row1 = mysqli_fetch_assoc($result1)) {
    $imgid = $row1["img_id"];
    $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
    $resultimg = mysqli_query($conn, $sqlimg);
    $rowimg = mysqli_fetch_assoc($resultimg);
    if (isset($rowimg["img_name"])) {
      $_SESSION["personalProfile"] = $rowimg["img_name"];
    } else {
      if ($row1["gender"] == 1) {
        $_SESSION["personalProfile"] = "Design\Image\LogoPic0.jpg";
      } else {
        $_SESSION["personalProfile"] = "Design\Image\LogoPic1.jpg";
      }
    }
    $sqlcover = "SELECT img_name FROM profile_info WHERE std_id = '" . $_SESSION["std_id"] . "'";
    $resultcover = mysqli_query($conn, $sqlcover);
    $rowcover = mysqli_fetch_assoc($resultcover);
    if (isset($rowcover["img_name"])) {
      $_SESSION["coverimg_name"] = $rowcover["img_name"];
    } else {
      if ($row1["gender"] == 1) {
        $_SESSION["coverimg_name"] = "Design\Image\LogoPic0.jpg";
      } else {
        $_SESSION["coverimg_name"] = "Design\Image\LogoPic1.jpg";
      }
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["profileImgPost"])) {
  if (!empty($_FILES['profileImgUpload'])) {
    $file = $_FILES['profileImgUpload'];
    $fileName = $_FILES['profileImgUpload']['name'];
    $fileTmpName = $_FILES['profileImgUpload']['tmp_name'];
    $fileSize = $_FILES['profileImgUpload']['size'];
    $fileError = $_FILES['profileImgUpload']['error'];
    $fileType = $_FILES['profileImgUpload']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    if ($fileError === 0) {
      $fileNameNew = uniqid('', true) . "." . $fileActualExt;
      $fileDestination = 'db_images/' . $fileNameNew;
      $sql = "INSERT INTO img (img_name,album_id) VALUES ('$fileDestination','".$_SESSION["std_id"]."')";
      mysqli_query($conn, $sql);
      if (move_uploaded_file($fileTmpName, $fileDestination)) {
        $sql = "SELECT * FROM img WHERE img_name = '$fileDestination'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $img_id = $row['img_id'];
        $sql = "UPDATE student SET img_id = '$img_id' WHERE std_id = '" . $_SESSION["std_id"] . "'";
        $result = mysqli_query($conn, $sql);
        $date = date("Y-m-d H:i:s", time());
        $sql = "INSERT INTO post(created_date,author,form_id, img_id) VALUES ('$date', '" . $_SESSION["std_id"] . "', '2', '$img_id')";
        $result = mysqli_query($conn, $sql);
        header("Location: personal.php");
      }
    }
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["profileCoverPost"])) {
  if (!empty($_FILES['profileCoverUpload'])) {
    $file = $_FILES['profileCoverUpload'];
    $fileName = $_FILES['profileCoverUpload']['name'];
    $fileTmpName = $_FILES['profileCoverUpload']['tmp_name'];
    $fileSize = $_FILES['profileCoverUpload']['size'];
    $fileError = $_FILES['profileCoverUpload']['error'];
    $fileType = $_FILES['profileCoverUpload']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    if ($fileError === 0) {
      $fileNameNew = uniqid('', true) . "." . $fileActualExt;
      $fileDestination = 'db_images/' . $fileNameNew;
      $sql = "SELECT * FROM profile_info WHERE std_id = '" . $_SESSION["std_id"] . "'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE profile_info SET img_name = '$fileDestination' WHERE std_id = '" . $_SESSION["std_id"] . "'";
        mysqli_query($conn, $sql);
        if (move_uploaded_file($fileTmpName, $fileDestination)) {
          $_SESSION["profileCover"] = $fileDestination;
          header("Location: personal.php");
        }
      } else {
        $sql = "INSERT INTO profile_info (img_name,std_id) VALUES ('$fileDestination','" . $_SESSION["std_id"] . "')";
        mysqli_query($conn, $sql);
        if (move_uploaded_file($fileTmpName, $fileDestination)) {
          $_SESSION["profileCover"] = $fileDestination;
          header("Location: personal.php");
        }
      }
    }
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editProfileSubmit"])) {

  $sql = "SELECT * FROM profile_info WHERE std_id = '" . $_SESSION["std_id"] . "'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $sql = "UPDATE profile_info SET discerption = '" . $_POST["description"] . "',
    uni='Studies " . $_POST["major"] . " at " . $_POST["AddUni"] . "' ,
     lives_in = '" . $_POST["livesIn"] . "',
    fromto = '" . $_POST["fromTo"] . "' ,
     instagram = '" . $_POST["instagramLink"] . "',
     facebook='" . $_POST["facebookLink"] . "',
      github = '" . $_POST["githubLink"] . "',
       linkedin = '" . $_POST["linkedinLink"] . "',
       snapchat ='" . $_POST["snapchatLink"] . "',
        twitter='" . $_POST["twitterLink"] . "'
         WHERE std_id = '" . $_SESSION["std_id"] . "'";
    mysqli_query($conn, $sql);
    header("Location: personal.php");
  } else {
    $sql = "INSERT INTO profile_info (discerption,uni,lives_in,fromto,instagram,facebook,github,linkedin,snapchat,twitter,std_id) VALUES ('" . $_POST["description"] . "','Studies " . $_POST["major"] . " at " . $_POST["AddUni"] . "','" . $_POST["livesIn"] . "','" . $_POST["fromTo"] . "','" . $_POST["instagramLink"] . "','" . $_POST["facebookLink"] . "','" . $_POST["githubLink"] . "','" . $_POST["linkedinLink"] . "','" . $_POST["snapchatLink"] . "','" . $_POST["twitterLink"] . "','" . $_SESSION["std_id"] . "')";
    mysqli_query($conn, $sql);
    header("Location: personal.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="Design/Image/whiteLogo.svg" type="image/x-icon">
  <title>Triibe profile</title>
  <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
  <link rel="stylesheet" href="bootstrap-css/all.min.css" />
  <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
  <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
  <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  <link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">
  <link id="theme" rel="stylesheet" href="bootstrap-css/personal.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
  <script src="node_modules/alertifyjs/build/alertify.min.js"></script>
  <script type="text/javascript">
    function alert(message) {
      alertify.defaults.glossary.title = 'My Title';
      alertify.alert("Triibe", message);
    }
  </script>
</head>

<body>
  <?php
  $sql = "SELECT * FROM profile_info WHERE std_id = '" . $_SESSION["std_id"] . "'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>
  <form class="EditInfoForm" method="post">
    <input type="text" class="description" placeholder="description" name="description" value="<?php echo $row['discerption'] ?>">
    <input type="text" class="AddUni" placeholder="AddUni" name="AddUni" value="<?php $uniName = explode('at', $row['uni']);
                                                                                echo $uniName[1]; ?>">
    <input type="text" class="major" placeholder="major" name="major" value="<?php $majorName = explode('at', $row['uni']);
                                                                              $majorName = explode('Studies', $majorName[0]);
                                                                              echo $majorName[1]; ?>">
    <input type="text" class="livesIn" placeholder="livesIn" name="livesIn" value="<?php echo $row['lives_in'] ?>">
    <input type="text" class="fromTo" placeholder="fromTo" name="fromTo" value="<?php echo $row['fromto'] ?>">
    <input type="text" class="instagramLink" placeholder="instagramLink" name="instagramLink" value="<?php echo $row['instagram'] ?>">
    <input type="text" class="facebookLink" placeholder="facebookLink" name="facebookLink" value="<?php echo $row['facebook'] ?>">
    <input type="text" class="snapchatLink" placeholder="snapchatLink" name="snapchatLink" value="<?php echo $row['snapchat'] ?>">
    <input type="text" class="githubLink" placeholder="githubLink" name="githubLink" value="<?php echo $row['github'] ?>">
    <input type="text" class="linkedinLink" placeholder="linkedinLink" name="linkedinLink" value="<?php echo $row['linkedin'] ?>">
    <input type="text" class="twitterLink" placeholder="twitterLink" name="twitterLink" value="<?php echo $row['twitter'] ?>">
    <input type="submit" name="editProfileSubmit" class="editProfileSubmit" value="editProfileSubmit">
  </form>
  <div class="post-card slide-in-elliptic-top-fwd">
    <div class="top-card">
      <div class="left-top-card">
        <div class="card-name-photo">
          <img class="card-user-photo" src="<?php echo $_SESSION["img_name"] ?>" alt="">
          <div class="card-name"><?php echo $_SESSION["std_fname"] . " " . $_SESSION["std_lname"] ?></div>
        </div>
        <div class="card-inside-top">
          <img src="Design/Image/home-images/images/ball2.svg" alt="">
          <img src="Design/Image/home-images/images/card-down.svg" alt="">
        </div>
      </div>
      <div class="right-top-card">
        <img class="exitCard" src="Design/Image/home-images/images/exit-card.svg" alt="">
      </div>
    </div>
    <?php
    $img_id = null;
    $video_id = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["post"])) {
      $file = $_FILES['file'];
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
      $ext = $fileActualExt;
      if ($ext == "" || $ext == null) {
        $post = nl2br($_POST["content"]);
        $date = date("Y-m-d H:i:s", time());
        $sql = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id) VALUES ('$post', '$date','" . $_SESSION["std_id"] . "' , 1 , NULL , NULL)";
        if (($_POST["content"] == "" || $_POST["content"] == null || $_POST["content"] == "<br>" || $_POST["content"] == "<br/>") && ($fileName == "" || $fileName == null)) {
          echo "<script>alert('Please write something')</script>";
        } else {
          if (mysqli_query($conn, $sql)) {
            header("Location: home.php");
          } else {
            echo "<script>alert('Post Failed');</script>";
          }
        }
      } else if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
        if ($fileError === 0) {
          if ($fileSize < 100000000) {
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'db_images/' . $fileNameNew;
            $sqlimg = "INSERT INTO img (img_name) VALUES ('$fileDestination')";
            mysqli_query($conn, $sqlimg);
            move_uploaded_file($fileTmpName, $fileDestination);
          } else {
            echo "<script>alert('Your file is too big!')</script>";
          }
        } else {
          echo "<script>alert('There was an error uploading your file!')</script>";
        }
        $result = mysqli_query($conn, "SELECT * FROM img WHERE img_name = '$fileDestination'");
        $row = mysqli_fetch_array($result);
        $img_id = $row["img_id"];
        $post = nl2br($_POST["content"]);
        $date = date("Y-m-d H:i:s", time());
        $sql = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id) VALUES ('$post', '$date','" . $_SESSION["std_id"] . "' , 1 , '$img_id' , NULL)";
        if (($_POST["content"] == "" || $_POST["content"] == null || $_POST["content"] == "<br>" || $_POST["content"] == "<br/>") && ($fileName == "" || $fileName == null)) {
          echo "<script>alert('Please write something')</script>";
        } else {
          if (mysqli_query($conn, $sql)) {
            header("Location: home.php");
          } else {
            echo "<script>alert('Post Failed');</script>";
          }
        }
      } else if ($ext == "mp4" || $ext == "webm") {
        if ($fileError === 0) {
          if ($fileSize < 100000000) {
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'db_images/' . $fileNameNew;
            $sqlVid = "INSERT INTO video (video_name) VALUES ('$fileDestination')";
            mysqli_query($conn, $sqlVid);
            move_uploaded_file($fileTmpName, $fileDestination);
          } else {
            echo "<script>alert('Your file is too big!')</script>";
          }
        } else {
          echo "<script>alert('There was an error uploading your file!')</script>";
        }
        $result2 = mysqli_query($conn, "SELECT * FROM video WHERE video_name = '$fileDestination'");
        $row2 = mysqli_fetch_array($result2);
        $video_id = $row2["video_id"];
        $post2 = nl2br($_POST["content"]);
        $date2 = date("Y-m-d H:i:s", time());
        $sql2 = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id) VALUES ('$post2', '$date2','" . $_SESSION["std_id"] . "',1, NULL ,'$video_id')";
        if (($_POST["content"] == "" || $_POST["content"] == null || $_POST["content"] == "<br>" || $_POST["content"] == "<br/>") && ($fileName == "" || $fileName == null)) {
          echo "<script>alert('Please write something')</script>";
        } else {
          if (mysqli_query($conn, $sql2)) {
            header("Location: home.php");
          } else {
            echo "<script>alert('Post Failed');</script>";
          }
        }
      } else {
        echo "<script>alert('File type not supported');</script>";
      }
    }
    ?>
    <form method="POST" enctype="multipart/form-data">
      <div class="mid-card">
        <textarea class="card-write-post" rows="3" placeholder="Write A Post ..." name="content"></textarea>
      </div>
      <div class="down-card">
        <div class="left-down-card">
          <p>Add to your post</p>
          <div class="icon-down">
            <label class="uploadLabel" for="uploadfile">
              <img class="imgIcon" src="Design/Image/home-images/images/ImageIcon.svg" alt="">
            </label>
            <input class="fileUpload_Button" type="file" name="file" id="uploadfile" accept=".gif,.jpg,.jpeg,.png,.doc,.docx,.mp4">
            <label class="uploadLabel" for="tagfriend">
              <img class="tagIcon" src="Design/Image/home-images/images/tagIcon.svg" alt="">
            </label>
            <div class="form-popup arrow-div animate__animated animate__fadeIn animate__faster" id="myForm">
              <form action="" class="form-container">
                <h1 class="tagH1">Tag someone</h1>
                <button type="button" class="btn cancel">Close</button>
                <div class="innerTag">
                  <?php $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["friend_id"] . "'";
                      $result1 = mysqli_query($conn, $sql1);
                      if (mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                          $imgid = $row1["img_id"];
                          $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                          $resultimg = mysqli_query($conn, $sqlimg);
                          $rowimg = mysqli_fetch_assoc($resultimg);
                          echo "<a href='#'><img class='tagImg' src='" . $rowimg["img_name"] . "' alt=''/>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</a>";
                        }
                      }
                    }
                  } ?>
                </div>
              </form>
            </div>
            <img class="locIcon" src="Design/Image/home-images/images/locIcon.svg" alt="">
            <label class="uploadLabel" for="uploadGif">
              <img class="gifIcon" src="Design/Image/home-images/images/GIFicon.svg" alt="">
            </label>
            <input class="fileUpload_Button" type="file" name="fileGif" id="uploadGif" accept=".gif">
            <img class="flagIcon" src="Design/Image/home-images/images/flagIcon.svg" alt="">
          </div>
        </div>
        <input type="submit" class="post-write" value="POST" name="post">
      </div>
    </form>
  </div>
  <nav class="nav">
    <div class="nav-left">
      <div class="box">
        <img src="Design/Image/home-images/images/logo.svg" alt="logoLight" class="logoLight">
        <img src="Design/Image/home-images/images/logo2.svg" alt="logoDark" class="logoDark">
        <p>Triibe</p>
      </div>
      <div class="search-box">
        <img src="Design/Image/home-images/images/Search-Icon.svg" alt="search">
        <input type="text" placeholder="Search">
      </div>
    </div>
    <div class="nav-right">
      <ul>
        <li>
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/Settings-icon.svg" alt="settingIcon">
          <img class="SettingsIcon-Dark" src="Design/Image/home-images/images/Settings-icon2.svg" alt="settingIcon">
        </li>
        <li>
          <img class="mapIcon-Light" src="Design/Image/home-images/images/mapIcon.svg" alt="mapIcon">
          <img class="mapIcon-Dark" src="Design/Image/home-images/images/mapIcon2.svg" alt="mapIcon">
        </li>
        <li>
          <img class="themeLight" src="Design/Image/home-images/images/theme-light.svg" alt="themeLight">
          <img class="themeDark" src="Design/Image/home-images/images/theme-dark.svg" alt="themeDark">
        </li>
        <li>
          <img class="notificationIcon-light" src="Design/Image/home-images/images/notification-logo.svg" alt="notificationIcon">
          <img class="notificationIcon-dark" src="Design/Image/home-images/images/notification-logo2.svg" alt="notificationIcon1">
        </li>
        <li>
          <img class="chatLight" src="Design/Image/home-images/images/chat-icon.svg" alt="image">
          <img class="chatDark" src="Design/Image/home-images/images/chat-icon2.svg" alt="image">
        </li>
      </ul>
      <div class="nav-user-icon online">
        <img src="<?php echo $_SESSION["personalProfile"] ?> " alt="">
        <div class="name">
          <?php echo $_SESSION["std_fname"]; ?>
        </div>
      </div>
    </div>
  </nav>
  <div class='content1'>
    <div class="headerBackground bg-pan-top">
      <div class="top">
        <div>
          <img class="coverImage" src="<?php echo $_SESSION['coverimg_name'] ?> " alt="">
          <form class="edit-cover-content" method="POST" enctype="multipart/form-data" id="coverImgForm">
            <div class="Edit-cover">
              <label id="" for="CoverImg">
                <img src="Design/Image/home-images/images/edit2.svg" alt="" />
              </label>
              <input type="file" name="profileCoverUpload" id="CoverImg" accept=".png,.jpg,.jpeg,.gif" style="display:none;" />
              <label class="submit" for="submitImg">
                <input type="submit" id="submitCoverImg" value="Upload" name="profileCoverPost" hidden />
              </label>
              <p>Edit cover</p>
            </div>
          </form>
        </div>
        <!-- <img src="Design/Image/home-images/images/Linear_Layer.svg" alt=""> -->
      </div>
      <div class="bottom-content">
        <div class="bottom">
          <div class="left-bottom">
            <img class="left-bottom-img" src="<?php echo $_SESSION["personalProfile"] ?>" alt="">
            <form method="POST" enctype="multipart/form-data" id="profileImgForm">
              <label class="editImg" for="profileImg">
                <img src="Design/Image/home-images/images/edit-image.svg" alt="">
              </label>
              <input type="file" name="profileImgUpload" id="profileImg" accept=".png,.jpg,.jpeg,.gif" style="display:none;" />
              <label class="submit" for="submitImg">
                <input type="submit" id="submitImg" value="Upload" name="profileImgPost" hidden />
              </label>
            </form>
            <div class="info">
              <div class="name-bottom">
                <p><?php echo  $_SESSION["std_fname"] . " " . $_SESSION["std_lname"] ?></p>
              </div>
              <?php
              $sqlfriend = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
              $resultfriend = mysqli_query($conn, $sqlfriend);
              $countfriend = mysqli_num_rows($resultfriend);
              if ($countfriend == 0) {
                echo '<div class="number-friends">';
                echo $countfriend . " Friends";
                echo '</div>';
              } elseif ($countfriend == 1) {
                echo '<div class="number-friends2">';
                echo $countfriend . " Friend";
                echo '</div>';
              } else {
                echo '<div class="number-friends">';
                echo $countfriend . " Friends";
                echo '</div>';
              }

              ?>
          </div>
        </div>
        <div class="right-bottom">
          <div class="edit-profile">
            <img src="Design/Image/home-images/images/Group-edit.svg" alt="">
            <p>Edit Profile</p>
          </div>
        </div>
      </div>
    </div>
    <div class="line-content">
      <div class="line"></div>
    </div>
    <div class="list-photo-content">
      <div class="list">
        <a href="">Posts</a>
        <a href="">Friends</a>
        <a href="">Photos</a>
        <a href="">Videos</a>
      </div>
    </div>
  </div>
  <div class="content-personal-post">
    <div class="content-left">
      <div class="left-post">
        <h1 class="h1">Bio</h1>
        <?php
        $sql = "SELECT * FROM profile_info WHERE std_id = '" . $_SESSION["std_id"] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="title-bio">
          <div class="name"><?php echo $row["discerption"] ?></div>
        </div>
        <div class="bio bio1">
          <img src="Design/Image/home-images/images/bio1.svg" alt="">
          <div class="name name2"><?php echo $row["uni"] ?></div>
        </div>
        <div class="bio bio3">
          <img src="Design/Image/home-images/images/bio2.svg" alt="">
          <div class="name">Lives in <?php echo $row["lives_in"] ?></div>
        </div>
        <div class="bio bio4">
          <img src="Design/Image/home-images/images/bio3.png" alt="">
          <div class="name">From <?php echo $row["fromto"] ?></div>
        </div>
        <div class="bio bio5">
          <a href="<?php echo $row["instagram"]; ?>"><img src="Design/Image/home-images/images/bio4.png" alt=""></a>
        </div>
        <?php
        if (!isset($row["github"]) || $row["github"] == "") {
          echo "";
        } else {
          echo ' <div class="bio bio2">
            <a href=' . $row["github"] . '><img src="Design/Image/home-images/images/bio5.png" alt=""></a>
          </div>';
        }
        ?>
        <?php
        if (!isset($row["facebook"]) || $row["facebook"] == "") {
          echo "";
        } else {
          echo ' <div class="bio bio2">
            <a href=' . $row["facebook"] . '><img src="Design/Image/home-images/images/iconmonstr-facebook-4.svg" alt=""></a>
          </div>';
        }
        ?>
        <?php
        if (!isset($row["twitter"]) || $row["twitter"] == "") {
          echo "";
        } else {
          echo ' <div class="bio bio2">
            <a href=' . $row["twitter"] . '><img src="Design/Image/home-images/images/iconmonstr-twitter-4.svg" alt=""></a>
          </div>';
        }
        ?>
        <?php
        if (!isset($row["linkedin"]) || $row["linkedin"] == "") {
          echo "";
        } else {
          echo ' <div class="bio bio2">
            <a href=' . $row["linkedin"] . '><img src="Design/Image/home-images/images/iconmonstr-linkedin-3" alt=""></a>
          </div>';
        }
        ?>
        <?php
        if (!isset($row["snapchat"]) || $row["snapchat"] == "") {
          echo "";
        } else {
          echo ' <div class="bio bio2">
            <a href=' . $row["snapchat"] . '><img src="Design/Image/home-images/images/iconmonstr-snapchat-1" alt=""></a>
          </div>';
        }
        ?>
      </div>
      <div class="left-post left-post-two">
        <div class="photo-see">

          <h1>Photo</h1>
          <div class="see-more">See more</div>
        </div>
        <div class="Photo">
          <?php
          $sql = "SELECT * FROM img WHERE album_id = '" . $_SESSION["std_id"] . "' LIMIT 4";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<img src='".$row["img_name"]."' alt='image'>";
          }
          
          ?>
        </div>
      </div>
      <div class="left-post left-post-two">
        <div class="photo-see">
          <h1>Friends</h1>
          <div class="see-more">See more</div>
        </div>
        <div class="Friends">
          <div class="left-Friends">
            <?php $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["friend_id"] . "'";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                  while ($row1 = mysqli_fetch_assoc($result1)) {
                    $imgid = $row1["img_id"];
                    $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                    $resultimg = mysqli_query($conn, $sqlimg);
                    $rowimg = mysqli_fetch_assoc($resultimg);
                    if (isset($rowimg["img_name"])) {
                      $imgName = $rowimg["img_name"];
                    } else {
                      if ($row1["gender"] == 1) {
                        $imgName = "Design\Image\LogoPic0.jpg";
                      } else {
                        $imgName = "Design\Image\LogoPic1.jpg";
                      }
                    }
                    echo "<div class='namePhoto'>
                              <img src='" . $imgName . "' alt='image'>
                              <div class='names'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                            </div>";
                  }
                }
              }
            } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="right-post">
      <div class="write-post-container">
        <div class="user-profile">
          <!-- <img src="Design/Image/home image/images/profile-pic.png" alt=""> -->
          <img src="<?php echo $_SESSION["personalProfile"]; ?>" alt="zzzzzzz">
          <div class="write-post-input">
            <textarea class="write-post" rows="3" placeholder="What`s on your mind, <?php echo $_SESSION["std_fname"]; ?>"></textarea>
          </div>
        </div>
        <?php
        $likenum = 0;
        $sql = "SELECT * FROM post where author = " . $_SESSION["std_id"] . " order by created_date desc";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["author"] . "'";
            $sql2 = "SELECT * FROM img WHERE img_id = '" . $row["img_id"] . "'";
            $sql3 = "SELECT * FROM video WHERE video_id  = '" . $row["video_id"] . "'";
            $result1 = mysqli_query($conn, $sql1);
            $result2 = mysqli_query($conn, $sql2);
            $result3 = mysqli_query($conn, $sql3);
            $sqllikenum = "SELECT COUNT(*) FROM post_likes WHERE post_id = '" . $row["post_id"] . "'";
            $resultlikenum = mysqli_query($conn, $sqllikenum);
            $rowlikenum = mysqli_fetch_assoc($resultlikenum);
            $likenum = $rowlikenum["COUNT(*)"];
            if (mysqli_num_rows($result1) > 0) {
              while ($row1 = mysqli_fetch_assoc($result1)) {
                $imgid = $row1["img_id"];
                $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                $resultimg = mysqli_query($conn, $sqlimg);
                $rowimg = mysqli_fetch_assoc($resultimg);
                if (isset($rowimg["img_name"])) {
                  $postImage = $rowimg["img_name"];
                } else {
                  if ($row1["gender"] == 1) {
                    $postImage = "Design\Image\LogoPic0.jpg";
                  } else {
                    $postImage = "Design\Image\LogoPic1.jpg";
                  }
                }
                echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <div class='name-photo'>
                                 <img src='" . $postImage . "' alt=''>
                                    <div class='name'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                              </div>
                                 <div class='inside-top'>
                                    " . $row["created_date"] . "
                                 <img src='Design/Image/home-images/images/ball.svg' alt=''>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img src='Design/Image/home-images/images/Dots.svg' alt=''>
                              </div>
                              </div>
                              <div class='mid-post'>
                                 <p>" . $row["content"] . "</p>
                              </div> ";
              }
            }
            if (mysqli_num_rows($result2) > 0) {
              while ($row2 = mysqli_fetch_assoc($result2)) {
                echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <img class='post-image' src='" . $row2["img_name"] . "' alt=''>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                       <div class='like'>
                                       ";
                $sql4 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                $result3 = mysqli_query($conn, $sql4);
                if (mysqli_num_rows($result3) > 0) {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' alt=''>
                                                  ";
                  if ($likenum == 1) {
                    echo "<p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                  } else {
                    echo "
                                                    <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                  }
                } else {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' alt=''>
                                                  <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                }
                echo "
                                       </div>
                                       <div class='comment'>
                                       <img src='Design/Image/home-images/images/Comment.svg' alt=''>
                                       <p>comment</p>
                                       </div>
                                       <div class='share'>
                                       <img src='Design/Image/home-images/images/Share.svg'' alt=''>
                                       <p>share</p>
                                       </div>
                                       <div class='save'>
                                       <img src='Design/Image/home-images/images/Save.svg' alt=''>
                                       <p>save</p>
                                       </div>
                                 </div>
                                 </div>
                                 </div>";
              }
            } else if (mysqli_num_rows($result3) > 0) {
              while ($row3 = mysqli_fetch_assoc($result3)) {
                echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <video width='800px' controls class='video-js vjs-theme-forest' data-setup='{}'>
                                         <source src='" . $row3["video_name"] . "' type='video/mp4'>
                                      </video>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                        <div class='like'>
                                        ";
                $sql7 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                $result7 = mysqli_query($conn, $sql7);
                if (mysqli_num_rows($result7) > 0) {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' alt=''>
                                                  ";
                  if ($likenum == 1) {
                    echo "<p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                  } else {
                    echo "
                                                    <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                  }
                } else {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' alt=''>
                                                  <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                }
                echo "
                                        </div>
                                        <div class='comment'>
                                        <img src='Design/Image/home-images/images/Comment.svg' alt=''>
                                        <p>comment</p>
                                        </div>
                                        <div class='share'>
                                        <img src='Design/Image/home-images/images/Share.svg' alt=''>
                                        <p>share</p>
                                        </div>
                                        <div class='save'>
                                        <img src='Design/Image/home-images/images/Save.svg' alt=''>
                                        <p>save</p>
                                        </div>
                                    </div>
                                    </div>
                                    </div>";
              }
            } else {
              echo "<div class='end-post>
                              <div class='content-end'>
                              </div>
                              <div class='likes'>
                                 <div class='like'>
                                  ";
              $sql5 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
              $result4 = mysqli_query($conn, $sql5);
              if (mysqli_num_rows($result4) > 0) {
                echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' alt=''>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' alt=''>
                                              ";
                if ($likenum == 1) {
                  echo "<p class='LikeCount'>$likenum</p>
                                                        <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                        <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                              ";
                } else {
                  echo "
                                                        <p class='LikeCount'>$likenum</p>
                                                        <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                        <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              ";
                }
              } else {
                echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' alt=''>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' alt=''>
                                              <p class='LikeCount'>$likenum</p>
                                              <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                        ";
              }
              echo "
                                 </div>
                                 <div class='comment'>
                                    <img src='Design/Image/home-images/images/Comment.svg' alt=''>
                                    <p>comment</p>
                                 </div>
                                 <div class='share'>
                                    <img src='Design/Image/home-images/images/Share.svg' ' alt=' '>
                                    <p>share</p>
                                 </div>
                                 <div class='save '>
                                    <img src='Design/Image/home-images/images/Save.svg' alt=' '>
                                    <p>save</p>
                                 </div>
                                 </div>
                              </div>";
            }
          }
        }
        ?>
      </div>
    </div>
  </div>
  </div>
  <div class="modal">
    <span class="close">&times;</span>
    <img class="modal-content slide-in-elliptic-top-fwd" id="img01">
  </div>
  <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
  <script type="module" src="bootstrap-js/personal.js" defer></script>
</body>

</html>
