<?php

function getParentCategoryName($parent_id){
$sql = mysql_query("SELECT `category_name`  FROM `categories` WHERE `parent_id` ".(int)$parent_id);

$data = mysql_fetch_array($sql);
return $data['category_name'];

}


?>