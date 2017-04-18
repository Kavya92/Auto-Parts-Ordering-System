<?php

$host ="localhost";
$username = "root";
$password = "";
$database = "orderingsystem";
$table ="abc";
$con = mysqli_connect('localhost','root','');

//Make your connection to database
//$con = mysql_connect($host,$username,$password);

//Check your connection
if (!$con) {
die("Could not connect: " . mysql_error());
}

//Select your database
$db_selected = mysqli_select_db($con,$database);

//Check to make sure the database is there
if (!$db_selected) {
    die ('Can\'t use the db : ' . mysql_error());
}

//Run query
$result = mysqli_query($con,"INSERT INTO abc(productID,price) VALUES('2','2')");

//Check Query
if (!$result) {
die("lid query: " . mysql_error());
}
echo "Data inserted";

mysqli_close($con);
?>
