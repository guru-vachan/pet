<?php
	session_start();
	$id = isset($_GET['id'])?$_GET['id']:"";
	if($id==""){
		header("Location: matrimonial-groom.php");
		exit;
	}
	var_dump($id);
	require_once('fns/auth.php');
	require_once('fns/db_fns.php');
	$helper = new AuthHelper;
	if(!$helper->loggedIn()){
		$_SESSION['matri']['groom'] = "Please Log In to continue";
	} else {
		$dbh = new PDOConfig;
		$sql = "INSERT INTO matri_data VALUES(NULL, $id, ".$helper->getId().")";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array());
		$_SESSION['matri']['groom'] = "Thank you. We'll get in touch soon.";
	}
	
	header("Location: matrimonial-groom.php");
	exit;
?>