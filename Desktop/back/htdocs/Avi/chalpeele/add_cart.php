<?php
session_start();
//session_destroy();die;
$p_id = $_REQUEST['p_id'];
if(isset($_SESSION['cart'])){
	if(array_key_exists($p_id,$_SESSION['cart'])){
		$_SESSION['cart'][$p_id]['qty'] = $_SESSION['cart'][$p_id]['qty']+1;
		//echo "hrrr";
		//print_r($_SESSION['cart']);
		echo count($_SESSION['cart']);die;
	}else{
		$_SESSION['cart'][$p_id]['id'] = $p_id;
		$_SESSION['cart'][$p_id]['qty'] = 1;
		//echo "hello";
		//print_r($_SESSION['cart']);
		echo count($_SESSION['cart']);die;
	}
}else{
	$_SESSION['cart'][$p_id]['id'] = $p_id;
	$_SESSION['cart'][$p_id]['qty'] = 1;
	//print_r($_SESSION['cart']);
	echo count($_SESSION['cart']);die;
}

?>
