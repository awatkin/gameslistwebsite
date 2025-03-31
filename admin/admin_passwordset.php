<?php
session_start();  // start the session to access any sort of variables that might be about

require_once "../common/admin_common.php";
require_once "../common/db_connect.php";

if(!isset($_SESSION["pwdset"])){
    $_SESSION['ERROR'] = "Not authorised to be here";
    header("Location: index.php");
    exit; // Stop further execution
}
elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["pwdset"])){
    try {
        if($_POST['password'] == $_POST['cpassword']) {
            $conn = dbconnect_update();
            // Prepare and execute the SQL query
            $sql = "UPDATE admin SET password = ? WHERE admin_id = ?";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $hpswd = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $stmt->bindParam(1, $hpswd);  //bind parameters for security
            $stmt->bindParam(2, $_SESSION['admin_id']);

            $stmt->execute();  //run the query to insert
            $conn = null;  // closes the connection so cant be abused.

            $_SESSION['SUCCESS'] = "PASSWORD UPDATED";
            unset($_SESSION["admin_id"]);
            unset($_SESSION["pwdset"]);
            header("Location: admin_login.php");
            exit;

        } else {
            $_SESSION['ERROR'] = "Passwords do not match.";
            header("Location: admin_passwordset.php");
            exit;
        }
    }  catch (PDOException $e) {
        // Handle database errors
        error_log("Database error: " . $e->getMessage()); // Log the error
        throw new Exception("Database error". $e); //Throw exception for calling script to handle.
    } catch (Exception $e) {
        // Handle validation or other errors
        error_log("Registration error: " . $e->getMessage()); //Log the error
        throw new Exception("Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
    }

} else {

    echo "<!DOCTYPE html>";

    echo "<html lang='en'>";

    echo "<head>";
    echo "<link rel='stylesheet' href='../common/styles.css'>";
    echo "<title> ADMIN SET PASSWORD - Bragging Rights</title>";
    echo "</head>";

    echo "<body>";

    echo "<div id='container'>";

    include_once "admin_title.php";

    include 'taadmin_nav.php';

    echo "<div id='content'>";

    echo "<h4> Admin First Time Login - Set your password</h4>";

    echo "<br>";
    if (isset($_SESSION['pwdset'])) {
        echo "hello " . $_SESSION['pwdset'];
    } else {
        echo "no data here";
    }
    echo admin_error($_SESSION);

    echo "<br>";

    echo "<br>";

    echo "<form method='post' action='admin_passwordset.php'>";

    echo "<input type='password' name='password' placeholder='Password'><br>";

    echo "<input type='password' name='cpassword' placeholder='Confirm Password'><br>";

    echo "<input type='submit' name='submit' value='Set Password'><br>";

    echo "<br><br>";

    echo "</div>";

    echo "</div>";

    echo "</body>";

    echo "</html>";
}