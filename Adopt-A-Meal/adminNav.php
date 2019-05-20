<?php
    if (!$_SESSION['admin']) {
        header('Location: /index.php');
        exit;
    }
?>

<head>
    <script type="text/javascript" src="js/modals.js"></script>
</head>

<html>
<body>
    <nav class="nav-bar navbar-default navbar-fixed-top" id="nav-shadow">
        <div class="navbar-header pull-left">
            <a class="navbar-brand" id="navbar-brand-padding" href="http://interfaithsanctuary.org/">
                <img class="brand" alt="Brand" id="navbar-brand-size" src="images/Interfaith-Temp-Logo.png">
            </a>
            <a class="navbar-brand" id="navbar-brand-font" href="home.php">Adopt a Meal</a>
        </div>
        <div class="collapse navbar-collapse pull-right" id="navigation">
            <ul class="nav navbar-nav">
                <li class="nav-item "><a class="navbar-link" href="adminManage.php">Manage Users</a></li>
                <li class="nav-item "><a class="navbar-link" href="adminMealIdeas.php">Meal Ideas</a></li>
                <li class="nav-item "><a class="navbar-link" href="adminVolunteer.php">Volunteer Requests</a></li>
                <li class="nav-item "><a class="navbar-link signOut" id="signOut" href="#">Sign Out</a></li>
            </ul>
        </div>
    </nav>

    <div class="modalContainer" id="signOutModal">
        <form method="POST" action="signOutHandler.php" class="formModal">
        <h1>DO YOU WANT TO SIGN OUT?</h1>
            <input type="hidden" name="id" value=""/>
            <button class="btn btn-danger" type="submit">Okay</button>
            <button type="reset" class="btn cancel" onclick="closeSignOutModal()">Close</button>
           
        </form>
    </div>

</body>
</html>
