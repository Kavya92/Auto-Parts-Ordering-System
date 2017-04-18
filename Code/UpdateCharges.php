
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
//session_start();
if($_GET['stateab'])
{
	$stateab = $_GET['stateab'];
	//$_SESSION['stateab'] = $stateab;
}
	echo '<form action="" method="post">';
	echo 'Modify Tax Rate: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type = "text" name = "taxRate">';
	echo '<br>';
	echo '<br>';
	echo 'Modify Shipping Charges:&nbsp; <input type = "text" name = "shippingCharges">';
	echo '<br>';
	echo '<br>';
    echo 'Modify Handling Charges:&nbsp; <input type = "text" name = "handlingCharges">';
	echo '<br>';
	echo '<br>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type = "submit"  name="change" value = "Modify">';
	echo '</form>';
//$existing = 'SELECT taxRate,shippingCharges FROM taxrates WHERE stateName = "'.$_SESSION['stateab'].'";';
  
            $existing ="SELECT taxRate,shippingCharges,handlingCharges FROM taxrates WHERE stateName='".$stateab."';";
            //echo $existing;
$data = mysqli_query($link,$existing);
$cRow = $data->fetch_array(MYSQLI_NUM);	

$tax = $cRow['0'];
$ship = $cRow['1'];
$handling=$cRow['2'];           

$shipC=$_POST['shippingCharges'];
$taxC=$_POST['taxRate'];
$handlingC=$_POST['handlingCharges'];
            
isset($_POST['submit']);
            
 if (isset($_POST['taxRate']))    
{    
     if($taxC!=""){
	$tax = $_POST['taxRate'];   
     }
     else
     {
       $tax = $cRow['0'];  
     }
}
if (isset($_POST['shippingCharges']))    
{   
    if($shipC!="")
    { 
	$ship = $_POST['shippingCharges'];  }
    else{
       $ship = $cRow['1'];  
    }
}
            
if (isset($_POST['handlingCharges']))    
{   
    if($handlingC!=""){
	$handling = $_POST['handlingCharges'];   }
    else{
      $handling=$cRow['2'];   
    }
}
 
if (isset($_POST['change']))
{
$query = "update taxrates set taxRate ='".$tax."',shippingCharges = '".$ship."',handlingCharges = '".$handling."' WHERE stateName = '".$stateab."' OR abbreviation LIKE '%".$stateab."%';";
          //  echo $query;
	$res = mysqli_query($link,$query);
	//$rowCount = mysqli_num_rows($res);	
	if($res)
	{
		echo 'Charges updated successfully';
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
