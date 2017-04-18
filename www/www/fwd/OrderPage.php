<html>
<head>
<?php 
error_reporting(0);
?>
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
<h2><b> Details Page : </b><h2>
<?php
include 'LocalhostConnection.php';
session_start();
if($_GET['Quantity'])
{
	$Quantity = $_GET['Quantity'];
	$_SESSION['Quantity'] = $Quantity;
}
if($_GET['ProductID'])
{
	$productID = $_GET['ProductID'];
	$_SESSION['productID'] = $productID;
}
if($_GET['OrderID'])
{
	$orderID = $_GET['OrderID'];
	$_SESSION['orderID'] = $orderID;	
}
$query = 'SELECT * FROM taxrates;';
$res = mysqli_query($link,$query);	
$cRow = mysqli_fetch_array($res);
//***********************SHIPPING INFORMATION********************************************
	echo '<h2> <center><b>Shipping Information </b></center></h2>';
	echo '<form id = "ShippingDetails" method = "post">';
	echo '<table cellpadding = "10" align = "center" width = "40%">';
	echo '<tr>';
	echo '<td> Name: </td>';
	echo '<td> <input type = "text" name = "Name" placeholder = "Name" required/> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Contact Email Address:</td>';
	echo '<td><input type = "text" name = "Email" placeholder = "Email" required/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Phone Number: </td>';
	echo '<td> <input type = "text" name = "Phone" placeholder = "Phone" required/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> Apartment and Street: </td>';
	echo '<td> <input type = "text" name = "Address" placeholder = "Apartment & Street" required/> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> State: </td>';
	echo '<td> <select name = "state" required> ';
			while($cRow = mysqli_fetch_array($res))
			{
				echo '<option>'.$cRow['0'].'</option>';
			}
	echo '</select> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> Zip Code </td>';
	echo '<td> <input type = "text" placeholer = "zip code" name = "zcode" required/> </td>';
	echo '</tr>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr/>';	
	echo '<tr>';
	echo '<td colspan = "2" align = "center"><button type = "submit" name = "submitCustDetails" align = "center">Submit Shipping Details</button></td>';
	echo '</tr>';
	echo '</table>';
	echo '</form>';
//******************************************************************************************************************
if(isset($_POST['submitCustDetails']))
{
	$custDetailsQuery = "INSERT INTO customer(orderID,customerName,addressLine,state,zipCode,email,phoneNumber) VALUES
						(".$_SESSION['orderID'].",'".$_POST['Name']."','".$_POST['Address']."','".$_POST['state']."',".$_POST['zcode']."
						,'".$_POST['Email']."',".$_POST['Phone'].");";
	$cust = mysqli_query($link,$custDetailsQuery);	
	$custRow = mysqli_fetch_array($cust);
	$getPrices = "SELECT p.price,o.quantity from products p JOIN orders o ON p.productID = o.productID 
					WHERE p.productID = ".$_SESSION['productID']." AND o.orderID = ".$_SESSION['orderID'].";";
	$price = mysqli_query($link,$getPrices);
	$priceRow = mysqli_fetch_array($price);
	$getAdditionalCharges = "SELECT * FROM taxrates WHERE abbreviation = '".$_POST['state']."';";
	$additionalCharge = mysqli_query($link,$getAdditionalCharges);
	$additionalChargeRow = mysqli_fetch_array($additionalCharge);
	$updateOrder = "UPDATE orders SET price = ((".$priceRow['0']."*".$additionalChargeRow['2']."*".$priceRow['1']."/100)+(".$priceRow['0']."*".$priceRow['1'].")+".$additionalChargeRow['3'].") 
					WHERE orderID = ".$_SESSION['orderID'].";";
	$setPrice = mysqli_query($link,$updateOrder);
	if($setPrice)
	{
		echo 'Shipping Details updated successfully';
		echo '<br>';	
	}	
	$getFinalPrice = "SELECT price FROM orders WHERE orderID = ".$_SESSION['orderID'].";";
	$FinalCharge = mysqli_query($link,$getFinalPrice);
	$Charge = mysqli_fetch_array($FinalCharge);
	$Site = "'http://localhost/PaymentPage.php?OrderID=".$_SESSION['orderID']."&price=".$Charge['0']."'";
	echo '<input type="button" onclick="location.href('.$Site.');" value="Click me to go to payment page!!!">';	
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