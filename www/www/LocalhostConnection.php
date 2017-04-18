<?php
$link = mysqli_connect('blitz.cs.niu.edu:3306','db5user','db5password','dbgradfive');

if(!$link){
die('Could not connect to the local host'.mysql_error());
}

$db = "dbgradfive";
$db_selected = mysqli_select_db($link,$db);
?>