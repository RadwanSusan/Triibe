<?php
include_once("connection.php");
if(isset($_GET["email"]))
{
    $code = rand(999999,111111);
    $st = $con->prepare("update students set otp=? where email=?");
    $st->bind_param("is", $code,$_GET["email"]);
    $st->execute();
    $st = $con->prepare("select id from students where email = ?");
    $st->bind_param("s", $_GET["email"]);
    $st->execute();
    $rs = $st->get_result();
    $num = $rs->num_rows;
    if($num == 1)
    {
        $row = $rs->fetch_assoc();
        $path = 'location: otp.php?id='.$row["id"];
        header($path);
    }
}
else 
{
    header('location: new_password.php');
}