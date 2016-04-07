<?php
include('config.php');
$id=$_GET['id'];
//$sql=mysql_query("select *from register where id=".(int)$id);
//$row=mysql_fetch_array($sql,MYSQL_ASSOC);
/* echo '<pre>';
print_r($row);
print($row['id']);
 */
$execsql=mysql_query("delete from register where id=" .(int)$id);

if($execsql)
{
$_SESSION['delete'] =true;
header("Location:user_listing.php");
}
else{
echo 'unsuccessful';
} 

?>
