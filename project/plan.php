<title>خطة المواد</title>
<?php
session_start();
$_SESSION["page"]=9;
if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"]))
{
    header('location: login.php');
}
?>
<?php
include 'header.php';
include_once 'connection.php';
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
AND std_plan.major_id=m.ID 
AND 
((SELECT substring(students.Std_No,2,4)from students where students.id=?) BETWEEN c.First_Year AND c.Last_Year) 
AND 
m.major_no=(SELECT substring(students.Std_No,8,2)from students where students.id=?)
order by c.id;
");
$st->bind_param("ii",$_SESSION["userid"],$_SESSION["userid"]);
$st->execute();
$rs = $st->get_result();
$num = $rs->num_rows;

?>
<div class="container log-container">
    <div class="row" style="width: 80%;">
    <input type="text" id="userid" value="<?php echo $_SESSION["userid"];?>" hidden>
        <div  id="table-scroll" class="table-scroll" >
            <table id="main-table" class="main-table"  style="direction: ltr; width: 100%">
                <thead style="position: sticky; top:0; background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); 
                color: var(--alt-2-color);">
                    <tr>
                        <td><input type="text" placeholder="بحث حسب المتطلب السابق" id="p_crs" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" placeholder="بحث حسب عدد الساعات" id="h" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" placeholder="بحث حسب اسم المادة" id="crs_name" class="form-control" style="text-align: center;"></td>
                        <td><input type="text" placeholder="بحث حسب رقم المادة" id="crs_no" class="form-control" style="text-align: center;"></td>
                    </tr>
                    <script>
                        $(document).ready(function(){
                            $(document).on("keyup","input", function(){
                                $.get("getPlan.php?crsno=" + 
                                        $("#crs_no").val()+
                                        "&hour="+
                                        $("#h").val()+
                                        "&userid="+
                                        $("#userid").val()+
                                        "&crsname="+
                                        $("#crs_name").val()+
                                        "&p_name="+
                                        $("#p_crs").val(),function(data,status){
                                    $("#tbody").html(data);
                                });
                            });
                        });
                    </script>
                    <tr>
                        <th>المتطلب السابق</th>
                        <th>عدد الساعات</th>
                        <th>اسم المادة</th>
                        <th>رقم المادة</th>
                    </tr>
                </thead>
                <tbody id="tbody" style="background-color: var(--alt-2-color); color: var(--alt-color);">
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
                        $rows = $rs1->fetch_assoc();
                        if($num > 0)
                        {
                            $f=1;
                            $str1="";
                            $str2="";
                            $str3="";
                            $str4="";
                            $str5="";
                            while($row = $rs->fetch_assoc())
                            {
                                if($row["ty"]=="جامعة اجباري" && $f==1)
                                {
                                    $str1= '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
                                    '<td style="vertical-align: middle; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);" colspan="4">'.'نوع المتطلب : '.$row["ty"].'&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["uni_man_hr"].'</td>'.
                                    '</tr>';
                                    $f=2;
                                }
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
                                    '<td style="vertical-align: middle;">'.$p.'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["h1"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["c_name"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["crs_no"].'</td>'.
                                    '</tr>';
                                }
                                if($row["ty"]=="جامعة اختياري" && $f==2)
                                {
                                    $str2= '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
                                    '<td style="vertical-align: middle; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);" colspan="4">'.'نوع المتطلب : '.$row["ty"].'&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["uni_op_hr"].'</td>'.
                                    '</tr>';
                                    $f=3;
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
                                    '<td style="vertical-align: middle;">'.$p.'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["h1"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["c_name"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["crs_no"].'</td>'.
                                    '</tr>';
                                }
                                if($row["ty"]=="كلية اجباري" && $f==3)
                                {
                                    $str3= '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
                                    '<td style="vertical-align: middle; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);" colspan="4">'.'نوع المتطلب : '.$row["ty"].'&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["col_man_hr"].'</td>'.
                                    '</tr>';
                                    $f=4;
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
                                    '<td style="vertical-align: middle;">'.$p.'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["h1"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["c_name"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["crs_no"].'</td>'.
                                    '</tr>';
                                }
                                if($row["ty"]=="تخصص اجباري" && $f==4)
                                {
                                    $str4= '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
                                    '<td style="vertical-align: middle; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);" colspan="4">'.'نوع المتطلب : '.$row["ty"].'&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["spc_man_hr"].'</td>'.
                                    '</tr>';
                                    $f=5;
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
                                    '<td style="vertical-align: middle;">'.$p.'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["h1"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["c_name"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["crs_no"].'</td>'.
                                    '</tr>';
                                }
                                if($row["ty"]=="تخصص اختياري" && $f==5)
                                {
                                    $str5= '<tr style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color);">'.
                                    '<td style="vertical-align: middle; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);" colspan="4">'.'نوع المتطلب : '.$row["ty"].'&nbsp;&nbsp;&nbsp; عدد الساعات المعتمدة : '.$rows["spc_op_hr"].'</td>'.
                                    '</tr>';
                                    $f=6;
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
                                    '<td style="vertical-align: middle;">'.$p.'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["h1"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["c_name"].'</td>'.
                                    '<td style="vertical-align: middle;">'.$row["crs_no"].'</td>'.
                                    '</tr>';
                                }
                            }
                            echo $str1;
                            echo $str2;
                            echo $str3;
                            echo $str4;
                            echo $str5;
                        }
                        else
                        {
                            echo'<tr>';
                            echo '<td style="  height: 228px;  vertical-align: middle; background-color: var(--alt-2-color);" colspan="4">لا يوجد نتائج</td>';
                            echo '</tr>';
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