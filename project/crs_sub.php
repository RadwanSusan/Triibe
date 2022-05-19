<title>جريدة المواد</title>
<?php
session_start();
$_SESSION["page"]=12;
if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"]))
{
    header('location: login.php');
}
?>
<?php 
include_once("connection.php");
include 'header.php';
$st = $con->prepare("
SELECT DISTINCT
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
ORDER BY
subjects.crs_id;
");
$st->execute();
$rs = $st->get_result();
$num = $rs->num_rows;
?>
<div class="container log-container">
    <div class="row" style="width: 100%;">
        <div  id="table-scroll" class="table-scroll" >
            <table id="main-table" class="main-table"  style="direction: ltr; width:100%">
                <thead style="position: sticky; top:0; color: var(--alt-2-color); background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);">
                    <tr>
                        <td><input type="text" placeholder="بحث حسب الايام" id="days" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="h2" placeholder="بحث حسب الساعة" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="h1" placeholder="بحث حسب الساعة" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="c_num" placeholder="بحث حسب الشعبة" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="t_name" placeholder="بحث حسب اسم المدرس" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="h3" placeholder="بحث حسب عدد الساعات" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="crs_name" placeholder="بحث حسب اسم المادة" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="crs_no" placeholder="بحث حسب رقم المادة" class="form-control" style="text-align: center;"></td>
                    </tr>
                    <script>
                        $(document).ready(function(){
                            $(document).on("keyup","input", function(){
                                $.get("getSubject.php?crsno=" + 
                                        $("#crs_no").val()+
                                        "&crsname="+
                                        $("#crs_name").val()+
                                        "&t_name="+
                                        $("#t_name").val()+
                                        "&c_num="+
                                        $("#c_num").val()+
                                        "&h1="+
                                        $("#h1").val()+
                                        "&h2="+
                                        $("#h2").val()+
                                        "&days="+
                                        $("#days").val()
                                        +"&h3="+
                                        $("#h3").val(),function(data,status){
                                    $("#tbody").html(data);
                                });
                            });
                        });
                    </script>
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
                <tbody id="tbody" style="background-color: #F5FFFA; color: var(--alt-color)">
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
                            echo'<tr>';
                            echo '<td style="height: 208px; vertical-align: middle;" colspan="8">لا يوجد نتائج</td>';
                            echo '</tr>';
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