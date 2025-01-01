
صفحة عرض الشكاوي
<?php

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
    <div class="page-wrapper">
        <!-- START HEADER-->
        <?php include('partials/header.php');?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php include('partials/sidebar.php');?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Complaints</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Complaints</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Complaints Table</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                    <th>الحالة</th>
                                    <th>الموقع</th>
                                    <th>التصنيف</th>
                                    <th>المحتوى</th>
                                    <th>تاريخ التقديم</th>
                                    <th>الاجراءات</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>الحالة</th>
                                    <th>الموقع</th>
                                    <th>التصنيف</th>
                                    <th>المحتوى</th>
                                    <th>تاريخ التقديم</th>
                                    <th>الاجراءات</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <!-- عرض الشكاوي -->
                                <?php foreach($complaints as $complaint) : ?>
                                <tr>
                                    <td><?= $complaint['status'] ?></td>
                                    <td><?= getarea($complaint['area_id'])['area_name'] ?></td>
                                    <td><?= getcategory($complaint['category_id'])['category_name'] ?></td>
                                    <td><?= $complaint['description'] ?></td>
                                    <td><?= $complaint['submission_date'] ?></td>
                                    <td>زر</td>
                                </tr>
                                <?php endforeach; ?>                               
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <!-- END PAGE CONTENT-->
            <!-- footer -->
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <?php include('partials/scripts.php');?>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
                //"ajax": './assets/demo/data/table_data.json',
                /*"columns": [
                    { "data": "name" },
                    { "data": "office" },
                    { "data": "extn" },
                    { "data": "start_date" },
                    { "data": "salary" }
                ]*/
            });
        })
    </script>
</body>

</html>