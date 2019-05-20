<?php
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
    $lists = $dao->getAcceptedMealIdeas();
?>


<html>
<head>
    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/table.js"></script>
    <script type="text/javascript" src="js/messageFade.js"></script>
    <link rel="stylesheet" type="text/css" href="css/interfaith.css">
    <title>Adopt-A-Meal - Meal Ideas</title>
    <link rel="stylesheet" type="text/css" href="css/jquery.datatables.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
    include('nav.php'); 
?>
<div class="container">
<div class="text-center jumbotron">
    <h1 id="meal-header">Meals Suggested By Volunteers and Community Members</h1>
    <p>If you have an idea click here 
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Share</button>
    </p>
</div>

<?php if (isset($_SESSION['messages'])) {
    foreach ($_SESSION['messages'] as $message) {?>
        <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
        echo $message; ?></div>
    <?php  }
    unset($_SESSION['messages']);
    ?> </div>
    <?php } ?>

<?php


echo "<table id='example' class= 'display'>
<thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Ingredients</th>
        <th>Instructions</th>
    </tr>
</thead>";
echo "<tbody>";
foreach ($lists as $list){
echo "<tr>";
echo "<td>" . htmlentities($list['title']) . "</td>";
echo "<td>" . htmlentities($list['description']) . "</td>";
echo "<td>" . htmlentities($list['ingredients']) . "</td>";
echo "<td>" . htmlentities($list['instructions']) . "</td>";
echo "</tr>";
}
echo "</tbody>";
echo "</table>";

?>
</div>
    <!-- Modal -->
    <form method="post" action="handler.php">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Suggest A Meal Idea</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <p>Thank you for taking the time to fill out a meal idea!</p>
                        <p>A provided recipe should be able to make at least 200 portions</p>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Meal Name</span>
                            <input id="meal-title" name="title" type="text" class="form-control" placeholder="Meal Name" required="">
                        </div>
                        <div id="meal-title-validation" class="hidden alert-danger">Required: Please enter a title for the meal</div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Description</span>
                            <input id="description" name="description" type="text" class="form-control" placeholder="Meal Description" required="">
                        </div>
                        <div id="description-validation" class="hidden alert-danger">Required: Please enter a description of the meal</div>
                    </div>
                    <div class="form-group">
                        <h4>Ingredients:</h4>
                        <div id="dynamic_field">
                            <div class="ingredient input-group">
                                <textarea type="text" id="ingredients" name="ingredients" placeholder="Enter ingredients" class="form-control ingredient_list"></textarea>
                                <!-- <span class="input-group-btn">
                                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                </span> -->
                            </div>
                        </div>
                        <div id="ingredients-validation" class="hidden alert-danger">Required: Please provide a list of ingredients needed to make your meal idea</div>
                    </div>
                    <div class="form-group">
                        <h4>Instructions:</h4>
                        <div class="input-group">
                            <textarea id="instructions" name="instructions" class="form-control" placeholder="Instructions"></textarea>
                        </div>
                        <div id="instructions-validation" class="hidden alert-danger">Required: Please provide instructions to prepare the meal</div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Source Website</span>
                            <input id="external-link" name="external_link" type="text" class="form-control" placeholder="Link to the Source Website">
                        </div>
                        <p class="help-block">Optional</p>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Your Name</span>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <p class="help-block">Optional</p>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Your Email</span>
                            <input id="email" name="email" type="text" class="form-control" placeholder="Your Email">
                        </div>
                        <p class="help-block">Optional</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id ="submit-form" type="submit" class="btn btn-success">Submit</button>
                    <button id="cancel-form" type="button" class="btn btn-detail" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>






<?php 
    include('footer.php'); 
?>

</body>
</html>
