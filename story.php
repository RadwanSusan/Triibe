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
   <title>Triibe Story</title>
   <link rel="stylesheet" href="bootstrap-css/bootstrap.min.css" />
   <link rel="stylesheet" href="bootstrap-css/all.min.css" />
   <link rel="stylesheet" href="bootstrap-css/story-light.css">
</head>

<body>

   <main>

      <div id="carousel">
         <?php
         $sql1 = "SELECT * FROM story WHERE author = '" . $_GET["author_id"] . "'";
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
                     if (mysqli_num_rows($result2) == 1) {
                        if (isset($row2["video_name"])) {
                           echo "<div class='selected'>
                           <video width='600px' controls class='video-js vjs-theme-forest vjs-fluid' data-setup='{}'>
                           <source src='" . $row1["video_name"] . "' type='video/mp4'>
                         </video>
                     </div>";
                        }
                     } else if (isset($row1["img_name"])) {
                        echo "<div class='selected'>
                    <img src='" . $row1["img_name"] . "'>
                 </div>";
                     } else {
                        echo "<div class='next'>
                   <video width='600px' controls class='video-js vjs-theme-forest vjs-fluid' data-setup='{}'>
                     <source src='" . $row1["video_name"] . "' type='video/mp4'>
                   </video>
                </div>";
                     }
                  }
               }
            }
         }
         ?>

      </div>

      <div class="buttons">
         <button id="prev">Prev</button>
         <button id="next">Next</button>
      </div>

   </main>
   <script src="bootstrap-js/bootstrap.bundle.min.js"></script>
   <script src="bootstrap-js/all.min.js"></script>
   <script src="node_modules/jquery/dist/jquery.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   <script src="bootstrap-js/story.js"></script>
</body>

</html>