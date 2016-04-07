<?php
include('fns/db_fns.php');
if($_POST){
/* echo '<pre>';
print_r($_POST); 
echo md5($_POST['password']);
die; 
 */	
	$email = $_POST['email'];
	$password = $_POST['passwd'];
	//$password = md5($password);
	$sql = mysql_query("SELECT * FROM `users` WHERE `email` ='".$email."'");
  $data=mysql_fetch_array($sql,MYSQL_ASSOC);
 $key=$data['password']
 
 
 
 if($key==md5(md5($data['salt']).md5($password))){
	 
	 echo "yes"
	 
 }
 else{
	 
	echo "no";
 }
 
?>