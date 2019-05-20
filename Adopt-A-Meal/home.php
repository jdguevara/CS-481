<?php
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
    $dates = $dao->getVolunteerDates();
?>

<html>

   <head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/table.js"></script>
<script type="text/javascript" src="js/modals.js"></script>
<script type="text/javascript" src="js/messageFade.js"></script>
<link rel="stylesheet" type="text/css" href="css/interfaith.css">
<link rel="stylesheet" type="text/css" href="css/jquery.datatables.min.css">
<title>Adopt-A-Meal - Home</title>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>

</head>

<body>

<?php 
    include('nav.php'); 
?>

<div class="header">
    <h1 id="home-header">Adopt A Meal</h1>
    <p>Select a date to Adopt A Meal</p>
</div>


<?php if (isset($_SESSION['messageSuccess'])) {
        foreach ($_SESSION['messageSuccess'] as $message) {?>
            <div class="messageSuccess <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
                echo $message; ?></div><br>
        <?php  }
        unset($_SESSION['messageSuccess']);
        ?> </div>
<?php } ?>

<h1>Available Volunteer Dates</h1>
<?php
echo "<table id='' class= 'display'>
<thead>
    <tr>
        <th align='left'>Date (YYYY/MM/DD)</th>
        <th align='left'>Volunteer</th>
    </tr>
</thead>";
echo "<tbody>";
foreach ($dates as $date){
        echo "<tr>";
        echo "<td>" . htmlentities($date['date']) . "</td>";
        echo "<td>
            <button class='volunteer' data-id='".$date['id']."'>Volunteer</button>
            </td>";
        echo "</tr>";
    }
echo "</tbody>";
echo "</table>";
?>

  <!-- Delete Admin -->
  <div class="modalContainer" id="volunteerModal">
        <form method="POST" action="volunteerHandler.php" class="formModal" id="volMod">
            <h1>Volunteer To Adopt A Meal!</h1>

            <label for="name"><b>Name/Orginization</b></label><br>
            <input type="text" placeholder="Enter Name/Orginization" name="name" required><br>

            <label for="email"><b>Email</b></label><br>
            <input type="text" placeholder="Enter Email" name="email" required><br>

            <label for="phone"><b>Phone</b></label><br>
            <input type="text" placeholder="Enter Phone Number" name="phone" required><br>

            <label for="description"><b>Meal Description</b></label><br>
            <textarea type="text" placeholder="Enter Meal Description" name="description" required></textarea><br>

            <label for="notes"><b>Meal Notes</b></label><br>
            <textarea type="text" placeholder="Enter Any Notes" name="notes" required></textarea><br>

            <label for="paper_goods"><b>Supplying Paper Goods?</b></label>
            <input type="checkbox" id="paper" name="paper"><br>

            <input type="hidden" name="id" value=""/>
            <button class="btn btn-danger" type="submit">Volunteer</button>
            <button type="reset" class="btn cancel" onclick="closeVolunteerModal()">Close</button>
        </form>
    </div>

    
    <div class="interfaith-row">
        <div class="col-sm-12 col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-body calendar-panel text-center">
                </div>
                <div class="panel-footer">

                    '<h4>Instructions:</h4>
                    <ol>
                        <li>Choose a date from the list above and click the volunteer button.</li>
                        <li>Fill out the form that opens with a your organization\'s name or your name, contact information, and some information about the meal that will be provided.
                            If you're unsure of the exact meal, please include that in the meal description and we will work with you!</li>
                        <li>Submit the form and staff at Interfaith Sanctuary will contact you once they've been notified of your request.</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center top-footer">
        <h1>Thank you for adopting a meal!</h1>
        <p>We would like to thank all the organizations who have volunteered for their wonderful contributions!</p>
    </div>
 <div class="interfaith-row">
<?php 
    include('footer.php'); 
?>
</div>
</body>

</html>
