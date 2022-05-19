<title>
    معلومات الطالب
</title>
<?php
session_start();
$_SESSION["page"]=6;
if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"]))
{
    header('location: login.php');
}
else
{
    include 'header.php';
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
    ORDER BY
    std_crs.sem_id;
    ");
    $st->bind_param("i",$_SESSION["userid"]);
    $st->execute();
    $rs = $st->get_result();
    $num = $rs->num_rows;
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
$st2->execute();
$rs2 = $st2->get_result();
$count1 = 0;
$count2 = 0;
$count3 = 0;
$count4 = 0;
$count5 = 0;
$degree = 0;
$sum = 0;
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
    $sum = $count1+$count2+$count3+$count4+$count5;
}
$st = $con->prepare("select std_no,std_name,email,mobile,address,major_name,std_ori_hr,std_ori_day from students,majors where students.id=? and majors.id=std_major_no");
$st->bind_param("i",$_SESSION["userid"]);
$st->execute();
$rs = $st->get_result();
$row = $rs->fetch_assoc();
}
if(isset($_POST["sub3"]))
{
    $st = $con->prepare("select *from students where mobile=? and id!=?");
    $st->bind_param("si",$_POST["mobile"],$_SESSION["userid"]);
    $st->execute();
    $rs = $st->get_result();
    $num = $rs->num_rows; 
    if(empty($_POST["mobile"])||empty($_POST["address"]))
    {
        $error_msg = '
                <div class="modal fade show" id="login-modal" tabindex="-1" aria-labelledby="login-modal-title" style="display: block; background-color: rgba(255,255,255,0.6);" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="width:250px; right:25%;">
                            <div class="modal-header">
                                <img class="img" src="images\info_status.png">
                                <h5 class="modal-title">Information</h5>
                                <button type="button" class="btn" id="btn-modal" style="color:#EEEEEE; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);s">X</button>
                            </div>
                            <div class="modal-body">
                                <p style="float:right; color:var(--main-color)">الرجاء ادخال رقم الهاتف ومكان الاقامة</p>
                            </div>
                        </div>
                    </div>
                </div>';
    }
    else if(strlen($_POST["mobile"])!=10 || !ctype_digit($_POST["mobile"]) || (substr($_POST["mobile"],0,3) != '079' && substr($_POST["mobile"],0,3) != '078' && substr($_POST["mobile"],0,3) != '077'))
    {
        $error_msg = '
                <div class="modal fade show" id="login-modal" tabindex="-1" aria-labelledby="login-modal-title" style="display: block; background-color: rgba(255,255,255,0.6);" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="width:250px; right:25%;">
                            <div class="modal-header">
                                <img class="img" src="images\info_status.png">
                                <h5 class="modal-title">Information</h5>
                                <button type="button" class="btn" id="btn-modal" style="color:#EEEEEE; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);s">X</button>
                            </div>
                            <div class="modal-body">
                                <p style="float:right; color:var(--main-color)">رقم الهاتف المدخل غير صحيح</p>
                            </div>
                        </div>
                    </div>
                </div>';    
    }
    else if($num == 1)
    {
        $error_msg = '
                <div class="modal fade show" id="login-modal" tabindex="-1" aria-labelledby="login-modal-title" style="display: block; background-color: rgba(255,255,255,0.6);" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="width:250px; right:25%;">
                            <div class="modal-header">
                                <img class="img" src="images\info_status.png">
                                <h5 class="modal-title">Information</h5>
                                <button type="button" class="btn" id="btn-modal" style="color:#EEEEEE; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);s">X</button>
                            </div>
                            <div class="modal-body">
                                <p style="float:right; color:var(--main-color)">رقم الهاتف المدخل مستعمل</p>
                            </div>
                        </div>
                    </div>
                </div>';    
    }
    else
    {
        $st = $con->prepare("update students set address=?,mobile=?,std_ori_hr=?,std_ori_day=? where students.id=?");
        $st->bind_param("ssiii",$_POST["address"],$_POST["mobile"],$_POST["std_hr"],$_POST["std_dy"],$_SESSION["userid"]);
        $st->execute();
        echo '<script> window.location = "info.php";</script>';
    }
}
?>

<form class="profile-container container mt-5 mb-5" style="width: 80%;" action="#" method="post" enctype="multipart/form-data">
<?php if (!empty($error_msg)) echo $error_msg; ?> 
        <div class="col-md-12">
            <div class="p-3 py-5 justify-content-center" >
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label class="labels">اسم الطالب</label>
                        <input type="text" class="form-control" disabled value="<?php echo $row['std_name']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="labels">الرقم الجامعي</label>
                        <input type="text" class="form-control" id="stdno" value="<?php echo $row['std_no']; ?>" disabled>
                    </div>
                    <div class="col-md-4">
                        <label class="labels">التخصص</label>
                        <input type="text" class="form-control" value="<?php echo $row['major_name']; ?>" disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label class="labels">البريد الالكتروني الجامعي</label>
                        <input type="text" class="form-control" value="<?php echo $row['email']; ?>" disabled style="text-align:right; direction:ltr">
                    </div>
                    <div class="col-md-4">
                        <label class="labels">المعدل التراكمي</label>
                        <input type="text" class="form-control" value="<?php
                        if($sum != 0) 
                        echo round($degree/ $sum,2);
                        else
                        echo "غير متاح";
                        ?>"disabled>
                    </div>
                    <div class="col-md-4">
                            <label class="labels">مكان الاقامة</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>" 
                            <?php 
                                if(!isset($_POST["sub1"]))
                                {
                                    echo 'disabled';
                                }
                                else
                                {
                                    echo 'style="box-shadow: 0px 0px 8px 4px var(--main-color);"';
                                }
                             ?>
                              style="text-align:right;">
                        </div>
                </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label class="labels">رقم الهاتف</label>
                            <input type="text" class="form-control"
                            <?php 
                                if(!isset($_POST["sub1"]))
                                {
                                    echo 'disabled';
                                }
                                else
                                {
                                    echo 'style="box-shadow: 0px 0px 8px 4px var(--main-color);"';
                                }
                             ?>
                             value="<?php echo $row['mobile']; ?>"
                             name="mobile"
                             >
                        </div>
                        <div class="col-md-4">
                            <label class="labels mt-1">التوجه الدراسي<sub> (ساعات) </sub></label>
                            <select class="form-control" name="std_hr" id="std_gr"
                            <?php 
                                if(!isset($_POST["sub1"]))
                                {
                                    echo 'disabled';
                                }
                                else
                                {
                                    echo 'style="box-shadow: 0px 0px 8px 4px var(--main-color);"';
                                }
                                
                            ?>
                            >
                                <?php
                                    switch($row["std_ori_hr"])
                                    {
                                        case 1:
                                        {
                                            echo 
                                            '
                                            <option value="1" selected>صباحي (8 - 12)</option>
                                            <option value="2">مسائي (12 - 8)</option>
                                            <option value="3">صباحي ومسائي</option>
                                            ';
                                        }break;
                                        case 2:
                                        {
                                            echo 
                                            '
                                            <option value="1">صباحي (8 - 12)</option>
                                            <option value="2" selected>مسائي (12 - 8)</option>
                                            <option value="3">صباحي ومسائي</option>
                                            ';
                                        }break;
                                        case 3:
                                        {
                                            echo 
                                            '
                                            <option value="1">صباحي (8 - 12)</option>
                                            <option value="2">مسائي (12 - 8)</option>
                                            <option value="3" selected>صباحي ومسائي</option>
                                            ';
                                        }break;
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="labels mt-1">التوجه الدراسي <sub> (أيام) </sub></label>
                            <select class="form-control" name="std_dy" id="std_dy"
                            <?php 
                                if(!isset($_POST["sub1"]))
                                {
                                    echo 'disabled';
                                }
                                else
                                {
                                    echo 'style="box-shadow: 0px 0px 8px 4px var(--main-color);"';
                                }
                                
                            ?>
                            >
                            <?php
                                    switch($row["std_ori_day"])
                                    {
                                        case 1:
                                        {
                                            echo 
                                            '
                                            <option value="1" selected>أثنين - أربعاء</option>
                                            <option value="2">أحد - ثلاثاء - خميس</option>
                                            <option value="3">أحد - ثلاثاء</option>
                                            <option value="4">طوال الاسبوع</option>
                                            ';
                                        }break;
                                        case 2:
                                        {
                                            echo 
                                            '
                                            <option value="1">أثنين - أربعاء</option>
                                            <option value="2" selected>أحد - ثلاثاء - خميس</option>
                                            <option value="3">أحد - ثلاثاء</option>
                                            <option value="4">طوال الاسبوع</option>
                                            ';
                                        }break;
                                        case 3:
                                        {
                                            echo 
                                            '
                                            <option value="1">أثنين - أربعاء</option>
                                            <option value="2">أحد - ثلاثاء - خميس</option>
                                            <option value="3" selected>أحد - ثلاثاء</option>
                                            <option value="4">طوال الاسبوع</option>
                                            ';
                                        }break;
                                        case 4:
                                        {
                                            echo 
                                            '
                                            <option value="1">أثنين - أربعاء</option>
                                            <option value="2">أحد - ثلاثاء - خميس</option>
                                            <option value="3">أحد - ثلاثاء</option>
                                            <option value="4" selected>طوال الاسبوع</option>
                                            ';
                                        }break;
                                    }
                                ?>
                            </select>
                        </div>
                        
                        
                    </div>
                    <div class="row mt-4">
                        <?php
                        if(!isset($_POST["sub1"]))
                        {
                            echo 
                            '
                            <div class="col-md-4 mt-2">   
                            </div>
                            <div class="col-md-4 mt-2">
                                <button type="submit" name="sub1" class="btn btn-block" id="btn-edit" style="background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); border-radius: 10px; color: white; font-size: 16px;">تعديل</button>
                            </div>
                            <div class="col-md-4 mt-2">
                            </div>
                            ';   
                        }
                        else
                        {
                            if(isset($_POST["sub2"]))
                            {
                                session_unset($_POST["sub1"]);
                                session_unset($_POST["sub2"]);
                            }
                            echo 
                            '
                            <div class="col-md-2 mt-2">
                            </div>
                            <div class="col-md-4 mt-2">
                                <button type="submit" name="sub3" class="btn btn-block" id="btn-save" style="background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); border-radius: 10px; color: white; font-size: 16px;">حفظ</button>
                            </div>
                            <div class="col-md-4 mt-2">
                                <button type="submit" name="sub2" class="btn btn-block" id="btn-cancel" style="background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); border-radius: 10px; color: white; font-size: 16px;">إلغاء</button>
                            </div>
                            <div class="col-md-2 mt-2">
                            </div>
                            ';
                        }
                        ?>
                    </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>
<div id="add">

</div>
<?php include 'footer.php'?>