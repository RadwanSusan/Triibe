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
    <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">
    <link id="theme" rel="stylesheet" href="bootstrap-css/personal.css"/>
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
           $fileTmpName = $_FILES['file']['tmp_name'];
           $fileSize = $_FILES['file']['size'];
           $fileError = $_FILES['file']['error'];
           $fileExt = explode('.', $fileName);
           $fileActualExt = strtolower(end($fileExt));
           $ext = $fileActualExt;
           if($ext == "" || $ext == null){
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
               if($fileSize < 100000000){
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
        }else{
          echo "<script>alert('File type not supported');</script>";
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
          <img src="<?php echo $_SESSION["img_name"]?> "alt ="" >
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
           <img src="Design/Image/home-images/images/farme.svg" alt="">
           <div class="edit-cover-content">
             <div class=".Edit-cover">
            <img src="Design/Image/home-images/images/edit cover.svg" alt="">
            <p>Edit cover</p>
          </div>
          </div>
        </div>
        <!-- <img src="Design/Image/home-images/images/Linear_Layer.svg" alt=""> -->
      </div>
      <div class="bottom-content">
          <div class="bottom">
        <div class="left-bottom">
          <img src="<?php echo $_SESSION['img_name']?>" alt="">
          <div class="info">
          <div class="name-bottom"><p><?php echo  $_SESSION["std_fname"] . " " . $_SESSION["std_lname"]?></p></div>
          <div class="number-friends"><?php
          $sqlfriend = "SELECT * FROM friends WHERE user_id = '".$_SESSION["std_id"]."'";
          $resultfriend = mysqli_query($conn, $sqlfriend);
          $countfriend = mysqli_num_rows($resultfriend);
          echo $countfriend . " Friends";
          ?></div>
          </div>
        </div>
        <div class="right-bottom">
          <div class="add-friends">
            <img src="Design/Image/home-images/images/Group-add.svg" alt="">
            <p>Add Friends</p>
          </div>
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
            <div class="title-bio">
              <div class="name">Stickin' to the plan 🃏</div>
              <img src="Design/Image/home-images/images/bio-title.svg" alt="">
            </div>
            <div class="bio bio1">
              <img src="Design/Image/home-images/images/bio1.svg" alt="">
                <div class="name name2">Studies Software Engineering at Al-Hussein
Bin Talal University</div>
            </div>
            <div class="bio bio3">
              <img src="Design/Image/home-images/images/bio2.svg" alt="">
                <div class="name">Lives in <?php echo $_SESSION["loc"]; ?></div>
            </div>
            <div class="bio bio4">
              <img src="Design/Image/home-images/images/bio3.png" alt="">
                <div class="name">From <?php echo $_SESSION["loc"]; ?></div>
            </div>
            <div class="bio bio5">
              <img src="Design/Image/home-images/images/bio4.png" alt="">
                <div class="name">radwan_susan4</div>
            </div>
            <div class="bio bio2">
              <img src="Design/Image/home-images/images/bio5.png" alt="">
                <div class="name">Radwan Susan</div>
            </div>
          </div>
          <div class="left-post left-post-two">
            <div class="photo-see">

            <h1>Photo</h1>
            <div class="see-more">See more</div>
            </div>
            <div class="Photo">
              <img src="/Design/Image/home-images/images/p1.svg" alt="image">
              <img src="/Design/Image/home-images/images/p2.svg" alt="image">
              <img src="/Design/Image/home-images/images/p3.svg" alt="image">
              <img src="/Design/Image/home-images/images/p4.svg" alt="image">
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
                              echo "<div class='namePhoto'>
                              <img src='".$rowimg["img_name"]."' alt='image'>
                              <div class='names'>". $row1["std_fname"] . " " . $row1["std_lname"] ."</div>
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
             <img src="<?php echo $_SESSION["img_name"]; ?>" alt="zzzzzzz">
             <div class="write-post-input">
             <textarea class="write-post" rows="3" placeholder="What`s on your mind, <?php echo $_SESSION["std_fname"]; ?>"></textarea>
             </div>
          </div>
                   <?php
            $likenum = 0;
            $sql = "SELECT * FROM post where author = ".$_SESSION["std_id"]." order by created_date desc";
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
                                      <video width='800px' controls class='video-js vjs-theme-forest' data-setup='{}'>
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
