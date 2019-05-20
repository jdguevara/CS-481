<?php
session_start();
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$_SESSION['presets']['username'] = $username;
$_SESSION['presets']['email'] = $email;
$_SESSION['presets']['password'] = $password;
$to_email_address = "jaimeguevara@u.boisestate.edu" ; // We need to fill this with DB emails
$subject = "Super User Added";
$message = $username . " has been added as a super user by " . $_SESSION['username'] . ".";

require_once 'Dao.php';
$dao = new Dao();
$presets = array();
$bad = false;

if (empty($username)) {
    $_SESSION['messages'][] = "Username is required.";
    $bad = true;
}

if (empty($email)) {
    $_SESSION['messages'][] = "Email is required.";
    $bad = true;
}

if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email)){ 
    $_SESSION['messages'][] = "Invalid email";
    $bad = true;
}

if (empty($password)) {
    $_SESSION['messages'][] = "Password is required.";
    $bad = true;
}

if($dao->checkUsername($username)){
    $_SESSION['messages'][] = "Admin already Exists";
    $bad = true;
}


if ($bad) {
  header('Location: /adminManage.php');
  $_SESSION['validated'] = 'bad';
  exit;
}

// Got here, means everything validated, and the comment will post.
$dao->addAdmin($username, $email, $password, 1);
$_SESSION['validated'] = 'good';
$_SESSION['messageSuccess'][]= "New super user has been added successfully!";
mail($to_email_address,$subject,$message);
unset($_SESSION['presets']);
header('Location: /adminManage.php');
exit;
