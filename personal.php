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
      $sql = "INSERT INTO img (img_name,album_id) VALUES ('$fileDestination','" . $_SESSION["std_id"] . "')";
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
    <input type="button" name="close" class="closeProf" value="close">
  </form>
  <div class="post-card slide-in-elliptic-top-fwd">
    <div class="top-card">
      <div class="left-top-card">
        <div class="card-name-photo">
          <img class="card-user-photo" src="<?php echo $_SESSION["img_name"] ?>">
          <div class="card-name"><?php echo $_SESSION["std_fname"] . " " . $_SESSION["std_lname"] ?></div>
        </div>
        <div class="card-inside-top">
          <img class="PublicChoice" src="Design/Image/home-images/images/ball2.svg" style="display:inline-block;">
          <img class="FriendChoice" src="Design/Image/home-images/images/friends_Post.svg" style="display:none;">
          <img class="choiceDropDown" src="Design/Image/home-images/images/card-down.svg">
        </div>
      </div>
      <div class="right-top-card">
        <img class="exitCard" src="Design/Image/home-images/images/exit-card.svg">
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
              <img class="imgIcon" src="Design/Image/home-images/images/ImageIcon.svg">
            </label>
            <input class="fileUpload_Button" type="file" name="file" id="uploadfile" accept=".gif,.jpg,.jpeg,.png,.doc,.mp4,.mkv">
            <label class="uploadLabel" for="tagfriend">
              <img class="tagIcon" src="Design/Image/home-images/images/tagIcon.svg">
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
            <img class="locIcon" src="Design/Image/home-images/images/locIcon.svg">
            <label class="uploadLabel" for="uploadfile">
              <img class="gifIcon" src="Design/Image/home-images/images/GIFicon.svg">
            </label>
            <input class="fileUpload_Button" type="file" name="fileGif" id="uploadGif" accept=".gif">
            <label class="FileLink_Button_Label" for="FileUpload">
              <img class="FileLink" src="Design/Image/home-images/images/FileLink.svg">
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
          <div class="forget-pass">
            <p>Change password</p>
          </div>
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
        <a href='personal.php'><img src="<?php echo $_SESSION["personalProfile"] ?>" /></a>
        <a href='personal.php'>
          <div class="name">
            <?php echo $_SESSION["std_fname"]; ?>
          </div>
        </a>
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
          <a href="" class="list-posts">Posts</a>
          <a href="" class="list-friends">Friends</a>
          <a href="" class="list-photos">Photos</a>
          <a href="" class="list-videos">Videos</a>
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
          <?php
          if (!isset($row['instagram']) || $row['instagram'] == "") {
            echo "";
          } else {
            echo "<div class='bio bio5'>
            <a href='" . $row['instagram'] . "'><img src='Design/Image/home-images/images/bio4.png' alt=''></a>
          </div>";
          }
          ?>
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
            <div class="see-more seeMorePhoto">See more</div>
          </div>
          <div class="Photo">
            <?php
            $sql = "SELECT * FROM img WHERE album_id = '" . $_SESSION["std_id"] . "' LIMIT 4";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<img src='" . $row["img_name"] . "' alt='image'>";
            }

            ?>
          </div>
        </div>
        <div class="left-post left-post-two">
          <div class="photo-see">
            <h1>Friends</h1>
            <div class="see-more seeMoreFriends">See more</div>
          </div>
          <div class="Friends">
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
      <div class="right-post">
        <div class="write-post-container">
          <div class="user-profile">
            <img src="<?php echo $_SESSION["personalProfile"]; ?>" alt="personalProfileImg">
            <div class="write-post-input">
              <textarea class="write-post" rows="3" placeholder="What`s on your mind, <?php echo $_SESSION["std_fname"]; ?>"></textarea>
            </div>
          </div>
          <?php
          if (isset($_COOKIE["Personal_id"]) == false) {
            $_COOKIE["Personal_id"] = 1;
          }
          if ($_COOKIE["Personal_id"] == 1) {
            $likenum = 0;
            $sql = "SELECT * FROM post where author = " . $_SESSION["std_id"] . " order by created_date desc";
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
                                                                      <div class='right-top-card'>
                                      <img class='exitCard editExit' src='Design/Image/home-images/images/exit-card.svg'>
                                   </div>
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
                                                                      <div class='right-top-card'>
                                      <img class='exitCard editExit' src='Design/Image/home-images/images/exit-card.svg'>
                                   </div>
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
                                                                      <div class='right-top-card'>
                                      <img class='exitCard editExit' src='Design/Image/home-images/images/exit-card.svg'>
                                   </div>
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
                                          <img class='show_Likes' data-post_id='" . $row["post_id"] . "' src='Design/Image/home-images/images/card-down.svg'>
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
                                          <img class='show_Likes' data-post_id='" . $row["post_id"] . "' src='Design/Image/home-images/images/card-down.svg'>
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
                                          <img class='show_Likes' data-post_id='" . $row["post_id"] . "' src='Design/Image/home-images/images/card-down.svg'>
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
          } else if ($_COOKIE["Personal_id"] == 2) {
            $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              echo "<div class='FCont'>";
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
              echo "</div>";
            }
          } else if ($_COOKIE["Personal_id"] == 3) {
            $sql = "SELECT * FROM img WHERE album_id = '" . $_SESSION["std_id"] . "'";
            $result = mysqli_query($conn, $sql);
            echo "<div class='imgContainer'>";
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<img src='" . $row["img_name"] . "' alt='image'>";
            }
            echo "</div>";
          } else {
            $sql = "SELECT * FROM video WHERE album_id = '" . $_SESSION["std_id"] . "'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<video width='800px' controls class='video-js vjs-theme-forest vjs-fluid' data-setup='{}'>
          <source src='" . $row["video_name"] . "' type='video/mp4'>
       </video>";
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="commentBox">
    <div class="closeBtnComment btn">Close</div>
    <p class="commentHeader">Comments</p>
    <div class="commentList">
      <!-- <div class="commentContent"></div> -->
      <textarea class="commentArea" name="commentArea" id="" cols="30" rows="10" placeholder="Write your comment..."></textarea>
      <button class="sendComment btn">Send</button>
    </div>
  </div>
  <button class="scrollToTopBtn">☝️</button>
  <div class="show_Likes_Box" style="display: none;"></div>
  <div class="modal">
    <span class="close">&times;</span>
    <img class="modal-content slide-in-elliptic-top-fwd">
  </div>
  <div class="modal" id="modal2">
    <span class="close" id="close2">&times;</span>
    <img class="modal-content slide-in-elliptic-top-fwd" id="modal-content">
  </div>
  <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-js/all.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
  <script type="module" src="bootstrap-js/personal.js" defer></script>
</body>

</html>