<?php
session_start();

require_once 'Dao.php';
$id = $_POST['delVol'];
$dao = new Dao();
$dao->deleteVolunteer($id);
$_SESSION['messageSuccess'][]= "Volunteer has been deleted successfully!";
header('Location: /adminVolunteer.php');
exit();