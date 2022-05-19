<?php
include_once("connection.php");
$state1 = $con->prepare("select max(id) max_sem,sem_no from semesters");
$state1->execute();
$rs = $state1->get_result();
$row = $rs->fetch_assoc();
$state2 = $con->prepare("insert into std_crs_temp(std_id,sub_id,sem_id) values (?,?,?)");
$state2->bind_param("iii",$_GET["userid"],$_GET["subid"],$row["max_sem"]);
$state3 = $con->prepare("update subjects set class_cap=class_cap-1 where id=?");
$state3->bind_param("i",$_GET["subid"]);
$st1 = $con->prepare("select sub_id from std_crs_temp where std_id=?");
$st1->bind_param("i",$_GET["userid"]);
$st1->execute();
$rs1 = $st1->get_result();
$num1 = $rs1->num_rows;
$st2 = $con->prepare("select days,round(from_hour) from_hour from subjects where id=? and class_cap!=0");
$st2->bind_param("i",$_GET["subid"]);
$st2->execute();
$rs2 = $st2->get_result();
$num2 = $rs2->num_rows;
$row2 = $rs2->fetch_assoc();
if($num2 == 0)
{
    echo "الشعبة مغلقة";
}
else
{
    if($num1 == 0)
    {
        $state2->execute();
        $state3->execute();
    }
    else
    {
        $flag = 0;
        while($row1 = $rs1->fetch_assoc())
        {
            $st2->bind_param("i",$row1["sub_id"]);
            $st2->execute();    
            $rs2 = $st2->get_result();
            $row3 = $rs2->fetch_assoc();
            if(($row3["days"] == $row2["days"] ||$row3["days"] == 2 || $row3["days"] == 3) && $row3["from_hour"] == $row2["from_hour"])
            {
                $flag = 1;
            }
        }
        if($flag == 0)
        {
            $st3 = $con->prepare("select courses.crs_hours crs_hours from courses where id in (select crs_id from subjects where id in(select sub_id from std_crs_temp where std_id=?))");
            $st3->bind_param("i",$_GET["userid"]);
            $st3->execute();
            $rs3 = $st3->get_result();
            $count = 0;
            while($row3 = $rs3->fetch_assoc())
            {
                $count += $row3["crs_hours"];
            }
            $st3 = $con->prepare("select crs_hours from courses where id = (select crs_id from subjects where id=?)");
            $st3->bind_param("i",$_GET["subid"]);
            $st3->execute();
            $rs3 = $st3->get_result();
            $row3 = $rs3->fetch_assoc();
            $hours = $row3["crs_hours"];
            if($row["sem_no"] == 1 || $row["sem_no"] == 2)
            {
                if($hours == 0)
                {
                    $state2->execute();
                    $state3->execute();
                }
                else if($count < 18)
                {
                    $state2->execute();
                    $state3->execute();
                }
                else 
                {
                    echo 'لا يمكن اضافة مادة بسبب تجاوز عدد الساعات المسموح';
                }
            }
            else if($row["sem_no"] == 3)
            {
                if($hours == 0)
                {
                    $state2->execute();
                    $state3->execute();
                }
                else if($count < 9) 
                {
                    $state2->execute();
                    $state3->execute();
                }
                else 
                {
                    echo 'لا يمكن اضافة مادة بسبب تجاوز عدد الساعات المسموح';
                }
            }
            
        }
        else
        {
            echo "يوجد تعارض";
        }
    }
}