<?php
session_start();
$title = $_POST['title'];
$description = $_POST['description'];
$ingredients = $_POST['ingredients'];
$instructions = $_POST['instructions'];
$external_link = $_POST['external_link'];
$name = $_POST['name'];
$email = $_POST['email'];

require_once 'Dao.php';
$bad = false;
$dao = new Dao();

if (empty($title)) {
    $_SESSION['messages'][] = "Title is required.";
    $bad = true;
}

if (empty($description)) {
    $_SESSION['messages'][] = "Description is required.";
    $bad = true;
}

if (empty($ingredients)) {
    $_SESSION['messages'][] = "Ingredients are required.";
    $bad = true;
}

if (empty($instructions)) {
    $_SESSION['messages'][] = "Instructions are required.";
    $bad = true;
}

if (empty($external_link)) {
   $external_link = NULL;
}

if (empty($name)) {
    $name = NULL;
}

if (empty($email)) {
    $email = NULL;
}

if ($bad) {
    header('Location: /mealIdeas.php');
    exit;
}
$dao->mealIdea($title, $description, $ingredients, $instructions, $external_link, $name, $email);
$_SESSION['validated'] = 'good';
unset($_SESSION['presets']);
header('Location: /mealIdeas.php');
exit;