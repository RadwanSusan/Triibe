<title>
    نظام معلومات الطلبة           
</title>
<?php
include_once("connection.php");
session_start();
$_SESSION["page"] = 1;
$_SESSION['userid'] = null;

include 'header.php';
?>
<!--            Start login            -->
<?php
if (isset($_POST["submit"])) {
    if (empty($_POST["std-no"]) || empty($_POST["password"]) || strlen($_POST["std-no"]) != 12 || strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20 || !ctype_digit($_POST["std-no"])) {
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
                            <p style="float:right; color:var(--main-color)">الرقم الجامعي او كلمة السر غير صحيحة</p>
                        </div>
                    </div>
                </div>
            </div>';
    } else {
        $st = $con->prepare("select * from students where std_no = ?");
        $st->bind_param("s", $_POST["std-no"]);
        $st->execute();
        $rs = $st->get_result();
        $num = $rs->num_rows;
        if($num == 1)
        {
            $row = $rs->fetch_assoc();
            $st2 = $con->prepare("select id from students where std_no=? and password=?");
            $st2->bind_param("ss", $_POST["std-no"],$_POST["password"]);
            $st2->execute();
            $rs = $st2->get_result();
            $num = $rs->num_rows;
            if($num == 1)
            {
                $_SESSION["userid"] = $row["id"];
                $_SESSION['failed_login'] = 0;
                header('location: info.php');
            }
            else
            {
                if(!isset($_SESSION['failed_login']))
                {
                    $_SESSION['failed_login']=0;
                }
                if ($_SESSION['failed_login'] == 0) 
                {
                    $_SESSION['failed_login'] = 1;
                } 
                elseif (isset($_SESSION['failed_login'])) 
                {
                    $_SESSION['failed_login']++;
                }

                if ($_SESSION['failed_login'] == 3) {
                    $_SESSION['failed_login'] = 0;
                    header("location: error.php");  
                }
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
                                <p style="float:right; color:var(--main-color)">الرقم الجامعي او كلمة السر غير صحيحة</p>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
        else 
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
                            <p style="float:right; color:var(--main-color)">الرقم الجامعي او كلمة السر غير صحيحة</p>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}
?>
<div class="container log-container">
<?php if (!empty($error_msg)) echo $error_msg; ?> 
    <div class="row log-row">
        <div class="col-12 col-sm-6 col-md-3 log-col">
            <form class="form-container form-log" action="#" method="post" enctype="multipart/form-data">
                <div class="mb-3 log-mb">
                    <label for="InputStdNo" class="from-label" style="float: right; margin-top:12px;" id="lb1">الرقم الجامعي</label>
                    <input type="text" class="form-control" id="InputStdNo" name="std-no" size="12">
                </div>
                <div class="mb-3 log-mb">
                    <label for="InputPassword" class="form-label" style="float: right">كلمة السر</label>
                    <input type="password" class="form-control" id="InputPassword" name="password" size="20">
                    <button id="toggle" type="button" class="toggle-bg-1">
                    </button>
                </div>
                <div class="mb-3 log-mb">
                    <a class="link-dark" id="link-reset" style="float: right; margin-bottom:12px; color:var(--first-color)" href="reset_password.php">هل نسيت كلمة السر؟</a>
                </div>
                <button type="submit" class="btn btn-block btn-log" id="btn-log" name="submit">تسجيل دخول</button>
            </form>
        </div>
    </div>
</div>
<!--            End login            -->

<?php include 'footer.php' ?>