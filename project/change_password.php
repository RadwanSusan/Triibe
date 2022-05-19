<title>
    إعادة تعيين كلمة السر           
</title>
<?php
 session_start();
 $_SESSION["page"]=13;
if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"]))
{
    header('location: login.php');
}
else
{
    include_once("connection.php");
    include 'header.php';
    ?>
    <!--            Start login            -->
    <?php
    if (isset($_POST["submit"])) {
        if (empty($_POST["password"]) || empty($_POST["c-password"]) || empty($_POST["oldpassword"]) )
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
                                <p style="float:right; color:var(--main-color)">الرجاء ادخال كلمة السر الجديدة والقديمة</p>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        else if(strlen($_POST["password"]) < 8 ||strlen($_POST["password"]) > 20 || strlen($_POST["c-password"]) < 8 || strlen($_POST["c-password"]) > 20 || 
        strlen($_POST["oldpassword"]) < 8 || strlen($_POST["oldpassword"]) > 20)
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
                                <p style="float:right; color:var(--main-color)">يجب ان تكون كلمة السر الجديدة والقديمة مكونة من 8 الى 20 رمز</p>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        else 
        {
            $st = $con->prepare("select password from students where id=?");
            $st->bind_param("i", $_SESSION["userid"]);
            $st->execute();
            $rs = $st->get_result();
            $row = $rs->fetch_assoc();
            if($row["password"]==$_POST["oldpassword"])
            {
                if(($_POST["c-password"]!=$_POST["password"])) {
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
                                        <p style="float:right; color:var(--main-color)">الكلمتان غير متطابقاتان</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                else 
                {
                    $st = $con->prepare("update students set password=? where id=?");
                    $st->bind_param("si", $_POST["password"],$_SESSION["userid"]);
                    $st->execute();
                    echo '<script> window.location="info.php" </script>';  
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
                                <p style="float:right; color:var(--main-color)">كلمة السر القديمة غير صحيحة</p>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    }

}
?>
<div class="container bg log-container">
<?php if (!empty($error_msg)) echo $error_msg; ?> 
    <div class="row log-row">
        <div class="col-12 col-sm-6 col-md-3 log-col">
            <form class="form-container form-log" action="#" method="post" enctype="multipart/form-data" style="height: 100%;">
                <div class="mb-1 log-mb">
                    <label for="oldpassword" class="from-label" style="float: right; margin-top:6px;" id="lb1">كلمة السر القديمة</label>
                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" size="20">
                    <button id="toggle-3" type="button" class="toggle-bg-1">
                    </button>
                </div>
                <div class="mb-1 log-mb">
                    <label for="npassword" class="from-label" style="float: right;" id="lb1">كلمة السر الجديدة</label>
                    <input type="password" class="form-control" id="npassword" name="password" size="20">
                    <button id="toggle-1" type="button" class="toggle-bg-1">
                    </button>
                </div>
                <div class="mb-1 log-mb">
                    <label for="cpassword" class="form-label" style="float: right">تأكيد كلمة السر الجديدة</label>
                    <input type="password" class="form-control" id="cpassword" name="c-password" size="20">
                    <button id="toggle-2" type="button" class="toggle-bg-1">
                    </button>
                </div>
                <div class="mb-1 log-mb">
                    <p class="link-dark" id="messsage" style="float: right; margin-bottom:12px; color:var(--first-color)"></p>
                </div>
                <button type="submit" class="btn btn-block btn-log mt-4 mb-3" id="btn-log" name="submit">إعادة تعيين</button>
            </form>
        </div>
    </div>
</div>
<!--            End login            -->

<?php include 'footer.php' ?>