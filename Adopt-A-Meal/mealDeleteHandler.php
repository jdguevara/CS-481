<?php
session_start();
$to_email_address = "jaimeguevara@u.boisestate.edu" ; // We need to fill this with DB emails
$subject = "Meal Idea Deleted";
$message = "A meal idea has been deleted by " . $_SESSION['username'] . ".";

require_once 'Dao.php';
$id = $_POST['id'];
$dao = new Dao();
$dao->deleteMealIdea($id);
$_SESSION['messageSuccess'][]= "Meal idea has been deleted successfully!";
mail($to_email_address,$subject,$message);
header('Location: /adminMealIdeas.php');
exit();
