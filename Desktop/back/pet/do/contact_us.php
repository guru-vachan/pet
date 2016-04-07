<?php
if($_POST){
    
	//echo "hiii";die();
	$msg = isset($_POST['message'])?$_POST['message']:'';
	$name = isset($_POST['name'])?$_POST['name']:'';
	$email = isset($_POST['email'])?$_POST['email']:'';
	$mob = isset($_POST['phone'])?$_POST['phone']:'';
	echo $mob;
	//echo "ram";die();
	
	//$msg1 = 'Name:' .$_POST['name'] .'\n' 
	  //       .'Message' .$_POST['message'] .'\n' 
		//	 .'Email' .$_POST['email']. '\n' 
			// .'Phone' .$_POST['phone']
	
	if($msg == "" ||  $name == "" || $email == "") {			// check if all fields are filled in the form
		//$_SESSION[C_CONTACT] = E_NOT_FILLED;
		//header('Location: ../');
		//exit;
	}
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) 			// Check if email is valid or not syntactically
    {
    //    $_SESSION[C_CONTACT] = E_VALID_EMAIL;
    //    header('Location: ../');
    //    exit;
    }
	require_once('../fns/db_fns.php');
	$dbh = new PDOConfig;
	$ip = ip2long($_SERVER['REMOTE_ADDR']);
	$stmt = $dbh->prepare("INSERT INTO contactus (name, email, msg, mob, added_on, ip, status) VALUES (?, ?, ?, ?, now(), ?, ?)");
	//echo $stmt;die();
    //$ip = ip2long($_SERVER['REMOTE_ADDR']);		// user's IP
  if($stmt->execute(array($name, $email, $msg, $mob, $ip, 0))) {
		//$_SESSION[C_CONTACT] = E_THANKS;
		
		// now send the mail
		//$mailMsg = "Hi! Your query has been received. We'll get back to you as soon as possible! <br><br> Thank you!<br><br>Team Pet Store.<br><br>----------------------<br>".$msg;
		//$headers = "From: Pet Store <contact@alkeste.com>\r\n";    //Replace the email id by which you wish to send the mail
		
		//$headers.= "MIME-Version: 1.0\r\n";
		//$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		//$subject = 'Contact Us | Pet Store';
		#send the mail finally
		//mail($email, 'Simple Contact Form',$msg1 );
		echo "success";die;
		
	}
	//else {
		//$_SESSION[C_CONTACT] = E_SORRY;
		//echo "plz enter correct details."
	//}
	
}
?>