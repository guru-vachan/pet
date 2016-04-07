<?php
	session_start();
	$id = isset($_GET['id'])?$_GET['id']:"";
	if($id==""){
		header("Location: checkout.php");
	}
	require_once('fns/cart.php');
	$cart = new Cart;
	$cart->removeProduct($id);
	header("Location: checkout.php");
	exit;
?>