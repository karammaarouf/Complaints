<!-- الاتصال بقاعدة البيانات -->
<?php include '../comploments/connect.php' ?>
<!-- فحص حالة تسجيل الدخول -->
<?php
session_start(); //بدء جلسة جديدة لحفظ بيانات المستخدم
if (isset($_POST['signin'])) { //التحقق من ان زر الفورم تم الضغط عليه و استقبال بيانات
    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    // تنظيف وتأمين المدخلات
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $pass = trim($pass);

    if (empty($email) || empty($pass)) {
        $_SESSION['message'] = 'الرجاء ملء جميع الحقول';
        header('location:login.php');
    } else {
        // التحقق من وجود المستخدم في قاعدة البيانات
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            // التحقق من صحة كلمة المرور
            if (password_verify($pass, $user['password'])) {
                // تخزين بيانات المستخدم في الجلسة
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['type'] = $user['type'];
                if ($user['type'] == 'admin') {// تحقق من نوع المستخدم
                header('location:../admin/dashboard.php');
                }
                elseif ($user['type'] == 'user') {
                    header('location:../user/user.php');
                }
            } else {
                $_SESSION['message'] = 'كلمة المرور غير صحيحة';
                header('location:login.php');
            }
        } else {
            $_SESSION['message'] = 'البريد الإلكتروني غير موجود';
            header('location:login.php');
        }

    }
} elseif (isset($_POST["signup"])) {
    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    $confirm_pass = $_POST['Confirm_Password'];
    $fullname = $_POST['FullName'];
    $nationalID = $_POST['nationalID'];
    $id = unique_id();

    // تنظيف وتأمين المدخلات
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $pass = trim($pass);
    $confirm_pass = trim($confirm_pass);

    if (empty($email) || empty($pass) || empty($confirm_pass)) {
        $_SESSION['message'] = 'الرجاء ملء جميع الحقول';
        header('location:login.php');
    } elseif ($pass != $confirm_pass) {
        $_SESSION['message'] = 'كلمات المرور غير متطابقة';
        header('location:login.php');
    } else {
        // التحقق من عدم وجود البريد الإلكتروني مسبقاً
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = 'البريد الإلكتروني مستخدم بالفعل';
            header('location:login.php');
        } else {
            // تشفير كلمة المرور وإضافة المستخدم الجديد
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (id, email, password,fullname,national_id) VALUES (?, ?, ?,?, ?)");
            $stmt->execute([$id, $email, $hashed_password, $fullname, $nationalID]);

            $_SESSION['message'] = 'تم إنشاء الحساب بنجاح';
            header('location:login.php');
                }
    }

} else {
    $_SESSION['message'] = "error11";
    session_reset();
    header('location:login.php');}
?>