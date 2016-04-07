<?php

include('fns/db_fns.php');
require_once('fns/auth.php');
if($_POST){
/* echo '<pre>';
print_r($_POST); 
echo md5($_POST['password']);
die; 
 */	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	//$password = md5($password);
	  $saltObj = new SaltHelper;
      $salt = $saltObj->generateNewSalt();
	  $new_p=md5(md5($data['salt']).md5($password));
	
	$id=6;
	$id++;
	
	mysql_query(insert into `user`(`uid`, `id`, `group`, `email`, `passhash`, `salt`, `reg_date`, `last_login`, `reg_ip`, `last_ip`, `valid`, `first_login`)values
	            (, $id, 1, $email, $new_p, $salt, now(), now(), 0, 0, 0, 0);
}
	
?>