<?php 
	session_start(); 
	//var_dump($_SESSION);
	require_once('fns/auth.php');
    $helper = new AuthHelper;
	require_once('fns/cart.php');
    $cart = new Cart;
    if($helper->loggedIn()) {
		$logged = true;
	} else {
		$logged = false;
	}
	
    $serr =$helper->getError(C_SIGNUP);
    $lerr =$helper->getError(C_LOGIN);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pet Store</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">



    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">

        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->

			<div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               &nbsp; &nbsp;
				
                <a href="#portfolioModal00" class="portfolio-link pull-left navbar-brand" style="margin-left: -90px" data-toggle="modal"> 
					<i class="fa fa-bars"></i> 
				</a>
				
				<a class="navbar-brand page-scroll" href="http://localhost/pet/">	            				
					<img src="img/a47.jpg" alt="petstore logo" width="50" height="70"/>
					<b> Pet Store </b> 
				</a>
				

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php#services">Breeds</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="about.php">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="about.php#team">Team</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php#contact">Contact</a>
                    </li>
<?php if($logged==true) { ?>
					<li>
                        <a class="page-scroll" href="#">Hi, <?php echo $helper->getName(); ?></a>
                    </li>
					<li>
                        <a class="page-scroll" href="checkout.php"><i class="fa fa-shopping-cart"></i> <?php echo $cart->getCartCount(); ?></a>
                    </li>
					<li>
                        <a class="page-scroll" href="logout.php">Logout</a>
                    </li>
<?php } else { ?>
					<li>
                        <a class="page-scroll" href="checkout.php"><i class="fa fa-shopping-cart"></i> <?php echo $cart->getCartCount(); ?></a>
                    </li>
					<li>
                        <a class="page-scroll" href="login_modal.php">Login</a>
                    </li>
					<li>
                        <a class="page-scroll" href="signup_modal.php">Sign Up</a>
                    </li>
<?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	
	<!---- LOGIN MODAL ----->
	
	 <!-- Portfolio Modal 4 -->
     
	
	<!---- SIGNUP MODAL ----->
	
	 <!-- Portfolio Modal 4 -->
	
	<!------------------------>

	<div class="portfolio-modal modal fade" id="portfolioModal00" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" id="menu-modal">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
    
						<h2> QUICK LINKS ! </h2>
                            <p class="item-intro text-muted"> Choose any which suits your convenience ;) </p>
                   
				   <!--    					<img class="img-responsive img-centered" src="img/portfolio/dreams-preview.png" alt="">   -->

				    <!--Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                            <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>. --> 
							
							

<div class="one-spot home">
<div id="loader"><div class="vjs-loading-spinner"></div></div>
<div id="wrapper">

 
<a href="#" class="menu-menu sficon-menu" title="Menu"></a>
   
  
<div class="menu-bar">
  <div class="relative">
  <ul class="menu-list">
    
	<li>
      <a href="#" class="menu-title">
        <div class="button-wrap"><!--<div href="#" class="btn btn-blend green action-close">Close</div>--></div>
       <b> <em> MENU </em> </b>
      </a>
    </li>
	
    <li><a href="index.html" class=""> <b> <em> HOME </em> </b> </a></li>
    <li><a href="services.php" class=""> <b> <em> BREEDS </em> </b> </a></li>
    <!--<li><a href="" class=""> <b> <em> FEATURES </em> </b> </a></li> -->
    <li><a href="products.php" class=""> <b> <em> SHOP </em> </b> </a></li>
    <li><a href="market.php" class=""> <b> <em> BUY / SELL </em> </b> </a></li>
    <li><a href="lost.php" class=""> <b> <em> LOST & FOUND </em> </b> </a></li>
    <li><a href="" class=""> <b> <em> ENDANGERED PETS </em> </b> </a></li>
    <li><a href="matrimonial.php" class=""> <b> <em> MATRIMONIAL </em> </b> </a></li>
    <li><a href="events.php" class=""> <b> <em> EVENTS </em> </b> </a></li>
   <!-- <li><a href="" class=""> <b> <em> CONTACT US </em> </b> </a></li>
	<li><a href="" class=""> <b> <em> ABOUT US</em> </b> </a></li> -->
    <li><a href="faq.php" class=""> <b> <em> FAQ </em> </b> </a></li>
    <!--<li><a href="" class=""> <b> <em> DISCLAIMER </em> </b> </a></li>
	<li><a href="" class=""> <b> <em> TERMS & CONDITIONS </em> </b> </a></li>
     <li><a href="" class=""> <b> <em> PRIVACY POLICY </em> </b> </a></li>  
    <li><a href="" class=""> <b> <em> TERMS OF USE </em> </b> </a></li>
	<li><a href="" class=""> <b> <em> TEAM </em> </b> </a></li>  
    <li><a href="" class=""> <b> <em> DONATE </em> </b> </a></li>
    <li><a href="" class=""> <b> <em> GALLERY </em> </b> </a></li>  -->
    
    
    
	
    
		
		
		
         </ul>
      </div>
    </li>

    <li>
	<!--
      <a href="about.html" class=""> <b> <em> ABOUT </em> </b> </a>  -->
	  <!--
      <div class="submenu">
        <ul class="menu-list">
          <li><a href="about.html">Overview</a></li>
          <li><a href="submission_policy.html">Submission Policy</a></li>
          <li><a href="http://sfarts.org/addevent/addevent.html">Submit Event</a></li>
          <li><a href="feedback_support.html">Feedback & Support</a></li>
          <li><a href="colophon.html">Colophon</a></li>
          
        </ul>
      </div> -->
    </li>
  </ul>
  </div><!-- /relative -->
</div><!-- /menu-bar -->
<div class="hide submenu-bar"></div>

  
  
</div>
</div>
<br> <br>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color: crimson;"><i class="fa fa-times"></i><b> CLOSE </b></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


	
	
	
	
	
	
	
	
	
	
	
	