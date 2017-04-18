<!DOCTYPE html>
<html>
<head>
        <title>Ordering System</title>

	<link rel="stylesheet" href="style.css" type="text/css" />
	<?php $Search = null; 
 
 include 'blitzConn.php';
 ?>
<style>

</style>
	
</head>
<body>

	<div id="page">
		
	<div id="banner">
			<h1><b>Auto Parts Ordering <br>System</b></h1>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="Index.php">About Us</a></li>
                                <li><a href="shop.php">ViewProducts</a></li>
                                 <!--<li><a href="return.php">Return Shipment</a></li> -->
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
		<div id="content">
			<h2><b>Products :</b></h2>
			<br><br>
			<!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
		
		
		<?php
		$conn =new mysqli('p:blitz.cs.niu.edu','db5user','db5password','dbgradfive');
		if(!$conn){
echo 'ERROR:Could not connect to the legacy database ' .getMessage();
//die('Could not connect to the legacy database'.mysql_error());

}

		$res = $conn->query("select * from products order by productID+0;");
	
	$rowCount=mysqli_num_rows($res);
	
	print "<table border=1>";
	if($rowCount>0)
	{
		print "<th>Product ID </th> <th>Product Name</th> <th>Price</th> <th>Quantity</th>";
		// while ($cdata = $res->fetch())
		while($cdata = mysqli_fetch_array($res))
		{
		print "<tr>";	
				print "<td> &nbsp &nbsp ".$cdata['0']."</td> <td> &nbsp ".$cdata['1']."</td> <td> &nbsp ".$cdata['2']." &nbsp </td> <td> &nbsp ".$cdata['3']." &nbsp </td>"; 
			//$dataLink->exec($insertQuery);
			//mysqli_query($dataLink,$insertQuery);
		print "</tr>";
		}
		
	}
	else
	{
		echo "No products found";
	}
	print "</table>";
if($conn)
mysqli_close($conn);

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