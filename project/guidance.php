<title>الارشاد الاكاديمي</title>
<?php
session_start();
$_SESSION["page"]=7;
if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"]))
{
    header('location: login.php');
}
?>
<?php include 'header.php'?>
<?php
$state1 = $con->prepare("select max(id) max_sem,sem_no from semesters");
$state1->execute();
$rs = $state1->get_result();
$row = $rs->fetch_assoc();
$st1 = $con->prepare("
select 
courses.Crs_Hours h1,courses.Course_Name,std_crs.crs_id c_id
from 
std_crs,courses where courses.id=std_crs.crs_id 
and 
std_crs.status!=0 
and 
std_crs.degree>68 
and 
std_crs.std_id=? 
and 
courses.Crs_Hours != 0
");
$st1->bind_param("i",$_SESSION["userid"]);
$st1->execute();
$rs1 = $st1->get_result();
$num1 = $rs1->num_rows;
$st2 = $con->prepare("
SELECT 
c.id c_id,
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
$st2->execute();
$rs2 = $st2->get_result();
$num2 = $rs2->num_rows;
$count1 = 0;
$count2 = 0;
$count3 = 0;
$count4 = 0;
$count5 = 0;
if($num1 > 0 && $num2 > 0)
{
    while($row1 = $rs1->fetch_assoc())
    {
        $st2->execute();
        $rs2 = $st2->get_result();
        while($row2 = $rs2->fetch_assoc())
        {
            if($row2["c_id"]==$row1["c_id"])
            {
                if($row2["ty"] =="جامعة اجباري")
                {
                    $count1  +=  $row1["h1"];
                }
                else  if($row2["ty"] == "جامعة اختياري")
                {
                    $count2  +=  $row1["h1"];
                }
                else  if($row2["ty"] == "كلية اجباري")
                {
                    $count3  +=  $row1["h1"];
                }
                else  if($row2["ty"] == "تخصص اجباري")
                {
                    $count4  +=  $row1["h1"];
                }
                else  if($row2["ty"] == "تخصص اختياري")
                {
                    $count5  +=  $row1["h1"];
                }
            }
        }
    }
}
$st3 = $con->prepare("
SELECT 
crs_type.Type ty, 
sum(c.crs_hours) h1
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
group by crs_type.Type
");
$st3->bind_param("iiiiiiiii",$_SESSION["userid"],$_SESSION["userid"],$_SESSION["userid"],$_SESSION["userid"],$_SESSION["userid"],$_SESSION["userid"],$_SESSION["userid"],$_SESSION["userid"],$_SESSION["userid"]);
$st3->execute();
$rs3 = $st3->get_result();
$num3 = $rs3->num_rows;
$st4 = $con->prepare("
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
$st4->bind_param("ii",$_SESSION["userid"],$_SESSION["userid"]);        
$st4->execute();
$rs4 = $st4->get_result();
$row4 = $rs4->fetch_assoc();
$hours = array(0,0,0,0,0);
while($row3 = $rs3->fetch_assoc())
{
    if($row3["ty"] =="جامعة اجباري")
    {
        $hours[0] = $row3["h1"];
    }
    else  if($row3["ty"] == "جامعة اختياري")
    {
        $hours[1] = $row3["h1"];
    }
    else  if($row3["ty"] == "كلية اجباري")
    {
        $hours[2] = $row3["h1"];
    }
    else  if($row3["ty"] == "تخصص اجباري")
    {
        $hours[3] = $row3["h1"];
    }
    else  if($row3["ty"] == "تخصص اختياري")
    {
        $hours[4] = $row3["h1"];
    }
}
?>
<script>
    $(document).ready(function(){
        
        var sum = parseInt($("#uni_man_hr2").val())+parseInt($("#uni_op_hr2").val())+parseInt($("#col_man_hr2").val())+parseInt($("#spc_man_hr2").val())+parseInt($("#spc_op_hr2").val());
        $("#uni_man_hr2").keyup(function(){
            var h1 = $("#uni_man_hr2").val();
            var h2 = $("#uni_op_hr2").val();
            var h3 = $("#col_man_hr2").val();
            var h4 = $("#spc_man_hr2").val();
            var h5 = $("#spc_op_hr2").val();
            if(isNaN(parseInt(h1)))
            {
                h1=0;
                $("#uni_man_hr2").val(h1);
            }
            if(isNaN(parseInt(h2)))
                h2=0;
            if(isNaN(parseInt(h3)))
                h3=0;
            if(isNaN(parseInt(h4)))
                h4=0;
            if(isNaN(parseInt(h5)))
                h5=0;
            if(parseInt(h1)>parseInt($("#uni_man_hr1").val())||parseInt(h1)>parseInt($("#sem_hr").val()))
            {
                h1=0;
                $("#uni_man_hr2").val(h1);
            }
            if(parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5)>parseInt($("#sem_hr").val()))
            {
                $("#uni_man_hr2").val(0);
                $("#uni_op_hr2").val(0);
                $("#col_man_hr2").val(0);
                $("#spc_man_hr2").val(0);
                $("#spc_op_hr2").val(0);
            }
            else 
            {
                sum = parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5);
            }
        });
        $("#uni_op_hr2").keyup(function(){
            var h1 = $("#uni_man_hr2").val();
            var h2 = $("#uni_op_hr2").val();
            var h3 = $("#col_man_hr2").val();
            var h4 = $("#spc_man_hr2").val();
            var h5 = $("#spc_op_hr2").val();
            if(isNaN(parseInt(h1)))
                h1=0;
            if(isNaN(parseInt(h2)))
            {
                h2=0;
                $("#uni_op_hr2").val(h2);
            }
            if(isNaN(parseInt(h3)))
                h3=0;
            if(isNaN(parseInt(h4)))
                h4=0;
            if(isNaN(parseInt(h5)))
                h5=0;
            if(parseInt(h2)>parseInt($("#uni_op_hr1").val())||parseInt(h2)>parseInt($("#sem_hr").val()))
            {
                h2=0;
                $("#uni_op_hr2").val(h2);
            }
            if(parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5)>parseInt($("#sem_hr").val()))
            {
                $("#uni_man_hr2").val(0);
                $("#uni_op_hr2").val(0);
                $("#col_man_hr2").val(0);
                $("#spc_man_hr2").val(0);
                $("#spc_op_hr2").val(0);
            }
            else 
            {
                sum = parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5);
            }
        });
        $("#col_man_hr2").keyup(function(){
            var h1 = $("#uni_man_hr2").val();
            var h2 = $("#uni_op_hr2").val();
            var h3 = $("#col_man_hr2").val();
            var h4 = $("#spc_man_hr2").val();
            var h5 = $("#spc_op_hr2").val();
            if(isNaN(parseInt(h1)))
                h1=0;
            if(isNaN(parseInt(h2)))
                h2=0;
            if(isNaN(parseInt(h3)))
            {
                h3=0;
                $("#col_man_hr2").val(h3);
            }
            if(isNaN(parseInt(h4)))
                h4=0;
            if(isNaN(parseInt(h5)))
                h5=0;
            if(parseInt(h3)>parseInt($("#col_man_hr1").val())||parseInt(h3)>parseInt($("#sem_hr").val()))
            {
                h3=0;
                $("#col_man_hr2").val(h3);
            }
            if(parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5)>parseInt($("#sem_hr").val()))
            {
                $("#uni_man_hr2").val(0);
                $("#uni_op_hr2").val(0);
                $("#col_man_hr2").val(0);
                $("#spc_man_hr2").val(0);
                $("#spc_op_hr2").val(0);
            }
            else 
            {
                sum = parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5);
            }
        });
        $("#spc_man_hr2").keyup(function(){
            var h1 = $("#uni_man_hr2").val();
            var h2 = $("#uni_op_hr2").val();
            var h3 = $("#col_man_hr2").val();
            var h4 = $("#spc_man_hr2").val();
            var h5 = $("#spc_op_hr2").val();
            if(isNaN(parseInt(h1)))
                h1=0;
            if(isNaN(parseInt(h2)))
                h2=0;
            if(isNaN(parseInt(h3)))
                h3=0;
            if(isNaN(parseInt(h4)))
            {
                h4=0;
                $("#spc_man_hr2").val(h4);
            }
            if(isNaN(parseInt(h5)))
                h5=0;
            if(parseInt(h4)>parseInt($("#spc_man_hr1").val())||parseInt(h4)>parseInt($("#sem_hr").val()))
            {
                h4=0;
                $("#spc_man_hr2").val(h4);
            }
            if(parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5)>parseInt($("#sem_hr").val()))
            {
                $("#uni_man_hr2").val(0);
                $("#uni_op_hr2").val(0);
                $("#col_man_hr2").val(0);
                $("#spc_man_hr2").val(0);
                $("#spc_op_hr2").val(0);
            }
            else 
            {
                sum = parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5);
            }
        });
        $("#spc_op_hr2").keyup(function(){
            var h1 = $("#uni_man_hr2").val();
            var h2 = $("#uni_op_hr2").val();
            var h3 = $("#col_man_hr2").val();
            var h4 = $("#spc_man_hr2").val();
            var h5 = $("#spc_op_hr2").val();
            if(isNaN(parseInt(h1)))
                h1=0;
            if(isNaN(parseInt(h2)))
                h2=0;
            if(isNaN(parseInt(h3)))
                h3=0;
            if(isNaN(parseInt(h4)))
                h4=0;
            if(isNaN(parseInt(h5)))
            {
                h5=0;
                $("#spc_op_hr2").val(h5);
            }
            if(parseInt(h5)>parseInt($("#spc_op_hr1").val())||parseInt(h5)>parseInt($("#sem_hr").val()))
            {
                h5=0;
                $("#spc_op_hr2").val(h5);
            }
            if(parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5)>parseInt($("#sem_hr").val()))
            {
                $("#uni_man_hr2").val(0);
                $("#uni_op_hr2").val(0);
                $("#col_man_hr2").val(0);
                $("#spc_man_hr2").val(0);
                $("#spc_op_hr2").val(0);
            }
            else 
            {
                sum = parseInt(h1)+parseInt(h2)+parseInt(h3)+parseInt(h4)+parseInt(h5);
            }
        });
        $('#btn-suggest').click(function(){
            $.get("checkNum.php?num="+sum+
                    "&n1="+$("#uni_man_hr2").val()+
                    "&n2="+$("#uni_op_hr2").val()+
                    "&n3="+$("#col_man_hr2").val()+
                    "&n4="+$("#spc_man_hr2").val()+
                    "&n5="+$("#spc_op_hr2").val(),function(data,status){
                if(data.length > 0 || sum == 0 || sum < 9)
                {
                    $("#login-modal").addClass("show");
                    $("#login-modal").css("display", "block");
                }
                else
                {
                    $.get("autoSchedule.php?userid="+$("#userid").val()+
                    "&n1="+$("#uni_man_hr2").val()+
                    "&n2="+$("#uni_op_hr2").val()+
                    "&n3="+$("#col_man_hr2").val()+
                    "&n4="+$("#spc_man_hr2").val()+
                    "&n5="+$("#spc_op_hr2").val()
                    ,function(data,status){
                        window.location="std_crs.php";
                    });
                }
            });
        });
    });
</script>
<input type="text" id="userid" value="<?php echo $_SESSION["userid"];?>" hidden>
<div class="container log-container" style="height: 700px">
    <div class="row" style="width: 90%;">
        <div  id="table-scroll" class="table-scroll" style="height: 100%;  margin: 100px">
            <table id="main-table" class="main-table" style="height: 100%; min-width: 720px">
                <thead style="position: sticky; top:0; color: var(--alt-2-color); background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);">
                    <tr>
                        <div class="modal fade" id="login-modal"  tabindex="-1" aria-labelledby="login-modal-title" style="display: none; background-color: rgba(255,255,255,0.6);" aria-modal="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="width:250px; right:25%;">
                                    <div class="modal-header">
                                        <img class="img" src="images\info_status.png">
                                        <h5 class="modal-title">Information</h5>
                                        <button type="button" class="btn" id="btn-modal" style="color:#EEEEEE; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);s">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <p style="float:right; color:var(--main-color)" id="message">الرجاء ادخال عدد ساعات صحيح</p>
                                    </div>
                                </div>
                            </div>
                        <div>
                        <th>عدد الساعات المتاح تنزيلها من</th>
                        <th>عدد الساعات المراد تنزيلها من</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr>
                        <td>
                            <div class="mb-1 log-mb">
                                <label class="labels from-label" style="float: right; margin-top:6px; width:78%" id="lb1">متطلبات جامعة اجباري</label>
                                <input type="text" class="form-control" id="uni_man_hr1" style="width: 20%; text-align: center"
                                <?php 
                                    echo "value = ". $hours[0];
                                ?> disabled>
                            </div>
                            <div class="mb-1 log-mb">
                                <label class="labels form-label" style="float: right; width:78%">متطلبات جامعة اختياري</label>
                                <input type="text" class="form-control" id="uni_op_hr1" style="width: 20%; text-align: center" 
                                <?php
                                    echo "value = ".($row4["uni_op_hr"]-$count2);
                                ?> disabled>
                            </div>
                            </div>
                            <div class="mb-1 log-mb">
                                <label class="labels form-label" style="float: right; width:78%">متطلبات كلية اجباري</label>
                                <input type="text" class="form-control" id="col_man_hr1" style="width: 20%; text-align: center"
                                 <?php
                                    echo "value = ". $hours[2];
                                ?> disabled>
                            </div>
                            <div class="mb-1 log-mb">
                                <label class="labels form-label" style="float: right; width:78%">متطلبات تخصص اجباري</label>
                                <input type="text" class="form-control" id="spc_man_hr1" style="width: 20%; text-align: center"
                                <?php 
                                    echo "value = ". $hours[3];
                                ?>  disabled>
                            </div>
                            <div class="mb-1 log-mb">
                                <label class="labels form-label" style="float: right; width:78%">متطلبات تخصص اختياري</label>
                                <input type="text" class="form-control" id="spc_op_hr1" style="width: 20%; text-align: center" 
                                <?php 
                                    if($hours[4]>$row4["spc_op_hr"])
                                    echo "value = ".($row4["spc_op_hr"]-$count5);
                                    else
                                    echo "value = ".$hours[4];
                                ?>
                                 disabled>
                            </div>
                            <div class="mb-1 log-mb">
                                <label class="labels" for="cpassword" class="form-label" style="float: right; width:78%" >هذا الفصل</label>
                                <input type="text" class="form-control" id="sem_hr" style="width:20%; text-align: center" value=
                                <?php 
                                if($row["sem_no"] == 1 || $row["sem_no"] == 2)
                                    echo "18";
                                else if($row["sem_no"] == 3)
                                    echo "9";
                                ?>
                                
                                 disabled>
                            </div>
                        </td>
                        <td>
                            <form class="form-container form-log" action="#" method="post" enctype="multipart/form-data" style="height: 100%;">
                                <div class="mb-1 log-mb">
                                    <label class="labels from-label" style="float: right; margin-top:6px; width:78%" id="lb1">متطلبات جامعة اجباري</label>
                                    <input type="text" class="form-control" id="uni_man_hr2" style="width: 20%; text-align: center" 
                                     
                                    <?php 
                                        if($num1 == 0)
                                        echo 'value = "3"';
                                        else
                                        {
                                            echo 'value = "0"';
                                        }
                                        if($hours[0]==0)
                                        { 
                                            echo "disabled";
                                        }
                                    ?>>
                                </div>
                                <div class="mb-1 log-mb">
                                    <label class="labels form-label" style="float: right; width:78%">متطلبات جامعة اختياري</label>
                                    <input type="text" class="form-control" id="uni_op_hr2" style="width: 20%; text-align: center"
                                    <?php 
                                        if($num1 == 0)
                                           echo 'value = "3"';
                                        else
                                        {
                                            echo 'value = "0"';
                                        }
                                        if($hours[1]==0)
                                        { 
                                            echo "disabled";
                                        }
                                    ?>>
                                </div>
                                </div>
                                <div class="mb-1 log-mb">
                                    <label class="labels form-label" style="float: right; width:78%">متطلبات كلية اجباري</label>
                                    <input type="text" class="form-control" id="col_man_hr2" style="width: 20%; text-align: center"
                                    <?php 
                                        if($num1 == 0)
                                        echo 'value = "6"';
                                        else
                                        {
                                            echo 'value = "0"';
                                        }
                                        if($hours[2]==0)
                                        { 
                                            echo "disabled";
                                        }
                                    ?>>
                                </div>
                                <div class="mb-1 log-mb">
                                    <label class="labels form-label" style="float: right; width:78%">متطلبات تخصص اجباري</label>
                                    <input type="text" class="form-control" id="spc_man_hr2" style="width: 20%; text-align: center"
                                    <?php 
                                        if($num1 == 0)
                                        echo 'value = "0"';
                                        else
                                        {
                                            echo 'value = "0"';
                                        }
                                        if($hours[3]==0)
                                        { 
                                            echo "disabled";
                                        }
                                    ?>>
                                </div>
                                <div class="mb-1 log-mb">
                                    <label class="labels form-label" style="float: right; width:78%">متطلبات تخصص اختياري</label>
                                    <input type="text" class="form-control" id="spc_op_hr2" style="width: 20%; text-align: center"
                                    <?php 
                                        if($num1 == 0)
                                        echo 'value = "0"';
                                        else
                                        {
                                            echo 'value = "0"';
                                        }
                                        if($hours[4]==0)
                                        { 
                                            echo "disabled";
                                        }
                                    ?>>
                                </div>
                                <button type="button" class="btn btn-block btn-log" id="btn-suggest" style="background:radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); color: var(--alt-2-color)!important; margin-bottom: 12px; font-weight: bold; margin: 10px auto; width:100%;">اقتراح الجدول</button>
                            </form> 
                        </td>
                    </tr>        
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