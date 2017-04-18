<html>
<body>
<form action="UserInterface.php" method="post">
 Enter a search item : <input  type = "text" name = "searchItem">
<input type  = submit  value = "Search Books">
</form>
<?php
isset($_POST['submit']);
 if(isset($_POST['searchItem']))   
 {    
     $Search = $_POST['searchItem'];   
 } 
 //$hostName = "turing.cs.niu.edu"; //name of the server
 $hostName = "localhost"; //name of the server
 //$username = "z1634207"; //id of the user
 $username = "root"; //id of the user
 //$password = "BEORN@93"; //password of the user
 $password = " "; //password of the user
 //$db = "z1634207"; //name of the databa
 $db = "karaoke"; //name of the databa

 //connect to the mysql server
  //$conn = mysqli_connect($hostName, $username, $password,$db);
  $conn = mysqli_connect('localhost', 'root','' ,'karaoke');

 //check for unsuccessful server connection
   if (!$conn) 
    {
     die('Could not connect:' . mysql_error());
    }

  //connect to the database
  mysqli_select_db($conn,"karaoke")  or die("cannot select DB") ;
  // $db_selected = mysql_select_db($conn,"karaoke");

  //check for unsuccessful connection
 
 //define the sql statement 
  //$sql  = "SELECT contributorName, songName, Version# FROM Karaoke WHERE songName = 'song' ";
  $sql  = "SELECT b.songName,c.contributorName,a.contribution,b.version,a.contribution FROM contribution a 
			JOIN song b ON a.songID=b.songID JOIN contributor c ON a.contributorID=c.contributorID;";
   
 //query the database
 //obtain the result set
 $result = mysqli_query($conn,$sql);

 //get in the result set
 $numrows = mysqli_num_rows($result);

  //create table in html for display on screen
  echo '<table border = 1 cellpadding="10"  width="50%">';
  echo "<th> Song </th>";
  echo "<th> Artist Name </th>";
  echo "<th> Contribution </th>";
  echo "<th> Version </th>";
 for($i=0;$i<$numrows;$i++)
  {
   //display info in table
   $row = mysqli_fetch_array($result);
   
   //fetch a row in the result set; 
     echo "<tr>";
     echo "<td>". $row['0'];
	 echo "<td>". $row['1'];
	 echo "<td>". $row['2'];
	 echo "<td>". $row['3'];
     echo "</tr>";
 
  }//end for

echo'</table>';

//close the connection to the database
mysqli_close($conn); 
?>

<h1>Karaoke Night!</h1>
<p>Pick A Song</p>
<form method = "post">

<p> Song:
<input type = "text" name = "song" size = "20"/>
</p>

<p> Artist:
<input type = "text" name ="art" size = "20"/>
</p>

<p>Choose a queue: <br/>

Accelerated
<input type = "input" name = "aqueue" value = "paid" />

Free
<input type = "input" name = "fqueue value = "unpaid" />
</p>

<p>
<input type = "submit" value = "Submit to queue" />
<input type = "reset" value = "Clear" /> 
</p>
</form>
</body>
</html> 