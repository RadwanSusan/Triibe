<?php
include_once("connection.php");
$st = $con->prepare("
SELECT
subjects.id sub_id,
concat(majors.Coll_Major_No,majors.Major_No,courses.Crs_Level,courses.Course_No) crs_no,
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
AND 
subjects.id in (select sub_id from std_crs_temp where std_id=?)
ORDER BY
subjects.crs_id;");
$st->bind_param("i",$_GET["userid"]);
$st->execute();
$rs = $st->get_result();
$num = $rs->num_rows; 
if($num > 0)
{
    while($row = $rs->fetch_assoc())
    {
        echo'<tr id='.$row["sub_id"].'>';
        echo '<td style="vertical-align: middle;">'.$row["days"].'</td>';
        echo '<td style="vertical-align: middle;">'.$row["h2"].'</td>';
        echo '<td style="vertical-align: middle;">'.$row["h1"].'</td>';
        echo '<td style="vertical-align: middle;">'.$row["c_num"].'</td>';
        echo '<td style="vertical-align: middle;">'.$row["t_name"].'</td>';
        echo '<td style="vertical-align: middle;">'.$row["h3"].'</td>';
        echo '<td style="vertical-align: middle;">'.$row["crs_name"].'</td>';
        echo '<td style="vertical-align: middle;">'.$row["crs_no"].'</td>';
        echo '</tr>';
    }
}
else
{
    echo'<tr>';
    echo '<td style="height: 208px; vertical-align: middle;" colspan="8">لا يوجد نتائج</td>';
    echo '</tr>';
}