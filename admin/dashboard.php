صفحة الادمن
<?php
session_start();
if (isset($_SESSION['user_id'])) {
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

} else {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right;
        }

        th {
            background-color: #f2f2f2;
        }

        .view-btn {
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .status-pending {
            color: #ff9800;
        }

        .status-closed {
            color: #f44336;
        }

        .status-completed {
            color: #4CAF50;
        }
    </style>
    <style>
        :root {
            --mian_color: #257180;
            --crame: #F2E5BF;
            --orange: #FD8B51;
            --brown: #CB6040;
            --gray: #dadadae2;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: var(--mian_color);
            position: fixed;
            right: 0;
            top: 0;
            padding: 20px;
            color: white;
        }

        .user-info {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #34495e;
        }

        .user-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .nav-links {
            margin-top: 20px;
        }

        .nav-links a {
            display: block;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #34495e;
        }

        .main-content {
            margin-right: 270px;
            padding: 20px;
        }
    </style>

    <div class="sidebar">
        <div class="user-info">
            <img src="../assets/user-avatar.png" alt="صورة المستخدم">
            <h3>اسم المستخدم</h3>
            <p>admin@example.com</p>
            <p>مسؤول الشوارع</p>
        </div>

        <div class="nav-links">
            <a href="dashboard.php"><i class="fas fa-home"></i> الرئيسية</a>
            <a href="complaints.php"><i class="fas fa-clipboard-list"></i> إدارة الشكاوى</a>
            <a href="reports.php"><i class="fas fa-chart-bar"></i> التقارير</a>
            <a href="settings.php"><i class="fas fa-cog"></i> الإعدادات</a>
            <a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
        </div>
    </div>

    <div class="main-content">
        <form action="" method="post">
            <select class="form-control" name="statu_value" id="district" required>
                <option value="all" <?= $search_status=='all'?'selected':'' ?>>عرض الكل</option>
                <option value="قيد الانتظار" <?= $search_status=='قيد الانتظار'?'selected':'' ?>>قيد الانتظار</option>
                <option value="منتهية" <?= $search_status=='منتهية'?'selected':'' ?>>منتهية</option>
                <option value="مرفوضة" <?= $search_status=='مرفوضة'?'selected':'' ?>>مرفوضة</option>
                <input type="submit" name="search_status" value="فلترة">
            </select>

        </form>
        <table>
            <tr>
                <th>الخصوصية</th>
                <th>الوضع</th>
                <th>تصنيف الشكوى</th>
                <th>تاريخ التقديم</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
                <th>رقم الشكوى</th>
            </tr>

            <?php foreach ($complaints as $key => $complaint) { ?>

                <tr>
                    <td><?= $complaint['type'] ?></td>
                    <td><?= $complaint['status'] ?></td>

                    <td><?= getcategory($complaint['category_id'])['category_name'] ?></td>
                    <td><?= $complaint['submission_date'] ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="complaint_id" value="<?= $complaint['complaint_id'] ?>">
                            <input value="قيد الانتظار" type="submit" name="status" class="status-btn status-pending"
                                <?= ($complaint['status'] == 'قيد الانتظار') ? 'hidden' : '' ?>>

                            <input value="منتهية" type="submit" name="status" class="status-btn status-completed"
                                <?= ($complaint['status'] == 'منتهية') ? 'hidden' : '' ?>>
                            <input value="مرفوضة" type="submit" name="status" class="status-btn status-closed"
                                <?= ($complaint['status'] == 'مرفوضة') ? 'hidden' : '' ?>>
                        </form>
                    </td>
                    <td>
                        <a href="view_complaint.php?id=1" class="view-btn">عرض</a>
                    </td>
                    <td><?= $key + 1 ?></td>
                </tr>

            <?php } ?>


        </table>

</body>

</html>