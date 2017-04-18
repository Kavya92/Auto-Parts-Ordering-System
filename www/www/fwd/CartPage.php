<html>
<?php 
error_reporting(0);
?>
<head>
<title>Ordering System</title>

	<link rel="stylesheet" href="style.css" type="text/css" />
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
<div id="content">
<h2><b>Your Cart :</b></h2>
<?php
include 'LocalhostConnection.php';
session_start();
if($_GET['pnumber'])
{
	$productID = $_GET['pnumber'];
	$_SESSION['productID'] = $productID;
}
	echo '<form id = "cart" action="CartPage.php" method="post">';
	echo 'Number of units required <input type = "text" name = "productQuantity" required>';
	echo '<input type = "submit"  name = "Cart" value = "Add to Cart">';
	echo '</form>'; 
if(isset($_POST['Cart']))
{
	 $CheckQuantity = null;
	 isset($_POST['submit']);
	 if (isset($_POST['productQuantity']))    
	{    
		$CheckQuantity = $_POST['productQuantity'];   
	} 

	$query = 'SELECT quantity FROM products WHERE productID = '.$_SESSION['productID'].';';
	$query2 = 'SELECT * FROM orders;';
	$res = mysqli_query($link,$query);
	$res2 = mysqli_query($link,$query2);	
	$rowCount = mysqli_num_rows($res2);
	$orderNumber = $rowCount+1;
	$cRow = mysqli_fetch_array($res);
	if($cRow['0'] >= $CheckQuantity)
	{
		$updateQuery = 'update products set blocked = blocked+'.$CheckQuantity.' WHERE productID = '.$_SESSION['productID'].';';
		$insertQuery = 'INSERT INTO orders(orderID,productID,quantity,status) values 
						('.$orderNumber.','.$_SESSION['productID'].','.$CheckQuantity.',"placed");';
		$updateResult = mysqli_query($link,$updateQuery);
		$insertResult = mysqli_query($link,$insertQuery);		
		if($updateResult && $insertResult)
		{
			echo 'Products added to cart successfully';	
			echo '<br>';		
		}
		$Site = "'http://localhost/OrderPage.php?Quantity=".$CheckQuantity."&ProductID=".$_SESSION['productID']."&OrderID=".$orderNumber."'";
		echo '<input type="button" onclick="location.href('.$Site.');" value="Click me to place your order!!!">';	
	}
	else
	{
		echo 'We don\'t have the no of items you requested. Please check back tomorrow. Sorry for any inconvenience!!!!!'; 
		echo '<br>';
		echo '<a href = "http://localhost/AddProducts.php"> Go back shopping!!!</a>';
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