<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
    <link rel="stylesheet" type="text/css" href="css/interfaith.css">
    <title>Adopt-A-Meal - Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico"/>
</head>

<body>



<?php 
    include('nav.php'); 
?>

<div class="text-center jumbotron">
    <h1 id="meal-header">Meals Suggested By Volunteers and Community Members</h1>
    <p>If you have an idea click here 
    <button class="btn btn-primary" href="#" onclick="loadMealIdeaModal();" role="button">Share</button>
    </p>
</div>







<?php 
    include('footer.php'); 
?>

</body>
</html>