<?php

 include('config.php');
$country_id = $_REQUEST['country_id'];

 $stateSql = mysql_query("SELECT * FROM `states` WHERE `status` =1 AND `country_id` = ".(int)$country_id);
 $option = 'Region : <select id="states" name="states"><option value="">Please Select </option>';
 while($stateData = mysql_fetch_array($stateSql)){
	$option.='<option value="'.$stateData['id'].'" >'.$stateData['name'].'</option>';
 
 }
 $option.= '</select>';
 echo $option;die;
