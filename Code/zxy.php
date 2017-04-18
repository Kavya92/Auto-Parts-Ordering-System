<?php
//$link = mysqli_connect('hopper.cs.niu.edu','z1786900','1991Jun23','z1786900');
//$link = mysqli_connect('blitz.cs.niu.edu:3306','student','student','csci467');
//$dataLink = mysqli_connect('blitz.cs.niu.edu:3306','db5user','db5password','dbgradfive');
$host = 'students';
$user = 'z1787482';
$password = '1994Jun15';
$db = 'z1787482';
$conn = new PDO("mysql:blitz.cs.niu.edu:3306;dbname=csci467",'student','student');
if(!$conn){
die('Could not connect to the legacy database'.mysql_error());
}
else
{
	echo 'connected';
}
//if(!$dataLink){
//die('Could not connect to the system database'.mysql_error());
//}
//mysqli_close($dataLink);
mysqli_close($link);
?>