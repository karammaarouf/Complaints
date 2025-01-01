صفحة الادمن
<?php
include('../comploments/sql.php');

session_start();
if (isset($_SESSION["user_id"]) && $_SESSION["type"]=='admin') {

    require_once('../comploments/connect.php');
    require_once('../comploments/sql.php');
    $_SESSION['sreach_status']='all';
    $_SESSION['complaints'] = getcomplaint();

    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $complaint_id = $_POST['complaint_id'];
        $sql = $conn->prepare("update complaints set status=? where complaint_id=?");
        $sql->execute([$status, $complaint_id]);
        header('location:dashboard.php');
    }
    if (isset($_POST['search_status'])) {
        $_SESSION['sreach_status'] = $_POST['statu_value'];
        $_SESSION['complaints'] = getcomplaint(status: $_SESSION['sreach_status']);


    }

    $search_status=$_SESSION['sreach_status'];
    $complaints=$_SESSION['complaints'] ;

}else {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('partials/head.php'); ?>

<body class="fixed-navbar">
    <!-- رسالة اشعار اول التحميل بعد التعديلات -->
    <?php if(isset($_SESSION['success_msg']) || isset($_SESSION['error_msg'])): ?>
        <div class="alert-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            <?php if(isset($_SESSION['success_msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>نجاح!</strong> <?php echo $_SESSION['success_msg']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success_msg']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['error_msg'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>خطأ!</strong> <?php echo $_SESSION['error_msg']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['error_msg']); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="page-wrapper">
        <!-- START HEADER-->
        <?php include('partials/header.php');?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php include('partials/sidebar.php');?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="content">
                <h1>هنا محتويات متغيرة حسب الضغط على الزر</h1>
                <?php include('profile.php');?>
            </div>
            <!-- END PAGE CONTENT-->
            <?php include('partials/footer.php');?>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <?php include('partials/settings.php');?>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
   <?php include('partials/scripts.php');?>
</body>
</html>