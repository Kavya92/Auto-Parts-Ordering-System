<html>
<head>


	<link rel="stylesheet" href="style.css" type="text/css" />
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
<?php
include 'LocalhostConnection.php';
session_start();
if($_GET['onumber'])
{
	$orderNumber = $_GET['onumber'];
	$_SESSION['orderNumber'] = $orderNumber;
}
?>
<h2><b> Feedback Form :</b></h1>
	<form id = "feedbackForm" method = "post">
		Feedback: <textarea rows="4" cols="50" name = "data"> </textarea>
		<br>
		<button type = "submit" name = "feedback"> Submit </button>
	</form>
	<?php
		if(isset($_POST['feedback']) && isset($_POST['data']))
		{
			$Site = "'http://localhost/AddProducts.php'";
			$query = 'INSERT INTO feedback(orderID,feedback) values('.$_SESSION['orderNumber'].',"'.$_POST['data'].'");';
			$res = mysqli_query($link,$query);
			echo 'Thank you for your feedback!!!!!!!';
			echo '<br>';
			echo 'Wanna shop more???? Please click ';
			echo '<a href = "http://localhost/AddProducts.php">here</a>';
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