<?php
  include_once "connection.php";
  include_once "like.php";
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="Design/Image/whiteLogo.svg" type="image/x-icon">
    <title>Triibe</title>
    <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap-css/all.min.css" />
    <link rel="stylesheet" href="node_modules/animate.css/animate.css" />
    <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css" />
    <link rel="stylesheet" href="node_modules/alertifyjs/build/css/themes/default.min.css" />
    <link href="node_modules/hover.css/css/hover-min.css" rel="stylesheet">
    <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">
    <link id="theme" rel="stylesheet" href="bootstrap-css/light-home.css" />
  </head>
  <body>
    <div class="post-card slide-in-elliptic-top-fwd">
      <div class="top-card">
        <div class="left-top-card">
          <div class="card-name-photo">
            <img class="card-user-photo" src="<?php echo $_SESSION["img_name"]?>" alt="">
            <div class="card-name"><?php echo $_SESSION["std_fname"] ." ". $_SESSION["std_lname"] ?></div>
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
       if($_SERVER["REQUEST_METHOD"] == "POST"){
           $file = $_FILES['file'];
           $fileName = $_FILES['file']['name'];
           $ext = pathinfo($fileName, PATHINFO_EXTENSION);
           $fileTmpName = $_FILES['file']['tmp_name'];
           $fileSize = $_FILES['file']['size'];
           $fileError = $_FILES['file']['error'];
           $fileExt = explode('.', $fileName);
           $fileActualExt = strtolower(end($fileExt));
           if($ext = "" || $ext == null){
              $post = nl2br($_POST["content"]);
              $date = date("Y-m-d H:i:s", time());
              $sql = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id) VALUES ('$post', '$date','".$_SESSION["std_id"]."' , 1 , NULL , NULL)";
              if(mysqli_query($conn, $sql)){
                header("Location: home.php");
              }
              else{
                echo "<script>alert('Post Failed');</script>";
              }
          }
           else if($ext == "jpg" || $ext == "jpeg" || $ext == "png"){
              if($fileError === 0){
                 if($fileSize < 50000000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'db_images/'.$fileNameNew;
                    $sqlimg = "INSERT INTO img (img_name) VALUES ('$fileDestination')";
                    mysqli_query($conn, $sqlimg);
                    move_uploaded_file($fileTmpName, $fileDestination);
                 }else{
                    echo "<script>alert('Your file is too big!')</script>";
                 }
              }else{
                 echo "<script>alert('There was an error uploading your file!')</script>";
              }
              $result = mysqli_query($conn,"SELECT * FROM img WHERE img_name = '$fileDestination'");
              $row = mysqli_fetch_array($result);
              $img_id = $row["img_id"];
          $post = nl2br($_POST["content"]);
          $date = date("Y-m-d H:i:s", time());
          $sql = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id) VALUES ('$post', '$date','".$_SESSION["std_id"]."' , 1 , '$img_id' , NULL)";
          if(mysqli_query($conn, $sql)){
            header("Location: home.php");
          }
          else{
            echo "<script>alert('Post Failed');</script>";
          }
        }else if($ext == "mp4" || $ext == "webm"){
            if($fileError === 0){
               if($fileSize < 50000000){
                  $fileNameNew = uniqid('', true).".".$fileActualExt;
                  $fileDestination = 'db_images/'.$fileNameNew;
                  $sqlVid = "INSERT INTO video (video_name) VALUES ('$fileDestination')";
                  mysqli_query($conn, $sqlVid);
                  move_uploaded_file($fileTmpName, $fileDestination);
               }else{
                  echo "<script>alert('Your file is too big!')</script>";
               }
            }else{
               echo "<script>alert('There was an error uploading your file!')</script>";
            }
            $result2 = mysqli_query($conn,"SELECT * FROM video WHERE video_name = '$fileDestination'");
            $row2 = mysqli_fetch_array($result2);
            $video_id = $row2["video_id"];
            $post2 = nl2br($_POST["content"]);
            $date2 = date("Y-m-d H:i:s", time());
            $sql2 = "INSERT INTO post ( content , created_date , author , form_id , img_id, video_id) VALUES ('$post2', '$date2','".$_SESSION["std_id"]."',1, NULL ,'$video_id')";
          if(mysqli_query($conn, $sql2)){
            header("Location: home.php");
          }else{
            echo "<script>alert('Post Failed');</script>";
          }
        }
      }
      ?>
     <form method = "POST"  enctype="multipart/form-data">
      <div class="mid-card">
        <textarea class="card-write-post" rows="3" placeholder="Write A Post ..." name = "content"></textarea>
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
            <div class="form-popup arrow-div" id="myForm">
             <form action="" class="form-container">
              <h1 class="tagH1">Tag someone</h1>
              <button type="button" class="btn cancel">Close</button>
              <div class="innerTag">
              <?php $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0)
              {
                  while ($row = mysqli_fetch_assoc($result))
                  {
                      $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["friend_id"] . "'";
                      $result1 = mysqli_query($conn, $sql1);
                      if (mysqli_num_rows($result1) > 0)
                      {
                          while ($row1 = mysqli_fetch_assoc($result1))
                          {
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
          <img src="Design/Image/home-images/images/logo.svg" alt="logoLight" class="logoLight" /> <img src="Design/Image/home-images/images/logo2.svg" alt="logoDark" class="logoDark" />
          <p>Triibe</p>
        </div>
        <div class="search-box"> <img src="Design/Image/home-images/images/Search-Icon.svg" alt="search" />
          <input type="text" placeholder="Search" />
        </div>
      </div>
      <div class="nav-right">
        <ul>
          <li>
            <img class="SettingsIcon-Light" src="Design/Image/home-images/images/Settings-icon.svg" alt="settingIcon" />
            <img class="SettingsIcon-Dark" src="Design/Image/home-images/images/Settings-icon2.svg" alt="settingIcon" />
          </li>
          <li>
            <img class="mapIcon-Light" src="Design/Image/home-images/images/mapIcon.svg" alt="mapIcon" />
            <img class="mapIcon-Dark" src="Design/Image/home-images/images/mapIcon2.svg" alt="mapIcon" />
          </li>
          <li>
            <img class="themeLight" src="Design/Image/home-images/images/theme-light.svg" alt="themeLight" />
            <img class="themeDark" src="Design/Image/home-images/images/theme-dark.svg" alt="themeDark" />
          </li>
          <li>
            <img class="notificationIcon-light" src="Design/Image/home-images/images/notification-logo.svg" alt="notificationIcon" />
            <img class="notificationIcon-dark" src="Design/Image/home-images/images/notification-logo2.svg" alt="notificationIcon1" />
          </li>
          <li>
            <img class="chatLight" src="Design/Image/home-images/images/chat-icon.svg" alt="image" />
            <img class="chatDark" src="Design/Image/home-images/images/chat-icon2.svg" alt="image" />
          </li>
        </ul>
        <div class="nav-user-icon online">
          <a href='personal.php'><img src="<?php echo $_SESSION["img_name"]; ?>" alt="" /></a>
          <a href='personal.php'><div class="name">
            <?php echo $_SESSION["std_fname"]; ?>
          </div></a>
        </div>
      </div>
    </nav>
    <div class="container1">
      <div class="left-sidebar">
        <div class="group-list">
          <a href="#"> <img class="pagesIcon-Light" src="Design/Image/home-images/images/pages-icon.svg" alt="pages-icon"> <img class="pagesIcon-Dark" src="Design/Image/home-images/images/pages-icon2.svg" alt="pages-icon2"> <span>Pages</span> </a>
          <a href="#"> <img class="Groups-Light" src="Design/Image/home-images/images/Groups.svg" alt=""> <img class="Groups-Dark" src="Design/Image/home-images/images/Groups2.svg" alt=""><span>Groups</span> </a>
          <div class="group-page">
            <p>Friends</p>
            <?php $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0)
              {
                  while ($row = mysqli_fetch_assoc($result))
                  {
                      $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["friend_id"] . "'";
                      $result1 = mysqli_query($conn, $sql1);
                      if (mysqli_num_rows($result1) > 0)
                      {
                          while ($row1 = mysqli_fetch_assoc($result1))
                          {
                              $imgid = $row1["img_id"];
                              $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                              $resultimg = mysqli_query($conn, $sqlimg);
                              $rowimg = mysqli_fetch_assoc($resultimg);
                              echo "<a href='#'><img src='" . $rowimg["img_name"] . "' alt=''/>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</a>";
                          }
                      }
                  }
              } ?>
          </div>
        </div>
      </div>
      <div class="main-content animate__animated animate__fadeIn animate__slow">
        <div class="story-gallery">
          <div class="story">
            <img src="Design/Image/home-images/images/upload.png" alt="">
            <p>
              <?php
                echo $_SESSION["std_fname"] . " " . $_SESSION["std_lname"];
                ?>
            </p>
          </div>
          <?php $sql = "SELECT * FROM friends WHERE user_id = '" . $_SESSION["std_id"] . "'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["friend_id"] . "'";
                    $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0)
                    {
                        while ($row1 = mysqli_fetch_assoc($result1))
                        {
                            echo "<div class='story'><img src='Design/Image/home-images/images/upload.png' alt=''><p>" . $row1["std_fname"] . " " . $row1["std_lname"] . "</p></div>";
                        }
                    }
                }
            } ?>
        </div>
        <div class="write-post-container">
          <div class="user-profile">
            <img src="<?php echo $_SESSION["img_name"]; ?>" alt="">
            <div class="write-post-input">
              <textarea class="write-post" rows="3" placeholder="What`s on your mind, <?php echo $_SESSION["std_fname"]; ?>"></textarea>
            </div>
          </div>
          <?php
            $likenum = 0;
            $sql = "SELECT * FROM post order by created_date desc";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $sql1 = "SELECT * FROM student WHERE std_id = '" . $row["author"] . "'";
                    $sql2 = "SELECT * FROM img WHERE img_id = '" . $row["img_id"] . "'";
                    $sql3 = "SELECT * FROM video WHERE video_id  = '" . $row["video_id"] . "'";
                    $result1 = mysqli_query($conn, $sql1);
                    $result2 = mysqli_query($conn, $sql2);
                    $result3 = mysqli_query($conn, $sql3);
                    $sqllikenum = "SELECT COUNT(*) FROM post_likes WHERE post_id = '".$row["post_id"]."'";
                    $resultlikenum = mysqli_query($conn, $sqllikenum);
                    $rowlikenum = mysqli_fetch_assoc($resultlikenum);
                    $likenum = $rowlikenum["COUNT(*)"];
                    if (mysqli_num_rows($result1) > 0){
                        while ($row1 = mysqli_fetch_assoc($result1)){
                            $imgid = $row1["img_id"];
                            $sqlimg = "SELECT * FROM img WHERE img_id = '$imgid'";
                            $resultimg = mysqli_query($conn, $sqlimg);
                            $rowimg = mysqli_fetch_assoc($resultimg);
                            echo "
                              <div class= 'post'>
                              <div class='top-post'>
                                 <div class='left-post'>
                              <div class='name-photo'>
                                 <img src='" . $rowimg["img_name"] . "' alt=''>
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
                    if (mysqli_num_rows($result2) > 0){
                        while ($row2 = mysqli_fetch_assoc($result2)){
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
                                        if (mysqli_num_rows($result3) > 0){
                                            echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' alt=''>
                                                  ";
                                                  if ($likenum == 1){
                                                    echo "<p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>like</p>
                                                  <p class='UnLikeParagraph' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>like</p>
                                                  ";
                                                  }else{
                                                    echo "
                                                    <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
                                                  ";
                                                  }
                                        }else{
                                            echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' alt=''>
                                                  <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
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
                    } else if (mysqli_num_rows($result3) > 0){
                        while ($row3 = mysqli_fetch_assoc($result3)){
                            echo "<div class='end-post'>
                                    <div class='content-end'>
                                    <div class='photo-post'>
                                      <video width='500px' controls class='video-js vjs-theme-forest' data-setup='{}'>
                                         <source src='".$row3["video_name"]."' type='video/mp4'>
                                      </video>
                                    </div>
                                    </div>
                                    <div class='likes'>
                                        <div class='like'>
                                        ";
                                        $sql7 = "SELECT * FROM post_likes WHERE post_id = '" . $row["post_id"] . "' AND std_id = '" . $_SESSION["std_id"] . "'";
                                        $result7 = mysqli_query($conn, $sql7);
                                        if (mysqli_num_rows($result7) > 0){
                                            echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' alt=''>
                                                  ";
                                                  if ($likenum == 1){
                                                    echo "<p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>like</p>
                                                  <p class='UnLikeParagraph' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>like</p>
                                                  ";
                                                  }else{
                                                    echo "
                                                    <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' style='display: none;' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
                                                  <p class='UnLikeParagraph' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
                                                  ";
                                                  }
                                        }else{
                                            echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' alt=''>
                                                  <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' alt=''>
                                                  <p class='LikeCount'>$likenum</p>
                                                  <p class='LikeParagraph' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
                                                  <p class='UnLikeParagraph' style='display: none;' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
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
                                    if (mysqli_num_rows($result4) > 0){
                                        echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' style='display: none;' alt=''>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' alt=''>
                                              ";
                                              if ($likenum == 1){
                                                  echo "<p class='LikeCount'>$likenum</p>
                                                        <p class='LikeParagraph' style='display: none;' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>like</p>
                                                        <p class='UnLikeParagraph' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>like</p>
                                              ";
                                              }else{
                                                  echo "
                                                        <p class='LikeCount'>$likenum</p>
                                                        <p class='LikeParagraph' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
                                                        <p class='UnLikeParagraph' style='display: none;' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
                                              ";
                                              }
                                    }else{
                                        echo "<img class='likeHollow' src='Design/Image/home-images/images/like1.svg' alt=''>
                                              <img class='likeFilled' src='Design/Image/home-images/images/LikeFilled.svg' style='display: none;' alt=''>
                                              <p class='LikeCount'>$likenum</p>
                                              <p class='LikeParagraph' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
                                              <p class='UnLikeParagraph' style='display: none;' post_id='".$row["post_id"]."' std_id='".$_SESSION["std_id"]."'>likes</p>
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
      <div class="right-sidebar">
        <div class="imp-link">
          <a href="#">
          <img class="savedPosts-Light" src="Design/Image/home-images/images/saved-posts.svg" alt="" />
          <img class="savedPosts-Dark" src="Design/Image/home-images/images/saved-posts2.svg" alt="" />
          <span> Saved posts</span>
          </a>
          <a href="#">
          <img class="marketIcon-Light" src="Design/Image/home-images/images/market-Icon.svg" alt=""/>
          <img class="marketIcon-Dark" src="Design/Image/home-images/images/market-Icon2.svg" alt=""/>
          <span>Market</span>
          </a>
          <a href="#">
          <img class="housingIcon-Light" src="Design/Image/home-images/images/housing-icon.svg" alt=""/>
          <img class="housingIcon-Dark" src="Design/Image/home-images/images/housing-icon2.svg" alt=""/>
          <span>Housing</span></a>
          <a href="http://elearning.ahu.edu.jo/login/index.php">
          <img class="elearningIcon-Light" src="Design/Image/home-images/images/elearning-icon.svg" alt=""/>
          <img class="elearningIcon-Dark" src="Design/Image/home-images/images/elearning-icon2.svg" alt=""/>
          <span>E-Learning</span>
          </a>
          <a href="http://sis.ahu.edu.jo/">
          <img class="infoIcon-Light" src="Design/Image/home-images/images/Info-Icon.svg" alt=""/>
          <img class="infoIcon-Dark" src="Design/Image/home-images/images/Info-Icon2.svg" alt=""/>
          <span>Student information system</span>
          </a>
          <a href="http://reg.ahu.edu.jo/">
          <img class="regIcon-Light" src="Design/Image/home-images/images/RegIcon.svg" alt=""/>
          <img class="regIcon-Dark" src="Design/Image/home-images/images/RegIcon2.svg" alt=""/>
          <span>Student registration system</span>
          </a>
          <a href="#">
          <img class="otherLinksIcon-Light" src="Design/Image/home-images/images/otherLinks-icon.svg"alt=""/>
          <img class="otherLinksIcon-Dark" src="Design/Image/home-images/images/otherLinks-icon2.svg"alt=""/>
          <span class="other-link">Other links</span>
          <img class="dropDownIcon-Light" src="Design/Image/home-images/images/dropDown-icon.svg" alt="">
          <img class="dropDownIcon-Dark" src="Design/Image/home-images/images/dropDown-icon2.svg" alt="">
          </a>
        </div>
      </div>
    </div>
    <div class="modal">
      <span class="close">&times;</span>
      <img class="modal-content slide-in-elliptic-top-fwd" id="img01">
    </div>
    <div id="particles-js"></div>
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
