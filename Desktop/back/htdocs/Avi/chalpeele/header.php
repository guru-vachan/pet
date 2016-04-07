 <?php 
 //session_start();
 ?>
 <html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Online Movie Store</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.min.js"></script>
</head>
<body>
<div id="wrapper">
  <div id="inner">
 <div id="header">
      <h1><img src="images/logo.gif" width="519" height="63" alt="Online Movie Store" /></h1>
      <div id="nav"> <a href="index.php">HOME</a> |
	  <a href="view_cart.php" >view cart <b id="p_qty"><?php echo isset($_SESSION['cart'])? '('.count($_SESSION['cart']).')':'(0)'?><b></a> | <a href="http://all-free-download.com/free-website-templates/">help</a> </div>
      <!-- end nav -->
      <a href="http://all-free-download.com/free-website-templates/"><img src="images/header_1.jpg" width="744" height="145" alt="Harry Potter cd" /></a>  </div>
    <!-- end header -->
<?php include('front_left.php'); ?>