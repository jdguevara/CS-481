<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
    <link rel="stylesheet" type="text/css" href="css/interfaith.css">
    <title>Adopt-A-Meal - Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico"/>
</head>

<?php 
    include('nav.php'); 
?>

<form method="post" action="/loginhandler.php" enctype="multipart/form-data">
<h2> ADMIN LOGIN </h2>
<div id="login">
  <label for="username"><b>Username</b></label><br>
  <input type="text" id="ip2" placeholder="Enter Username"  value="<?php echo isset($_SESSION['presets']['username']) ? $_SESSION['presets']['username'] : ''; ?>" name="username" required><br>

  <label for="password"><b>Password</b></label><br>
  <input type="password" id="ip2" placeholder="Enter Password"  value="<?php echo isset($_SESSION['presets']['password']) ? $_SESSION['presets']['password'] : ''; ?>" name="password" required><br>
      
  <button type="submit">Login</button>
  <button type="reset" class="cancelbtn">Cancel</button>
</div>

<div id="bottom_login">
  
</div>
</form>

<?php 
    include('footer.php'); 
?>

</html>