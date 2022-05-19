<?php
include_once("connection.php");
$st = $con->prepare("
SELECT 
concat(majors.Coll_Major_No,majors.Major_No,courses.Crs_Level,courses.Course_No) crs_no,
courses.Course_Name crs_name,
std_crs.degree degree,
courses.crs_hours hr,
semesters.sem_year year,
semesters.sem_no sem_no,
std_crs.status status
FROM
courses,
majors,
semesters,
std_crs
WHERE
courses.Crs_Mjr_No=majors.ID
AND
courses.id=std_crs.crs_id
AND
semesters.id=std_crs.sem_id
AND
std_crs.std_id=?
AND
concat(majors.Coll_Major_No,majors.Major_No,courses.Crs_Level,courses.Course_No) like '".$_GET["crsno"]."%'
AND
courses.Course_Name like '%".$_GET["crsname"]."%'
AND
(
std_crs.degree like '".$_GET["degree"]."%'
OR
CASE 
    WHEN std_crs.degree<50 THEN 'راسب'
    ELSE 'ناجح'
END LIKE'".$_GET["degree"]."%' 
)
AND
concat(semesters.sem_year,' / ' ,semesters.sem_year + 1) like '".$_GET["year"]."%'
AND
CASE
    WHEN semesters.sem_no = 1 THEN 'الفصل الاول'
    WHEN semesters.sem_no = 2 THEN 'الفصل الثاني'
    WHEN semesters.sem_no = 3 THEN 'الفصل الصيفي'
    ELSE 'لا يوجد'
END LIKE '%".$_GET["semester"]."%'   
ORDER BY
std_crs.sem_id;
");
$st->bind_param("i",$_GET["userid"]);
$st->execute();
$rs = $st->get_result();
$num = $rs->num_rows;
if($num > 0)
{
    while($row = $rs->fetch_assoc())
    {
        echo'<tr>';
        echo '<td style="vertical-align: middle;">';
        if($row["status"] == 0)
        {
            echo 'ملغاة';
        }
        else
        {
            if($row["hr"] == 3)
            {
                if($row["degree"] >= 35 && $row["degree"] < 50)
                {
                    echo '<i class="fas fa-window-close text-danger" style="font-size: 24px"></i>';
                }
                else if($row["degree"] >= 50 && $row["degree"] < 68)
                {
                    echo '<i class="fas fa-exclamation-triangle text-warning" style="font-size: 24px"></i>';
                }
                else if($row["degree"] >= 68)
                {
                    echo '<i class="fas fa-check-circle text-success" style="font-size: 24px"></i>';
                }
            }
            else
            {
                if($row["degree"] >= 35 && $row["degree"] < 50)
                {
                    echo '<i class="fas fa-window-close text-danger" style="font-size: 24px"></i>';
                }
                else if($row["degree"] >= 50)
                {
                    echo '<i class="fas fa-check-circle text-success" style="font-size: 24px"></i>';
                }
            }
        }
        echo'</td>';
        echo '<td style="vertical-align: middle;">';
        if($row["sem_no"]==1)
        {
            echo 'الفصل الاول';
        }
        else if($row["sem_no"]==2)
        {
            echo 'الفصل الثاني';
        }
        else if($row["sem_no"]==3)
        {
            echo 'الفصل الصيفي';
        }
        $year= $row["year"].' / '.$row["year"]+1;
        echo '</td>';
        echo '<td style="vertical-align: middle;">'.$year.'</td>';
        echo '<td style="vertical-align: middle;">';
        if($row["hr"] == 0)
        {
            if($row["degree"]<50)
            {
                echo 'راسب';
            }
            else
            {
                echo 'ناجح';
            }
        }
        else
        {
            echo $row["degree"];
        }
        echo '</td>';
        echo '<td style="vertical-align: middle;">'.$row["crs_name"].'</td>';
        echo '<td style="vertical-align: middle;">'.$row["crs_no"].'</td>';
        echo '</tr>';
    }
}
else
{
    echo'<tr>';
    echo '<td style="height: 228px; vertical-align: middle;" colspan="6">لا يوجد نتائج</td>';
    echo '</tr>';
}
?>