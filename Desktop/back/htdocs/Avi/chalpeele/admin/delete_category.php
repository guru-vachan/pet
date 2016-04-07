<?php
include('config.php');
$id=$_GET['id'];
$execsql=mysql_query("delete from categories where id=".(int)$id);

if($execsql)
{

header("Location:category_listing.php");
}
else{
echo 'unsuccessful';
} 