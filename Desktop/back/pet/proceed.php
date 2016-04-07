<?php
	session_start();
	var_dump($_POST);
	if(!isset($_POST) || empty($_POST)){
		header('Location: checkout.php');
		exit;
	}
	$address = isset($_POST['address'])?$_POST['address']:"";
	$mob = isset($_POST['mob'])?$_POST['mob']:"";
	
	if($address == "" || $mob == ""){
		$_SESSION['msg']['checkout'] = "Please fill all the fields.";
		header('Location: checkout.php');
		exit;
	}
	
	//require_once('fns/cart.php');
	//$cart = new Cart;
	//$cart->processRequest($address, $mob);
	
	header('Location: success.php');
	exit;
?>