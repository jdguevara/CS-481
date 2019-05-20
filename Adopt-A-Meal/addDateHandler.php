<?php
session_start();
$date = $_POST['date'];
$to_email_address = "jdguevara93@gmail.com, jaimeguevara@u.boisestate.edu"; // We need to fill this with DB emails
$subject = "Volunteer Date Accepted";
$message = "The following date: " . $date . " has been added as a volunteer date by " . $_SESSION['username'] . ".";

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


$dao->addVolunteerDate($date);
$_SESSION['validated'] = 'good';
$_SESSION['messageSuccess'][]= "New volunteer date has been added to list successfully!";
mail($to_email_address,$subject,$message);
header('Location: /adminVolunteer.php');
exit;
