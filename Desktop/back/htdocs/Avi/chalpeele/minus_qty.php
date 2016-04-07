<?php
session_start();
$p_id=$_GET['p_id'];
echo $p_id;
if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart']))
  {
     $_SESSION['cart']=array();
     echo 'hii';
   }
  
     if(array_key_exists($p_id,$_SESSION['cart']))
	 {   //echo 'hii1';
	  //echo '<pre>';
	  //print_r ($_SESSION['cart']);
	    $_SESSION['cart'][$p_id]['qty']--;
		echo  $_SESSION['cart'][$p_id]['qty'];
	 }

	
header("Location:view_cart.php");
?>