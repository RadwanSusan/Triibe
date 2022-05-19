<?php
include_once("connection.php");
$st = $con->prepare("
SELECT 
concat(ma.Coll_Major_No,ma.Major_No,c.Crs_Level,c.Course_No) crs_no, 
c.Course_Name c_name, 
crs_type.Type ty, 
c.crs_hours h1, 
p.Course_Name p_name 
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
concat(ma.Coll_Major_No,ma.Major_No,c.Crs_Level,c.Course_No) like '".$_GET["crsno"]."%'
AND
c.crs_hours like '".$_GET["hour"]."%'
AND
nvl(p.Course_Name,'لا يوجد') like '%".$_GET["p_name"]."%'
AND
c.Course_Name like '%".$_GET["crsname"]."%'
order by c.id;
");
$st->bind_param("ii",$_GET["userid"],$_GET["userid"]); 
$st->execute();
$rs = $st->get_result();
$num = $rs->num_rows;
$st1 = $con->prepare("
SELECT 
uni_man_hr,
uni_op_hr,
col_man_hr,
spc_man_hr,
spc_op_hr
FROM 
majors,majors_hour
WHERE 
majors.id=majors_hour.mjr_id and
((SELECT substring(students.Std_No,2,4)from students where students.id=?) 
BETWEEN from_Year AND to_Year)
AND majors.major_no=(SELECT substring(students.Std_No,8,2)from students where students.id=?)
");
$st1->bind_param("ii",$_GET["userid"],$_GET["userid"]);        
$st1->execute();
$rs1 = $st1->get_result();
$rows = $rs1->fetch_assoc();
if($num > 0)
{
    $f=1;
    $str1 =  '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
            '<td style="vertical-align: middle;" colspan="4">'.'نوع المتطلب : جامعة اجباري&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["uni_man_hr"].'</td>'.
            '</tr>';
    $len1 = strlen($str1);
    $str2 =  '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
            '<td style="vertical-align: middle;" colspan="4">'.'نوع المتطلب : جامعة اختياري&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["uni_op_hr"].'</td>'.
            '</tr>';
    $len2 = strlen($str2);
    $str3 =  '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
            '<td style="vertical-align: middle;" colspan="4">'.'نوع المتطلب : كلية اجباري&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["col_man_hr"].'</td>'.
            '</tr>';
    $len3 = strlen($str3);
    $str4 =  '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
            '<td style="vertical-align: middle;" colspan="4">'.'نوع المتطلب : تخصص اجباري&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["spc_man_hr"].'</td>'.
            '</tr>';
    $len4 = strlen($str4);
    $str5 =  '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
            '<td style="vertical-align: middle;" colspan="4">'.'نوع المتطلب : تخصص اختياري&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["spc_op_hr"].'</td>'.
            '</tr>';
    $len5 = strlen($str5);
    while($row = $rs->fetch_assoc())
    {
        if($row["ty"]=="جامعة اجباري")
        {
            if($row["p_name"]==null)
            {
                $p = "لا يوجد";
            }
            else
            {
                $p = $row["p_name"];
            }
            $str1=
            $str1.
            '<tr>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$p.'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["h1"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["c_name"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["crs_no"].'</td>'.
            '</tr>';
        }
        if($row["ty"]=="جامعة اختياري")
        {
            if($row["p_name"]==null)
            {
                $p = "لا يوجد";
            }
            else
            {
                $p = $row["p_name"];
            }
            $str2=
            $str2.
            '<tr>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$p.'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["h1"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["c_name"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["crs_no"].'</td>'.
            '</tr>';
        }
        if($row["ty"]=="كلية اجباري")
        {
            if($row["p_name"]==null)
            {
                $p = "لا يوجد";
            }
            else
            {
                $p = $row["p_name"];
            }
            $str3=
            $str3.
            '<tr>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$p.'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["h1"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["c_name"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["crs_no"].'</td>'.
            '</tr>';
        }
        if($row["ty"]=="تخصص اجباري")
        {
            if($row["p_name"]==null)
            {
                $p = "لا يوجد";
            }
            else
            {
                $p = $row["p_name"];
            }
            $str4=
            $str4.
            '<tr>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$p.'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["h1"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["c_name"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["crs_no"].'</td>'.
            '</tr>';
        }
        if($row["ty"]=="تخصص اختياري")
        {
            if($row["p_name"]==null)
            {
                $p = "لا يوجد";
            }
            else
            {
                $p = $row["p_name"];
            }
            $str5=
            $str5.
            '<tr>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$p.'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["h1"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["c_name"].'</td>'.
            '<td style="vertical-align: middle; background-color: var(--alt-2-color);">'.$row["crs_no"].'</td>'.
            '</tr>';
        }
    }
    if($len1 != strlen($str1))
    echo $str1;
    if($len2 != strlen($str2))
    echo $str2;
    if($len3 != strlen($str3))
    echo $str3;
    if($len4 != strlen($str4))
    echo $str4;
    if($len5 != strlen($str5))
    echo $str5;
}
else
{
    echo'<tr>';
    echo '<td style="  height: 228px;  vertical-align: middle; background-color: var(--alt-2-color);" colspan="4">لا يوجد نتائج</td>';
    echo '</tr>';
}
?>
