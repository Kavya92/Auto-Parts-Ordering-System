<html>
<?php 
echo 'Successfully redirected';
error_reporting(0);
?>
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
		<div id="content">
<h2><b>Add Products to Inventory : </b></h1>
<?php
include 'LocalhostConnection.php';
session_start();
if($_GET['pnumber'])
{
	$productID = $_GET['pnumber'];
	$_SESSION['productID'] = $productID;
}
	echo '<form action="ReduceProducts.php" method="post">';
	echo 'Enter the quantity to be reduced: <input type = "text" name = "quantityIncrement" required>';
	echo '<input type = "submit"  value = "Add Products">';
	echo '</form>'; 


$Decrement = null;
 isset($_POST['submit']);
 if (isset($_POST['quantityIncrement']))    
{    
	$Decrement = $_POST['quantityIncrement'];   
} 

$query = 'update products set quantity = (quantity - '.$Decrement.'),blocked=(blocked - '.$Decrement.') WHERE productID = '.$_SESSION['productID'].';';
	$res = mysqli_query($link,$query);
	//$rowCount = mysqli_num_rows($res);	
	if($res)
	{
		echo 'Quantity updated successfully';
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