<html>
<head>
<?php 
 include 'LocalhostConnection.php';
 ?>
<link rel="stylesheet" href="style.css" type="text/css" />
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
                                 <!--  <li><a href="return.php">Return Shipment</a></li>  -->
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">
<?php
	$query = "SELECT o.orderID,p.productID,p.productName,o.quantity,o.deliveryDays FROM orders o 
				JOIN products p ON o.productID = p.productID WHERE o.status = 'placed';";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{		
		echo "<table border=1 style=width:50%>";
		echo "<th> Order ID </th>";
		echo "<th> Product ID </th>";		
		echo "<th> Products to Ship </th>";
		echo "<th> Quantity Ordered</th>";
		echo "<th> No. of days to deliver </th>";
		echo "<th> Generate Invoice </th>";
		while($cRow = mysqli_fetch_array($res))
		{	
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";
			echo "<td>". $cRow['4']."</td>";
          // echo '<form action="form.php?onumber='.$cRow['0'].'"><td>Generate Invoice</td> </form>';
            //echo "<td><a href='link'>" . $row['name'] . "</a></td>";
            /*
            echo "<form action=\"PaymentPage.php?OrderID=".$orderID."&price=".$Charge['0']."\" method=\"POST\">
    <input type=\"submit\" name=\"submit\" value=\"Click me to go to payment page!!!\"> </form>";	
            */
            //echo 'test'.$cRow['0'];
            //echo "href=\"form.php?onumber=".$cRow['0']."\">Generate Invoice";
            //$cRow1 = mysqli_fetch_array($res)
            echo "<td><a href=\"form.php?onumber=".$cRow['0']."\">Generate Invoice</a></td>";
          
            
            //  echo '<td><a href="form.php?onumber='.$cRow['0'].'" onClick="window.opener.location.reload();">Generate Invoice</a></td>';				
			echo "</tr>";
		}
		echo "</table>";
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