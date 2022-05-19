<title>
    إعادة تعيين كلمة السر           
</title>
<?php
include_once("connection.php");
session_start();
$_SESSION["page"] = 3;
include 'header.php';
?>

<!--            Start New Stsudent            -->
<?php

if (isset($_POST["submit"])) {
    if (empty($_POST["email"]))
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
                            <p style="float:right; color:var(--main-color)">الرجاء ادخال البريد الالكتروني</p>
                        </div>
                    </div>
                </div>
            </div>';
    } 
    else if(strlen($_POST["email"]) != 26) {
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
                            <p style="float:right; color:var(--main-color)">البريد الالكتروني المدخل غير صحيح</p>
                        </div>
                    </div>
                </div>
            </div>';
    } else {
        $st = $con->prepare("select email from students where email = ?");
        $st->bind_param("s", $_POST["email"]);
        $st->execute();
        $rs = $st->get_result();
        $num = $rs->num_rows;
        if($num == 1)
        {
            $row = $rs->fetch_assoc();
            $path = 'location: reset_otp.php?email='.$row["email"];
            header($path);
        }
        else 
        {
            $error_msg = '
            <div class="modal fade show" id="login-modal" tabindex="-1" aria-labelledby="login-modal-title" style="display: block;  background-color: rgba(255,255,255,0.6);" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="width:250px; right:25%;">
                        <div class="modal-header">
                            <img class="img" src="images\info_status.png">
                            <h5 class="modal-title">Information</h5>
                            <button type="button" class="btn" id="btn-modal" style="color:#EEEEEE; background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%);s">X</button>
                        </div>
                        <div class="modal-body">
                            <p style="float:right; color:var(--main-color)">البريد الالكتروني المدخل غير صحيح</p>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}
?>
<div class="container bg log-container" style="min-height: 720px;">
<?php if (!empty($error_msg)) echo $error_msg; ?> 
    <div class="row log-row">
        <div class="col-12 col-sm-6 col-md-3 log-col">
            <form class="form-container form-log new-std-form" action="#" method="post" enctype="multipart/form-data">
                <div class="log-mb mb-3">
                    <label for="InputEmail" class="from-label mt-5" style="float: right; margin-top:15px;">البريد الالكتروني الجامعي</label>
                    <input type="text" class="form-control" id="InputEmail" name="email" size="27" style="text-align:right; direction:ltr">
                </div>
                <button type="submit" class="btn btn-block btn-log" id="btn-log" name="submit">ارسال</button>
                <button type="button" class="btn btn-block btn-log" id="btn-log-2" name="btn">إلغاء</button>
            </form>
        </div>
    </div>
</div>
<!--            End New Student            -->

<?php include 'footer.php'; ?>