<html>
<?php 
echo 'Successfully redirected';
error_reporting(0);
?>
<head>
<title>Add Products</title>
</head>
<body>
<h1>Add Products to Inventory</h1>
<?php
include 'LocalhostConnection.php';
session_start();
if($_GET['pnumber'])
{
	$productID = $_GET['pnumber'];
	$_SESSION['productID'] = $productID;
}
	echo '<form action="UpdateQuantityPage.php" method="post">';
	echo 'Enter the no.of '.$productID.'s to be added: <input type = "text" name = "quantityIncrement">';
	echo '<input type = "submit"  value = "Add Products">';
	echo '</form>'; 


$Add = null;
 isset($_POST['submit']);
 if (isset($_POST['quantityIncrement']))    
{    
	$Add = $_POST['quantityIncrement'];   
} 
 if (isset($_POST['pName']))    
{    
	$pName = $_POST['pName'];   
} 
$query = 'update products set quantity = (quantity + '.$Add.') WHERE productID = '.$_SESSION['productID'].';';
	$res = mysqli_query($link,$query);
	//$rowCount = mysqli_num_rows($res);	
	if($res)
	{
		echo 'Quantity updated successfully';
	}	
?>
</body>
</html>