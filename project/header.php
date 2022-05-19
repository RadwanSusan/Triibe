<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/projectlogo.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="css/header.css" rel="stylesheet" type="text/css" />
        <link href="css/login.css" rel="stylesheet" type="text/css" />
        <link href="css/footer.css" rel="stylesheet" type="text/css" />
        <link href="css/info.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <?php
            date_default_timezone_set('Asia/Amman');
            ob_start();
        ?>
    </head>
    <body>
        <!--            header                      -->
        <!--            Start upper-bar             -->
        <div class="jumbotron j-pad">
            <div class="container upper-bar-container">
                <div class="row upper-bar-row">
                    <div class="col-1 upper-bar-col-1">
                        <img src="images\projectlogo.png" class="img img-fluid img-thumbnail">
                    </div>
                    <div class="col-10 upper-bar-col-10">
                        جامعة الحسين بن طلال
                    </div>
                    <div class="col-1 upper-bar-col-1">
                        <img src="images\ahulogo.png" class="img img-fluid img-thumbnail" style="background-color: transparent!important; border:0px!important;">
                    </div>
                </div>
            </div>
        </div>
        <!--            End upper-bar               -->
        <!--            Start Navbar                -->
            <?php 
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
                AND
                courses.crs_hours != 0
                ORDER BY
                std_crs.sem_id;
                ");
                $st->bind_param("i",$_SESSION["userid"]);
                $st->execute();
                $rs = $st->get_result();
                $num = $rs->num_rows;
                if(($_SESSION["page"]>=6 && $_SESSION["page"]<=14)|| $_SESSION["page"]==1000)
                {
                    echo '
                    <nav class="navbar navbar-expand-lg navbar-light" style="background: var(--alt-2-color); border-bottom: 4px solid var(--main-color); overflow-x: auto; width: 100%">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" style="height: 63px;" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon" style="height: 100%;"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav" style="padding: 2px">';
                    echo '<ul class="navbar-nav header-nav justify-content-center align-items-center" id="pills-tab">';
                }
                switch($_SESSION["page"])
                {   
                    case 6: 
                    {
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="info.php">المعلومات الشخصية</a>';
                        echo '</li>';
                        if($num == 0)
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        else if(((date('d')>=3 && date('d')<=5 && date('m')==1)||
                           (date('d')>=17 && date('d')<=19 && date('m')==5)||
                           (date('d')>=8 && date('d')<=10 && date('m')==8))&& 
                           (date('G')>= 8 && date('G')<=24))
                        {
                            $count1=0;
                            while($row = $rs->fetch_assoc())
                            {
                                $count+=$row['hr'];
                            }
                            if(date('d')==3 && $count>=0 && $count<=45)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==4 && $count>45 && $count<=90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==5 && $count>90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';   
                            }
                        }
                        else if((((date('d')==7 || date('d')==8) && date('m')==1)||
                                ((date('d')==20 || date('d')==21) && date('m')==5)||
                                ((date('d')==11 || date('d')==12) && date('m')==8))&& 
                                (date('G')>= 8 && date('G')<=24))
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="plan.php">الخطة الدراسية</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_crs.php">الجدول الدراسي</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="stdCrsPass.php">كشف العلامات</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_deg.php">علامات الفصل</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="crs_sub.php">جريدة المواد</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="change_password.php">تغيير كلمة السر</a>';
                        echo '</li>';
                    }break;
                    case 7: 
                    {
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="info.php">المعلومات الشخصية</a>';
                        echo '</li>';
                        if($num == 0)
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        else if(((date('d')>=3 && date('d')<=5 && date('m')==1)||
                           (date('d')>=17 && date('d')<=19 && date('m')==5)||
                           (date('d')>=8 && date('d')<=10 && date('m')==8))&& 
                           (date('G')>= 8 && date('G')<=24))
                        {
                            $count1=0;
                            while($row = $rs->fetch_assoc())
                            {
                                $count+=$row['hr'];
                            }
                            if(date('
                            d')==3 && $count>=0 && $count<=45)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==4 && $count>45 && $count<=90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==5 && $count>90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';   
                            }
                        }
                        else if((((date('d')==7 || date('d')==8) && date('m')==1)||
                                ((date('d')==20 || date('d')==21) && date('m')==5)||
                                ((date('d')==11 || date('d')==12) && date('m')==8))&& 
                                (date('G')>= 8 && date('G')<=24))
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="plan.php">الخطة الدراسية</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_crs.php">الجدول الدراسي</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="stdCrsPass.php">كشف العلامات</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_deg.php">علامات الفصل</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="crs_sub.php">جريدة المواد</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="change_password.php">تغيير كلمة السر</a>';
                        echo '</li>';
                    }break;
                    case 8: 
                    {
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="info.php">المعلومات الشخصية</a>';
                        echo '</li>';
                        if($num == 0)
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        else if(((date('d')>=3 && date('d')<=5 && date('m')==1)||
                           (date('d')>=17 && date('d')<=19 && date('m')==5)||
                           (date('d')>=8 && date('d')<=10 && date('m')==8))&& 
                           (date('G')>= 8 && date('G')<=24))
                        {
                            $count1=0;
                            while($row = $rs->fetch_assoc())
                            {
                                $count+=$row['hr'];
                            }
                            if(date('d')==3 && $count>=0 && $count<=45)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==4 && $count>45 && $count<=90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==5 && $count>90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';   
                            }
                        }
                        else if((((date('d')==7 || date('d')==8) && date('m')==1)||
                                ((date('d')==20 || date('d')==21) && date('m')==5)||
                                ((date('d')==11 || date('d')==12) && date('m')==8))&& 
                                (date('G')>= 8 && date('G')<=24))
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="plan.php">الخطة الدراسية</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_crs.php">الجدول الدراسي</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="stdCrsPass.php">كشف العلامات</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_deg.php">علامات الفصل</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="crs_sub.php">جريدة المواد</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="change_password.php">تغيير كلمة السر</a>';
                        echo '</li>';
                    }break;
                    case 9: 
                    {
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="info.php">المعلومات الشخصية</a>';
                        echo '</li>';
                        if($num == 0)
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        else if(((date('d')>=3 && date('d')<=5 && date('m')==1)||
                           (date('d')>=17 && date('d')<=19 && date('m')==5)||
                           (date('d')>=8 && date('d')<=10 && date('m')==8))&& 
                           (date('G')>= 8 && date('G')<=24))
                        {
                            $count1=0;
                            while($row = $rs->fetch_assoc())
                            {
                                $count+=$row['hr'];
                            }
                            if(date('d')==3 && $count>=0 && $count<=45)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==4 && $count>45 && $count<=90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==5 && $count>90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';   
                            }
                        }
                        else if((((date('d')==7 || date('d')==8) && date('m')==1)||
                                ((date('d')==20 || date('d')==21) && date('m')==5)||
                                ((date('d')==11 || date('d')==12) && date('m')==8))&& 
                                (date('G')>= 8 && date('G')<=24))
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="plan.php">الخطة الدراسية</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_crs.php">الجدول الدراسي</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="stdCrsPass.php">كشف العلامات</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_deg.php">علامات الفصل</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="crs_sub.php">جريدة المواد</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="change_password.php">تغيير كلمة السر</a>';
                        echo '</li>';
                    }break;
                    case 10: 
                    {
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="info.php">المعلومات الشخصية</a>';
                        echo '</li>';
                        if($num == 0)
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        else if(((date('d')>=3 && date('d')<=5 && date('m')==1)||
                           (date('d')>=17 && date('d')<=19 && date('m')==5)||
                           (date('d')>=8 && date('d')<=10 && date('m')==8))&& 
                           (date('G')>= 8 && date('G')<=24))
                        {
                            $count1=0;
                            while($row = $rs->fetch_assoc())
                            {
                                $count+=$row['hr'];
                            }
                            if(date('d')==3 && $count>=0 && $count<=45)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==4 && $count>45 && $count<=90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==5 && $count>90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';   
                            }
                        }
                        else if((((date('d')==7 || date('d')==8) && date('m')==1)||
                                ((date('d')==20 || date('d')==21) && date('m')==5)||
                                ((date('d')==11 || date('d')==12) && date('m')==8))&& 
                                (date('G')>= 8 && date('G')<=24))
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="plan.php">الخطة الدراسية</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="std_crs.php">الجدول الدراسي</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="stdCrsPass.php">كشف العلامات</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_deg.php">علامات الفصل</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="crs_sub.php">جريدة المواد</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="change_password.php">تغيير كلمة السر</a>';
                        echo '</li>';
                    }break;
                    case 11: 
                    {
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="info.php">المعلومات الشخصية</a>';
                        echo '</li>';
                        if($num == 0)
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        else if(((date('d')>=3 && date('d')<=5 && date('m')==1)||
                           (date('d')>=17 && date('d')<=19 && date('m')==5)||
                           (date('d')>=8 && date('d')<=10 && date('m')==8))&& 
                           (date('G')>= 8 && date('G')<=24))
                        {
                            $count1=0;
                            while($row = $rs->fetch_assoc())
                            {
                                $count+=$row['hr'];
                            }
                            if(date('d')==3 && $count>=0 && $count<=45)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==4 && $count>45 && $count<=90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==5 && $count>90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';   
                            }
                        }
                        else if((((date('d')==7 || date('d')==8) && date('m')==1)||
                                ((date('d')==20 || date('d')==21) && date('m')==5)||
                                ((date('d')==11 || date('d')==12) && date('m')==8))&& 
                                (date('G')>= 8 && date('G')<=24))
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="plan.php">الخطة الدراسية</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_crs.php">الجدول الدراسي</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="stdCrsPass.php">كشف العلامات</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="std_deg.php">علامات الفصل</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="crs_sub.php">جريدة المواد</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="change_password.php">تغيير كلمة السر</a>';
                        echo '</li>';
                    }break;
                    case 12: 
                    {
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="info.php">المعلومات الشخصية</a>';
                        echo '</li>';
                        if($num == 0)
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        else if(((date('d')>=3 && date('d')<=5 && date('m')==1)||
                           (date('d')>=17 && date('d')<=19 && date('m')==5)||
                           (date('d')>=8 && date('d')<=10 && date('m')==8))&& 
                           (date('G')>= 8 && date('G')<=24))
                        {
                            $count1=0;
                            while($row = $rs->fetch_assoc())
                            {
                                $count+=$row['hr'];
                            }
                            if(date('d')==3 && $count>=0 && $count<=45)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==4 && $count>45 && $count<=90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==5 && $count>90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';   
                            }
                        }
                        else if((((date('d')==7 || date('d')==8) && date('m')==1)||
                                ((date('d')==20 || date('d')==21) && date('m')==5)||
                                ((date('d')==11 || date('d')==12) && date('m')==8))&& 
                                (date('G')>= 8 && date('G')<=24))
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="plan.php">الخطة الدراسية</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_crs.php">الجدول الدراسي</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="stdCrsPass.php">كشف العلامات</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_deg.php">علامات الفصل</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="crs_sub.php">جريدة المواد</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="change_password.php">تغيير كلمة السر</a>';
                        echo '</li>';
                    }break;
                    case 13: 
                    {
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="info.php">المعلومات الشخصية</a>';
                        echo '</li>';
                        if($num == 0)
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        else if(((date('d')>=3 && date('d')<=5 && date('m')==1)||
                           (date('d')>=17 && date('d')<=19 && date('m')==5)||
                           (date('d')>=8 && date('d')<=10 && date('m')==8))&& 
                           (date('G')>= 8 && date('G')<=24))
                        {
                            $count1=0;
                            while($row = $rs->fetch_assoc())
                            {
                                $count+=$row['hr'];
                            }
                            if(date('d')==3 && $count>=0 && $count<=45)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==4 && $count>45 && $count<=90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==5 && $count>90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';   
                            }
                        }
                        else if((((date('d')==7 || date('d')==8) && date('m')==1)||
                                ((date('d')==20 || date('d')==21) && date('m')==5)||
                                ((date('d')==11 || date('d')==12) && date('m')==8))&& 
                                (date('G')>= 8 && date('G')<=24))
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="plan.php">الخطة الدراسية</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_crs.php">الجدول الدراسي</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="stdCrsPass.php">كشف العلامات</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_deg.php">علامات الفصل</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="crs_sub.php">جريدة المواد</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="change_password.php">تغيير كلمة السر</a>';
                        echo '</li>';
                    }break;
                    case 14: 
                    {
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="info.php">المعلومات الشخصية</a>';
                        echo '</li>';
                        if($num == 0)
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        else if(((date('d')>=3 && date('d')<=5 && date('m')==1)||
                           (date('d')>=17 && date('d')<=19 && date('m')==5)||
                           (date('d')>=8 && date('d')<=10 && date('m')==8))&& 
                           (date('G')>= 8 && date('G')<=24))
                        {
                            $count1=0;
                            while($row = $rs->fetch_assoc())
                            {
                                $count+=$row['hr'];
                            }
                            if(date('d')==3 && $count>=0 && $count<=45)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==4 && $count>45 && $count<=90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';
                            }
                            else if(date('d')==5 && $count>90)
                            {
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                                echo '</li>';
                                echo '<li class="nav-item header-nav-item">';
                                echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                                echo '</li>';   
                            }
                        }
                        else if((((date('d')==7 || date('d')==8) && date('m')==1)||
                                ((date('d')==20 || date('d')==21) && date('m')==5)||
                                ((date('d')==11 || date('d')==12) && date('m')==8))&& 
                                (date('G')>= 8 && date('G')<=24))
                        {
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="guidance.php">الارشاد الاكاديمي</a>';
                            echo '</li>';
                            echo '<li class="nav-item header-nav-item">';
                            echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="register.php">التسجيل الالكتروني</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="plan.php">الخطة الدراسية</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_crs.php">الجدول الدراسي</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="stdCrsPass.php">كشف العلامات</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="std_deg.php">علامات الفصل</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="crs_sub.php">جريدة المواد</a>';
                        echo '</li>';
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link" id="pill-new-log-tab" href="change_password.php">تغيير كلمة السر</a>';
                        echo '</li>';
                    }break;
                    case 1000:{
                        echo '<li class="nav-item header-nav-item">';
                        echo '<a class="nav-link header-nav-link active" id="pill-new-log-tab" href="login.php">تسجيل الدخول</a>';
                        echo '</li>';
                    }break;
                }
                
                if(isset($_SESSION["userid"]))
                {
                    echo
                    '
                        <form class="d-flex" action="login.php" method="post">
                            <button class="btn mt-2 mr-2 mb-2" type="submit" id="btn-logout" style="background: radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%); border-radius: 100px; width: 100px; color: white; font-size: 16px;">تسجيل خروج</button>
                        </form>
                    ';
                }
                
                if(($_SESSION["page"]>=6 && $_SESSION["page"]<=14)|| $_SESSION["page"]==1000)
                echo '</ul></div>
                </nav>';
            ?>
            

        <!--            End Navbar                  -->

        <!--            Begin Marquee                  -->

        
        <?php 
        if($_SESSION["page"]<3)
        {
            echo '<div class="container container-marq" style="margin-top: 0; border-top: 4px solid var(--alt-2-color)" >
            <div class="ticker">
                    <div class="title">
                    الإعلانـــــــــــــات
                    </div>
                    <div class="news">
                        <marquee class="news-content" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="14">
                            <p>
                                يتم طرح الجدول بناءا على ميول الطالب حسي الايام و ساعات دوامه
                            </p>
                            
                            <p>
                                يساعد الموقع الطلبة قي تسجيل موادهم الجامعية دون اي جهد
                            </p>
                            <p>
                               موقع الارشاد الطلابي
                            </p>
                            <p>
                                يتم طرح الجدول بناءا على ميول الطالب حسي الايام و ساعات دوامه
                            </p>
                            
                            <p>
                                يساعد الموقع الطلبة قي تسجيل موادهم الجامعية دون اي جهد
                            </p>
                            <p>
                               موقع الارشاد الطلابي
                            </p>
                            <p>
                                يتم طرح الجدول بناءا على ميول الطالب حسي الايام و ساعات دوامه
                            </p>
                            
                            <p>
                                يساعد الموقع الطلبة قي تسجيل موادهم الجامعية دون اي جهد
                            </p>
                            <p>
                               موقع الارشاد الطلابي
                            </p>
                            <p>
                                يتم طرح الجدول بناءا على ميول الطالب حسي الايام و ساعات دوامه
                            </p>
                            
                            <p>
                                يساعد الموقع الطلبة قي تسجيل موادهم الجامعية دون اي جهد
                            </p>
                            <p>
                               موقع الارشاد الطلابي
                            </p>
                        </marquee>
                    </div>
                </div>
            </div>';
        }
        ?>
        <!--            End Marquee                  -->

        <!--            End Header                  -->