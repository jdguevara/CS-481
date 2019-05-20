<?php
session_start();
?>

<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/adminLogin.js"></script>
    <script type="text/javascript" src="js/messageFade.js"></script>
    <link rel="stylesheet" type="text/css" href="css/interfaith.css">
    <title>Adopt-A-Meal - Admin Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico"/>
</head>

<body>
    <?php include('nav.php'); ?>

    <?php if (isset($_SESSION['messages'])) {
    foreach ($_SESSION['messages'] as $message) {?>
        <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
        echo $message; ?></div>
    <?php  }
    unset($_SESSION['messages']);
    ?> </div>
    <?php } ?>

    <form id="login" method="post" action="loginHandler.php" enctype="multipart/form-data">
    <h2> ADMIN LOGIN </h2>
    <div id="login">
        <label for="username"><b>Username</b></label><br>
        <input type="text" id="ip2" placeholder="Enter Username"  value="<?php echo isset($_SESSION['presets']['username']) ? $_SESSION['presets']['username'] : ''; ?>" name="username" required><br>

        <label for="password"><b>Password</b></label>
        </br>
        <input type="password" id="ip2" placeholder="Enter Password"  value="<?php echo isset($_SESSION['presets']['password']) ? $_SESSION['presets']['password'] : ''; ?>" name="password" required>
        </br>
        <button type="submit">Login</button>
        <button type="reset" class="cancelbtn">Cancel</button>
    </div>
    <div id="bottom_login">
        <!-- <a class="forgot-password-link" onclick="openForm()">
            <p>Forgot Password</p>
        </a>

        <a id="createAccount" href="signup.php">
            <p id="secondaryLink">Create Account</p>
        </a> -->
    </div>
    </form>

    <div class="form-popup" id="forgot-password-form">
        <form action="forgotPassword.php" class="form-container">
            <h1>Forgot Password</h1>

            <label for="user"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <button type="submit" class="btn">Retrieve Password</button>
            <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>

    <div id="footer">
        <footer>
            <li id="first">© 2019 Interfaith Sanctuary</li>
            <li>Contact Admin: <a id="adminEmail" href="mailto: ">TODO</a></li>
        </footer>
    </div>

    
</body>
</html>
