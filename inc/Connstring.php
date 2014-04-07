<?php
/*---------------
constring.php
include file for connecting to databas.
------------------*/

$mysqli = new mysqli('localhost', 'root', 'primax', 'userdb'); // (HOST, USER, PASSWORD, DATABASE) 

if (mysqli_connect_error()) { 
 	echo "Connect failed: " . mysqli_connect_error() . "<br>"; 
 	exit(); 
} 

$mysqli->set_charset("utf8");
 
?>