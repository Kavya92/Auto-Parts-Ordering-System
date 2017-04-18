<html>
<?php 
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
			<br><br><br><h1><b>Auto Parts </b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>

			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">
<h2><b>Add Products to Inventory :</b></h2>
<?php
include 'LocalhostConnection.php';
session_start();
if($_GET['stateab'])
{
	$stateab = $_GET['stateab'];
	$_SESSION['stateab'] = $stateab;
}
	echo '<form action="UpdateCharges.php" method="post">';
	echo 'Modify Tax Rate: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type = "text" name = "taxRate">';
	echo '<br>';
	echo '<br>';
	echo 'Modify Shipping Charges:&nbsp; <input type = "text" name = "shippingCharges">';
	echo '<br>';
	echo '<br>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type = "submit"  value = "Modify">';
	echo '</form>';
$existing = 'SELECT taxRate,shippingCharges FROM taxrates WHERE abbreviation = "'.$_SESSION['stateab'].'";';
$data = mysqli_query($link,$query);
$cRow = mysqli_fetch_array($res);	
$tax = $cRow['0'];
$ship = $cRow['1'];
 isset($_POST['submit']);
 if (isset($_POST['taxRate']))    
{    
	$tax = $_POST['taxRate'];   
}
if (isset($_POST['shippingCharges']))    
{    
	$ship = $_POST['shippingCharges'];   
}
$query = 'update taxrates set taxRate = '.$tax.' and shippingCharges = '.$ship.' WHERE abbreviation = '.$_SESSION['stateab'].';';
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