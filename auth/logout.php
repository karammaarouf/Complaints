<!-- تسجيل الخروج -->
<?php
// بدء الجلسة
session_start();

// Delete cookies
setcookie('user_id', '', time() - 3600, '/');
setcookie('user_email', '', time() - 3600, '/'); 
setcookie('user_name', '', time() - 3600, '/');
setcookie('user_type', '', time() - 3600, '/');

// إنهاء الجلسة
session_unset(); // إزالة جميع متغيرات الجلسة
session_destroy(); // تدمير الجلسة

// إعادة توجيه المستخدم الى صفحة البداية
header("Location: ../index.php");
exit();
?>