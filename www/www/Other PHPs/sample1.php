<html>
<head>
<title> Karaoke Interface </title>
</head>
<body bgcolor="#0099CC">
<h1><font face = "segoe UI" align = "Center">User Interface</font></h1>
<form action="sample1.php" method="post">
 Search Text : <input  type = "text" name = "searchSong"> <p> Enter either a song name or an artist name to see the list!!!!</p>
<input type  = submit  value = "Search Song">
</form>
<?php
$searchSong = null;
isset($_POST['submit']);
 if(isset($_POST['searchSong']))   
 {    
     $searchSong = $_POST['searchSong'];   
 } 
 
 $hostName = "localhost"; //name of the server
 $username = "root"; //id of the user
 $password = ""; //password of the user
 $db = "karaoke"; //name of the databa

 //connect to the mysql server
  $conn = mysqli_connect($hostName, $username, $password,$db);
  //$conn = mysqli_connect('students', 'z1754930','19930612' ,'z1754930');

 //check for unsuccessful server connection
   if (!$conn) 
    {
     die('Could not connect:' . mysql_error());
    }

 if($searchSong == NULL)
 { 
	$query = "SELECT b.songName,c.contributorName,a.contribution,b.version,a.contribution FROM Contribution a 
			JOIN Song b ON a.songID=b.songID JOIN Contributor c ON a.contributorID=c.contributorID;";
	$res = mysqli_query($conn,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
	  echo '<table border = 1 cellpadding="10"  width="50%">';
	  echo "<th> Song </th>";
	  echo "<th> Artist Name </th>";
	  echo "<th> Contribution </th>";
	  echo "<th> Version </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";		
			echo "</tr>";
		}
		echo "</table>";
	}	
 }
 else
 {
	$query = "SELECT b.songName,c.contributorName,a.contribution,b.version,a.contribution FROM Contribution a 
			JOIN Song b ON a.songID=b.songID JOIN Contributor c ON a.contributorID=c.contributorID
			WHERE b.songName LIKE '%".$searchSong."%' OR c.contributorName LIKE '%".$searchSong."%';";	 
	$res = mysqli_query($conn,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
	  echo '<table border = 1 cellpadding="10"  width="50%">';
	  echo "<th> Song </th>";
	  echo "<th> Artist Name </th>";
	  echo "<th> Contribution </th>";
	  echo "<th> Version </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";		
			echo "</tr>";
		}
		echo "</table>";
	}	
 }
//close the connection to the database
mysqli_close($conn); 
?>
<center><h1>Karaoke Night!</h1>

<h3>Pick A Song</h3>
<form method = "post">

<p> Song:
<input type = "text" name = "song" size = "20"/>
</p>

<p> Artist:
<input type = "text" name ="art" size = "20"/>
</p>
<br>
<p> User ID:
<input type = "text" name ="user" size = "20"/>
</p>
<br>
<p><h3>Select Queue:</h3> 
<h4>
<input type="radio" name="queue" value="paid" > Accelerated
<input type="radio" name="queue" value="unpaid" > Free
</h4>
</p>


<p>
<button type="submit" name = "AddSong">Submit</button>
<input type = "reset" value = "Clear" /> 
</p>
</form>
<?php
if(isset($_POST['AddSong']) && isset($_POST['art']) && isset($_POST['song']) && isset($_POST['queue']))
{
	$Artist = $_POST['art'];
$Song = $_POST['song'];
 $hostName = "localhost"; //name of the server
 $username = "root"; //id of the user
 $password = ""; //password of the user
 $db = "karaoke"; //name of the databa

 //connect to the mysql server
  $conn = mysqli_connect($hostName, $username, $password,$db);
  //$conn = mysqli_connect('students', 'z1754930','19930612' ,'z1754930');

 //check for unsuccessful server connection
   if (!$conn) 
    {
     die('Could not connect:' . mysql_error());
    }
	$insertQueue = "INSERT INTO queue(type) VALUES('".$_POST['queue']."');";
	$ins = mysqli_query($conn,$insertQueue);
    $getContributorID = "SELECT contributorID FROM contributor WHERE contributorName = '".$Artist."';";
	$res = mysqli_query($conn,$getContributorID);
	$cRow = mysqli_fetch_array($res);
	$getSongID = "SELECT s.songID FROM song s JOIN contribution c ON s.songID = c.songID WHERE s.songName = '".$Song."' AND c.contributorID =".$cRow['0'].";";
	$res2 = mysqli_query($conn,$getSongID);
	$cRow1 = mysqli_fetch_array($res2);	
	$insertSong = "INSERT INTO added(period,userID,songID,queueID) VALUES (NOW(),".$_POST['user'].",".$cRow1['0'].",".$cRow['0'].");";
	$res3 = mysqli_query($conn,$insertSong);
	if($res3)
	{
		echo 'Song successfully added to queue';
	}
}
else
{
	echo 'Please fill the above form';
}
?>
</script>
</center>
</body>
</html> 