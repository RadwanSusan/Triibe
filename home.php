<?php
include_once "connection.php";
session_start();
$themeStyleSheet = 'light-home.css';
if (isset($_COOKIE['theme'])) {
  if ($_COOKIE['theme'] == 'light') {
    $themeStyleSheet = 'dark-home.css';
  }
}
$badwords = ["fuck", "shit", "bitch", "asshole", "dick", "pussy", "كس", "كس امك", "قحبة", "شرموطة", "منيك", "شرمط"];
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
  }
}
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
  <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
  <link href="node_modules/hover.css/css/hover-min.css" rel="stylesheet">
  <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
  <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  <link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
  <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
  <link id="theme" rel="stylesheet" href="bootstrap-css/<?php echo $themeStyleSheet ?>" />
  <script src="node_modules/alertifyjs/build/alertify.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    function alert(message) {
      alertify.defaults.glossary.title = 'My Title';
      alertify.alert("Triibe", message);
    }

    function confirm(message, function1, function2) {
      alertify.defaults.glossary.title = 'My Title';
      alertify.confirm("Triibe", message, function1, function2);
    }
  </script>
</head>

<body>
  <div id="particles-js"></div>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["UploadStoryImage"])) {
    $file = $_FILES['fileimg'];
    $fileName = $_FILES['fileimg']['name'];
    $fileTmpName = $_FILES['fileimg']['tmp_name'];
    $fileSize = $_FILES['fileimg']['size'];
    $fileError = $_FILES['fileimg']['error'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $ext = $fileActualExt;
    if ($fileError === 0) {
      if ($fileSize < 100000000) {
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = 'db_images/' . $fileNameNew;
        $date = date("h:i:s");
        $sqlimg = "INSERT INTO story (author,created_date,img_name) VALUES ('" . $_SESSION["std_id"] . "','$date','" . $fileDestination . "')";
        mysqli_query($conn, $sqlimg);
        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        echo "<script>alert('Your file is too big!')</script>";
      }
    } else {
      echo "<script>alert('There was an error uploading your file!')</script>";
    }
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["UploadStoryVideo"])) {
    $file = $_FILES['filevid'];
    $fileName = $_FILES['filevid']['name'];
    $fileTmpName = $_FILES['filevid']['tmp_name'];
    $fileSize = $_FILES['filevid']['size'];
    $fileError = $_FILES['filevid']['error'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $ext = $fileActualExt;
    if ($fileError === 0) {
      if ($fileSize < 100000000) {
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = 'db_images/' . $fileNameNew;
        $date = date("h:i:s");
        $sqlimg = "INSERT INTO story (author,created_date,video_name) VALUES ('" . $_SESSION["std_id"] . "','$date','" . $fileDestination . "')";
        mysqli_query($conn, $sqlimg);
        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        echo "<script>alert('Your file is too big!')</script>";
      }
    } else {
      echo "<script>alert('There was an error uploading your file!')</script>";
    }
  }
  ?>
  <div class="storyUploadBox" style="display: none;">
    <h1>Upload A Story</h1>
    <p>Upload from webcam</p>
    <p>Upload image From A file</p>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="fileimg" id="file" accept=".jpg,.png,.gif,jpeg" />
      <input type="submit" name="UploadStoryImage" value="submit" />
    </form>
    <p>Upload video From A file</p>
    <p>(Max Length is 1min)</p>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="filevid" id="file2" accept=".mp4,.mkv" />
      <input type="submit" name="UploadStoryVideo" value="submit" />
    </form>
  </div>
  <div class="commentBox">
    <p class="commentHeader">Comments</p>
    <div class="commentList">
      <!-- <div class="commentContent"></div> -->
      <textarea class="commentArea" name="commentArea" id="" cols="30" rows="10"></textarea>
      <button class="sendComment">Send</button>
    </div>
  </div>
  <div class="post-card slide-in-elliptic-top-fwd">
    <div class="top-card">
      <div class="left-top-card">
        <div class="card-name-photo">
          <img class="card-user-photo" src="<?php echo $_SESSION["img_name"] ?>" alt="">
          <div class="card-name"><?php echo $_SESSION["std_fname"] . " " . $_SESSION["std_lname"] ?></div>
        </div>
        <div class="card-inside-top">
          <img class="PublicChoice" src="Design/Image/home-images/images/ball2.svg" alt="" style="display:inline-block;">
          <img class="FriendChoice" src="Design/Image/home-images/images/friends_Post.svg" alt="" style="display:none;">
          <img class="choiceDropDown" src="Design/Image/home-images/images/card-down.svg" alt="">
        </div>
      </div>
      <div class="right-top-card">
        <img class="exitCard" src="Design/Image/home-images/images/exit-card.svg" alt="">
      </div>
    </div>
    <?php
    $img_id = null;
    $video_id = null;
    $fileId = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["post"])) {
      $content = explode(" ", $_POST["content"]);
      $usingBadWords = false;
      foreach ($content as $word) {
        foreach ($badwords as $badword) {
          if ($word == $badword) {
            $usingBadWords = true;
            break;
          }
        }
      }
      if ($usingBadWords == false) {
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $ext = $fileActualExt;
        $fileUpload = $_FILES['fileLink'];
        $fileUploadName = $_FILES['fileLink']['name'];
        $fileUploadTmpName = $_FILES['fileLink']['tmp_name'];
        $fileUploadSize = $_FILES['fileLink']['size'];
        $fileUploadError = $_FILES['fileLink']['error'];
        $fileUploadExt = explode('.', $fileUploadName);
        $fileUploadActualExt = strtolower(end($fileUploadExt));
        $fileNameNew2 = uniqid('', true) . "." . $fileUploadActualExt;
        $fileDestination2 = 'db_files/' . $fileNameNew2;
        if ($fileUploadName == "" || $fileUploadName == null) {
          if ($ext == "" || $ext == null) {
            $post = nl2br($_POST["content"]);
            $form_id = $_POST["formId"];
            $date = date("Y-m-d H:i:s", time());
            $sql = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id) VALUES ('$post', '$date','" . $_SESSION["std_id"] . "' , '$form_id' , NULL , NULL)";
            if (($_POST["content"] == "" || $_POST["content"] == null || $_POST["content"] == "<br>" || $_POST["content"] == "<br/>") && ($fileName == "" || $fileName == null)) {
              echo "<script>alert('Please write something')</script>";
            } else {
              if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Post Success');</script>";
              } else {
                echo "<script>alert('Post Failed');</script>";
              }
            }
          } else if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
            if ($fileError === 0) {
              if ($fileSize < 100000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'db_images/' . $fileNameNew;
                $sqlimg = "INSERT INTO img (img_name ,album_id) VALUES ('$fileDestination','" . $_SESSION["std_id"] . "')";
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
            $form_id = $_POST["formId"];
            $date = date("Y-m-d H:i:s", time());
            $sql = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id) VALUES ('$post', '$date','" . $_SESSION["std_id"] . "' , '$form_id' , '$img_id' , NULL)";
            if (($_POST["content"] == "" || $_POST["content"] == null || $_POST["content"] == "<br>" || $_POST["content"] == "<br/>") && ($fileName == "" || $fileName == null)) {
              echo "<script>alert('Please write something')</script>";
            } else {
              if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Post Success');</script>";
              } else {
                echo "<script>alert('Post Failed');</script>";
              }
            }
          } else if ($ext == "mp4" || $ext == "webm") {
            if ($fileError === 0) {
              if ($fileSize < 100000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'db_images/' . $fileNameNew;
                $sqlVid = "INSERT INTO video (video_name,album_id) VALUES ('$fileDestination','" . $_SESSION["std_id"] . "')";
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
            $form_id = $_POST["formId"];
            $date2 = date("Y-m-d H:i:s", time());
            $sql2 = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id) VALUES ('$post2', '$date2','" . $_SESSION["std_id"] . "','$form_id', NULL ,'$video_id')";
            if (($_POST["content"] == "" || $_POST["content"] == null || $_POST["content"] == "<br>" || $_POST["content"] == "<br/>") && ($fileName == "" || $fileName == null)) {
              echo "<script>alert('Please write something')</script>";
            } else {
              if (mysqli_query($conn, $sql2)) {
                echo "<script>alert('Post Success');</script>";
              } else {
                echo "<script>alert('Post Failed');</script>";
              }
            }
          } else {
            echo "<script>alert('File type not supported');</script>";
          }
        } else {
          if ($fileUploadError === 0) {
            if ($fileUploadSize < 100000000) {
              if ($fileUploadError === 0) {
                $sqlFile = "INSERT INTO files (fileName,fileOriginalName) VALUES ('$fileDestination2','$fileUploadName')";
                mysqli_query($conn, $sqlFile);
                move_uploaded_file($fileUploadTmpName, $fileDestination2);
              }
            } else {
              echo "<script>alert('File is too big')</script>";
            }
          }
          if ($ext == "" || $ext == null) {
            $post = nl2br($_POST["content"]);
            $form_id = $_POST["formId"];
            $date = date("Y-m-d H:i:s", time());
            $result0 = mysqli_query($conn, "SELECT * FROM files WHERE fileName = '$fileDestination2'");
            $row0 = mysqli_fetch_array($result0);
            $file_id = $row0["fileId"];
            $sql = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id, fileId) VALUES ('$post', '$date','" . $_SESSION["std_id"] . "' , '$form_id' , NULL , NULL, '$file_id')";
            if (($_POST["content"] == "" || $_POST["content"] == null || $_POST["content"] == "<br>" || $_POST["content"] == "<br/>") && ($fileName == "" || $fileName == null) && ($fileUploadName == "" || $fileUploadName == null)) {
              echo "<script>alert('Please write something')</script>";
            } else {
              if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Post Success');</script>";
              } else {
                echo "<script>alert('Post Failed');</script>";
              }
            }
          } else if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'db_images/' . $fileNameNew;
            if ($fileError === 0) {
              if ($fileSize < 100000000) {
                $sqlimg = "INSERT INTO img (img_name,album_id) VALUES ('$fileDestination','" . $_SESSION["std_id"] . "')";
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
            $resultFile1 = mysqli_query($conn, "SELECT * FROM files WHERE fileName = '$fileDestination2'");
            $rowFile1 = mysqli_fetch_array($resultFile1);
            $file_id = $rowFile1["fileId"];
            $post = nl2br($_POST["content"]);
            $form_id = $_POST["form_id"];
            $date = date("Y-m-d H:i:s", time());
            $sql = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id, fileId ) VALUES ('$post', '$date','" . $_SESSION["std_id"] . "' , '$form_id' , '$img_id' , NULL , '$file_id')";
            if (($_POST["content"] == "" || $_POST["content"] == null || $_POST["content"] == "<br>" || $_POST["content"] == "<br/>") && ($fileName == "" || $fileName == null)) {
              echo "<script>alert('Please write something')</script>";
            } else {
              if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Post Success');</script>";
              } else {
                echo "<script>alert('Post Failed');</script>";
              }
            }
          } else if ($ext == "mp4" || $ext == "webm") {
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination3 = 'db_images/' . $fileNameNew;
            if ($fileError === 0) {
              if ($fileSize < 100000000) {
                $sqlVid = "INSERT INTO video (video_name,album_id) VALUES ('$fileDestination3','" . $_SESSION["std_id"] . "')";
                mysqli_query($conn, $sqlVid);
                move_uploaded_file($fileTmpName, $fileDestination3);
              } else {
                echo "<script>alert('Your file is too big!')</script>";
              }
            } else {
              echo "<script>alert('There was an error uploading your file!')</script>";
            }
            $result2 = mysqli_query($conn, "SELECT * FROM video WHERE video_name = '$fileDestination3'");
            $row2 = mysqli_fetch_array($result2);
            $video_id = $row2["video_id"];
            $resultFile2 = mysqli_query($conn, "SELECT * FROM files WHERE fileName = '$fileDestination2'");
            $rowFile2 = mysqli_fetch_array($resultFile2);
            $file_id = $rowFile2["fileId"];
            $post2 = nl2br($_POST["content"]);
            $form_id = $_POST["formId"];
            $date2 = date("Y-m-d H:i:s", time());
            $sql2 = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id , fileId) VALUES ('$post2', '$date2','" . $_SESSION["std_id"] . "','$form_id', NULL ,'$video_id' , '$file_id')";
            if (($_POST["content"] == "" || $_POST["content"] == null || $_POST["content"] == "<br>" || $_POST["content"] == "<br/>") && ($fileName == "" || $fileName == null)) {
              echo "<script>alert('Please write something')</script>";
            } else {
              if (mysqli_query($conn, $sql2)) {
                echo "<script>alert('Post Success');</script>";
              } else {
                echo "<script>alert('Post Failed');</script>";
              }
            }
          } else {
            echo "<script>alert('File type not supported');</script>";
          }
        }
      } else {
        echo "<script>alert('لا تسب');</script>";
      }
    }
    ?>
    <form method="POST" enctype="multipart/form-data">
      <div class="mid-card">
        <div class="my-textarea" contenteditable="true">Write something here...</div>
        <textarea class="card-write-post" rows="3" placeholder="Write A Post ..." name="content"></textarea>
      </div>
      <div class="formIdSelector animate__animated animate__fadeIn animate__faster" style="display: none;">
        <p>Choose where to post:</p>
        <div class="radioInputBox">
          <input class="formIdInput1" type="radio" name="formId" id="formId1" value="1" checked />
          <label class="formIdLabel1" for="formId1">Public</label>
        </div>
        <span></span>
        <div class="radioInputBox">
          <input class="formIdInput2" type="radio" name="formId" id="formId2" value="2" />
          <label class="formIdLabel2" for="formId2">Friends</label>
        </div>
        <button type="button" class="btn-primary hvr-underline-from-center">close</button>
      </div>
      <div class="down-card">
        <div class="left-down-card">
          <p>Add to your post</p>
          <div class="icon-down">
            <label class="uploadLabel" for="uploadfile">
              <img class="imgIcon" src="Design/Image/home-images/images/ImageIcon.svg" alt="">
            </label>
            <input class="fileUpload_Button" type="file" name="file" id="uploadfile" accept=".gif,.jpg,.jpeg,.png,.doc,.mp4,.mkv">
            <label class="uploadLabel" for="tagfriend">
              <img class="tagIcon" src="Design/Image/home-images/images/tagIcon.svg" alt="">
            </label>
            <div class="tag-F form-popup arrow-div animate__animated animate__fadeIn animate__faster" id="myForm" style="display: none;">
              <form action="" class="form-container">
                <h1 class="tagH1">Tag someone</h1>
                <button type="button" class="btn cancel">Close</button>
                <div class="innerTag">
                  <?php
                  $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
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
                            $FriendImgName = $rowimg["img_name"];
                          } else {
                            if ($row1["gender"] == 1) {
                              $FriendImgName = "Design\Image\LogoPic0.jpg";
                            } else {
                              $FriendImgName = "Design\Image\LogoPic1.jpg";
                            }
                          }
                          echo "<a class='tagButton' href='#' account_id='" . $row1["account_id"] . "' fName='" . $row1["std_fname"] . "' lName='" . $row1["std_lname"] . "'>
                              <img class='tagImg' src='$FriendImgName'/>
                              " . $row1["std_fname"] . " " . $row1["std_lname"] . "
                              </a>";
                        }
                      }
                    }
                  } ?>
                </div>
              </form>
            </div>
            <img class="locIcon" src="Design/Image/home-images/images/locIcon.svg" alt="">
            <label class="uploadLabel" for="uploadfile">
              <img class="gifIcon" src="Design/Image/home-images/images/GIFicon.svg" alt="">
            </label>
            <input class="fileUpload_Button" type="file" name="fileGif" id="uploadGif" accept=".gif">
            <label class="FileLink_Button_Label" for="FileUpload">
              <img class="FileLink" src="Design/Image/home-images/images/FileLink.svg" alt="">
            </label>
            <input class="FileLink_Button" type="file" name="fileLink" id="FileUpload">
          </div>
        </div>
        <input type="submit" class="post-write" value="POST" name="post">
      </div>
    </form>
  </div>
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
        <a class="list2" href="list.php">
          <li class="more-list">
            <img class="SettingsIcon-Light" src="Design/Image/home-images/images/more-list.svg" alt="settingIcon" />
          </li>
        </a>
        <li class="settingsList">
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/Settings-icon.svg" alt="settingIcon" />
          <img class="SettingsIcon-Dark" src="Design/Image/home-images/images/Settings-icon2.svg" alt="settingIcon" />
        </li>
        <div class="settings" style="display: none;">
          <p>Settings</p>
          <div class="Logout">
            <p>Logout</p>
          </div>
        </div>

        <li class="map">
          <img class="mapIcon-Light" src="Design/Image/home-images/images/mapIcon.svg" alt="mapIcon" />
          <img class="mapIcon-Dark" src="Design/Image/home-images/images/mapIcon2.svg" alt="mapIcon" />
        </li>

        <li class="theme">
          <img class="themeLight" src="Design/Image/home-images/images/theme-light.svg" alt="themeLight" />
          <img class="themeDark" src="Design/Image/home-images/images/theme-dark.svg" alt="themeDark" />
        </li>
        <li class="NotificationsList">
          <?php
          $sql = "SELECT * FROM friends_request WHERE receiver = '" . $_SESSION["std_id"] . "' AND status = '0' ";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            $count = mysqli_num_rows($result);
            echo "<span class='notificationCount'>$count</span>";
          }
          ?>
          <img class="notificationIcon-light" src="Design/Image/home-images/images/notification-logo.svg" alt="notificationIcon" />
          <img class="notificationIcon-dark" src="Design/Image/home-images/images/notification-logo2.svg" alt="notificationIcon1" />
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
        <li class="chat">
          <img class="chatLight" src="Design/Image/home-images/images/chat-icon.svg" alt="image" />
          <img class="chatDark" src="Design/Image/home-images/images/chat-icon2.svg" alt="image" />
        </li>
        <li class="more-list">
          <img class="SettingsIcon-Light" src="Design/Image/home-images/images/more2.svg" alt="settingIcon" />
        </li>
      </ul>
      <div class="nav-user-icon online">
        <a href='personal.php'><img src="<?php echo $_SESSION["personalProfile"] ?>" alt="" /></a>
        <a href='personal.php'>
          <div class="name">
            <?php echo $_SESSION["std_fname"]; ?>
          </div>
        </a>
      </div>
    </div>
  </nav>
  <div class="container1">
    <div class="left-sidebar">
      <div class="group-page2">
        <p>Collage </p>
        <?php
        $sqlc = "SELECT Coll_Name,Coll_No FROM colleges WHERE Coll_NO = (SELECT Coll_Major_No FROM majors WHERE ID = (SELECT Std_Major_No FROM students WHERE std_No = '" . $_SESSION["std_id"] . "'))";
        $resultc = mysqli_query($conn, $sqlc);
        $rowc = mysqli_fetch_assoc($resultc);
        echo "<a href='#' class='group-list-item' data-form_id=" . "0" . $rowc["Coll_No"] . ">" . $rowc["Coll_Name"] . "</a>";
        ?>
      </div>
      <div class="group-page2">
        <p>major</p>
        <?php
        $sqlm = "SELECT Major_Name,Major_No FROM majors WHERE ID = (SELECT Std_Major_No FROM students WHERE std_No = '" . $_SESSION["std_id"] . "')";
        $resultm = mysqli_query($conn, $sqlm);
        $rowm = mysqli_fetch_assoc($resultm);
        echo "<a href='#' class='group-list-item' data-form_id=" . "1" . $rowm["Major_No"] . ">" . $rowm["Major_Name"] . "</a>";
        ?>
      </div>
      <div class="group-page2">
        <p> Subjects </p>
        <?php
        $sqlsub = "SELECT Course_Name,ID FROM courses WHERE ID IN (SELECT crs_id FROM subjects where id IN (SELECT sub_id FROM std_crs_temp WHERE std_id IN (SELECT id FROM students WHERE Std_No =" . $_SESSION["std_id"] . ")))";
        $resultsub = mysqli_query($conn, $sqlsub);
        if (mysqli_num_rows($resultsub) > 0) {
          while ($rowsub = mysqli_fetch_assoc($resultsub)) {
            echo "<a href='#' class='group-list-item' data-form_id=" . "2" . $rowsub["ID"] . ">" . $rowsub["Course_Name"] . "</a>";
          }
        }
        ?>
      </div>
      <div class="group-page">
        <p>Friends</p>
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
                  $imgname = $rowimg["img_name"];
                } else {
                  if ($row1["gender"] == 1) {
                    $imgname = "Design\Image\LogoPic0.jpg";
                  } else {
                    $imgname = "Design\Image\LogoPic1.jpg";
                  }
                }
                echo "<a href='friendpage.php?account_id=" . $row1["account_id"] . "'><img src='$imgname'/>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</a>";
              }
            }
          }
        } ?>
      </div>
    </div>
    <div class="main-content animate__animated animate__fadeIn animate__slower">
      <div class="story-gallery">
        <div class="story" style="background-image: url('<?php echo $_SESSION["personalProfile"]; ?>');">
          <img class="UploadStory" src="Design/Image/home-images/images/upload.png" alt="">
          <p>
            <?php
            echo $_SESSION["std_fname"] . " " . $_SESSION["std_lname"];
            ?>
          </p>
        </div>
        <?php
        $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $sql1 = "SELECT * FROM story WHERE author = '" . $row["friend_id"] . "' GROUP by author order by author ";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
              while ($row1 = mysqli_fetch_assoc($result1)) {
                $sql2 = "SELECT * FROM student WHERE std_id = '" . $row1["author"] . "'";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                  while ($row2 = mysqli_fetch_assoc($result2)) {
                    $imgid = $row2["img_id"];
                    $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                    $resultimg = mysqli_query($conn, $sqlimg);
                    $rowimg = mysqli_fetch_assoc($resultimg);
                    if (isset($rowimg["img_name"])) {
                      $imgname = $rowimg["img_name"];
                    } else {
                      if ($row2["gender"] == 1) {
                        $imgname = "Design\Image\LogoPic0.jpg";
                      } else {
                        $imgname = "Design\Image\LogoPic1.jpg";
                      }
                    }
                    if (isset($row1["img_name"])) {
                      echo "<div class='story' style ='background-image:url(" . $row1['img_name'] . ")' data-AthStory='".$row["friend_id"] ."'><img src='$imgname'><p>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</p></div>";
                    } else {
                      echo "<div class='story' data-AthStory='".$row["friend_id"] ."'><img src='$imgname'>
                <video class='story-vid'>
                <source src='" . $row1['video_name'] . "'>
                </video>
                <p>" . $row2["std_fname"] . " " . $row2["std_lname"] . "</p></div>";
                    }
                  }
                }
              }
            }
          }
        }
        ?>
      </div>
      <div class="write-post-container">
        <div class="user-profile">
          <img src="<?php echo $_SESSION["personalProfile"] ?>" alt="">
          <div class="write-post-input">
            <textarea class="write-post" rows="3" placeholder="What`s on your mind, <?php echo $_SESSION["std_fname"]; ?>"></textarea>
          </div>
        </div>
        <div class="post-place">
          <p class="post-public hvr-underline-from-center"> Public Posts </p>
          <span></span>
          <p class="post-friend hvr-underline-from-center"> Friends Posts</p>
        </div>
        <?php
        $likenum = 0;
        if (isset($_COOKIE["form_id"]) == false) {
          $form_id = 1;
        } else {
          $form_id = $_COOKIE["form_id"];
        }
        if ($form_id == '2') {
          $sqlfriend = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
          $resultfriend = mysqli_query($conn, $sqlfriend);
          if (mysqli_num_rows($result) > 0) {
            while ($rowfriend = mysqli_fetch_assoc($resultfriend)) {
              $sql = "SELECT * FROM post where form_id='" . $form_id . "' AND author = '" . $rowfriend["friend_id"] . "' OR author ='" . $_SESSION["std_id"] . "' order by created_date desc";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["author"] . "'";
                  $sql2 = "SELECT * FROM img WHERE img_id = '" . $row["img_id"] . "'";
                  $sql3 = "SELECT * FROM video WHERE video_id  = '" . $row["video_id"] . "'";
                  $sql9 = "SELECT * FROM files WHERE fileId = '" . $row["fileId"] . "'";
                  $result1 = mysqli_query($conn, $sql1);
                  $result2 = mysqli_query($conn, $sql2);
                  $result3 = mysqli_query($conn, $sql3);
                  $result9 = mysqli_query($conn, $sql9);
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
                      $now = new DateTime();
                      $post = new DateTime($row["created_date"]);
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
                      if ($row1["std_id"] == $_SESSION["std_id"]) {
                        $href = "personal.php";
                      } else {
                        $href = "friendpage.php?account_id=" . $row1["account_id"];
                      }
                      $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row["share_original"] . "'";
                      $shareResult = mysqli_query($conn, $shareSQL);
                      $shareRow = mysqli_fetch_assoc($shareResult);
                      if (($row["share_original"] == NULL || $row["share_original"] == "") && ($row["share_new"] == NULL || $row["share_new"] == "")) { // NOTE - THIS IS FOR POST WITHOUT SHARE
                        echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$href'>
                                 <img src='$postImage'>
                                    <div class='name'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                              </a>
                                 <div class='inside-top2'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/friends_Post.svg'>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img class='modify' src='Design/Image/home-images/images/Dots.svg'>
                                 <div class='form-popup1 animate__animated animate__fadeIn animate__faster' id='myForm1' style='display: none;'>
                                  <form action='' class='form-container2'>
                                  <p>Post Settings</p>
                                  <button type='button' class='btn cancel1'>Close</button>
                                  <div class='innerTag'>
                                  <a class='edit'>Edit post</a>
                                  <div class='modifyPost' style='display:none;'>
                                  <textarea class='edit-text' name='edit-text' placeholder='Edit your post'></textarea>
                                  <button type='button' class='btn edit-btn' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "'>Edit</button>
                                  </div>
                                  <a class='delete' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "' data-std_id='" . $_SESSION["std_id"] . "'>Delete the post</a>
                                  </div>
                                  </form>
                                  </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row["content"] . "</p>
                                 ";
                      } else if (($row["share_original"] == $row["share_new"])) { // if the person shared his own post
                        $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row["share_new"] . "'";
                        $shareResult = mysqli_query($conn, $shareSQL);
                        $shareRow = mysqli_fetch_assoc($shareResult);
                        $shareImg = "SELECT * FROM img WHERE img_id = '" . $shareRow["img_id"] . "'";
                        $shareImgResult = mysqli_query($conn, $shareImg);
                        $shareImgRow = mysqli_fetch_assoc($shareImgResult);
                        if (isset($shareImgRow["img_name"])) {
                          $shareImage = $shareImgRow["img_name"];
                        } else {
                          if ($shareRow["gender"] == 1) {
                            $shareImage = "Design\Image\LogoPic0.jpg";
                          } else {
                            $shareImage = "Design\Image\LogoPic1.jpg";
                          }
                        }
                        if ($row["share_new"] == $_SESSION["std_id"]) {
                          $shareHref = "personal.php";
                        } else {
                          $shareHref = "friendpage.php?account_id=" . $shareRow["account_id"];
                        }
                        echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$href'>
                                 <img src='$postImage'>
                                    <div class='name'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                                    </a>
                                    <div class = 'shareDesc'>Shared His Post</div>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/friends_Post.svg'>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img src='Design/Image/home-images/images/Dots.svg' class='modify'>
                                 <div class='form-popup1 animate__animated animate__fadeIn animate__faster' id='myForm1' style='display: none;'>
                                  <form action='' class='form-container2'>
                                  <p>Post Settings</p>
                                  <button type='button' class='btn cancel1'>Close</button>
                                  <div class='innerTag'>
                                  <a class='edit'>Edit post</a>
                                  <div class='modifyPost' style='display:none;'>
                                  <textarea class='edit-text' name='edit-text' placeholder='Edit your post'></textarea>
                                  <button type='submit' class='btn edit-btn' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "'>Edit</button>
                                  </div>
                                  <a class='delete' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "' data-std_id='" . $_SESSION["std_id"] . "'>Delete the post</a>
                                  </div>
                                  </form>
                                  </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row["content"] . "</p>
                                 ";
                      } else if (($row["share_original"] != $row["share_new"])) { // if the person shared onother person post
                        $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row["share_new"] . "'";
                        $shareResult = mysqli_query($conn, $shareSQL);
                        $shareRow = mysqli_fetch_assoc($shareResult);
                        $shareImg = "SELECT * FROM img WHERE img_id = '" . $shareRow["img_id"] . "'";
                        $shareImgResult = mysqli_query($conn, $shareImg);
                        $shareImgRow = mysqli_fetch_assoc($shareImgResult);
                        if (isset($shareImgRow["img_name"])) {
                          $shareImage = $shareImgRow["img_name"];
                        } else {
                          if ($shareRow["gender"] == 1) {
                            $shareImage = "Design\Image\LogoPic0.jpg";
                          } else {
                            $shareImage = "Design\Image\LogoPic1.jpg";
                          }
                        }
                        if ($row["share_new"] == $_SESSION["std_id"]) {
                          $shareHref = "personal.php";
                        } else {
                          $shareHref = "friendpage.php?account_id=" . $shareRow["account_id"];
                        }
                        echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$shareHref'>
                                 <img src='$shareImage'>
                                  <div class='name'>" .  $shareRow["std_fname"] . " " . $shareRow["std_lname"] . "</div>
                              </a>
                                    <div class = 'shareDesc'>Shared<a href='$href'><p class='shareDesc' style='display:inline'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</p></a> post</div>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/friends_Post.svg'>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img src='Design/Image/home-images/images/Dots.svg' class='modify'>
                                 <div class='form-popup1 animate__animated animate__fadeIn animate__faster' id='myForm1' style='display: none;'>
                                  <form action='' class='form-container2'>
                                  <p>Post Settings</p>
                                  <button type='button' class='btn cancel1'>Close</button>
                                  <div class='innerTag'>
                                  <a class='edit'>Edit post</a>
                                  <div class='modifyPost' style='display:none;'>
                                  <textarea class='edit-text' name='edit-text' placeholder='Edit your post'></textarea>
                                  <button type='submit' class='btn edit-btn' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "'>Edit</button>
                                  </div>
                                  <a class='delete' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "' data-std_id='" . $_SESSION["std_id"] . "'>Delete the post</a>
                                  </div>
                                  </form>
                                  </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row["content"] . "</p>
                                 ";
                      }
                      if (mysqli_num_rows($result9) > 0) {
                        while ($row9 = mysqli_fetch_assoc($result9)) {
                          echo "
                              <span>
                                  The file:
                                  <a href='" . $row9["fileName"] . "' download='" . $row9["fileOriginalName"] . "'>" . $row9["fileOriginalName"] . "</a>
                              </span>
                              ";
                        }
                      }
                      echo "
                              </div> ";
                    }
                  }
                  if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                      echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <img class='post-image' src='" . $row2["img_name"] . "'>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                       <div class='like'>
                                       ";
                      $sql4 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                      $result3 = mysqli_query($conn, $sql4);
                      if (mysqli_num_rows($result3) > 0) {
                        echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  ";
                        if ($likenum == 1) {
                          echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                        } else {
                          echo "
                                                    <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                        }
                      } else {
                        echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                      }
                      echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row["post_id"] . "' data-std_id='" . $_SESSION["std_id"] . "' data-author='" . $row["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row["post_id"] . "' data-author_id='" . $_SESSION["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                      $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $_SESSION["std_id"] . "' AND post_id = '" . $row["post_id"] . "'";
                      $result8 = mysqli_query($conn, $sql8);
                      if (mysqli_num_rows($result8) > 0) {
                        echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                      } else {
                        echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                      }
                      echo "
                                 </div>
                                 </div>
                                 </div>";
                    }
                  } else if (mysqli_num_rows($result3) > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                      echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <video width='800px' controls class='video-js vjs-theme-forest vjs-fluid' data-setup='{}'>
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
                        echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  ";
                        if ($likenum == 1) {
                          echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                        } else {
                          echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                        }
                      } else {
                        echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                      }
                      echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row["post_id"] . "' data-std_id='" . $_SESSION["std_id"] . "' data-author='" . $row["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row["post_id"] . "' data-author_id='" . $_SESSION["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                      $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $_SESSION["std_id"] . "' AND post_id = '" . $row["post_id"] . "'";
                      $result8 = mysqli_query($conn, $sql8);
                      if (mysqli_num_rows($result8) > 0) {
                        echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                      } else {
                        echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                      }
                      echo "
                                 </div>
                                 </div>
                                 </div>";
                    }
                  } else {
                    echo "<div class='end-post'>
                              <div class='likes'>
                                 <div class='like'>
                                  ";
                    $sql5 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                    $result4 = mysqli_query($conn, $sql5);
                    if (mysqli_num_rows($result4) > 0) {
                      echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              ";
                      if ($likenum == 1) {
                        echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                        <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                        <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                              ";
                      } else {
                        echo "
                                                        <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                        <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                        <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              ";
                      }
                    } else {
                      echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                              <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                        ";
                    }
                    echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row["post_id"] . "' data-std_id='" . $_SESSION["std_id"] . "' data-author='" . $row["author"] . "'>
                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row["post_id"] . "' data-author_id='" . $_SESSION["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                    $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $_SESSION["std_id"] . "' AND post_id = '" . $row["post_id"] . "'";
                    $result8 = mysqli_query($conn, $sql8);
                    if (mysqli_num_rows($result8) > 0) {
                      echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                    } else {
                      echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                    }
                    echo "
                                 </div>
                                 </div>
                                 </div>";
                  }
                }
              }
            }
          }
        } else {
          $sql = "SELECT * FROM post where form_id='" . $form_id . "' order by created_date desc";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["author"] . "'";
              $sql2 = "SELECT * FROM img WHERE img_id = '" . $row["img_id"] . "'";
              $sql3 = "SELECT * FROM video WHERE video_id  = '" . $row["video_id"] . "'";
              $sql9 = "SELECT * FROM files WHERE fileId = '" . $row["fileId"] . "'";
              $result1 = mysqli_query($conn, $sql1);
              $result2 = mysqli_query($conn, $sql2);
              $result3 = mysqli_query($conn, $sql3);
              $result9 = mysqli_query($conn, $sql9);
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
                  $now = new DateTime();
                  $post = new DateTime($row["created_date"]);
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
                  if ($row1["std_id"] == $_SESSION["std_id"]) {
                    $href = "personal.php";
                  } else {
                    $href = "friendpage.php?account_id=" . $row1["account_id"];
                  }
                  if (($row["share_original"] == NULL || $row["share_original"] == "") && ($row["share_new"] == NULL || $row["share_new"] == "")) { // NOTE - THIS IS FOR POST WITHOUT SHARE
                    echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$href'>
                                 <img src='$postImage'>
                                    <div class='name'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                              </a>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/ball.svg'>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img src='Design/Image/home-images/images/Dots.svg' class='modify'>
                                 <div class='form-popup1 animate__animated animate__fadeIn animate__faster' id='myForm1' style='display: none;'>
                                  <form action='' class='form-container2'>
                                  <p>Post Settings</p>
                                  <button type='button' class='btn cancel1'>Close</button>
                                  <div class='innerTag'>
                                  <a class='edit'>Edit post</a>
                                  <div class='modifyPost' style='display:none;'>
                                  <textarea class='edit-text' name='edit-text' placeholder='Edit your post'></textarea>
                                  <button type='submit' class='btn edit-btn' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "'>Edit</button>
                                  </div>
                                  <a class='delete' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "' data-std_id='" . $_SESSION["std_id"] . "'>Delete the post</a>
                                  </div>
                                  </form>
                                  </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row["content"] . "</p>
                                 ";
                  } else if (($row["share_original"] == $row["share_new"])) { // if the person shared his own post
                    $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row["share_new"] . "'";
                    $shareResult = mysqli_query($conn, $shareSQL);
                    $shareRow = mysqli_fetch_assoc($shareResult);
                    $shareImg = "SELECT * FROM img WHERE img_id = '" . $shareRow["img_id"] . "'";
                    $shareImgResult = mysqli_query($conn, $shareImg);
                    $shareImgRow = mysqli_fetch_assoc($shareImgResult);
                    if (isset($shareImgRow["img_name"])) {
                      $shareImage = $shareImgRow["img_name"];
                    } else {
                      if ($shareRow["gender"] == 1) {
                        $shareImage = "Design\Image\LogoPic0.jpg";
                      } else {
                        $shareImage = "Design\Image\LogoPic1.jpg";
                      }
                    }
                    if ($row["share_new"] == $_SESSION["std_id"]) {
                      $shareHref = "personal.php";
                    } else {
                      $shareHref = "friendpage.php?account_id=" . $shareRow["account_id"];
                    }
                    echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$href'>
                                 <img src='$postImage'>
                                    <div class='name'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</div>
                                    </a>
                                    <div class = 'shareDesc'>Shared His Post</div>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/ball.svg'>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img src='Design/Image/home-images/images/Dots.svg' class='modify'>
                                 <div class='form-popup1 animate__animated animate__fadeIn animate__faster' id='myForm1' style='display: none;'>
                                  <form action='' class='form-container2'>
                                  <p>Post Settings</p>
                                  <button type='button' class='btn cancel1'>Close</button>
                                  <div class='innerTag'>
                                  <a class='edit'>Edit post</a>
                                  <div class='modifyPost' style='display:none;'>
                                  <textarea class='edit-text' name='edit-text' placeholder='Edit your post'></textarea>
                                  <button type='submit' class='btn edit-btn' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "'>Edit</button>
                                  </div>
                                  <a class='delete' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "' data-std_id='" . $_SESSION["std_id"] . "'>Delete the post</a>
                                  </div>
                                  </form>
                                  </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row["content"] . "</p>
                                 ";
                  } else if (($row["share_original"] != $row["share_new"])) { // if the person shared onother person post
                    $shareSQL = "SELECT * FROM student WHERE std_id = '" . $row["share_new"] . "'";
                    $shareResult = mysqli_query($conn, $shareSQL);
                    $shareRow = mysqli_fetch_assoc($shareResult);
                    $shareImg = "SELECT * FROM img WHERE img_id = '" . $shareRow["img_id"] . "'";
                    $shareImgResult = mysqli_query($conn, $shareImg);
                    $shareImgRow = mysqli_fetch_assoc($shareImgResult);
                    if (isset($shareImgRow["img_name"])) {
                      $shareImage = $shareImgRow["img_name"];
                    } else {
                      if ($shareRow["gender"] == 1) {
                        $shareImage = "Design\Image\LogoPic0.jpg";
                      } else {
                        $shareImage = "Design\Image\LogoPic1.jpg";
                      }
                    }
                    if ($row["share_new"] == $_SESSION["std_id"]) {
                      $shareHref = "personal.php";
                    } else {
                      $shareHref = "friendpage.php?account_id=" . $shareRow["account_id"];
                    }
                    echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <a class='name-photo' href='$shareHref'>
                                 <img src='$shareImage'>
                                  <div class='name'>" .  $shareRow["std_fname"] . " " . $shareRow["std_lname"] . "</div>
                              </a>
                                    <div class = 'shareDesc'>Shared<a href='$href'><p class='shareDesc' style='display:inline'>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</p></a> post</div>
                                 <div class='inside-top'>
                                  $difftime
                                 <img src='Design/Image/home-images/images/ball.svg'>
                              </div>
                              </div>
                              <div class='right-post'>
                                 <img src='Design/Image/home-images/images/Dots.svg' class='modify'>
                                 <div class='form-popup1 animate__animated animate__fadeIn animate__faster' id='myForm1' style='display: none;'>
                                  <form action='' class='form-container2'>
                                  <p>Post Settings</p>
                                  <button type='button' class='btn cancel1'>Close</button>
                                  <div class='innerTag'>
                                  <a class='edit'>Edit post</a>
                                  <div class='modifyPost' style='display:none;'>
                                  <textarea class='edit-text' name='edit-text' placeholder='Edit your post'></textarea>
                                  <button type='submit' class='btn edit-btn' data-post_id='" . $row["post_id"] . "'data-author_id = '" . $row1["std_id"] . "'>Edit</button>
                                  </div>
                                  <a class='delete' data-post_id='" . $row["post_id"] . "' data-author_id = '" . $row1["std_id"] . "' data-std_id='" . $_SESSION["std_id"] . "'>Delete the post</a>
                                  </div>
                                  </form>
                                  </div>
                              </div>
                              </div>
                              <div class='mid-post'>
                              <p>" . $row["content"] . "</p>
                                 ";
                  }
                  if (mysqli_num_rows($result9) > 0) {
                    while ($row9 = mysqli_fetch_assoc($result9)) {
                      echo "
                              <span>
                                  The file:
                                  <a href='" . $row9["fileName"] . "' download='" . $row9["fileOriginalName"] . "'>" . $row9["fileOriginalName"] . "</a>
                              </span>
                              ";
                    }
                  }
                  echo "
                              </div> ";
                }
              }
              if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                  echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <img class='post-image' src='" . $row2["img_name"] . "'>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                       <div class='like'>
                                       ";
                  $sql4 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                  $result3 = mysqli_query($conn, $sql4);
                  if (mysqli_num_rows($result3) > 0) {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  ";
                    if ($likenum == 1) {
                      echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                    } else {
                      echo "
                                                    <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                    }
                  } else {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                  }
                  echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row["post_id"] . "' data-std_id='" . $_SESSION["std_id"] . "' data-author='" . $row["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row["post_id"] . "' data-author_id='" . $_SESSION["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                  $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $_SESSION["std_id"] . "' AND post_id = '" . $row["post_id"] . "'";
                  $result8 = mysqli_query($conn, $sql8);
                  if (mysqli_num_rows($result8) > 0) {
                    echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                  } else {
                    echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                  }
                  echo "
                                 </div>
                                 </div>
                                 </div>";
                }
              } else if (mysqli_num_rows($result3) > 0) {
                while ($row3 = mysqli_fetch_assoc($result3)) {
                  echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <video width='800px' controls class='video-js vjs-theme-forest vjs-fluid' data-setup='{}'>
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
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  ";
                    if ($likenum == 1) {
                      echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                  ";
                    } else {
                      echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  ";
                    }
                  } else {
                    echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                                  <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                            ";
                  }
                  echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row["post_id"] . "' data-std_id = '" . $_SESSION["std_id"] . "' data-author ='" . $row["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row["post_id"] . "' data-author_id='" . $_SESSION["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                  $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $_SESSION["std_id"] . "' AND post_id = '" . $row["post_id"] . "'";
                  $result8 = mysqli_query($conn, $sql8);
                  if (mysqli_num_rows($result8) > 0) {
                    echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                  } else {
                    echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                  }
                  echo "
                                 </div>
                                 </div>
                                 </div>";
                }
              } else {
                echo "<div class='end-post'>
                              <div class='likes'>
                                 <div class='like'>
                                  ";
                $sql5 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                $result4 = mysqli_query($conn, $sql5);
                if (mysqli_num_rows($result4) > 0) {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              ";
                  if ($likenum == 1) {
                    echo "<p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                        <p class='LikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                                        <p class='UnLikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>like</p>
                                              ";
                  } else {
                    echo "
                                                        <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                                        <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                                        <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              ";
                  }
                } else {
                  echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>
                                              <p class='LikeCount' post_id='" . $row["post_id"] . "'>$likenum</p>
                                              <p class='LikeParagraph' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                              <p class='UnLikeParagraph' style='display: none;' post_id='" . $row["post_id"] . "' std_id='" . $_SESSION["std_id"] . "'>likes</p>
                                        ";
                }
                echo "
                                       </div>
                                       <div class='comment' data-post_id='" . $row["post_id"] . "' data-std_id = '" . $_SESSION["std_id"] . "' data-author ='" . $row["author"] . "'>                                       <img src='Design/Image/home-images/images/Comment.svg'>
                                       <p>comment</p>
                                       </div>
                                       <div class='share' data-post_id='" . $row["post_id"] . "' data-author_id='" . $_SESSION["std_id"] . "'>
                                       <img src='Design/Image/home-images/images/Share.svg''>
                                       <p>share</p>
                                       </div>";
                $sql8 = "SELECT * FROM saved_post WHERE keeper_id = '" . $_SESSION["std_id"] . "' AND post_id = '" . $row["post_id"] . "'";
                $result8 = mysqli_query($conn, $sql8);
                if (mysqli_num_rows($result8) > 0) {
                  echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                } else {
                  echo "<div class='save' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "'>
                                                   <img src='Design/Image/home-images/images/Save.svg'>
                                                   <p>save</p>
                                                   </div>
                                                   <div class='saved' data-post_id='" . $row["post_id"] . "' data-keeper_id='" . $_SESSION["std_id"] . "' style='display: none;'>
                                                  <img src='Design/Image/home-images/images/Saved.svg'>
                                                  <p>Unsave</p>
                                                </div>";
                }
                echo "
                                 </div>
                                 </div>
                                 </div>";
              }
            }
          }
        }
        ?>
      </div>
    </div>

    <div class="right-sidebar">
      <div class="imp-link">
        <a href="savedPosts.php">
          <img class="savedPosts-Light" src="Design/Image/home-images/images/saved-posts.svg" alt="" />
          <img class="savedPosts-Dark" src="Design/Image/home-images/images/saved-posts2.svg" alt="" />
          <span> Saved posts</span>
        </a>
        <a href="Friends.php">
          <img class="savedPosts-Light" src="Design/Image/home-images/images/Groups.svg" alt="" />
          <span> Friends</span>
        </a>
        <a href="market.php">
          <img class="marketIcon-Light" src="Design/Image/home-images/images/market-Icon.svg" alt="" />
          <img class="marketIcon-Dark" src="Design/Image/home-images/images/market-Icon2.svg" alt="" />
          <span>Market</span>
        </a>
        <a href="http://elearning.ahu.edu.jo/login/index.php">
          <img class="elearningIcon-Light" src="Design/Image/home-images/images/elearning-icon.svg" alt="" />
          <img class="elearningIcon-Dark" src="Design/Image/home-images/images/elearning-icon2.svg" alt="" />
          <span>E-Learning</span>
        </a>
        <a class="SRGS" href="#">
          <img class="housingIcon-Light" src="Design/Image/home-images/images/iconmonstr-edit-9.svg" alt="" />
          <img class="housingIcon-Dark" src="Design/Image/home-images/images/iconmonstr-edit-9.svg" alt="" />
          <span>Student Reg Guidance System</span></a>
        <a href="http://sis.ahu.edu.jo/">
          <img class="infoIcon-Light" src="Design/Image/home-images/images/Info-Icon.svg" alt="" />
          <img class="infoIcon-Dark" src="Design/Image/home-images/images/Info-Icon2.svg" alt="" />
          <span>Student information system</span>
        </a>
        <a href="http://reg.ahu.edu.jo/">
          <img class="regIcon-Light" src="Design/Image/home-images/images/RegIcon.svg" alt="" />
          <img class="regIcon-Dark" src="Design/Image/home-images/images/RegIcon2.svg" alt="" />
          <span>Student registration system</span>
        </a>
      </div>
    </div>
  </div>
  <div class="modal">
    <span class="close">&times;</span>
    <img class="modal-content slide-in-elliptic-top-fwd" id="img01">
  </div>
  <div class="modalStory">
    <span class="close">&times;</span>
    <img class="modal-content slide-in-elliptic-top-fwd" id="img01">
    <video class="videoElement" width='300px' controls class='video-js vjs-theme-forest vjs-fluid' data-setup='{}'>
      <source class="vidSource" src='" . $row3["video_name"] . "' type='video/mp4'>
    </video>
  </div>
  <button class="scrollToTopBtn">☝️</button>
  <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
  <script type="module" src="bootstrap-js/home.js" defer></script>
</body>

</html>
