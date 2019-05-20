<?php
    session_start();
    // $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    if (!$_SESSION['admin']) {
        header('Location: /index.php');
        exit;
    }
    require_once 'Dao.php';
    $dao = new Dao();
    $lists = $dao->getMealIdeas();
    $lists2 = $dao->getMealIdeas();
    $vols = $dao->getVolunteers();
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/table.js"></script>
    <script type="text/javascript" src="js/modals.js"></script>
    <script type="text/javascript" src="js/messageFade.js"></script>
    <link rel="stylesheet" type="text/css" href="css/interfaith.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.datatables.min.css">
    <title>Adopt-A-Meal - Admin Meal Ideas</title>
    <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico"/>
</head>

<body>

<?php 
    include('adminNav.php'); 
?>

<?php if (isset($_SESSION['messagePending'])) {
            foreach ($_SESSION['messagePending'] as $message) {?>
                <div class="messageSuccess <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
                    echo $message; ?></div><br>
            <?php  }
            unset($_SESSION['messagePending']);
            ?> </div>
<?php } ?>

<h1>Pending Meal Ideas </h1>
<?php
echo "<table id='' class= 'display'>
<thead>
    <tr>
        <th align='left'>Title</th>
        <th align='left'>Description</th>
        <th align='left'>Ingredients</th>
        <th align='left'>Instructions</th>
        <th align='left'>External Link</th>
        <th align='left'>Name</th>
        <th align='left'>Email</th>
        <th align='left'>Status</th>
        <th align='left'>Manage</th>
    </tr>
</thead>";
echo "<tbody>";
foreach ($lists as $list){
    if($list['meal_idea_status'] == 0){
        echo "<tr>";
        echo "<td>" . htmlentities($list['title']) . "</td>";
        echo "<td>" . htmlentities($list['description']) . "</td>";
        echo "<td>" . htmlentities($list['ingredients']) . "</td>";
        echo "<td>" . htmlentities($list['instructions']) . "</td>";
        if($list['external_link'] == NULL){
            echo "<td></td>";
        }
        else{
            echo "<td>" . htmlentities($list['external_link']) . "</td>";
        }
        if($list['name'] == NULL){
            echo "<td></td>";
        }
        else{
            echo "<td>" . htmlentities($list['name']) . "</td>";
        }
        if($list['email'] == NULL){
            echo "<td></td>";
        }
        else{
            echo "<td>" . htmlentities($list['email']) . "</td>";
        }
        echo "<td>" . "Pending" . "</td>";
        echo "<td> <form method='post' action='mealAcceptHandler.php' enctype='multipart/form-data' id = 'idea'>
        <button name='btn' value='".$list['id']."' type='submit'>Accept</button> </form>
        <form method='post' action='mealRejectHandler.php' enctype='multipart/form-data' id = 'idea'>
        <button name='btn' value='" . $list['id']. "' type='submit'>Reject</button> </form> </td>";
        echo "</tr>";
        
    }
}
        echo "</tbody>";
        echo "</table>";
    ?>
        
    
    <?php if (isset($_SESSION['messageSuccess'])) {
            foreach ($_SESSION['messageSuccess'] as $message) {?>
                <div class="messageSuccess <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
                    echo $message; ?></div><br>
            <?php  }
            unset($_SESSION['messageSuccess']);
            ?> </div>
    <?php } ?>


    <h1>Accepted/Rejected Meal Ideas</h1>
    <?php
    echo "<table id='' class= 'display'>
    <thead>
        <tr>
            <th align='left'>Title</th>
            <th align='left'>Description</th>
            <th align='left'>Ingredients</th>
            <th align='left'>Instructions</th>
            <th align='left'>External Link</th>
            <th align='left'>Name</th>
            <th align='left'>Email</th>
            <th align='left'>Status</th>
            <th align='left'>Manage</th>
        </tr>
    </thead>";
    echo "<tbody>";
    foreach ($lists2 as $list){
    if($list['meal_idea_status'] != 0){
        echo "<tr>";
        echo "<td>" . htmlentities($list['title']) . "</td>";
        echo "<td>" . htmlentities($list['description']) . "</td>";
        echo "<td>" . htmlentities($list['ingredients']) . "</td>";
        echo "<td>" . htmlentities($list['instructions']) . "</td>";
        if($list['external_link'] == NULL){
            echo "<td></td>";
        }
        else{
            echo "<td>" . htmlentities($list['external_link']) . "</td>";
        }
        if($list['name'] == NULL){
            echo "<td></td>";
        }
        else{
            echo "<td>" . htmlentities($list['name']) . "</td>";
        }
        if($list['email'] == NULL){
            echo "<td></td>";
        }
        else{
            echo "<td>" . htmlentities($list['email']) . "</td>";
        }
        if($list['meal_idea_status'] == 1){
        echo "<td>" . "Accepted" . "</td>";
        }
        else if($list['meal_idea_status'] == 2){
            echo "<td>" . "Rejected" . "</td>";
        }
        echo "<td>
            <button class='restore' data-id='".$list['id']."'>Restore</button>
            <button class='delete' data-id='".$list['id']."'>Delete</button></td>";
        echo "</tr>";
        
    }
}
echo "</tbody>";
echo "</table>";
?>

    <div class="modalContainer" id="deleteMealModal">
        <form method="POST" action="mealDeleteHandler.php" class="formModal" enctype="multipart/form-data">
        <h1>ARE YOU SURE YOU WANT TO DELETE THIS MEAL IDEA?</h1>
        <p class="text-warning"><small>This will delete entire record and this action cannot be undone.</small></p>

            <input type="hidden" name="id" value=""/>
            <button class="btn btn-danger" type="submit">Delete</button>
            <button type="reset" class="btn cancel" onclick="closeDeleteModal()">Close</button>
        </form>
    </div>

     <div class="modalContainer" id="restoreMealModal">
        <form method="POST" action="mealRestoreHandler.php" class="formModal">
        <h1>ARE YOU SURE YOU WANT TO RESTORE THIS MEAL IDEA?</h1>
        <p class="text-warning"><small>This will change status back to pending.</small></p>

            <input type="hidden" name="id" value=""/>
            <button class="btn btn-danger" type="submit">Okay</button>
            <button type="reset" class="btn cancel" onclick="closeRestoreModal()">Close</button>
        </form>
    </div>
</div>
 
<?php 
    include('footer.php'); 
?>
</div>
</body>


</html>
