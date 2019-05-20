<?php
session_start();

require_once 'Dao.php';
$id = $_POST['rejVol'];
$dao = new Dao();
$dao->rejectVolunteer($id);
$_SESSION['messageSuccess'][]= "Volunteer event has been rejected";
header('Location: /adminVolunteer.php');
exit();