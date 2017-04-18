<html>
<?php $Search = null; 
 include 'LocalhostConnection.php';?>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>Ordering System</title>	
</head>
<body>
<div id="banner">
<img style="display: inline;" src="fast.jpg" ; align=right />
			<br><br><br><h1><b>Auto Parts </b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="Order.php">All Orders</a></li>
                <li><a href="SearchProducts.php">Maintain Inventory</a></li>
                <li><a href="WSReturnPage.php">Returned Orders</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">		
<h2><b>Search Products : <b></h2>
<form action="SearchProducts.php" method="post">
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
	$query = "SELECT productID,productName FROM products;";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		echo "<th> Product ID </th>";
		echo "<th> Product Name </th>";
		echo "<th> Add Products</th>";
		echo "<th> Reduce Products</th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo '<td><a href = "http://localhost/UpdateQuantityPage.php?pnumber='.$cRow['0'].'">Add</a></td>';		
			echo '<td><a href = "http://localhost/ReduceProducts.php?pnumber='.$cRow['0'].'">Reduce</a></td>';					
			//echo '<td><input type="submit" name = "quantity" value = "Update Quantity"/></td>';			
			echo "</tr>";
		}
		echo "</table>";
	}	
 }
 else
 {
	$query = "SELECT productID,productName FROM products WHERE productName LIKE '%".$Search."%';";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		echo "<th> Product ID </th>";
		echo "<th> Product Name </th>";
		echo "<th> Add Products </th>";
		echo "<th> Reduce Products </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo '<td><a href = "http://localhost/UpdateQuantityPage.php?pnumber='.$cRow['0'].'">Add</a></td>';	
			echo '<td><a href = "http://localhost/ReduceProducts.php?pnumber='.$cRow['0'].'">Reduce</a></td>';			
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