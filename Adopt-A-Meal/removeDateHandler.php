<?php
session_start();
$date = $_POST['removeDate'];

require_once 'Dao.php';
$dao = new Dao();
$presets = array();
$bad = false;

echo $date;

if (empty($date)) {
    $_SESSION['messages'][] = "Something went wrong.";
    $bad = true;
}

if ($bad) {
  header('Location: /adminVolunteer.php');
  $_SESSION['validated'] = 'bad';
  exit;
}


$dao->removeVolunteerDate($date);
$_SESSION['validated'] = 'good';
$_SESSION['messageSuccess'][]= "Volunteer date has been removed from list successfully!";
unset($_SESSION['presets']);
header('Location: /adminVolunteer.php');
exit;