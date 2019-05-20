<?php
session_start();

require_once 'Dao.php';
$id = $_POST['id'];
$dao = new Dao();
$bad = false;
echo $id;
$permission = $_SESSION['super_user'];

if(!$permission){
    $bad = true;
    $_SESSION['messages'][] = "You don't have permissions to delete admins";
}

if ($bad) {
    header('Location: /adminManage.php');
    $_SESSION['validated'] = 'bad';
    exit;
}

$dao->deleteAdmin($id);
$_SESSION['messageSuccess'][] = "Admin successfully deleted!";
header('Location: /adminManage.php');
exit();