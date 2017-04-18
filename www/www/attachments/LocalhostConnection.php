<?php
$link = mysqli_connect('localhost','root','','orderingsystem');

if(!$link){
die('Could not connect to the local host'.mysql_error());
}

$db = "orderingsystem";
$db_selected = mysqli_select_db($link,$db);
?>