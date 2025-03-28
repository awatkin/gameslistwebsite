<?php

session_start();  // start the session to access any sort of variables that might be about

require_once "../common/admin_common.php";
require_once "../common/db_connect.php";

echo "<!DOCTYPE html>";

echo "<html lang='en'>";

echo "<head>";
echo "<link rel='stylesheet' href='../common/styles.css'>";
echo "<title> ADMIN - Bragging Rights</title>";
echo "</head>";

echo "<body>";

echo "<div id='container'>";

include_once "admin_title.php";

include 'taadmin_nav.php';

echo "<div id='content'>";

echo "<h4> Admin System</h4>";

echo "<br>";
echo admin_error($_SESSION);

echo "<br>";

echo "Use the links above to complete the tasks needed. ";
echo "<br>";
echo "<br>";


echo "<br><br>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";