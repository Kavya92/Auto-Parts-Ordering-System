<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>Ordering System</title>
</head>
<body>
<div id="page">
		
	<div id="banner">
<img style="display: inline;" src="fast.jpg" ; align=right />
			<h1><b>Auto Parts <br> Ordering System</b></h1>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="index.php">About Us</a></li>
                                <li><a href="shop.php">Shop</a></li>
                                <li><a href="return.php">Return Shipment</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<?php
include 'LocalhostConnection.php';
	$query = "SELECT o.orderID,p.productName,o.quantity,o.price,o.orderDate,o.shippedDate,o.productID FROM orders o
				JOIN products p ON o.productID = p.productID WHERE o.status = 'Return Initiated';";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:75%>";
		echo "<th> order ID </th>";
		echo "<th> Product Name </th>";
		echo "<th> Quantity</th>";
		echo "<th> Amount Paid</th>";
		echo "<th> Ordered Date</th>";
		echo "<th> Shipped Date</th>";
		echo "<th> Feedback</th>";		
		while($cRow = mysqli_fetch_array($res))
		{
			$fQuery = "SELECT feedback FROM feedback WHERE orderID=".$cRow['0'].";";
			$fres = mysqli_query($link,$fQuery);
			$feedback = mysqli_fetch_array($fres);
			echo "<tr>";
			echo '<td><a href = "http://localhost/UpdateReturnedQuantity.php?pnumber='.$cRow['6'].'&quantity='.$cRow['2'].'&oNumber='.$cRow['0'].'">'.$cRow['0'].'</a></td>';
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";
			echo "<td>". $cRow['4']."</td>";
			echo "<td>". $cRow['5']."</td>";
			echo "<td>". $feedback['0']."</td>";	
			echo "</tr>";
		}
		echo "</table>";
	}	
	else
	{
		echo 'Awesome!!!!!!!!!!!!!';
		echo '<br>';
		echo 'There are no returns';
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