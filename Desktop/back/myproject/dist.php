<?php

 include('config.php');
$state_id = $_REQUEST['state_id'];

 $Sql = mysql_query("SELECT * FROM `dist` WHERE `state_id` = ".(int)$state_id);
 $option = '<select id="dist" name="dist"><option value="">Please Select </option>';
 while($Data = mysql_fetch_array($Sql)){
	$option.='<option value="'.$Data['dist_id'].'" >'.$Data['name'].'</option>';
 
 }
 $option.= '</select>';
 echo $option;die;
 ?>