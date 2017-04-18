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
$link = mysqli_connect('blitz.cs.niu.edu:3306','student','student','csci467');
$dataLink = mysqli_connect('blitz.cs.niu.edu:3306','db5user','db5password','dbgradfive');
if(!$link){
die('Could not connect to the legacy database'.mysql_error());
}
if(!$dataLink){
die('Could not connect to the system database'.mysql_error());
}

$db = "csci467";
$systemDB = "dbgradfive";
mysqli_select_db($link,$db);
mysqli_select_db($dataLink,$systemDB);

$query = "SELECT * FROM parts";

	$res = mysqli_query($link,$query) or die("Cannot run query on legacy database".mysql_error());
	$rowCount = mysqli_num_rows($res);
	if($rowCount>0)
	{
		while($cdata = mysqli_fetch_array($res))
		{
			$insertQuery = "INSERT INTO products(productID,productName,price) values(".$cdata['0'].",'".$cdata['1']."',".$cdata['2'].") 
							ON DUPLICATE KEY UPDATE productName = values(productName),price = values(price);";
			mysqli_query($dataLink,$insertQuery);
		}
	}
	else
	{
		echo "No products found";
	}
mysqli_close($dataLink);
mysqli_close($link);
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