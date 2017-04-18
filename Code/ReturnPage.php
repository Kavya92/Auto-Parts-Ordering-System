<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<?php  
error_reporting(0);
 include 'LocalhostConnection.php';
 ?>
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
<form method="post">
Order Number : <input  type = "text" name = "searchOrder">
<button type  = "submit" name = sOrder>Search Order </button>
</form>
<?php
$searchOrder = null;
if(isset($_POST['sOrder']) && isset($_POST['searchOrder']))
{
      $searchOrder = $_POST['searchOrder'];   
	 $query = 'select p.productName,o.quantity,o.price from products p 
	JOIN orders o ON p.productID = o.productID WHERE o.orderID = '.$searchOrder.';';
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		echo "<th> Product Name </th>";
		echo "<th> Quantity Purchased </th>";
		echo "<th> Amount Paid </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";				
			echo "</tr>";
		}
		echo "</table>";
		echo '<br>';
		$updateQuery = 'UPDATE orders SET status = "Return Initiated" WHERE orderID = '.$searchOrder.';';
		$updateResult = mysqli_query($link,$updateQuery);
			echo 'Your Return Shipment process is initiated';
			echo '<br>';
			echo 'Your money will be refunded to the same card you used during your purchase';
			echo '<br>';
			echo 'We are sorry you didn\'t like our product';
			echo '<br>';
			echo 'Please leave a feedback on why you are returning the product ';
			echo '<a href = "http://localhost/Feedback.php?onumber='.$searchOrder.'">here</a>';
	}	
	else
	{
		echo 'Please check the order number';
	}
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