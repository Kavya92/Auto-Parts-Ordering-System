<html>
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
<p> This is a customer homepage for Auto parts on-line ordering system.</p>
<p> Customer can either order new products or return already delivered products.</p>
<p> Please use appropriate links below to go to respective pages </p>
<?php
$Site = "'http://localhost/AddProducts.php'";
$Site2 = "'http://localhost/ReturnPage.php'";
echo '<input type="button" onclick="location.href('.$Site.');" value="Click here to order new products">';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="location.href('.$Site2.');" value="Click here to return products">';
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