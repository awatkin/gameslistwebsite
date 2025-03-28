<?php

//    if($_SESSION['admin_id'] != 3){
//
//        echo "<li><a href='add_game.php'>Add Game</a></li>";
//        echo "<li><a href='add_maker.php'>Add Maker</a></li>";
//        echo "<li><a href='add_dev.php'>Add Dev</a></li>";
//        echo "<li><a href='add_pub.php'>Add Pub</a></li>";
//        echo "<li><a href='add_format.php'>Add Format</a></li>";
//    }
//
//
//    echo "<li><a href='edit_game.php'>Edit Game</a></li>";
//    echo "<li><a href='edit_maker.php'>Edit Maker</a></li>";
//    echo "<li><a href='edit_dev.php'>Edit Dev</a></li>";
//    echo "<li><a href='edit_pub.php'>Edit Pub</a></li>";
//    echo "<li><a href='edit_format.php'>Edit Format</a></li>";
//
//}

echo "<nav>";

echo "<ul>";

echo "<li><a href='index.php'>Home</a></li>";

if(!isset($_SESSION['admin_id'])){
    echo "<li><a href='admin_login.php'>Login</a></li>";
}
echo "<li>";
      echo"<a href='#'>Consoles</a>";
      echo "<ul class='dropdown'>";
        echo "<li><a href='add_console.php'>Add Console</a></li>";
        echo "<li><a href='edit_console.php'>Edit Console</a></li>";
      echo "</ul>";
echo "</li>";
echo "<li><a href='admin_logout.php'>Logout</a></li>";

echo " </ul>";

echo "</nav>";