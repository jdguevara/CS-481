<?php
    session_start();
    // $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    if (!$_SESSION['admin']) {
        header('Location: /index.php');
        exit;
    }
    require_once 'Dao.php';
    $dao = new Dao();
    $admins = $dao->getAdmins();
    $curId = $_SESSION['id'];
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
        <title>Adopt-A-Meal - Admin Home</title>
        <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico"/>

    </head>

    <body>
        <?php 
        include('adminNav.php'); 
        ?>
                        
        <?php if (isset($_SESSION['messages'])) {
            foreach ($_SESSION['messages'] as $message) {?>
                <div class="message <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
                    echo $message; ?></div><br>
            <?php  }
            unset($_SESSION['messages']);
            ?> </div>
        <?php } ?>

        <?php if (isset($_SESSION['messageSuccess'])) {
            foreach ($_SESSION['messageSuccess'] as $message) {?>
                <div class="messageSuccess <?php echo isset($_SESSION['validated']) ? $_SESSION['validated'] : '';?>"><?php
                    echo $message; ?></div><br>
            <?php  }
            unset($_SESSION['messageSuccess']);
            ?> </div>
        <?php } ?>

<div class ="addAdmin">
    <button class="btn" onclick="addAdminModal()">Add Admin</button>
    <?php
    if($_SESSION['super_user']){ 
       echo" <button class='btn' onclick='addSuperUserModal()'>Add Super User</button>";
    }
    ?>
</div>

<h1>Admins</h1>
<?php
echo "<table id='' class= 'display'>
<thead>
    <tr>
        <th align='left'>Username</th>
        <th align='left'>Email</th>
        <th align='left'>Permissions</th>
        <th align='left'>Manage</th>
    </tr>
</thead>";
echo "<tbody>";
foreach ($admins as $admin){
        echo "<tr>";
        echo "<td>" . htmlentities($admin['name']) . "</td>";
        echo "<td>" . htmlentities($admin['email']) . "</td>";
        if($admin['super_user']){
            echo "<td> Super Admin </td>";
        }
        else{
            echo "<td> Admin </td>";
        }
    if($curId != $admin['id'] && $_SESSION['super_user']){
        if(!$admin['super_user']){
            echo "<td>
            <button class='deleteAdmin' data-id='".$admin['id']."'>Delete</button>
            <button class='changePermission' data-id='".$admin['id']."'>Add Permissions</button>
            </td>";
        }
        else{
            echo "<td>
            <button class='deleteAdmin' data-id='".$admin['id']."'>Delete</button>
            </td>";
        }
        echo "</tr>";
    }
    else if($curId == $admin['id']){
        echo "<td>
        <button class='change' value='" . $admin['id']. "'>Change Password</button></td>";
        echo "</tr>";
    }
    else{
        echo "<td></td>";
        echo "</tr>";
    }
}
echo "</tbody>";
echo "</table>";
?>

    <!-- Change Password Modal -->
    <div class="modalContainer" id="changePasswordModal">
        <form method="POST" action="changePasswordHandler.php" class="formModal">
            <h1>Change Password</h1>

            <input type="password" placeholder="Enter Password" name="oldPassword" id="oldPassword" required><br>
            <span id='message'></span><br>
            <input type="password" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" required>
            <input type="password" placeholder="Enter New Password" name="newPassword" required><br>

            <button typer="submit" id="enter" class="enter btn">Change Password</button>
            <button type="reset" class="btn cancel" onclick="closeChangePasswordModal()">Close</button>
        </form>
    </div>

    <!-- Add Admin Modal -->
    <div class="modalContainer" id="addAdminModal">
        <form method="POST" action="addAdminHandler.php" class="formModal" id="addAdmin">
            <h1>Add Admin</h1>

            <label for="user"><b>Username</b></label><br>
            <input type="text" placeholder="Enter Username" name="username" required><br>

            <label for="email"><b>Email</b></label><br>
            <input type="text" placeholder="Enter Email" name="email" required><br>

            <label for="password"><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="password" required><br>

            <button type="submit" class="btn">Submit</button>
            <button type="reset" class="btn cancel" onclick="closeAddAdminModal()">Close</button>
        </form>
    </div>

    <!-- Add Super User Modal -->
    <div class="modalContainer" id="addSuperUserModal">
        <form method="POST" action="addSuperUserHandler.php" class="formModal" id="addAdmin">
            <h1>Add Super User</h1>

            <label for="user"><b>Username</b></label><br>
            <input type="text" placeholder="Enter Username" name="username" required><br>

            <label for="email"><b>Email</b></label><br>
            <input type="text" placeholder="Enter Email" name="email" required><br>

            <label for="password"><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="password" required><br>

            <button type="submit" class="btn">Submit</button>
            <button type="reset" class="btn cancel" onclick="closeAddSuperUserModal()">Close</button>
        </form>
    </div>

    <!-- Delete Admin -->
    <div class="modalContainer" id="deleteAdminModal">
        <form method="POST" action="adminDeleteHandler.php" class="formModal">
        <h1>ARE YOU SURE YOU WANT TO DELETE THIS ADMIN?</h1>
        <p class="text-warning"><small>This will delete entire record and this action cannot be undone.</small></p>

            <input type="hidden" name="id" value=""/>
            <button class="btn btn-danger" type="submit">Delete</button>
            <button type="reset" class="btn cancel" onclick="closeDeleteAdminModal()">Close</button>
        </form>
    </div>

    <!-- Change Permissions -->
    <div class="modalContainer" id="changePermissionModal">
        <form method="POST" action="changePermissionHandler.php" class="formModal">
        <h1>ARE YOU SURE YOU WANT TO GIVE ADMIN SUPER USER PERMISSIONS?</h1>
            <input type="hidden" name="change" value=""/>
            <button class="btn btn-danger" type="submit">Change</button>
            <button type="reset" class="btn cancel" onclick="closeChangePermissionModal()">Close</button>
        </form>
    </div>

    <?php 
        include('footer.php'); 
    ?>
    
    </body>






</html>

