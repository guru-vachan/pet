<?php
session_start();
//print_r ($_SESSION);die();
if(isset($_SESSION['LoginUser']) && !empty($_SESSION['LoginUser'])){
$_SESSION['LoginUser'] ='';
unset($_SESSION['LoginUser']);
//session_destroy();
header('Location:index1.php');
}
?>