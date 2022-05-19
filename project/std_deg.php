<title>علامات الفصل</title>
<?php
session_start();
$_SESSION["page"]=11;
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
std_crs_sem.degree degree
FROM
courses,
majors,
subjects,
std_crs_sem
WHERE
courses.Crs_Mjr_No=majors.ID
AND
courses.ID=subjects.crs_id
and
std_crs_sem.sub_id=subjects.id
and
std_crs_sem.std_id=?
and
std_crs_sem.degree is not null
ORDER BY
subjects.crs_id;
");
$st->bind_param("i",$_SESSION["userid"]);
$st->execute();
$rs = $st->get_result();
$num = $rs->num_rows;
?>
<div class="container log-container">
    <div class="row" style="width: 80%;">
        <div  id="table-scroll" class="table-scroll" >
            <table id="main-table" class="main-table">
                <thead style="position: sticky; top:0; color: var(--alt-2-color);">
                    <tr style=" background-color: var(--alt-2-color); border: 1px solid var(--main-color);">
                        <th class="justify-content-end" style="border: 1px solid var(--main-color); color: black" colspan="5">
                            <i class="fas fa-check-circle text-success" style="font-size: 24px; direction: rtl;"><span style="font-size: 20px; color: black;">&nbsp;لا يمكن اعادة المادة/ناجح</span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 24px; direction: rtl;"><span style="font-size: 20px; color: black;">&nbsp;يمكن اعادة المادة/ناجح</span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-window-close text-danger" style="font-size: 24px; direction: rtl;"><span style="font-size: 20px; color: black;">&nbsp;يمكن اعادة المادة/راسب</span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                    </tr>
                    <tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);">
                        <th>حالة المادة</th>
                        <th>العلامة</th>
                        <th>رقم الشعبة</th>
                        <th>اسم المادة</th>
                        <th>رقم المادة</th>
                    </tr>
                </thead>
                <tbody id="tbody" style="background-color: var(--alt-2-color); <?php if($num == 0) echo 'height:228px;'; ?> color: var(--alt-color);">
                    <?php
                        if($num > 0)
                        {
                            while($row = $rs->fetch_assoc())
                            {
                                echo'<tr>';
                                if($row["degree"] == null)
                                {
                                    echo '<td style="vertical-align: middle;">';
                                    echo '</td>';
                                }
                                else if($row["degree"] >= 35 && $row["degree"] < 50)
                                {
                                    echo '<td style="vertical-align: middle;">';
                                    echo '<i class="fas fa-window-close text-danger" style="font-size: 24px"></i>';
                                    echo '</td>';
                                }
                                else if($row["degree"] >= 50 && $row["degree"] < 68)
                                {
                                    echo '<td style="vertical-align: middle;">';
                                    echo '<i class="fas fa-exclamation-triangle text-warning" style="font-size: 24px"></i>';
                                    echo '</td>';
                                }
                                else if($row["degree"] >= 68)
                                {
                                    echo '<td style="vertical-align: middle;">';
                                    echo '<i class="fas fa-check-circle text-success" style="font-size: 24px"></i>';
                                    echo '</td>';
                                }
                                
                                
                                echo '<td style="vertical-align: middle;">'.$row["degree"].'</td>';
                                echo '<td style="vertical-align: middle;">'.$row["c_num"].'</td>';
                                echo '<td style="vertical-align: middle;">'.$row["crs_name"].'</td>';
                                echo '<td style="vertical-align: middle;">'.$row["crs_no"].'</td>';
                                echo '</tr>';
                            }
                        }
                        else
                        {
                            echo '<td colspan="5" style="vertical-align: middle; border: 0.5px solid var(--main-color);">لا يوجد علامات</td>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php'?>