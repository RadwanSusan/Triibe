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

<body>
   <div id="box">
      <form id="myform-search" method="post" autocomplete="off">
         <h1>Change Password <span>choose a good one!</span></h1>
         <form>
            <p>
               <input type="password" value="" placeholder="Enter Password" id="p" class="password">
               <button class="unmask" type="button"></button>
            </p>
            <p>
               <input type="password" value="" placeholder="Confirm Password" id="p-c" class="password">
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
