<?php
session_start();

require_once 'Dao.php';
$id = $_POST['id'];
$dao = new Dao();
$dao->restoreMealIdea($id);
$_SESSION['messageSuccess'][]= "Meal idea has been restored successfully!";
header('Location: /adminMealIdeas.php');
exit();