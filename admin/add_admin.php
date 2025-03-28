<?php
session_start();  // connects with or starts a session if not already existing

require_once '../common/db_connect.php';  // include once the db connect functions
require_once '../common/admin_common.php';  // include ones the admin functions


if ($_SERVER['REQUEST_METHOD'] === 'POST'){  // if superuser doesn't exist and posted to this page
    try {
        if(only_user(dbconnect_select(), $_POST['username']) && reg_admin(dbconnect_insert(),$_POST)) { // Assuming $conn is your database connection
            $_SESSION['SUCCESS'] = $_POST['priv']." ADMIN REGISTERED";
            header("Location: index.php");
            exit; // Stop further execution
        } else {
            $_SESSION['ERROR'] = "ADD ADMIN FAIL, UNKNOWN ERROR";
            header("Location: onetimesuper.php");
            exit; // Stop further execution
        }
    }
    catch(Exception $e) {
        // Handle database error within reg_admin or here.
        $_SESSION['ERROR'] = "ADD ADMIN REG ERROR: ". $e->getMessage();
        header("Location: one_time_super.php");
        exit; // Stop further execution
    }
}

echo "<!DOCTYPE html>";

echo "<html lang='en'>";

echo "<head>";

echo "<link rel='stylesheet' href='../common/styles.css'>";

echo "<title> Add Admin</title>";

echo "</head>";

echo "<body>";

echo "<div id='container'>";

include_once "admin_title.php";

include_once "taadmin_nav.php";

echo "<div id='content'>";

echo admin_error($_SESSION);

echo "<h4> Bragging Rights - Add an Admin </h4>";

echo "<br>";

echo "<form method='post' action='add_admin.php'>";

echo "<input type='text' name='username' placeholder='Username' required><br>";

echo "<label for='user-role'>Select User Role:</label>";
echo "<select name='priv'>";
    echo "<option value='CREATOR'>Creator</option>";
    echo "<option value='EDITOR'>Editor</option>";
echo "</select><br>";

echo "<input type='submit' name='submit' value='Register'>";

echo "<br><br>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";