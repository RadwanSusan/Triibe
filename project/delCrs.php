<?php
include_once("connection.php");
$state2 = $con->prepare("delete from std_crs_temp where std_id=? and sub_id=?");
$state2->bind_param("ii",$_GET["userid"],$_GET["subid"]);
$state2->execute();
$state3 = $con->prepare("update subjects set class_cap=class_cap+1 where id=?");
$state3->bind_param("i",$_GET["subid"]);
$state3->execute();