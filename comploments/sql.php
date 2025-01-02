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
function updateuser($id, $fullname, $email, $password_update) {
    global $conn;
    
    $sql = "UPDATE users SET 
            fullname = ?, 
            email = ? 
            $password_update 
            WHERE id = ?";
            
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("ssi", $fullname, $email, $id);
        return $stmt->execute();
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}

?>