<?php
session_start();

require_once 'Dao.php';
$id = $_POST['change'];
$dao = new Dao();
$bad = false;
$permission = $_SESSION['super_user'];

if(!$permission){
    $bad = true;
    $_SESSION['messages'][] = "You don't have permissions to change admins permission";
}

if ($bad) {
    header('Location: /adminManage.php');
    $_SESSION['validated'] = 'bad';
    exit;
}

$dao->changePermission($id);
$_SESSION['messageSuccess'][] = "Admins permissions successfully updated!";
header('Location: /adminManage.php');
exit();