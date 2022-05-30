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

         <div class="hideLeft">
            <img src="https://i1.sndcdn.com/artworks-000165384395-rhrjdn-t500x500.jpg">
         </div>

         <div class="prevLeftSecond">
            <img src="https://i1.sndcdn.com/artworks-000185743981-tuesoj-t500x500.jpg">
         </div>

         <div class="prev">
            <img src="https://i1.sndcdn.com/artworks-000158708482-k160g1-t500x500.jpg">
         </div>

         <div class="selected">
            <img src="https://i1.sndcdn.com/artworks-000062423439-lf7ll2-t500x500.jpg">
         </div>

         <div class="next">
            <img src="https://i1.sndcdn.com/artworks-000028787381-1vad7y-t500x500.jpg">
         </div>

         <div class="nextRightSecond">
            <img src="https://i1.sndcdn.com/artworks-000108468163-dp0b6y-t500x500.jpg">
         </div>

         <div class="hideRight">
            <img src="https://i1.sndcdn.com/artworks-000064920701-xrez5z-t500x500.jpg">
         </div>

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
