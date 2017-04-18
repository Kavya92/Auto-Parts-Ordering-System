<html>
<head>
<title> Karaoke Interface </title>
</head>
<body  bgcolor="#0099CC">
<h1><font face = "segoe UI" align = "Center">Karaoke Interface</font></h1>
<?php
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
	$query = "SELECT u.userName,s.songName,s.version,c.contributorName,c1.contribution,q.type,a.period FROM added a
				JOIN song s ON a.songID = s.songID
				JOIN contribution c1 ON a.songID = c1.songID
				JOIN contributor c ON c1.contributorID = c.contributorID
				JOIN queue q ON a.queueID=q.queueID
				JOIN user u ON a.userID = u.userID;";
	$res = mysqli_query($conn,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
	  echo '<table border = 1 cellpadding="10"  width="70%">';
	  echo "<th> Requested By </th>";
	  echo "<th> Song </th>";
	  echo "<th> Version </th>";	  
	  echo "<th> Artist Name </th>";
	  echo "<th> Contribution </th>";
	  echo "<th> Type </th>";
	  echo "<th> Added on </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";	
			echo "<td>". $cRow['4']."</td>";	
			echo "<td>". $cRow['5']."</td>";	
			echo "<td>". $cRow['6']."</td>";				
			echo "</tr>";
		}
		echo "</table>";
	}	
 ?>
</body>
</html>