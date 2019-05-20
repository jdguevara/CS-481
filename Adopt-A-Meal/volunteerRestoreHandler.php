<?php
session_start();

require_once 'Dao.php';
$id = $_POST['resVol'];
$dao = new Dao();
$dao->restoreVolunteer($id);
$_SESSION['messageSuccess'][]= "Volunteer has been restored successfully!";
header('Location: /adminVolunteer.php');
exit();