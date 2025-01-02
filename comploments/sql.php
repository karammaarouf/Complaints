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
    elseif($status!='all') {
        $sql = $conn->prepare('select * from complaints where status = ?');
        $sql->execute([$status]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($id!= 'all') {
        $sql = $conn->prepare('SELECT * FROM complaints WHERE complaint_id =?');
        $sql->execute([$id]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
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

?>