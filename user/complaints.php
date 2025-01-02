<?php
require_once('../comploments/connect.php');
require_once('../comploments/sql.php');
session_start();
if (isset($_SESSION['user_id'])) {
$category=getcategory();
$area=getarea();
$user=getuser($_SESSION['user_id']);

if(isset($_POST['send'])){
$complaint_id=unique_id(); 
$user_id=$_SESSION['user_id'];
$description=$_POST['discreption'];
$category_id=$_POST['category'];
$type=$_POST['type'];
$area=$_POST['area'];
$sql=$conn->prepare("insert into complaints (complaint_id, user_id, category_id,type,area_id,description)values(?,?,?,?,?,?)");
    $sql->execute([$complaint_id,$user_id,$category_id,$type,$area,$description]);
    header('location: complaints.php');
    exit();

} 
}
else {
    header('location: ../auth/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">

    <title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
    :root {
        --mian_color: #257180;
        --crame: #F2E5BF;
        --orange: #FD8B51;
        --brown: #CB6040;
        --gray: #dadadae2;
    }
    body{
            
            font-family: 'Roboto', sans-serif;
            background-color:var(--gray);
        }
        * {
            margin: 0;
            padding: 0;
        }
        i {
            margin-right: 10px;
        }
        /*----------bootstrap-navbar-css------------*/
        .navbar-logo{
            padding: 15px;
            color: #fff;
        }
        .navbar-mainbg{
            background-color: var(--mian_color);
            padding: 0px;
            position: fixed;
            z-index: 1000;
        }
        #navbarSupportedContent{
            overflow: hidden;
        }
        #navbarSupportedContent ul{
            padding: 0px;
            margin: 0px;
        }
        #navbarSupportedContent ul li a i{
            margin-right: 10px;
        }
        #navbarSupportedContent li {
            list-style-type: none;
            float: left;
        }
        #navbarSupportedContent ul li a{
            color: rgba(7, 0, 0, 0.5);
            text-decoration: none;
            font-size: 15px;
            display: block;
            padding: 20px 20px;
            transition-duration:0.6s;
            transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
        }
        #navbarSupportedContent>ul>li.active>a{
            color: #333;
            background-color: transparent;
            transition: all 0.7s;
        }
        #navbarSupportedContent a:not(:only-child):after {
            content: "\f105";
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 14px;
            font-family: "Font Awesome 5 Free";
            display: inline-block;
            padding-right: 3px;
            vertical-align: middle;
            font-weight: 900;
            transition: 0.5s;
        }
        #navbarSupportedContent .active>a:not(:only-child):after {
            transform: rotate(90deg);
        }
        .hori-selector{
            display:inline-block;
            position:absolute;
            height: 100%;
            top: 0px;
            left: 0px;
            transition-duration:0.6s;
            transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
            background-color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .hori-selector .right,
        .hori-selector .left{
            position: absolute;
            width: 25px;
            height: 25px;
            background-color: #fff;
            bottom: 0px;
        }
        .hori-selector .right{
            right: -25px;
        }
        .hori-selector .left{
            left: -25px;
        }
        .hori-selector .right:before,
        .hori-selector .left:before{
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--mian_color);
        }
        .hori-selector .right:before{
            bottom: 0;
            right: -25px;
        }
        .hori-selector .left:before{
            bottom: 0;
            left: -25px;
        }
        
        
        @media(min-width: 992px){
            .navbar-expand-custom {
                -ms-flex-flow: row nowrap;
                flex-flow: row nowrap;
                -ms-flex-pack: start;
                justify-content: flex-start;
            }
            .navbar-expand-custom .navbar-nav {
                -ms-flex-direction: row;
                flex-direction: row;
            }
            .navbar-expand-custom .navbar-toggler {
                display: none;
            }
            .navbar-expand-custom .navbar-collapse {
                display: -ms-flexbox!important;
                display: flex!important;
                -ms-flex-preferred-size: auto;
                flex-basis: auto;
            }
        }
        
        
        @media (max-width: 991px){
            #navbarSupportedContent ul li a{
                padding: 12px 30px;
            }
            .hori-selector{
                margin-top: 0px;
                margin-left: 10px;
                border-radius: 0;
                border-top-left-radius: 25px;
                border-bottom-left-radius: 25px;
            }
            .hori-selector .left,
            .hori-selector .right{
                right: 10px;
            }
            .hori-selector .left{
                top: -25px;
                left: auto;
            }
            .hori-selector .right{
                bottom: -25px;
            }
            .hori-selector .left:before{
                left: -25px;
                top: -25px;
            }
            .hori-selector .right:before{
                bottom: -25px;
                left: -25px;
            }
        }</style>
</style>
<body style="background-color: var(--gray);">
<nav class="navbar navbar-expand-custom navbar-mainbg w-100 ">
        <a class="navbar-brand navbar-logo" href="#">شكاوي بلدية</a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                
                <li class="nav-item active">
                    <a class="nav-link" href="user.php"><i class="far fa-address-book"></i>الصفحة الرئيسية </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php
                    if(isset($_SESSION["user_id"])){
                        echo "../auth/logout.php";
                    }
                    else{
                        echo "../auth/login.php";
                    }
                    ?>"><i class="far fa-clone"></i><?php 
                    if(isset($_SESSION["user_id"])){
                        echo "تسجيل الخروج";
                    }
                    else{
                        echo "تسجيل الدخول";
                    }
                     ?></a>
                </li>
                
               
            </ul>
        </div>
    </nav>


  <section class="complaint-section" style="background: #f8f9fa; padding: 100px 0; " >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="complaint-box" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                    <h2 class="text-center mb-4" style="color: var(--mian_color);">تقديم شكوى</h2>
                    <form action="" method="post">
                        
                        <div class="form-group">
                            <label for="national_id">الرقم الوطني  </label>
                            <input type="tel" class="form-control" id="national_id" value="<?= $user['national_id']?>" disabled>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input name="phone" type="tel" class="form-control" id="phone" required>
                        </div>

                        <div class="form-group w-100 le">
        <label for="district">نوع الشكوى</label>
        <select name="type" class="form-control" id="district" required>
            <option value="">اختر النوع</option>
            <option value="عامة">عامة </option>
            <option value="خاصة"> خاصة</option>

        </select>
    </div>
                        <div class="form-group">
                            <label for="district">المنطقة</label>
                            <select name="area" class="form-control" id="district" required>
                                <option value="">اختر المنطقة</option>
<?php foreach ($area as $areaa): ?>
    <option value="<?= $areaa['area_id'] ?>"><?= $areaa['area_name'] ?></option>
    <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="district"> اختر التصنيف </label>
                            <select class="form-control" name="category" id="district" required>
                            <option value="">اختر التصنيف </option>
<?php foreach ($category as $key => $value) : ?>
    <option value="<?= $value['category_id'] ?>"><?= $value['category_name'] ?></option>

    <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="complaint">تفاصيل الشكوى</label>
                            <textarea name="discreption" class="form-control" id="complaint" rows="4" required></textarea>
                        </div>
                        <button name="send" type="submit" class="btn btn-primary btn-block" style="background: var(--mian_color); border: none; "onmouseover="this.style.backgroundColor='var(--brown)'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 20px rgba(0,0,0,0.3)'" onmouseout="this.style.backgroundColor='var(--mian_color)'; this.style.transform='scale(1)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.2)'">إرسال الشكوى</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>


    <script>// ---------Responsive-navbar-active-animation-----------
        function test(){
            var tabsNewAnim = $('#navbarSupportedContent');
            var selectorNewAnim = $('#navbarSupportedContent').find('li').length;
            var activeItemNewAnim = tabsNewAnim.find('.active');
            var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
            var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
            var itemPosNewAnimTop = activeItemNewAnim.position();
            var itemPosNewAnimLeft = activeItemNewAnim.position();
            $(".hori-selector").css({
                "top":itemPosNewAnimTop.top + "px", 
                "left":itemPosNewAnimLeft.left + "px",
                "height": activeWidthNewAnimHeight + "px",
                "width": activeWidthNewAnimWidth + "px"
            });
            $("#navbarSupportedContent").on("click","li",function(e){
                $('#navbarSupportedContent ul li').removeClass("active");
                $(this).addClass('active');
                var activeWidthNewAnimHeight = $(this).innerHeight();
                var activeWidthNewAnimWidth = $(this).innerWidth();
                var itemPosNewAnimTop = $(this).position();
                var itemPosNewAnimLeft = $(this).position();
                $(".hori-selector").css({
                    "top":itemPosNewAnimTop.top + "px", 
                    "left":itemPosNewAnimLeft.left + "px",
                    "height": activeWidthNewAnimHeight + "px",
                    "width": activeWidthNewAnimWidth + "px"
                });
            });
        }
        $(document).ready(function(){
            setTimeout(function(){ test(); });
        });
        $(window).on('resize', function(){
            setTimeout(function(){ test(); }, 500);
        });
        $(".navbar-toggler").click(function(){
            $(".navbar-collapse").slideToggle(300);
            setTimeout(function(){ test(); });
        });
        
        
        
        // --------------add active class-on another-page move----------
        jQuery(document).ready(function($){
            // Get current path and find target link
            var path = window.location.pathname.split("/").pop();
        
            // Account for home page with empty path
            if ( path == '' ) {
                path = 'index.html';
            }
        
            var target = $('#navbarSupportedContent ul li a[href="'+path+'"]');
            // Add active class to target link
            target.parent().addClass('active');
        });
    </script>
</body>
</html>