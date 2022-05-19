<title>كشف علامات المواد</title>
<?php
session_start();
$_SESSION["page"]=14;
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
ORDER BY
std_crs.sem_id;
");
$st->bind_param("i",$_SESSION["userid"]);
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
$st1->bind_param("ii",$_SESSION["userid"],$_SESSION["userid"]);        
$st1->execute();
$rs1 = $st1->get_result();
$st2 = $con->prepare("
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
AND std_plan.major_id=m.ID 
AND 
((SELECT substring(students.Std_No,2,4)from students where students.id=?) BETWEEN c.First_Year AND c.Last_Year) 
AND 
m.major_no=(SELECT substring(students.Std_No,8,2)from students where students.id=?)
order by c.id;
");
$st2->bind_param("ii",$_SESSION["userid"],$_SESSION["userid"]);
$count1 = 0;
$count2 = 0;
$count3 = 0;
$count4 = 0;
$count5 = 0;
$degree = 0;
if($num > 0)
{
    while($row = $rs->fetch_assoc())
    {
        $st2->execute();
        $rs2 = $st2->get_result();
        while($row2 = $rs2->fetch_assoc())
        {
            if($row["crs_no"] == $row2["crs_no"] && $row["status"] != 0 && $row["degree"] != NULL)
            {
                if($row2["ty"] =="جامعة اجباري")
                {
                    $count1  +=  $row2["h1"];
                }
                else  if($row2["ty"] == "جامعة اختياري")
                {
                    $count2  +=  $row2["h1"];
                }
                else  if($row2["ty"] == "كلية اجباري")
                {
                    $count3  +=  $row2["h1"];
                }
                else  if($row2["ty"] == "تخصص اجباري")
                {
                    $count4  +=  $row2["h1"];
                }
                else  if($row2["ty"] == "تخصص اختياري")
                {
                    $count5  +=  $row2["h1"];
                }
                $degree += ($row["degree"]*$row2["h1"]);
            }
        }
    }
}
$st->execute();
$rs = $st->get_result();
$num = $rs->num_rows;
?>
<div class="container log-container">
    <div class="row" style="width: 80%;" style="height: 1000px">
    <input type="text" id="userid" value="<?php echo $_SESSION["userid"];?>" hidden>
        <div  id="table-scroll" class="table-scroll" style="height: 700px; margin:40px auto">
            <table id="main-table" class="main-table">
                <thead style="position: sticky; top:0; color: var(--alt-2-color); background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);">
                <tr style=" background-color: var(--alt-2-color); border: 1px solid var(--main-color);">
                        <th class="justify-content-end" style="border: 1px solid var(--main-color); color: black" colspan="6">
                            <i class="fas fa-check-circle text-success" style="font-size: 24px; direction: rtl;"><span style="font-size: 20px; color: black;">&nbsp;لا يمكن اعادة المادة/ناجح</span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 24px; direction: rtl;"><span style="font-size: 20px; color: black;">&nbsp;يمكن اعادة المادة قبل اخذ متطلبها اللاحق/ناجح</span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-window-close text-danger" style="font-size: 24px; direction: rtl;"><span style="font-size: 20px; color: black;">&nbsp;يفضل اعادة المادة قبل اخذ متطلبها اللاحق/راسب</span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                </tr>
                <?php
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
                 $st1->bind_param("ii",$_SESSION["userid"],$_SESSION["userid"]);        
                 $st1->execute();
                 $rs1 = $st1->get_result();
                 $row1 = $rs1->fetch_assoc();
                 $sum1 = $row1["uni_man_hr"]+$row1["uni_op_hr"]+$row1["col_man_hr"]+$row1["spc_man_hr"]+$row1["spc_op_hr"];
                 $sum2 = $count1+$count2+$count3+$count4+$count5;
                 echo '
                    <tr>
                        <td colspan="3" style="border: 6px double var(--alt-2-color); vertical-align: middle; text-align: right; padding-right: 100px">'.
                        '<p>عدد ساعات متطلبات الكلية الاجباري&nbsp;&nbsp;&nbsp;'.$row1["col_man_hr"].'</p>'.
                        '<p>عدد الساعات التي درسها الطالب من متطلبات الجامعة الاجباري&nbsp;&nbsp;&nbsp;'.$count3.'</p>'.
                        '<p>عدد ساعات متطلبات التخصص الاجباري&nbsp;&nbsp;&nbsp;'.$row1["spc_man_hr"].'</p>'.
                        '<p>عدد الساعات التي درسها الطالب من متطلب التخصص الاجباري&nbsp;&nbsp;&nbsp;'.$count4.'</p>'.
                        '<p>عدد ساعات متطلبات التخصص الاختياري&nbsp;&nbsp;&nbsp;'.$row1["spc_op_hr"].'</p>'.
                        '<p>عدد الساعات التي درسها الطالب من متطلبات التخصص الاختياري&nbsp;&nbsp;&nbsp;'.$count5.'</p>'.
                        '</td>
                        <td colspan="3" style="border: 6px double var(--alt-2-color); vertical-align: middle; text-align: right; padding-right: 100px">
                        <p>عدد الساعات المعتمدة للتخرج&nbsp;&nbsp;&nbsp;'.$sum1.'</p>'.
                        '<p>مجموع عدد الساعات التي درسها الطالب بنجاح&nbsp;&nbsp;&nbsp;'.$sum2.'</p>'.
                        '<p>عدد ساعات متطلبات الجامعة الاجباري&nbsp;&nbsp;&nbsp;'.$row1["uni_man_hr"].'</p>'.
                        '<p>عدد الساعات التي درسها الطالب من متطلبات الجامعة الاجباري&nbsp;&nbsp;&nbsp;'.$count1.'</p>'.
                        '<p>عدد ساعات متطلبات الجامعة الاختياري&nbsp;&nbsp;&nbsp;'.$row1["uni_op_hr"].'</p>'.
                        '<p>عدد الساعات التي درسها الطالب من متطلبات الجامعة الاختياري&nbsp;&nbsp;&nbsp;'.$count2.'</p>'.
                        '</td>
                    </tr>
                 ';
                 echo '<tr><td colspan="6"> المعدل التراكمي : ';
                 if($sum2 != 0) 
                 echo round($degree/ $sum2 , 2);
                 else
                 echo "غير متاح";
                 echo '</td></tr>';
                ?>
                    
        
                    <tr>
                        <td><input type="text"  class="form-control" style="text-align: center;" disabled></td>
                        <td><input type="text" id="semester" placeholder="بحث حسب الفصل" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="year" placeholder="بحث حسب العام الدراسي" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="degree" placeholder="بحث حسب العلامات" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="crs_name" placeholder="بحث حسب اسم المادة" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" id="crs_no" placeholder="بحث حسب رقم المادة" class="form-control" style="text-align: center;"></td>
                    </tr>
                    <script>
                        $(document).ready(function(){
                            $(document).on("keyup","input", function(){
                                $.get("getStdPass.php?crsno=" + 
                                        $("#crs_no").val()+
                                        "&crsname="+
                                        $("#crs_name").val()+
                                        "&year="+
                                        $("#year").val()+
                                        "&degree="+
                                        $("#degree").val()+
                                        "&semester="+
                                        $("#semester").val()+
                                        "&userid="+
                                        $("#userid").val(),function(data,status){
                                    $("#tbody").html(data);
                                });
                            });
                        });
                    </script>
                    <tr>
                        <th>حالة المادة</th>
                        <th>الفصل</th>
                        <th>العام الدراسي</th>
                        <th>العلامة</th>
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
                                $year= ($row["year"]).' / '.$row["year"]+1;
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
                                else if($row["degree"] != NULL)
                                {
                                    echo $row["degree"];
                                }
                                else
                                {
                                    echo 'غير متاحة';
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
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php'?>