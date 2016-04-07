<?php
ob_start();
session_start();
$con = mysql_connect('localhost','root','guru');
if($con){
//echo 'connect';
}else{
echo mysql_error();
}
mysql_select_db('pet',$con);
//echo dirname(dirname($_SERVER['SCRIPT_NAME'])); // GET FOLDER NAME
$siteFolder = dirname(dirname($_SERVER['SCRIPT_NAME']));
define('SUBDIR', $siteFolder);

define('WEBSITE_URL', 'http://' . $_SERVER['HTTP_HOST']. SUBDIR);
define('CATEGORY_IMAGE' ,$_SERVER['DOCUMENT_ROOT'].$siteFolder.'/category_image/');
define('PRODUCT_IMAGE' ,$_SERVER['DOCUMENT_ROOT'].$siteFolder.'/product_image/');
 /*  THUMB image Path and size*/
define('CATEGORY_IMAGE_SMALL_THUMB' ,CATEGORY_IMAGE.'small_thumb/');
define('CATEGORY_IMAGE_SMALL_THUMB_WIDTH' ,50);
define('CATEGORY_IMAGE_SMALL_THUMB_HEIGHT' ,50);

define('CATEGORY_IMAGE_LARGE_THUMB' ,CATEGORY_IMAGE.'large_thumb/');
define('CATEGORY_IMAGE_LARGE_THUMB_WIDTH' ,100);
define('CATEGORY_IMAGE_LARGE_THUMB_HEIGHT' ,100);

define('PRODUCT_IMAGE_SMALL' ,PRODUCT_IMAGE.'small/');
define('PRODUCT_IMAGE_SMALL_WIDTH' ,95);
define('PRODUCT_IMAGE_SMALL_HEIGHT' ,100);

define('PRODUCT_IMAGE_LARGE' ,PRODUCT_IMAGE.'large/');
define('PRODUCT_IMAGE_LARGE_WIDTH' ,93);
define('PRODUCT_IMAGE_LARGE_HEIGHT' ,107);
define('PER_PAGE_RECORD',3);

/* function getExtension($filename=NULL){
	$file = explode('.',$filename);
	$ext = end($file);
	 echo $ext;
	echo '<pre>';
	print_r($file);die; 
	return $ext;
} */
 function getParentCategoryName($parent_id=NULL){

$sql = mysql_query("SELECT `category_name`  FROM `categories` WHERE `id` =".(int)$parent_id);

$data = mysql_fetch_array($sql);
return $data['category_name'];

}

function sendMail($mail,$to,$message,$subject,$from=null,$attachment=null){


//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "chalpeele@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "guru55555";

//Set who the message is to be sent from
$mail->setFrom('chalpeele@gmail.com', 'GURU');



//Set who the message is to be sent to
$mail->addAddress($to);

//Set the subject line
$mail->Subject = $subject;



//Replace the plain text body with one created manually

$mail->Body = $message;

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;die;
} else {
    echo "Message sent!";die;
}

}
?>