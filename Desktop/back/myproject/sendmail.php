<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;
//print_r($mail);die;
$mail->isSMTP();   
$mail->SMTPAuth = true;                                    // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->Username = 'guruvachanjain1996@gmail.com';                 // SMTP username
$mail->Password = 'jainguru';                           // SMTP password
//$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to

$mail->From = 'chalpeele@gmail.com';
$mail->FromName = 'Mailer';
$mail->addAddress('guruvachanj@gmail.com', 'Joe User');     // Add a recipient
   // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>