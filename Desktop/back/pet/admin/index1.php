<?php
include('config.php');
//print_r($_SESSION);die;
//echo md5(123456);die(); 
   if(isset($_SESSION['LoginUser']) && !empty($_SESSION['LoginUser'])){
	header('Location:dashboard.php');
  } 
 if($_POST){
// echo '<pre>';
//print_r($_POST); 
//echo md5($_POST['password']);
//echo md5(123456);
//die; 
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	//$password = md5($password);
	$sql = mysql_query("SELECT * FROM `user` WHERE `email` ='".$email."' AND `passhash` ='".md5($password)."' AND `uid` = 8 AND `group` = 2");
	
	$numrows = mysql_num_rows($sql);
	//echo $numrows;
	if($numrows>0){
		$data =mysql_fetch_array($sql,MYSQL_ASSOC);
		
		$_SESSION['LoginUser'] = $data;
		header('Location:dashboard.php');
	}else{
	
	$errorMsg =  "Invalid email and password .";
	}
	
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>Free HTML5 Bootstrap Admin Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link href='css/responsive-tables.css' rel='stylesheet'>
    <link href="css/charisma-app.css" rel="stylesheet">
 <link href='css/chosen.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>

<body>


	<div class="ch-container">
    <div class="row">
	       
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Welcome to Charisma</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                <?php echo isset($errorMsg)?$errorMsg:'Please login with your Username and Password.';?>
            </div>
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="clearfix"></div>

                    

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='js/moment.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>
<!-- plugin for gallery image view -->
<script src="js/jquery.colorbox-min.js"></script>

<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="js/responsive-tables.js"></script>

<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>

<script src="js/chosen.jquery.min.js"></script>
</body>
</html>

	