<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>medication</title>
</head>



<style>
body {
    background-image: url("images.jpg");
}
</style>
</head>
<body>

<?php

$cn=mysql_connect("localhost","root","");
mysql_select_db("crawl",$cn);
echo"MEDICATION DETAILS<br>";
$q="select * from tab";
$rs=mysql_query($q);
echo"<table><tr><td>id</td><td>treatment</td><td>price</td></tr>";
while($records=mysql_fetch_row($rs))
{
echo"<tr><td>$records[0]</td><td>$records[1]</td> <td>$records[2]</td></tr>";
}
echo"</table><br>"
		
?>
</body>
</html>
