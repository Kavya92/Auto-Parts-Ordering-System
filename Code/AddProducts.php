<html>
<head>


	<link rel="stylesheet" href="style.css" type="text/css" />
<?php $Search = null; 
 include 'LocalhostConnection.php';
 include 'blitzConn.php';
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
				<li><a href="Index.php">About Us</a></li>
                                <li><a href="shop.php">Shop</a></li>
                                <!-- <li><a href="return.php">Return Shipment</a></li> -->
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">
			<h2><b>Products :</b></h2>
			
	<form action="AddProducts.php" method="POST">
 Enter a search item: <input  type = "text" name = "searchText">
<input type  = "submit"  value = "Search Products">
</form>
<?php

 isset($_POST['submit']);
 if (isset($_POST['searchText']))    
{    
	$Search = $_POST['searchText'];   
} 
            
$query="UPDATE products set quantity=quantity+blocked;";
$res=mysqli_query($link,$query);
$query1="UPDATE products set blocked=0;";
$res1=mysqli_query($link,$query1);
           
            
if($Search == NULL)
 { 
	//$query = "SELECT productID,productName,price,quantity AS quantity FROM products;";
	$query = "SELECT productID,productName,price,quantity as totalQuantity FROM products ORDER BY productID+0;";
	$res = $link->query($query);
	//$res = mysqli_query($link,$query);
	$rowCount =mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		echo "<th> Product ID </th>";
		echo "<th> Product Name </th>";
		echo "<th> Price per Unit </th>";
		echo "<th> Quantity in hand </th>";
		echo "<th> Add to Cart </th>";
        echo "<th> Product images</th>";
        $i=1 ;
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";
			echo '<td><a href = "http://students.cs.niu.edu/~z1778592/OrderingSystem/CartPage.php?pnumber='.$cRow['0'].'">Add to Cart</a></td>';
           ?>
            
            <td> <img src ="<?php if($i==6) $i=1; echo $i++?>.jpg" > </td>           
               
            <?php
            
			echo "</tr>";
		}
		echo "</table>";
	}	
 }
 else
 {
	$query = "SELECT productID,productName,price,(quantity) as quantity FROM products WHERE productName LIKE '%".$Search."%';";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		echo "<th> Product ID </th>";
		echo "<th> Product Name </th>";
		echo "<th> Price per Unit </th>";
		echo "<th> Quantity in hand </th>";
		echo "<th> Add to Cart </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";			
			echo '<td><a href = "http://students.cs.niu.edu/~z1778592/OrderingSystem/CartPage.php?pnumber='.$cRow['0'].'">Add to Cart</a></td>';	
//session_start();
//			$_SESSION['productID'] =$cRow['0'];
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