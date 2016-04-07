<?php
	session_start();
	$id = isset($_GET['id'])?$_GET['id']:"";
	if($id==""){
		header("Location: products.php");
	}
	require_once('fns/cart.php');
	$cart = new Cart;
	$cart->addProduct($id);
	if(isset($_SERVER['HTTP_REFERER']))
		header('Location: '.$_SERVER['HTTP_REFERER']);
	else
		header("Location: products.php");
	exit;
?>