<?php
session_start();
if(isset($_SESSION['LoginUser']) && !empty($_SESSION['LoginUser'])){
$_SESSION['LoginUser'] ='';
unset($_SESSION['LoginUser']);
//session_destroy();
header('Location:index.php');
}
?>