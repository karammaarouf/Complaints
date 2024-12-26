<!-- صفحة الاتصال بقاعدة البيانات -->
<?php
try {
    $dsn = "mysql:host=localhost;dbname=complaints;charset=utf8mb4";
    $username = "root";
    $password = "";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ];

    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// لتوليد رقم مميز لكل عملية اتصال جديدة
function unique_id()
{
    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $rand = array();
    $length = strlen($str) - 1;
    for ($i = 0; $i < 20; $i++) {
        $n = mt_rand(0, $length);
        $rand[] = $str[$n];
    }
    return implode($rand);
}

?>