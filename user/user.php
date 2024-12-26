صفحة المستخدمين
<?php
session_start();
if (isset($_SESSION['user_id'])) {
echo '<a href="../auth/logout.php">Logout</a>';
}
else {
    header('location:../index.php');
}
?>