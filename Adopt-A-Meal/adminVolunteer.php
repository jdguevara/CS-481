<?php
    session_start();
    // $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    if (!$_SESSION['admin']) {
        header('Location: /index.php');
        exit;
    }
    require_once 'Dao.php';
    $dao = new Dao();
    $vols = $dao->getVolunteers();
    $volsAcc = $dao->getVolunteers();
    $rds = $dao->getVolunteerDates ();
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/table.js"></script>
    <script type="text/javascript" src="js/date.js"></script>
    <script type="text/javascript" src="js/modals.js"></script>
    <script type="text/javascript" src="js/messageFade.js"></script>
    <link rel="stylesheet" type="text/css" href="css/interfaith.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.datatables.min.css">
    <title>Adopt-A-Meal - Admin Volunteer Management</title>
    <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico"/>
</head>

<body>

<?php 
    include('adminNav.php'); 
?>

<div class ="addAdmin">
    <button class="btn" onclick="addDateModal()">Add Volunteer Date</button>
    <button class="btn" onclick="removeDateModal()">Remove Volunteer Date</button>
</div>


<?php if (isset($_SESSION['messageSuccess'])) {
        foreach ($_SESSION['messageSuccess'] as $message) {?>
            <div class="messageSuccess <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
                echo $message; ?></div><br>
        <?php  }
        unset($_SESSION['messageSuccess']);
        ?> 
<?php } ?>

<h1> Pending Volunteer Requests </h1>
<?php


echo "<table id='example' class= 'display'>
<thead>
    <tr>
        <th align='left'>Organization</th>
        <th align='left'>Email</th>
        <th align='left'>Phone</th>
        <th align='left'>Meal Description</th>
        <th align='left'>Notes</th>
        <th align='left'>Paper Goods</th>
        <th align='left'>Date</th>
        <th align='left'>Status</th>
        <th align='left'>Accept/Reject</th>
    </tr>
</thead>";

echo "<tbody>";
foreach ($vols as $vol){
    if($vol['form_status'] == 0){
        echo "<tr>";
        echo "<td>" . htmlentities($vol['organization_name']) . "</td>";
        echo "<td>" . htmlentities($vol['email']) . "</td>";
        echo "<td>" . htmlentities($vol['phone']) . "</td>";
        echo "<td>" . htmlentities($vol['meal_description']) . "</td>";
        echo "<td>" . htmlentities($vol['notes']) . "</td>";
        if($vol['paper_goods'] == 0){
            echo "<td>" . "Not Providing" . "</td>";
        }
        else{
                echo "<td>" . "Will Provide" . "</td>";
        }
        
        echo "<td>" . htmlentities($vol['event_date_time']) . "</td>";
        echo "<td>" . "Pending" . "</td>";
        echo "<td><button class='volAcc' data-id='".$vol['id']."'>Accept</button>
             <button class='volRej' data-id='".$vol['id']."'>Reject</button></td>";
        echo "</tr>";
        
    }
}
echo "</tbody>";
echo "</table>";

?>

<h1> Accepted/Rejected Volunteer Requests </h1>
<?php

echo "<table id='example' class= 'display'>
<thead>
    <tr>
        <th align='left'>Organization</th>
        <th align='left'>Email</th>
        <th align='left'>Phone</th>
        <th align='left'>Meal Description</th>
        <th align='left'>Notes</th>
        <th align='left'>Paper Goods</th>
        <th align='left'>Date</th>
        <th align='left'>Status</th>
        <th align='left'>Delete/Restore</th>
    </tr>
</thead>";

echo "<tbody>";
foreach ($volsAcc as $vol){
    if($vol['form_status'] != 0){
        echo "<tr>";
        echo "<td>" . htmlentities($vol['organization_name']) . "</td>";
        echo "<td>" . htmlentities($vol['email']) . "</td>";
        echo "<td>" . htmlentities($vol['phone']) . "</td>";
        echo "<td>" . htmlentities($vol['meal_description']) . "</td>";
        echo "<td>" . htmlentities($vol['notes']) . "</td>";
        if($vol['paper_goods'] == 0){
            echo "<td>" . "Not Providing" . "</td>";
        }
        else{
                echo "<td>" . "Will Provide" . "</td>";
        }
        
        echo "<td>" . htmlentities($vol['event_date_time']) . "</td>";
        if($vol['form_status'] == 1){
            echo "<td>" . "Accepted" . "</td>";
        }
        else{
            echo "<td>" . "Rejected" . "</td>";
        }
        echo "<td>  <button class='volRestore' data-id='".$vol['id']."'>Restore</button>
                    <button class='volDelete' data-id='".$vol['id']."'>Delete</button></td>";
        echo "</tr>";
    }
}
echo "</tbody>";
echo "</table>";

    ?>


<div class="modalContainer" id="addDateModal">
<form method="POST" class="formModal" action="addDateHandler.php">
        <div class="nativeDatePicker">
        <label for="date">Enter New Volunteer Date:</label>
        <input type="date" id="date" name="date">
        <span class="validity"></span>
        </div>
        <p class="fallbackLabel">Enter your birthday:</p>
        <div id="fallbackDatePicker" class="fallbackDatePicker">
        <span>
            <label for="day">Day:</label>
            <select id="day" name="day">
            </select>
        </span>
        <span>
            <label for="month">Month:</label>
            <select id="month" name="month">
            <option selected>January</option>
            <option>February</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>June</option>
            <option>July</option>
            <option>August</option>
            <option>September</option>
            <option>October</option>
            <option>November</option>
            <option>December</option>
            </select>
        </span>
        <span>
            <label for="year">Year:</label>
            <select id="year" name="year">
            </select>
        </span>
        </div>
        <button typer="submit" id="enter" class="enter btn">Add Date</button>
        <button type="reset" onclick="closeAddDateModal()" class="btn cancel">Close</button>
    </form>
</div>

<div class="modalContainer" id="removeDateModal">
<form method="POST" class="formModal" action="removeDateHandler.php">
        <?php
        echo "<select name='removeDate'>";
        ?>
        <option value="">Date To Remove</option>
        <?php
        foreach ($rds as $rd) {
            echo "<option data-value='" . htmlentities($rd['date']) . "'>" . htmlentities($rd['date']) . "</option>";
            }
        echo "</select>";

        ?>
        <button type="submit" id="enter" class="enter btn">Remove Date</button>
        <button type="reset" onclick="closeRemoveDateModal()" class="btn cancel">Close</button>
    </form>
</div>

<div class="modalContainer" id="acceptVolunteerModal">
        <form method="POST" action="volunteerAcceptHandler.php" class="formModal" enctype="multipart/form-data">
        <h1>Accept This Volunteer</h1>
        <p class="text-warning"><small>This will remove volunteer date from list and send email notifiying volunteer their request has been accepted. Will also reject all other volunteers on same date.</small></p>
            <input type="hidden" name="accVol" value=""/>
            <button class="btn btn-danger" type="submit">Accept</button>
            <button type="reset" class="btn cancel" onclick="closeAcceptVolunteerModal()">Close</button>
        </form>
</div>

<div class="modalContainer" id="rejectVolunteerModal">
        <form method="POST" action="volunteerRejectHandler.php" class="formModal" enctype="multipart/form-data">
        <h1>Reject This Volunteer</h1>
        <p class="text-warning"><small>This will remove volunteer date from list and send email that request has been rejected</small></p>
            <input type="hidden" name="rejVol" value=""/>
            <button class="btn btn-danger" type="submit">Reject</button>
            <button type="reset" class="btn cancel" onclick="closeRejectVolunteerModal()">Close</button>
        </form>
</div>

 <div class="modalContainer" id="deleteVolunteerModal">
        <form method="POST" action="volunteerDeleteHandler.php" class="formModal" enctype="multipart/form-data">
        <h1>ARE YOU SURE YOU WANT TO DELETE THIS Volunteer?</h1>
        <p class="text-warning"><small>This will delete entire record and this action cannot be undone.</small></p>
            <input type="hidden" name="delVol" value=""/>
            <button class="btn btn-danger" type="submit">Delete</button>
            <button type="reset" class="btn cancel" onclick="closeDeleteVolunteerModal()">Close</button>
        </form>
</div>

<div class="modalContainer" id="restoreVolunteerModal">
    <form method="POST" action="volunteerRestoreHandler.php" class="formModal">
    <h1>ARE YOU SURE YOU WANT TO RESTORE THIS Volunteer?</h1>
    <p class="text-warning"><small>This will change status back to pending.</small></p>
        <input type="hidden" name="resVol" value=""/>
        <button class="btn btn-danger" type="submit">Okay</button>
        <button type="reset" class="btn cancel" onclick="closeRestoreVolunteerModal()">Close</button>
    </form>
</div>

    
<?php 
    include('footer.php'); 
?>
</div>
</body>


</html>
