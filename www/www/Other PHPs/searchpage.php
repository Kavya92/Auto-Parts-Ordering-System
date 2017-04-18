<html>
<head>
<title>Book Store Registration</title>
</head>
<BODY>
<form method = "post" action="searchpage.php">
<?php $conn = mysql_connect('localhost','root','');
mysql_select_db('henrybooks',$conn);
$qry = "select * from author";


$result = mysql_query($qry);
$numrows = mysql_num_rows($result);
echo '<table>';
for($i = 0;$i<$numrows;$i++)
{
echo '<tr>';
$row=mysql_fetch_array($result);
echo '<td>',($row[0]),'</td>';
echo "\t";
echo '<td>',($row[1]),'</td>';
echo "\t";
echo '<td>',($row[2]),'</td>';
echo "\t";
echo '<td>',($row[3]),'</td>';
echo "\t";
echo '</tr>';

}
echo '</table>';
?>
</form>
</body>
</html>
