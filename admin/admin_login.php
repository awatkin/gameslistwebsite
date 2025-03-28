<?php

session_start();  // start the session to access any sort of variables that might be about

require_once "../common/admin_common.php";
require_once "../common/db_connect.php";

if (isset($_SESSION['admin_id'])){
    $_SESSION['ERROR'] = "Admin already logged in";
    header("Location: index.php");
    exit; // Stop further execution
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){  // if superuser doesn't exist and posted to this page
    try {  //try this code, catch errors

        $conn = dbconnect_select();
        $sql = "SELECT admin_id, password, priv FROM admin WHERE username = ?"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->bindParam(1,$_POST['username']);  //binds the parameters to execute
        $stmt->execute(); //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        $conn = null;  // nulls off the connection so cant be abused.

        if($result){  // if there is a result returned

            if (password_verify($_POST["password"], $result["password"])) { // verifies the password is matched
                $_SESSION["admin_id"] = $result['admin_id'];  // sets up the session variables
                $_SESSION["priv"] = $result["priv"];
                $_SESSION['SUCCESS'] = "Admin Successfully Logged In";
                header("location:index.php");  //redirect on success
                exit();

            } else{
                $_SESSION['ERROR'] = "Admin login passwords not match";
                header("Location: admin_login.php");
                exit; // Stop further execution
            }

        } else {
            $_SESSION['ERROR'] = "Admin user not found";
            header("Location: admin_login.php");
            exit; // Stop further execution

        }

    } catch (Exception $e) {
        $_SESSION['ERROR'] = "Admin login".$e->getMessage();
        header("Location: admin_login.php");
        exit; // Stop further execution
    }
}

echo "<!DOCTYPE html>";

echo "<html lang='en'>";

echo "<head>";
echo "<link rel='stylesheet' href='../common/styles.css'>";
echo "<title> ADMIN Login - Bragging Rights</title>";
echo "</head>";

echo "<body>";

echo "<div id='container'>";

include_once "admin_title.php";

include 'taadmin_nav.php';

echo "<div id='content'>";

echo "<h4> Admin Login</h4>";

echo "<br>";
echo admin_error($_SESSION);

echo "<br>";

echo "Use the links above to complete the tasks needed. ";
echo "<br>";
echo "<br>";

echo "<form method='post' action='admin_login.php'>";

echo "<input type='text' name='username' placeholder='username' required><br>";

echo "<input type='password' name='password' placeholder='Password'><br>";

echo "<input type='submit' name='submit' value='Login'>";

echo "<br><br>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";