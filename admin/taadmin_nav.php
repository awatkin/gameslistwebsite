<?php

echo "<div id='nav'>";


echo "<table border='0'>"; // start table

echo "<tr id='navtitle'>";  // row of headers
            echo "<td></td>";  // empty for gap filling
            echo "<td></td>"; // empty for gap filling
            if(isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
                echo "<td> Admin </td>";
            }
            echo "<td> Console </td>";
            echo "<td> Game </td>";
            echo "<td> Maker </td>";
            echo "<td> Dev </td>";
            echo "<td> Pub </td>";
            echo "<td> Format </td>";
            echo "<td> Requests (".get_requests_num(dbconnect_select()).")</td>";
echo "</tr>";



echo "<tr>";  // row for home, login and ADD

    echo "<td></td>";  // empty for gap filling
    echo "<td></td>"; // empty for gap filling

if(isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
        echo "<td><a href='add_admin.php'>Add Admin</a></td>";
    }
    if(isset($_SESSION['admin_id']) && $_SESSION['admin_id'] != 3) {
        echo "<td><a href='add_console.php'>Add Console</a></td>";
        echo "<td><a href='add_game.php'>Add Game</a></td>";
        echo "<td><a href='add_maker.php'>Add Maker</a></td>";
        echo "<td><a href='add_dev.php'>Add Dev</a></td>";
        echo "<td><a href='add_pub.php'>Add Pub</a></td>";
        echo "<td><a href='add_format.php'>Add Format</a></td>";
    }
echo "</tr>";

echo "<tr>";  // row for home, login and edit
    echo "<td><a href='index.php'>Home</a></td>";
    if(!isset($_SESSION['admin_id'])){
        echo "<td><a href='admin_login.php'>Login</a></td>";
    } else {
        echo "<td><a href='admin_logout.php'>Logout</a></td>";
    }
if(isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    echo "<td><a href='delete_admin.php'>Delete Admin</a></td>";
}// empty for gap filling
    if(isset($_SESSION['admin_id'])){

        echo "<td><a href='edit_console.php'>Edit Console</a></td>";
        echo "<td><a href='edit_game.php'>Edit Game</a></td>";
        echo "<td><a href='edit_maker.php'>Edit Maker</a></td>";
        echo "<td><a href='edit_dev.php'>Edit Dev</a></td>";
        echo "<td><a href='edit_pub.php'>Edit Pub</a></td>";
        echo "<td><a href='edit_format.php'>Edit Format</a></td>";
        echo "<td><a href='sort_requests.php'>Sort Requests</a></td>";
}

echo "</tr>";

echo "</table>";

echo "</div>";