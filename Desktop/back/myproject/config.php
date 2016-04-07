<?php
ob_start();
session_start();
$con = mysql_connect('localhost','root','');
if($con){
//echo 'connect';
}else{
echo mysql_error();
}
mysql_select_db('myproject',$con);



/* function getExtension($filename=NULL){
	$file = explode('.',$filename);
	$ext = end($file);
	 echo $ext;
	echo '<pre>';
	print_r($file);die; 
	return $ext;
} */
?>