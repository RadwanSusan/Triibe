<?php
include_once("connection.php");
$state1 = $con->prepare("select sub_id from std_crs_temp where std_id=?");
$state1->bind_param("i",$_GET["userid"]);
$state1->execute();
$rs1 = $state1->get_result();
while($row = $rs1->fetch_assoc())
{
    $state3 = $con->prepare("update subjects set class_cap=class_cap+1 where id=?");
    $state3->bind_param("i",$row["sub_id"]);
    $state3->execute();
}
$state1 = $con->prepare("delete from std_crs_temp where std_id=?");
$state1->bind_param("i",$_GET["userid"]);
$state1->execute();
$state1 = $con->prepare("select max(id) max_sem,sem_no from semesters");
$state1->execute();
$rs = $state1->get_result();
$row = $rs->fetch_assoc();
$st1 = $con->prepare("
SELECT 
c.id crs_id,
concat(ma.Coll_Major_No,ma.Major_No,c.Crs_Level,c.Course_No) crs_no, 
c.Course_Name c_name, 
crs_type.Type ty, 
c.crs_hours h1, 
nvl(p.id,0) p_id
FROM 
courses c LEFT JOIN courses p ON(p.ID=c.Pre_ID) INNER JOIN majors ma ON(ma.ID=c.Crs_Mjr_No), 
majors m, 
std_plan, 
crs_type 
WHERE 
std_plan.course_id=c.ID 
AND 
std_plan.crs_type=crs_type.ID 
AND 
std_plan.major_id=m.ID 
AND 
((SELECT substring(students.Std_No,2,4)from students where students.id=?) BETWEEN c.First_Year AND c.Last_Year) 
AND 
m.major_no=(SELECT substring(students.Std_No,8,2)from students where students.id=?)
AND 
c.ID not in (
SELECT 
std_crs.crs_id
FROM
std_crs
WHERE
std_crs.std_id=?
AND
std_crs.degree >= 68
)
and
c.ID not in (
SELECT 
std_crs.crs_id
FROM
std_crs,courses
WHERE
std_crs.std_id=?
AND
std_crs.degree BETWEEN 50 and 68
AND
std_crs.crs_id=courses.id
AND
courses.Crs_Hours = 0
AND
std_crs.status  = 1
)
AND
(
c.Pre_ID in (
SELECT 
std_crs.crs_id
FROM
std_crs
WHERE
std_crs.std_id=?
)
or
c.Pre_ID is null
)
AND
(
c.Pre_ID not in (
SELECT 
std_crs.crs_id
FROM
std_crs,courses
WHERE
std_crs.std_id=?
AND
std_crs.degree < 50
AND
std_crs.crs_id=courses.id
AND
courses.Crs_Hours = 0
AND
std_crs.status  = 1
)
or
c.Pre_ID is null
)
AND
(
c.Pre_ID not in (select subjects.crs_id from subjects,std_crs_sem WHERE subjects.id=std_crs_sem.sub_id and std_id=?)
OR
c.Pre_ID in (select subjects.crs_id from subjects,std_crs_sem WHERE subjects.id=std_crs_sem.sub_id and std_id=?)
or
c.Pre_ID is null
)
AND
c.ID not IN (select subjects.crs_id from subjects,std_crs_sem WHERE subjects.id=std_crs_sem.sub_id and std_crs_sem.std_id=? and std_crs_sem.degree> 68)
AND 
c.ID not IN (select subjects.crs_id from subjects,std_crs_temp WHERE subjects.id=std_crs_temp.sub_id and std_crs_temp.std_id=?)
order by std_plan.crs_type ,c.id
");
$st1->bind_param("iiiiiiiiii",$_GET["userid"],$_GET["userid"],$_GET["userid"],$_GET["userid"],$_GET["userid"],$_GET["userid"],$_GET["userid"],$_GET["userid"],$_GET["userid"],$_GET["userid"]);
$st1->execute();
$rs1 = $st1->get_result();
$num1 = $rs1->num_rows;
$st9 = $con->prepare("select std_ori_hr,std_ori_day from students where id=?");
$st9->bind_param("i",$_GET["userid"]);
$st9->execute();
$rs9 = $st9->get_result();
$row9 = $rs9->fetch_assoc();
$day1 = 0;
$day2 = 0;
$day3 = 0;
$hour = 12;
$choose = 0;
if($row9["std_ori_hr"]==1)
{
    $choose = 1;
    if($row9["std_ori_day"]==1)
    {
        $day1 = 1;
    }
    else if($row9["std_ori_day"]==2)
    {
        $day2 = 2; 
    }
    else if($row9["std_ori_day"]==3)
    {
        $day3 = 3;
    }
    else if($row9["std_ori_day"]==4)
    {
        $day1 = 1;
        $day2 = 2;
        $day3 = 3;
    }
}
else if($row9["std_ori_hr"]==2)
{
    $choose = 2;
    if($row9["std_ori_day"]==1)
    {
        $day1 = 1;
    }
    else if($row9["std_ori_day"]==2)
    {
        $day2 = 2; 
    }
    else if($row9["std_ori_day"]==3)
    {
        $day3 = 3;
    }
    else if($row9["std_ori_day"]==4)
    {
        $day1 = 1;
        $day2 = 2;
        $day3 = 3;
    }
}
else if($row9["std_ori_hr"]==3)
{
    $choose = 3;
    if($row9["std_ori_day"]==1)
    {
        $day1 = 1;
    }
    else if($row9["std_ori_day"]==2)
    {
        $day2 = 2; 
    }
    else if($row9["std_ori_day"]==3)
    {
        $day3 = 3;
    }
    else if($row9["std_ori_day"]==4)
    {
        $day1 = 1;
        $day2 = 2;
        $day3 = 3;
    }
}
$str = "";
if($day1 != 0)
    $str = "and subjects.days in( ".$day1.")";
if($day2 != 0)
    $str = "and subjects.days in( ".$day2.")";
if($day3 != 0)
    $str = "and subjects.days in( ".$day3.")";
if($day1 != 0 && $day2 != 0 && $day3 != 0)
{
    $str = "and subjects.days in( ".$day1.",".$day2.",".$day3.")";
}
switch($choose)
{
    case 1:{
        $str=$str." and subjects.from_hour<=12";
    }break;
    case 2:{
        $str=$str." and subjects.from_hour>=12";
    }break;
}
$st2 = $con->prepare("
SELECT DISTINCT
concat(majors.Coll_Major_No,majors.Major_No,courses.Crs_Level,courses.Course_No) crs_no,
subjects.id sub_id,
courses.Course_Name crs_name,
subjects.class_num c_num,
teachers.t_name t_name,
subjects.from_hour h1,
subjects.to_hour h2,
courses.crs_hours h3,
sub_days.days days
FROM
courses,
majors,
subjects,
sub_days,
teachers
WHERE
courses.Crs_Mjr_No=majors.ID
AND
courses.ID=subjects.crs_id
AND
teachers.id=subjects.crs_teach
AND
subjects.days=sub_days.id
".$str."
AND 
round(subjects.from_hour)+ case 
                when subjects.days = 2 then 2 
                when subjects.days = 3 then 2
                else  subjects.days
                end
<>ALL (select round(subjects.from_hour)+case 
when subjects.days = 2 then 2 
when subjects.days = 3 then 2
else  subjects.days
end from subjects where id in(select sub_id from std_crs_temp where std_id=?))
and
subjects.crs_id not in (select subjects.crs_id from subjects where id in(select sub_id from std_crs_temp where std_id=?))
and 
subjects.class_cap!=0
ORDER BY
subjects.crs_id;
");   
$st2->bind_param("ii",$_GET["userid"],$_GET["userid"]); 
$arr = array();
$i = 0;    
while($_GET["n1"]!=0)
{
    if($num1 > 0)
    {
        $st1->execute();
        $rs1 = $st1->get_result();
        while($row1 = $rs1->fetch_assoc())
        {
            $st2->execute();
            $rs2 = $st2->get_result();
            $num2 = $rs2->num_rows;
            if($num2 > 0)
            {
                while($row2 = $rs2->fetch_assoc())
                {
                    if($row2["crs_no"]==$row1["crs_no"] && $row1["ty"] == "جامعة اجباري")
                    {
                        $arr[$i]=$row2["sub_id"];
                        $i++; 
                    }
                }
            }
        } 
    } 
    if($i!=0)
    $rand = rand(0,$i-1);
    else
    $rand = rand(0,$i);
    $sub_id = (int)$arr[$rand];
    $st6 = $con->prepare("insert into std_crs_temp (std_id,sub_id,sem_id) values (?,?,?)");
    $st6->bind_param("iii",$_GET["userid"],$sub_id,$row["max_sem"]);
    $st6->execute();
    $state3 = $con->prepare("update subjects set class_cap=class_cap-1 where id=?");
    $state3->bind_param("i",$sub_id);
    $state3->execute();
    $i = 0;
    $arr=array();
    $_GET["n1"] = $_GET["n1"] - 3;
}
$i = 0;    
while($_GET["n2"]!=0)
{ 
    if($num1 > 0)
    {
        $st1->execute();
        $rs1 = $st1->get_result();
        while($row1 = $rs1->fetch_assoc())
        {
            $st2->execute();
            $rs2 = $st2->get_result();
            $num2 = $rs2->num_rows;
            if($num2 > 0)
            {
                while($row2 = $rs2->fetch_assoc())
                {
                    if($row2["crs_no"]==$row1["crs_no"] && $row1["ty"] == "جامعة اختياري")
                    {
                        $arr[$i]=$row2["sub_id"];
                        $i++; 
                    }
                }
            }
        } 
    } 
    if($i!=0)
    $rand = rand(0,$i-1);
    else
    $rand = rand(0,$i);
    $sub_id = (int)$arr[$rand];
    $st6 = $con->prepare("insert into std_crs_temp (std_id,sub_id,sem_id) values (?,?,?)");
    $st6->bind_param("iii",$_GET["userid"],$sub_id,$row["max_sem"]);
    $st6->execute();
    $state3 = $con->prepare("update subjects set class_cap=class_cap-1 where id=?");
    $state3->bind_param("i",$sub_id);
    $state3->execute();
    $i = 0;
    $arr=array();
    $_GET["n2"] = $_GET["n2"] - 3;
}
$arr = array();
$i = 0;
while($_GET["n3"]!=0)
{
    
    if($num1 > 0)
    {
        $st1->execute();
        $rs1 = $st1->get_result();
        while($row1 = $rs1->fetch_assoc())
        {
            $st2->execute();
            $rs2 = $st2->get_result();
            $num2 = $rs2->num_rows;
            if($num2 > 0)
            {
                while($row2 = $rs2->fetch_assoc())
                {
                    if($row2["crs_no"]==$row1["crs_no"] && $row1["ty"] == "كلية اجباري")
                    {
                        $arr[$i]=$row2["sub_id"];
                        $i++; 
                    }
                }
            }
        } 
    } 
    if($i!=0)
    $rand = rand(0,$i-1);
    else
    $rand = rand(0,$i);
    $sub_id = (int)$arr[$rand];
    $st6 = $con->prepare("insert into std_crs_temp (std_id,sub_id,sem_id) values (?,?,?)");
    $st6->bind_param("iii",$_GET["userid"],$sub_id,$row["max_sem"]);
    $st6->execute();
    $state3 = $con->prepare("update subjects set class_cap=class_cap-1 where id=?");
    $state3->bind_param("i",$sub_id);
    $state3->execute();
    $i = 0;
    $arr=array();
    $_GET["n3"] = $_GET["n3"] - 3;
}
$arr = array();
$i = 0;
while($_GET["n4"]!=0)
{
    if($num1 > 0)
    {
        $st1->execute();
        $rs1 = $st1->get_result();
        while($row1 = $rs1->fetch_assoc())
        {
            $st2->execute();
            $rs2 = $st2->get_result();
            $num2 = $rs2->num_rows;
            if($num2 > 0)
            {
                while($row2 = $rs2->fetch_assoc())
                {
                    if($row2["crs_no"]==$row1["crs_no"] && $row1["ty"] == "تخصص اجباري")
                    {
                        $arr[$i]=$row2["sub_id"];
                        $i++; 
                    }
                }
            }
        } 
    } 
    if($i!=0)
    $rand = rand(0,$i-1);
    else
    $rand = rand(0,$i);
    $sub_id = (int)$arr[$rand];
    $st6 = $con->prepare("insert into std_crs_temp (std_id,sub_id,sem_id) values (?,?,?)");
    $st6->bind_param("iii",$_GET["userid"],$sub_id,$row["max_sem"]);
    $st6->execute();
    $state3 = $con->prepare("update subjects set class_cap=class_cap-1 where id=?");
    $state3->bind_param("i",$sub_id);
    $state3->execute();
    $i = 0;
    $arr=array();
    $_GET["n4"] = $_GET["n4"] - 3;
} 
$arr = array();
$i = 0;
while($_GET["n5"]!=0)
{
    if($num1 > 0)
    {
        $st1->execute();
        $rs1 = $st1->get_result();
        while($row1 = $rs1->fetch_assoc())
        {
            $st2->execute();
            $rs2 = $st2->get_result();
            $num2 = $rs2->num_rows;
            if($num2 > 0)
            {
                while($row2 = $rs2->fetch_assoc())
                {
                    if($row2["crs_no"]==$row1["crs_no"] && $row1["ty"] == "تخصص اختياري")
                    {
                        $arr[$i]=$row2["sub_id"];
                        $i++; 
                    }
                }
            }
        } 
    } 
    if($i!=0)
    $rand = rand(0,$i-1);
    else
    $rand = rand(0,$i);
    $sub_id = (int)$arr[$rand];
    $st6 = $con->prepare("insert into std_crs_temp (std_id,sub_id,sem_id) values (?,?,?)");
    $st6->bind_param("iii",$_GET["userid"],$sub_id,$row["max_sem"]);
    $st6->execute();
    $state3 = $con->prepare("update subjects set class_cap=class_cap-1 where id=?");
    $state3->bind_param("i",$sub_id);
    $state3->execute();
    $i = 0;
    $arr=array();
    $_GET["n5"] = $_GET["n5"] - 3;
}
