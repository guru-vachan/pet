<?php
session_start();
//session_destroy();die;
$p_id = $_REQUEST['p_id'];

	if(array_key_exists($p_id,$_SESSION['cart']))
	{
		unset($_SESSION['cart'][$p_id]);
		
	}


header("Location:view_cart.php");

 
?>