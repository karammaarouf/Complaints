صفحة المستخدمين
<?php
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['type']=='user') {
    require_once('../comploments/connect.php');
    require_once('../comploments/sql.php');
    

echo '<a href="../auth/logout.php">Logout</a>';


}
else {
    header('location:../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('../admin/partials/head.php'); ?>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <?php include('../admin/partials/header.php');?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php include('../admin/partials/sidebar.php');?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="content">
                <h1>هنا محتويات متغيرة حسب الضغط على الزر</h1>
                <?php include('../admin/profile.php');?>
            </div>
            <!-- END PAGE CONTENT-->
            <?php include('../admin/partials/footer.php');?>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <?php include('../admin/partials/settings.php');?>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
   <?php include('../admin/partials/scripts.php');?>
</body>
</html>