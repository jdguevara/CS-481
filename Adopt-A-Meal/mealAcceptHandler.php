<?php
session_start();
$to_email_address = "jaimeguevara@u.boisestate.edu" ; // We need to fill this with DB emails
$subject = "Meal Idea Accepted";
$message = "A meal idea has been accepted by " . $_SESSION['username'] . ".";

require_once 'Dao.php';
$id = $_POST['btn'];
$dao = new Dao();
$dao->acceptMealIdea($id);
$_SESSION['messagePending'][]= "Meal idea has been accepted";
mail($to_email_address,$subject,$message);
header('Location: /adminMealIdeas.php');
exit();
