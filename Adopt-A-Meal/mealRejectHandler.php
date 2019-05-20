<?php
session_start();

require_once 'Dao.php';
$id = $_POST['btn'];
$dao = new Dao();
$dao->rejectMealIdea($id);
$_SESSION['messagePending'][]= "Meal idea has been rejected";
header('Location: /adminMealIdeas.php');
exit();