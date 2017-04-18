<!--CSCI 566-3 Assignment 8
author: Lohith Rao Boinapally
ZID: Z1760481 Section: 2
due date: 04/10/2015
-->
<!--Description of Page:
In this page we can search for books written by individual authors.
We can enter either the first name or the last name of the author to
search for the books written by him-->
<html>
<?php include 'LocalhostConnection.php'; ?>

<head>
	<title> Author and his books </title>
</head>

<body bgcolor = "Bisque">
<table cellpadding="10"  width="100%">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <h1 align="left"><font face = "Buxton Sketch"> Author and his books </font></h1>
        </td>
        <td>
            <table align="right">
                <!--Details of the programmer-->
                <tr>
                    <td  bgcolor = "white"><b>Name:</b></td>
                    <td  bgcolor = "white">Lohith Rao Boinapally</td>
                </tr>
                <tr>
                    <td  bgcolor = "white"><b>Course:</b></td>
                    <td  bgcolor = "white">CSCI 566</td>
                </tr>
                <tr>
                    <td  bgcolor = "white"><b>Section:</b></td>
                    <td  bgcolor = "white"> 2 </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<form action="author_books.php" method="post">
 Author Name : <input  type = "text" name = ""Author"">
<input type  = submit  value = "Search Books">
</form>

<?php
 isset($_POST['submit']);
 echo "<br/>";
 $AuthorName = isset($_POST['Author']);
	$query = "select * from Author where authorName = '".$AuthorName."')";
 if($AuthorName == NULL)
 { 

 }
 else
 {
	$res = mysqli_query($link,$query);
 }

// displaying books to the UI
if ($query != NULL)
{
$res = mysqli_query($link,$query) or die("No result matches your search");
echo "<table border=1 style=width:20%>";
echo "<th> ID </th>";
echo "<th> Author NAME </th>";
echo "<th> BOOK NAME </th>";
echo "<th> Version </th>";
while($cRow = mysqli_fetch_array($res))
   {
     echo "<tr>";
     echo "<td>". $cRow['0'];
	 echo "<td>". $cRow['1'];
	 echo "<td>". $cRow['2'];
	 echo "<td>". $cRow['3'];
     echo "</tr>";
   }
echo "</table>";
}
?>
</body>
</head>
</html>