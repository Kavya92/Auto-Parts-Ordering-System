<!--
	Nitish Achunala z1757564
	Kyle Cornelius z1692822
	Anil Murahari z1759385
	Alex Njaastad z1671654
	CSCI 466- SEC 02- Group Project 2- Group 3 
	TA: Sweta Thota
	04/22/2015
	
	This page establishes connection with the Karaoke database.
	
	The first half of the page contains the 'User Interface' and allows 
	a user to search for a song by either Artist Name, 
	Song Title, or Contributor Last Name. The page returns a table from 
	the database containing all relevant(to the user) information tied to 
	any songs that met the search criteria. A user can click a button to add 
	song to the normal or accelerated queue. These users are intended to be visitors of a bar.
	
	The second half of the page contains the 'DJ Interface' and displays all songs
	in each of the two queues- normal and accelerated. All relevant information about
	the song and its placement in the queue are displayed to the user. These users
	are intended to be bar DJs.
-->
<!DOCTYPE HTML PUBLIC>
<html>
	<head>
		<title>SEC 02- GROUP 3- Group Project 2</title>
		<center>
			Nitish Achunala z1757564<br/>
			Kyle Cornelius z1692822<br/>
			Anil Murahari z1759385<br/>
			Alex Njaastad z1671654<br/>	
			CSCI 466 SEC 02 GROUP 3<br/>
			TA: Sweta Thota <br/>
			04/22/2015 <br/><br/>
		</center>
	</head>
	<body bgcolor="grey">
		<br /><br />
		
		<?php //connect
		$hostName = "courses"; //name of the server
		$username = "z1671654"; //id of the user
		$password = "19940417"; //password of the user
		$db = "z1671654"; //name of the database    	***********CHANGE TO YOUR OWN ZID************
		
		//connect to the mysql server
		$conn = mysql_connect($hostName, $username, $password);
		//check for unsuccessful server connection
		if (!$conn) {
			die('Could not connect: ' . mysql_error());
		}
		
		//connect to the database
		$db_selected = mysql_select_db($db,$conn);
		//check for unsuccessful connection
		if (!$db_selected) { die ("Can\'t use database: " . $db . mysql_error());
		}
		else {
			echo '<center><b>*Connected to -'.$db.'- Database*<br/><br/></b></center>';
		}		
		?>
		
		<br />
		
		<center><h1> USER INTERFACE</h1></center> <br/>
		<center><b>Search for a Song by Artist Name, Song Title, or Contributor-<br/>
					Then Select a Song (By Clicking the File ID)to Add to Queue<br/>
					Be Sure To Specify Your User ID and Queue Type!</b> <br /></center>
		<form method="post" action="466GP2.php"> <!-- form -->
			
			<p>
			Artist Name: 
			<input type="text" name="artistName" size="20" />
			<input type="submit" value="Search By Artist Name" name="submit1AN"/>
			</p>
			
			<p>
			Song Title: 
			<input type="text" name="songTitle"" size="20" />
			<input type="submit" value="Search By Song Title" name="submit1ST"/>
			</p>
			
			<p>
			Contributor Name: 
			<input type="text" name="contName" size="20" />
			<input type="submit" value="Search By Contributor Name" name="submit1CN"/>
			</p>
			
		</form>
		
		<?php
	        $searchtype1 = $_GET["searchtype"];
			$searchval1 = $_GET["searchval"];		
		function UserInterface($searchtype, $searchval) //user interface- only show after user submits something
		{
			//anil changes
			$searchtype1 = $_GET["searchtype"];
			$searchval1 = $_GET["searchval"];
			//Sort logic starts 
			$field='KaraokeID';
			$sort='ASC';
			if(isset($_GET['sorting']))
			{
				if($_GET['sorting']=='ASC')
				{
				$sort='DESC';
				}
				else
				{
				$sort='ASC';
				}
			}
			//sort logic ends
			if($_GET['field']=='KaraokeID')
			{
			$field = "KaraokeID"; 
			}
			elseif($_GET['field']=='SongTitle')
			{
			$field = "SongTitle";
			}
			elseif($_GET['field']=='VersionNum')
			{
			$field="VersionNum";
			}
			elseif($_GET['field']=='ArtistName')
			{
			$field="ArtistName";
			}
			
			//anil changes ends
			//table 1
			#select song info by...
			if(isset($_POST['submit1AN'])) { //...Artist Name
				$sql1 = "SELECT K.KaraokeID, S.SongTitle,S.VersionNum,A.ArtistName 
						FROM Song S, Artist A, KaraokeFile K
						WHERE S.ArtistID = A.ArtistID 
						AND A.ArtistName = '".$_POST["artistName"]."'
						AND K.SongID = S.SongID";
			}
			else if(isset($_POST['submit1ST'])) { //...Song Title
				$sql1 = "SELECT K.KaraokeID, S.SongTitle,S.VersionNum,A.ArtistName
						FROM Song S, Artist A, KaraokeFile K
						WHERE S.ArtistID = A.ArtistID 
						AND S.SongTitle= '".$_POST["songTitle"]."'
						AND K.SongID = S.SongID";
			}
			else { 										//...Contributor Name
				$sql1 = "SELECT K.KaraokeID, S.SongTitle,S.VersionNum,A.ArtistName, CT.ContributorType
						FROM Song S, Artist A, Contributor C, Contributesto CT, KaraokeFile K
						WHERE C.ContributorName = '".$_POST["contName"]."'
							AND C.ContributorID = CT.ContributorID
							AND CT.SongID = S.SongID
							AND S.ArtistID = A.ArtistID
							AND K.SongID = S.SongID";
			}
			//Below code will be execured on click of table header only
						if($searchtype1 == 1) { //...Artist Name
				$sql1 = "SELECT K.KaraokeID, S.SongTitle,S.VersionNum,A.ArtistName 
						FROM Song S, Artist A, KaraokeFile K
						WHERE S.ArtistID = A.ArtistID 
						AND A.ArtistName = '".$searchval1."'
						AND K.SongID = S.SongID ORDER BY $field $sort";
			}
			else if($searchtype1 == 2) { //...Song Title
				$sql1 = "SELECT K.KaraokeID, S.SongTitle,S.VersionNum,A.ArtistName
						FROM Song S, Artist A, KaraokeFile K
						WHERE S.ArtistID = A.ArtistID 
						AND S.SongTitle= '".$searchval1."'
						AND K.SongID = S.SongID ORDER BY $field $sort";
			}
			else if($searchtype1 == 3) { 										//...Contributor Name
				$sql1 = "SELECT K.KaraokeID, S.SongTitle,S.VersionNum,A.ArtistName, CT.ContributorType
						FROM Song S, Artist A, Contributor C, Contributesto CT, KaraokeFile K
						WHERE C.ContributorName = '".$searchval1."'
							AND C.ContributorID = CT.ContributorID
							AND CT.SongID = S.SongID
							AND S.ArtistID = A.ArtistID
							AND K.SongID = S.SongID ORDER BY $field $sort";
			}
			
				
			$result1 = mysql_query($sql1); //query results
			$numrows1 = mysql_num_rows($result1); //number of rows
			?>
			<form method="post" action="466GP2.php">
				<p>Select UserID
				<select name = "userIDs">
						<?php
							#select all userIDs
							$sql4 = "SELECT U.UserID FROM User U";
		 
							$result4 = mysql_query($sql4); //query results
							$numrows4 = mysql_num_rows($result4); //number of rows
						?>
						
						<?php
						for($i=0;$i<$numrows4;$i++) //add all userIDs to the select form
						{
						$row4=mysql_fetch_array($result4);
						?>
							<option value="<?php echo ''.($row4[0]).'';?>"> <?php echo ''.($row4[0]).'';?></option>
						<?php
						}
						?>
				</select>
				</p>
				
				<p>Accelerate? | n = No | y = Yes | e = Extreme Yes (Costs Extra)|
				<select name="isAccel">					
					<option value="n">n</option> <!--Goes into normal Queue-->
					<option value="y"selected="selected">y</option><!--Goes into Acc Queue-->
					<option value="e">e</option> <!-- Goes at TOP of Acc Queue -->
				</select>
				</p>
			<?php
			echo '<b>Search Results:</b>';
			//create table in html for display on screen
			echo '<table border="1" bgcolor="white" cellpadding="1" cellspacing="1">';
			echo '<tr>';
			echo '<th><a href = "466GP2.php?sorting='.$sort.'&searchval='.$searchval.'&searchtype='.$searchtype.'&field=KaraokeID">','Karaoke ID','</a></th>';
			echo '<th><a href = "466GP2.php?sorting='.$sort.'&searchval='.$searchval.'&searchtype='.$searchtype.'&field=SongTitle">','Song Title','</a></th>';
			echo '<th><a href = "466GP2.php?sorting='.$sort.'&searchval='.$searchval.'&searchtype='.$searchtype.'&field=VersionNum">','Version Number','</a></th>';
			echo '<th><a href = "466GP2.php?sorting='.$sort.'&searchval='.$searchval.'&searchtype='.$searchtype.'&field=ArtistName">','Artist Name','</a></th>';
			if(isset($_POST['submit1CN'])) { echo '<th>','Contribution Type','</th>';} //only display if search by contributor
			echo '</tr>';
			
			for($i=0;$i<$numrows1;$i++)
			{//display info in table
			echo '<tr>';
			//fetch a row in the result set
			$row1=mysql_fetch_array($result1);
			echo '<td><input type="submit" value="'.($row1[0]).'" name="submitK" /></td>';
			echo '<td>',($row1[1]),'</td>';
			echo '<td>',($row1[2]),'</td>';
			echo '<td>',($row1[3]),'</td>';
			if(isset($_POST['submit1CN'])) { echo '<td>',($row1[4]),'</td>';} //only display if search by contributor
			echo '</tr>';
			}//end for
			echo '</table><br/><br/>';
			
			
		}	
        if(isset($_POST['submit1AN']))
		{
		$searchtype = 1;
		}
		else if(isset($_POST['submit1ST']))
		{
		$searchtype = 2;
		} 
		else if(isset($_POST['submit1CN']))
		{
		$searchtype = 3;
		}
 
            $searchtype1 = $_GET["searchtype"]; // Reading the values from the URL on click of table header
			$searchval1 = $_GET["searchval"]; //Reading the values from the URL on click of table header
		if($searchtype ==1 || $searchtype1 ==1)  //Artist Name UserInterface should be called on click of table header as well
		{
		if($_POST['artistName'] != '')
		{
		$searchval = $_POST['artistName'];
		}
		if($searchtype1 != '')
		{
			$searchval = $searchval1;
			$searchtype = $searchtype1; 
		}
		UserInterface($searchtype, $searchval);
		
		}
		else if($searchtype == 2||$searchtype1 ==2) //Song Title UserInterface should be called on click of table header as well
		{
		//$searchval = $_POST['submit1ST'];
		if($_POST['submit1ST'] != '')
		{
		$searchval = $_POST['songTitle'];
		}
		if($searchtype1 != '')
		{
			$searchval = $searchval1;
			$searchtype = $searchtype1; 
		}
		UserInterface($searchtype, $searchval);
		} 
		else if($searchtype == 3||$searchtype1 == 3) //Contributor Name UserInterface should be called on click of table header as well
		{
		//$searchval = $_POST['submit1CN'];
		if($_POST['submit1CN'] != '')
		{
		$searchval = $_POST['contName'];
		}
		if($searchtype1 != '') // on resubmiting the form searchval gets nullfied to avoid this i'm assigning values again
		{
			$searchval = $searchval1;
			$searchtype = $searchtype1; 
		}
		UserInterface($searchtype, $searchval);
		} 

		?>
		
		
		</form>
		<?php
		if(isset($_POST['submitK']) ) //add song to queue if user selects one
		{
			addtoQueue();
		}
		?>
		
		<?php
		function addtoQueue()
		{
			
			$KID = $_POST["submitK"]; //KaraokeID
			$UID = $_POST["userIDs"]; //UserID			
			$RT = date('Y/m/d H:i:s');	//Date-Time
			$A = $_POST["isAccel"]; //Accelerated?
				
			//add to Queue table
			mysql_query("INSERT INTO Queue(Accelerated) 
			VALUES ('$A')");
			
			#select max queueID- Get last created QueueID
			$sqlQ = "SELECT MAX(QueueID) FROM Queue";
			$resultQ = mysql_query($sqlQ); //query results
			$rowQ=mysql_fetch_array($resultQ);		
			$QID = ($rowQ[0]);
									
			//add to AddstoQueue table			
			mysql_query("INSERT INTO  AddstoQueue 
			(KaraokeID, UserID, QueueID, RequestedTime)  
			values('$KID', '$UID', '$QID',  '$RT'  )"); 

			//echo 'K:'.$KID.' UID:'.$UID.' QID:'.$QUID.' RT:'.$RT.' A:'.$A.'';  //test
			
		}
		?>
		
			
				
		<center><h1>DJ INTERFACE</h1></center> <br/>
		<center><b>View Songs Added to Queues- Songs Ordered By Added Time- <br />
					Songs At Top Are Next To Be Played</b><br /></center>
		<?php
		function DJInterface() //DJ interface- Always Show
		{
			//Accelerated Queue Table
			//SELECT All Accelerated Songs in Queue with 'e', this way 'e' values are at top of table		
			$sql3Y = "SELECT  K.KaraokeID, U.UserName, S.SongTitle, S.VersionNum, A.ArtistName, AQ.RequestedTime, Q.Accelerated
						FROM Queue Q, User U, AddstoQueue AQ, KaraokeFile K, Song S, Artist A
						WHERE Q.Accelerated='e'
						AND Q.QueueID = AQ.QueueID
						AND AQ.UserID = U.UserID
						AND AQ.KaraokeID = K.KaraokeID
						AND K.SongID = S.SongID
						AND S.ArtistID = A.ArtistID
						ORDER BY AQ.RequestedTime ASC";
			//SELECT All Accelerated Songs in Queue with 'y'			
			$sql3 = "SELECT  K.KaraokeID, U.UserName, S.SongTitle, S.VersionNum, A.ArtistName, AQ.RequestedTime, Q.Accelerated
						FROM Queue Q, User U, AddstoQueue AQ, KaraokeFile K, Song S, Artist A
						WHERE Q.Accelerated='y'
						AND Q.QueueID = AQ.QueueID
						AND AQ.UserID = U.UserID
						AND AQ.KaraokeID = K.KaraokeID
						AND K.SongID = S.SongID
						AND S.ArtistID = A.ArtistID
						ORDER BY AQ.RequestedTime ASC";
						
			

			//y values	
			$result3 = mysql_query($sql3); //query results
			$numrows3 = mysql_num_rows($result3); //number of rows
			//e values
			$result3Y = mysql_query($sql3Y); //query results
			$numrows3Y = mysql_num_rows($result3Y); //number of rows
			
			echo '<b>Accelerated Queue:</b>';
			//create table in html for display on screen
			echo '<table border="1" bgcolor="white" cellpadding="1" cellspacing="1">';
			echo '<tr>';
			echo '<th>','Karaoke File ID','</th>';
			echo '<th>','User','</th>';
			echo '<th>','Song Title','</th>';
			echo '<th>','Version Number','</th>';
			echo '<th>','Artist Name','</th>';
			echo '<th>','Requested Time','</th>';
			echo '<th>','Queue Type','</th>';
			echo '</tr>';
			
			//e values
			for($i=0;$i<$numrows3Y;$i++)
			{//display info in table(e values)
			echo '<tr>';
			//fetch a row in the result set
			$row3Y=mysql_fetch_array($result3Y);
			echo '<td>',($row3Y[0]),'</td>';
			echo '<td>',($row3Y[1]),'</td>';
			echo '<td>',($row3Y[2]),'</td>';
			echo '<td>',($row3Y[3]),'</td>';
			echo '<td>',($row3Y[4]),'</td>';
			echo '<td>',($row3Y[5]),'</td>';
			echo '<td>',($row3Y[6]),'</td>';
			echo '</tr>';
			}//end for
			
			//y values
			for($i=0;$i<$numrows3;$i++)
			{//display info in table(y values)
			echo '<tr>';
			//fetch a row in the result set
			$row3=mysql_fetch_array($result3);
			echo '<td>',($row3[0]),'</td>';
			echo '<td>',($row3[1]),'</td>';
			echo '<td>',($row3[2]),'</td>';
			echo '<td>',($row3[3]),'</td>';
			echo '<td>',($row3[4]),'</td>';
			echo '<td>',($row3[5]),'</td>';
			echo '<td>',($row3[6]),'</td>';
			echo '</tr>';
			}//end for
						
			echo '</table><br/><br/>'; //end table
			
			//---------------------------------------------------------------------------------------------------
			
			//Normal Queue Table
			//SELECT All Non-Accelerated Songs in Queue- Ordered By Time Added
			$sql2 = "SELECT  K.KaraokeID, U.UserName, S.SongTitle, S.VersionNum, A.ArtistName, AQ.RequestedTime, Q.Accelerated
						FROM Queue Q, User U, AddstoQueue AQ, KaraokeFile K, Song S, Artist A
						WHERE Q.Accelerated='n'
						AND Q.QueueID = AQ.QueueID
						AND AQ.UserID = U.UserID
						AND AQ.KaraokeID = K.KaraokeID
						AND K.SongID = S.SongID
						AND S.ArtistID = A.ArtistID
						ORDER BY AQ.RequestedTime ASC";
						

				
			$result2 = mysql_query($sql2); //query results
			$numrows2 = mysql_num_rows($result2); //number of rows
			
			echo '<b>Normal Queue:</b>';
			//create table in html for display on screen
			echo '<table border="1" bgcolor="white" cellpadding="1" cellspacing="1">';
			echo '<tr>';
			echo '<th>','Karaoke File ID','</th>';
			echo '<th>','User','</th>';
			echo '<th>','Song Title','</th>';
			echo '<th>','Version Number','</th>';
			echo '<th>','Artist Name','</th>';
			echo '<th>','Requested Time','</th>';
			echo '<th>','Queue Type','</th>';
			echo '</tr>';
			
			//n values
			for($i=0;$i<$numrows2;$i++)
			{//display info in table(n values)
			echo '<tr>';
			//fetch a row in the result set
			$row2=mysql_fetch_array($result2);
			echo '<td>',($row2[0]),'</td>';
			echo '<td>',($row2[1]),'</td>';
			echo '<td>',($row2[2]),'</td>';
			echo '<td>',($row2[3]),'</td>';
			echo '<td>',($row2[4]),'</td>';
			echo '<td>',($row2[5]),'</td>';
			echo '<td>',($row2[6]),'</td>';
			echo '</tr>';
			}//end for
			echo '</table><br/><br/>';
						
		}
		DJInterface(); //always show
		mysql_close($conn);	 //close connection
		?>		
</body>
</html>