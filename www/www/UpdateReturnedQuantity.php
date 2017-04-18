<html>
<head>
<?php  
error_reporting(0);
 include 'LocalhostConnection.php';
 ?>
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
                                <li><a href="return.php">Return Shipment</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">
<?php

$pNumber = $_GET['pnumber'];
$quantity = $_GET['quantity'];
$orderNumber = $_GET['oNumber'];

	$updateOrders = "UPDATE orders SET status = 'Returned',returnDate = current_date() WHERE orderID = ".$orderNumber.";";
	$updateProducts = "UPDATE products SET quantity = quantity + ".$quantity." WHERE productID = ".$pNumber.";";
	$cardDetails = "SELECT * FROM cardDetails WHERE orderID = ".$orderNumber.";";
	$res = mysqli_query($link,$updateOrders);
	$res2 = mysqli_query($link,$updateProducts);
	$display = mysqli_query($link,$cardDetails);
	$rowCount = mysqli_num_rows($display);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:75%>";
		echo "<th> order ID </th>";
		echo "<th> Card Number </th>";
		echo "<th> Amount </th>";
		while($cRow = mysqli_fetch_array($display))
		{
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['3']."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo 'Please check the details of the refund above!!!!!';
	}
?>
</div>
<div id="footer">
			<p><center>
				Powered by <a href="/" target="_blank">Team 9</a></center>
			</p>
		</div>
						</div>
</body>
</html>