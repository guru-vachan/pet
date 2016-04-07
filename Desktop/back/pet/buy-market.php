<?php
	session_start();
	$id = isset($_GET['id'])?$_GET['id']:"";
	if($id==""){
		header("Location: market.php");
	}
	require_once('fns/cart.php');
	$cart = new Cart;
	$cart->addPet($id);
	if(isset($_SERVER['HTTP_REFERER']))
		header('Location: '.$_SERVER['HTTP_REFERER']);
	else
		header("Location: market.php");
	exit;
?>