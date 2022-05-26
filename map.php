<?php
include_once "connection.php";
session_start();
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
   <link id="theme" rel="stylesheet" href="bootstrap-css/light-home.css" />
   <script src="node_modules/alertifyjs/build/alertify.min.js"></script>
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
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                  <div class="form-popup arrow-div animate__animated animate__fadeIn animate__faster" id="myForm" style="display: none;">
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
   <br>
   <iframe src="https://my.atlistmaps.com/map/5af7905c-717e-4c65-9276-d7207902c5d8?share=true" allow="geolocation" width="100%" height="850PX" frameborder="0" scrolling="no" allowfullscreen></iframe>
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
