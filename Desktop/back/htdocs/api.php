<?php
ob_start();
$con=mysql_connect('localhost','root','guru');
if($con){
	
}
else{
	echo mysql_error();
}
mysql_select_db('pet',$con);
//echo '<pre>';
//print_r ($_SERVER);die();
//print_r($_POST);die();
//if($_SERVER['REQUEST_METHOD']==GET){
//echo 'ram';
$data=mysql_query("select *from `breeds`");
	
while($row = mysql_fetch_array($data)){
		
	echo $row['breed_name'] ;
	echo '<br/>';
};
	


?>
