<title>الجدول الدراسي</title>
<?php
session_start();
$_SESSION["page"]=10;
if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"]))
{
    header('location: login.php');
}
?>
<?php 
include_once("connection.php");
include 'header.php';
$st = $con->prepare("
SELECT
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
teachers,
std_crs_sem
WHERE
courses.Crs_Mjr_No=majors.ID
AND
courses.ID=subjects.crs_id
AND
teachers.id=subjects.crs_teach
AND
subjects.days=sub_days.id
and
std_crs_sem.sub_id=subjects.id
and 
std_crs_sem.std_id=?
ORDER BY
subjects.crs_id;
");
$st2 = $con->prepare("
SELECT
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
teachers,
std_crs_temp
WHERE
courses.Crs_Mjr_No=majors.ID
AND
courses.ID=subjects.crs_id
AND
teachers.id=subjects.crs_teach
AND
subjects.days=sub_days.id
and
std_crs_temp.sub_id=subjects.id
and 
std_crs_temp.std_id=?
ORDER BY
subjects.crs_id;
");
$st->bind_param("i",$_SESSION["userid"]);
$st2->bind_param("i",$_SESSION["userid"]);
$st->execute();
$rs = $st->get_result();
$num = $rs->num_rows;
$st2->execute();
$rs2 = $st2->get_result();
$num2 = $rs2->num_rows;
if($num2!=0)
{
    $rs = $rs2;
    $num = $num2;
}

?>
<div class="container log-container">
    <div class="row" style="width: 80%;">
        <div  id="table-scroll" class="table-scroll" >
            <table id="main-table" class="main-table">
                <thead style="position: sticky; top:0; color: var(--alt-2-color); background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);">
                    <tr>
                        <th>الايام</th>
                        <th>الى</th>
                        <th>من</th>
                        <th>رقم الشعبة</th>
                        <th>مدرس المادة</th>
                        <th>عدد الساعات</th>
                        <th>اسم المادة</th>
                        <th>رقم المادة</th>
                    </tr>
                </thead>
                <tbody id="tbody" style="
                <?php
                    if($num == 0)
                    {
                        echo 'height:268px;';
                    }
                ?>background-color: #F5FFFA; color: var(--alt-color)">
                    <?php
                        if($num > 0)
                        {
                            while($row = $rs->fetch_assoc())
                            {
                                echo'<tr>';
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
                            echo '<td colspan="8" style="vertical-align: middle;">لا يوجد مواد مسجلة بعد</td>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php'?>