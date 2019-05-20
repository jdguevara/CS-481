<?php
session_start();
$oldPassword = $_POST['oldPassword'];
$confirmPassword = $_POST['confirmPassword'];
$newPassword = $_POST['newPassword'];
$id = $_SESSION['id'];
$username = $_SESSION['username'];

require_once 'Dao.php';
$dao = new Dao();
$presets = array();
$usrPass = $dao->getPassword($username);
$hash = sha1($oldPassword . $username);
$bad = false;

if (empty($oldPassword)) {
    $_SESSION['messages'][] = "Old password is required.";
    $bad = true;
}

if (empty($confirmPassword)) {
    $_SESSION['messages'][] = "Confirmed password is required.";
    $bad = true;
}

if (empty($newPassword)) {
    $_SESSION['messages'][] = "New password is required.";
    $bad = true;
}


if($oldPassword != $confirmPassword){
    $_SESSION['messages'][] = "Passwords did not match";
    $bad = true;
}

if($usrPass != $hash ){
    $_SESSION['messages'][] = "Old password incorrect";
    $bad = true;
}

if ($bad) {
  header('Location: /adminManage.php');
  $_SESSION['validated'] = 'bad';
  exit;
}

// Got here, means everything validated, and the comment will post.
$_SESSION['validated'] = 'good';
$_SESSION['admin'] = true;
$dao->changePassword($id, $username, $newPassword);
$_SESSION['messageSuccess'][]= "Your password has been changed successfully!";
header('Location: /adminManage.php');
exit;