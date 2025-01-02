<?php
//عرض تصنيف الشكوى
function getcategory($id = 'all')
{
    global $conn;
    if ($id == 'all') {
        $sql = $conn->prepare('SELECT * FROM categories');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $sql = $conn->prepare('SELECT * FROM categories WHERE category_id = ?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    return $result;
}

//بيانات الرسائل

function getmessage($id='all'){
    global $conn;
    if($id=='all'){
        $sql = $conn->prepare('SELECT * FROM messages');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $result;
}
function sendmessage($user_id, $message_content,$created_at,$message_id){
    global $conn;
    $sql = $conn->prepare('INSERT INTO messages ( sender_id, message_content, created_at,message_id) VALUES (?, ?, ?,?)');
    $sql->execute([$user_id, $message_content,$created_at,$message_id]);
}
//عرض المناطق
function getarea($id = 'all')
{
    global $conn;
    if ($id == 'all') {
        $sql = $conn->prepare('SELECT * FROM area');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $sql = $conn->prepare('SELECT * FROM area WHERE area_id = ?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    return $result;
}

//بيانات المستخدم
function getuser($id='all', $email='all')
{
    global $conn;
    if ($id != 'all') {
        $sql = $conn->prepare('SELECT * FROM users WHERE id = ?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    elseif ($email != 'all') {
        $sql = $conn->prepare('SELECT * FROM users WHERE email = ?');
        $sql->execute([$email]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    else {
        $sql = $conn->prepare('SELECT * FROM users');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $result;
}

//بيانات الشكوى
function getcomplaint($id = 'all',$status='all')
{
    global $conn;
    if ($id == 'all'&& $status == 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($id != 'all' && $status != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE user_id = ? or status = ?');
        $sql->execute([$id, $status]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($id != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE complaint_id = ?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    elseif ($status != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE status = ?');
        $sql->execute([$status]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
   

    return $result;
}
//احضار الشكاوي حسب النوع 
function getcomplainttype($id = 'all',$status='all')
{
    global $conn;
    if ($id == 'all'&& $status == 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($id != 'all' && $status != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE user_id = ? or type = ?');
        $sql->execute([$id, $status]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($id != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE complaint_id = ?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    elseif ($status != 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE type = ?');
        $sql->execute([$status]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
   

    return $result;
}


//تحديث بيانات المستخدم
function updateuser($id, $fullname, $email, $password)
{
    global $conn;
    if (!empty($password)) {
        $sql = $conn->prepare('UPDATE users SET fullname=?, email=?, password=? WHERE id=?');
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql->execute([$fullname, $email, $hashed_password, $id]);
    } else {
        $sql = $conn->prepare('UPDATE users SET fullname=?, email=? WHERE id=?');
        $sql->execute([$fullname, $email, $id]);
    }
    
    if($sql->rowCount() > 0) {
        $_SESSION['user_name'] = $fullname;
        $_SESSION['email'] = $email;
        return true;
    }
    return false;
}
//لتحديث حالة الشكوى رفض او قبول
function actioncomplaint($action, $complaint_id){
    global $conn;
    $today = date('Y/m/d');
    if($action == 'Accept') {
        $sql = $conn->prepare('UPDATE complaints SET status="Done", resolution_date=? WHERE complaint_id=?');
    } elseif($action == 'Deny') {
        $sql = $conn->prepare('UPDATE complaints SET status="Closed", resolution_date=? WHERE complaint_id=?');
    }

    $sql->execute([$today, $complaint_id]);
    return $sql->rowCount() > 0;
}


?>