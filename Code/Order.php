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
			<br><br><br><h1><b>Auto Parts </b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="Order.php">All Orders</a></li>
                <li><a href="shop.php">ViewProducts</a></li>
                <li><a href="SearchProducts.php">Maintain Inventory</a></li>
               <!-- <li><a href="WSReturnPage.php">Returned Orders</a></li> -->
			</ul>	
		</div>
		<div id="content">
			
	<form action="Order.php" method="post">
 Enter an Order Number to search: <input  type = "text" name = "searchText">
<input type  = "submit"  value = "Search Order">
</form>
<?php
 isset($_POST['submit']);
 if (isset($_POST['searchText']))    
{    
	$Search = $_POST['searchText'];   
} 

if($Search == NULL)
 { 
	$query = "SELECT o.orderID,p.productName,o.quantity,o.price,o.status FROM orders o 
				JOIN products p ON o.productID = p.productID;";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:65%>";
		echo "<th> Order Number </th>";
		echo '<th align = "left"> Product Name </th>';
		echo "<th> Quantity Ordered</th>";
		echo "<th> Total Price </th>";		
		echo '<th align = "left"> Order Status </th>';
		while($cRow = mysqli_fetch_array($res))
		{
			$queryCard = "SELECT * FROM cardDetails WHERE orderID =".$cRow['0'].";";
			$resCard = mysqli_query($link,$queryCard);
			$resCardCount = mysqli_num_rows($resCard);
			if($resCardCount > 0)
			{
				echo "<tr>";
				echo '<td align = "center">'. $cRow['0'].'</td>';
				echo "<td>". $cRow['1']."</td>";
				echo '<td align = "center">'. $cRow['2'].'</td>';
				echo '<td align = "center">$'. $cRow['3'].'</td>';
				echo "<td>". $cRow['4']."</td>";				
				echo "</tr>";
			}
			else 
			{
				echo "<tr>";
				echo '<td align = "center">'. $cRow['0'].'</td>';
				echo "<td>". $cRow['1']."</td>";
				echo '<td align = "center">'. $cRow['2'].'</td>';
				echo '<td align = "center">$'. $cRow['3'].'</td>';
				echo "<td> Order not completed</td>";				
				echo "</tr>";				
			}
		}
		echo "</table>";
	}	
 }
 else
 {
	$query = "SELECT o.orderID,p.productName,o.quantity,o.price,o.status FROM orders o 
				JOIN products p ON o.productID = p.productID WHERE o.orderID = ".$Search.";";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:65%>";
		echo "<th> Order Number </th>";
		echo '<th align = "left"> Product Name </th>';
		echo "<th> Quantity Ordered</th>";
		echo "<th> Total Price </th>";		
		echo '<th align = "left"> Order Status </th>';
		while($cRow = mysqli_fetch_array($res))
		{
			$queryCard = "SELECT * FROM cardDetails WHERE orderID =".$cRow['0'].";";
			$resCard = mysqli_query($link,$queryCard);
			$resCardCount = mysqli_num_rows($resCard);
			if($resCardCount > 0)
			{
				echo "<tr>";
				echo '<td align = "center">'. $cRow['0'].'</td>';
				echo "<td>". $cRow['1']."</td>";
				echo '<td align = "center">'. $cRow['2'].'</td>';
				echo '<td align = "center">$'. $cRow['3'].'</td>';
				echo "<td>". $cRow['4']."</td>";				
				echo "</tr>";
			}
			else 
			{
				echo "<tr>";
				echo '<td align = "center">'. $cRow['0'].'</td>';
				echo "<td>". $cRow['1']."</td>";
				echo '<td align = "center">'. $cRow['2'].'</td>';
				echo '<td align = "center">$'. $cRow['3'].'</td>';
				echo "<td> Order not completed</td>";				
				echo "</tr>";				
			}
		}
		echo "</table>";
	}	
 }
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