<?php

$link = new mysqli('p:blitz.cs.niu.edu','db5user','db5password','dbgradfive');
//$link = new PDO("mysql:blitz.cs.niu.edu;dbname=dbgradfive",'db5user','db5password');

if(!$link){
	
die('Could not connect to the local host'.mysql_error());
}
//$db = "csci467";
//$db_selected = mysqli_select_db($link,$db);
?>