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
    $sql = $conn->prepare('SELECT * FROM area');
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//بيانات المستخدم
function getuser($id='all',$email='all')
{
    global $conn;
    if ($id == 'all'&& $email == 'all') {
    $sql = $conn->prepare('select * from users where id = ?');
    $sql->execute([$id]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    }
    if($email!='all') {
        $sql = $conn->prepare('select * from users where email=?');
        $sql->execute([$email]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
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
?>