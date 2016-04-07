<?php
include('config.php');
$id=$_GET['id'];
$execsql=mysql_query("delete from users where id=".(int)$id);

if($execsql)
{

header("Location:user_listing.php");
}
else{
echo 'unsuccessful';
} 
?>