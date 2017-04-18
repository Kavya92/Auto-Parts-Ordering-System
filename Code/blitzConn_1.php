<html>
<head>


	<link rel="stylesheet" href="style.css" type="text/css" />
<title>Ordering System</title>
</head>
<body>
<div id="page">
		
	<div id="banner">
<img style="display: inline;" src="fast.jpg" ; align=right />
			<br><br><br><h1><b>Auto Parts </b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="index.php">About Us</a></li>
                                <li><a href="shop.php">Shop</a></li>
                               <! <li><a href="return.php">Return Shipment</a></li> >
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
<div id="content">
<h2><b> Parts in the Inventory :</b></h2>
<?php
$host='blitz.cs.niu.edu:3306';
$db='csci467';
$user='student';
$pwd='student';
$conn = new PDO("mysql:$host;dbname=$db",$user,$pwd);
//$dataLink = new PDO("mysql:blitz.cs.niu.edu;dbname=dbgradfive",'db5user','db5password');

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$dataLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!$conn){
echo 'ERROR:Could not connect to the legacy database ' .getMessage();
//die('Could not connect to the legacy database'.mysql_error());

}
else{
	echo 'connected';
}

/*
if(!$dataLink){
echo 'ERROR:Could not connect to the system database' .getMessage();
//die('Could not connect to the system database'.mysql_error());
}
else {
	echo 'new DB connected!';
}
*/

/*$db = "csci467";
$systemDB = "dbgradfive";
mysqli_select_db($link,$db);
mysqli_select_db($dataLink,$systemDB);
*/ // no need


//$conn->query('use csci467');
$mysql='select * from csci467.parts';

$res = $conn->query("select productID from csci467.parts;");
	echo 'success';
	
	$res->setFetchMode(PDO::FETCH_ASSOC);
	//mysqli_query($link,$query) or die("Cannot run query on legacy database".mysql_error());
	$rowCount = $res->rowCount();
	echo 'row values are' .$rowCount;
	
	//mysqli_num_rows($res);
	if($rowCount>0)
	{
		 while ($cdata = $res->fetch())
		//while($cdata = mysqli_fetch_array($res))
		{
			$insertQuery = "INSERT INTO products(productID,productName,price) values(".$cdata['0'].",'".$cdata['1']."',".$cdata['2'].") 
							ON DUPLICATE KEY UPDATE productName = values(productName),price = values(price);";
			
			$dataLink->exec($insertQuery);
			//mysqli_query($dataLink,$insertQuery);
		}
	}
	else
	{
		echo "No products found";
	}
//mysqli_close($dataLink);
//mysqli_close($link);
?>
</div>
<div id="footer">
			<p><center>
				Powered by <a href="/" target="_blank">Team 5</a></center>
			</p>
		</div>
						</div>
</body>
</html>