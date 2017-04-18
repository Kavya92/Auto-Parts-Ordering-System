<html>
<head>


	<link rel="stylesheet" href="style.css" type="text/css" />
<?php $Search = null; 
 include 'LocalhostConnection.php';
 ?>
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
			<h2><b>Products :</b></h2>
			
	<form action="AddProducts.php" method="post">
 Enter a search item: <input  type = "text" name = "searchText">
<input type  = "submit"  value = "Search Products">
</form>
<?php
 isset($_POST['submit']);
 if (isset($_POST['searchText']))    
{    
	$Search = $_POST['searchText'];   
} 

if($Search == NULL)
 { 
	$query = "SELECT productID,productName,price,(quantity-blocked) AS quantity FROM products;";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		//echo "<th> Product ID </th>";
		echo "<th> Product Name </th>";
		echo "<th> Price per Unit </th>";
		echo "<th> Quantity in hand </th>";
		echo "<th> Add to Cart </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			//echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";
			echo '<td><a href = "http://localhost/CartPage.php?pnumber='.$cRow['0'].'">Add to Cart</a></td>';				
			echo "</tr>";
		}
		echo "</table>";
	}	
 }
 else
 {
	$query = "SELECT productID,productName,price,(quantity-blocked) as quantity FROM products WHERE productName LIKE '%".$Search."%';";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		//echo "<th> Product ID </th>";
		echo "<th> Product Name </th>";
		echo "<th> Price per Unit </th>";
		echo "<th> Quantity in hand </th>";
		echo "<th> Add to Cart </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			//echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";			
			echo '<td><a href = "http://localhost/CartPage.php?pnumber='.$cRow['0'].'">Add to Cart</a></td>';				
			echo "</tr>";
		}
		echo "</table>";
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