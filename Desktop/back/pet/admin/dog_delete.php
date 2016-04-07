<?php
include('config.php');
$p_id=$_GET['p_id'];
$execsql=mysql_query("delete from dog where p_id=".(int)$p_id);

if($execsql)
{

header("Location:dog_listing.php");
}
else{
echo 'unsuccessful';
} 