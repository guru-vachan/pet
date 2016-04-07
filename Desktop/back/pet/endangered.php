<html lang="en"><head>

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
    <link href="http://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css">

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
					<img src="img/a47.jpg" alt="petstore logo" width="50" height="70">
					<b> Pet Store </b> 
				</a>
				

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden active">
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
					<li>
                        <a class="page-scroll" href="checkout.php"><i class="fa fa-shopping-cart"></i> 2</a>
                    </li>
					<li>
                        <a class="page-scroll" href="index.php#login" data-toggle="modal">Login</a>
                    </li>
					<li>
                        <a class="page-scroll" href="index.php#signup" data-toggle="modal">Sign Up</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	
	<!---- LOGIN MODAL ----->
	
	 <!-- Portfolio Modal 4 -->
     <div class="portfolio-modal modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
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
                            <h2 style="color:rgb(250, 197, 82);">LOGIN</h2>
                            <p class="item-intro text-muted" style="color:black;">Log into your account here.</p>
                            <p>
							</p><div class="row">
                <div class="col-lg-12">
                    <form id="loginForm" action="do/login.php" method="post" novalidate="">
                        <div class="row">
                            <div class="col-md-6">
                                    
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *" id="email" required="" data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
								<div class="form-group">
                                    <input type="password" name="passwd" class="form-control" placeholder="Your Password *" id="password" required="" data-validation-required-message="Please enter your password.">
                                    <p class="help-block text-danger"></p>
                                </div>
                              
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <!-- <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
									-->
									<div class="clearfix"></div>
									<div class="col-lg-12 text-center">
										<div id="success"></div>
										<button type="submit" class="btn btn-xl">Submit</button>
									</div>
								</div>
                            </div>
                        </div>
                           
                    </form>
                </div>
            </div>
							<p></p>
                            
							<button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color: crimson;"><i class="fa fa-times"></i> CLOSE </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	
	<!------------------------>
	
	<!---- SIGNUP MODAL ----->
	
	 <!-- Portfolio Modal 4 -->
	 
	  <div class="portfolio-modal modal fade" id="signup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
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
                            <h2 style="color:rgb(250, 197, 82);">SIGN UP</h2>
                            <p class="item-intro text-muted" style="color:black;">Sign up to create your new account.</p>
								<div class="row">
									<div class="col-lg-12">
										<form method="post" action="do/signup.php" id="signupForm" novalidate="">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input name="name" type="text" class="form-control" placeholder="Your Name *" id="name" required="" data-validation-required-message="Please enter your name.">
														<p class="help-block text-danger"></p>
													</div>
													<div class="form-group">
														<input name="email" type="email" class="form-control" placeholder="Your Email *" id="email" required="" data-validation-required-message="Please enter your email address.">
														<p class="help-block text-danger"></p>
													</div>
													<div class="form-group">
														<input name="passwd" type="password" class="form-control" placeholder="Your Password *" id="password" required="" data-validation-required-message="Please enter your password.">
														<p class="help-block text-danger"></p>
													</div>
												<!--	<div class="form-group">
														<input type="password" class="form-control" placeholder="Your Password *" id="password" required data-validation-required-message="Please confirm your password.">
														<p class="help-block text-danger"></p>
													</div>  -->
													
												</div>
												<div class="col-md-6">
													
													 <div class="clearfix"></div>
													<div class="col-lg-12 text-center">
														<div id="success"></div>
														<button type="submit" class="btn btn-xl">Submit</button>
													</div>
												</div>
													
											</div>
										</form>
									<button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color: crimson;"><i class="fa fa-times"></i> CLOSE </button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    
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
    <li><a href="lost.php" class=""> <b> <em> LOST &amp; FOUND </em> </b> </a></li>
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
    


	
	
	
	
	
	
	
	
	
	
	
	
    <!-- About Section -->
    <section id="about" style="background-color: rgb(61, 95, 116);">
        <div class="container" style="color:rgb(81, 118, 86);">
            <div class="row" style=" margin-right: -210px;">
                <div class="col-lg-12 text-center" style=" background-color: rgb(205, 103, 73); margin-left: -105px; margin-right: -180px; ">
                    <h2 class="section-heading" style="background-color: rgb(0, 0, 0); padding-bottom:15px; padding-top:15px;margin-right: -230px;color: rgb(219, 240, 31);">ENDANGERED SPECIES</h2>
                    <h3 class="section-subheading text-muted" style="margin-right: -200px;">MEET THEM!</h3>
                </div>
            </div>
			<div style="color:rgb(199, 172, 172)">
				<div class="row" style="padding-top:60px; background-color: rgb(175, 116, 221);margin-left: -150px;margin-right: -105px;">
					<div class="col-lg-offset-1 col-lg-5 img-circle">
						<a href="#" style="" class="circle-anim-parent">
							<img src="img/endangered/tibetan-mastiff_ph.jpg" class=" img-circle" style="width:370px; height:370px;">
						<!--	<div style="position: absolute;top: 0;text-align: center;font-weight: bold;color: #000;font-size: 24px;width:100%">-->
							
						
						</a>
					</div>
					<h2 style="color:blue"> TIBETAN MASTIFF</h2>
					<div class="col-lg-5" style="padding-top:75px">
						The Tibetan Mastiff is huge in size and noble in bearing, known for a “solemn but kind expression” and an impressive double coat. Its aloof, watchful, and independent nature makes the Tibetan Mastiff an excellent guardian breed but a reluctant participant in organized activities like obedience.
					</div>
				</div>
				<h2 style="color:blue"> AZAWAKH</h2>
				<div class="row" style="padding-top:20px">
					<div class="col-lg-offset-1 col-lg-5" style="padding-top:75px">
						This West African sighthound makes a fiercely protective companion and guardian, and an extremely intelligent lure courser. The breed is elegantly built and features a short coat in a wide variety of colors and markings.				</div>
					<a href="#" style="" class="circle-anim-parent">
							<img src="img/endangered/azawakh_ph.jpg" class=" img-circle" style="width:370px; height:370px;">
						<!--	<div style="position: absolute;top: 0;text-align: center;font-weight: bold;color: #000;font-size: 24px;width:100%">-->
							
						
						</a>
						<div style="color:rgb(199, 172, 172)">
				<div class="row" style="padding-top:60px; background-color: rgb(139, 54, 103);margin-left: -150px;margin-right: -105px;">
					<div class="col-lg-offset-1 col-lg-5 img-circle">
						<a href="#" style="" class="circle-anim-parent">
							<img src="img/endangered/catalburun_ph.jpg" class=" img-circle" style="width:370px; height:370px;">
						<!--	<div style="position: absolute;top: 0;text-align: center;font-weight: bold;color: #000;font-size: 24px;width:100%">-->
							
						
						</a>
					</div>
					<h2 style="color:blue"> CATALBURUN</h2>
					<div class="col-lg-5" style="padding-top:75px">
						Possibly because of severe inbreeding due to their rarity, the Catalburun is one of the only dogs in the world featuring a split nose and suspended ears. They were originally bred for hunting in Turkey.
					</div>
				</div>
				<h2 style="color:blue"> OTTERHOUND</h2>
				<div class="row" style="padding-top:20px">
					<div class="col-lg-offset-1 col-lg-5" style="padding-top:75px">
						As its name implies, the massive Otterhound is very capable in the water. The scent hound has webbed feet and a rough, double coat, which also makes it a great hunter on land. Otterhounds excel as pets too, being inquisitive, boisterous, and amiable.				</div>
					<a href="#" style="" class="circle-anim-parent">
							<img src="img/endangered/otterhound_ph.jpg" class=" img-circle" style="width:370px; height:370px;">
						<!--	<div style="position: absolute;top: 0;text-align: center;font-weight: bold;color: #000;font-size: 24px;width:100%">-->
							
						</a>
						
						<div style="color:rgb(199, 172, 172)">
				<div class="row" style="padding-top:60px; background-color: rgb(253, 85, 55);margin-left: -150px;margin-right: -105px;">
					<div class="col-lg-offset-1 col-lg-5 img-circle">
						<a href="#" style="" class="circle-anim-parent">
							<img src="img/endangered/karelian-bear-dog_ph.jpg" class=" img-circle" style="width:370px; height:370px;">
						<!--	<div style="position: absolute;top: 0;text-align: center;font-weight: bold;color: #000;font-size: 24px;width:100%">-->
							
						
						</a>
					</div>
					<h2 style="color:blue">Finnish Karelian Bear Dog </h2>
					<div class="col-lg-5" style="padding-top:75px">
						The Finnish Karelian Bear Dog is one of the top 10 most common breeds in its home country. Originally used for hunting and as a watchdog, it has quick reflexes and a fearless nature, and is still popular with big-game hunters.
					</div>
				</div>
				<h2 style="color:blue">Lagotto Romagnolo </h2>
				<div class="row" style="padding-top:20px">
					<div class="col-lg-offset-1 col-lg-5" style="padding-top:75px">
						Hailing from the Romagna sub-region of Italy, the Lagotto Romagnolo was named as a lake dog and traditionally used as a gun dog. Its most interesting occupation, though, is truffle hunting.					</div>
					<a href="#" style="" class="circle-anim-parent">
							<img src="img/endangered/lagotto-romagnolo_ph.jpg" class=" img-circle" style="width:370px; height:370px;">
						<!--	<div style="position: absolute;top: 0;text-align: center;font-weight: bold;color: #000;font-size: 24px;width:100%">-->
							
						
						</a>
			<!--		<a href="" id="pic-hov"><img src="img/about/4.jpg"  class="col-lg-5 img-circle"> </img> </a>  -->
				</div>
			</div>
			
			
        </div>
    </div></div></div></div></section>
	

    <footer>
        <div class="container">
			<div class="row">
				<div class="col-xs-4">
					<h4>Testimonials</h4>
					<strong style="font-family: monospace; font-style: italic; color: floralwhite" ;="">Pranjal Mittal</strong>
					<hr style="border-top-width:medium;">
					<p style="color:lavender;font-family: serif;font-style: initial;"><i class="fa fa-quote-left pet-quote"></i> &nbsp; Awesome &amp; Innovative website for pet-lovers. Extremely User-friendly and Unique in itself. Amazing to see a site which is successful in capturing the love for pets in so Mesmerising and Creative way. &nbsp; <i class="fa fa-quote-right pet-quote"></i></p>
				</div>
				<div class="col-xs-4">
					<h4>Quick Links</h4>
					<div class="col-xs-6">
						<ul class="list-unstyled">
							<li><a href="index.php"><i class="fa fa-home pet-home"></i>   &nbsp; Home</a></li>
							<li><a href="index.php#services"><i class="fa fa-paw pet-paw"></i>  &nbsp;  Breeds</a></li>
							<li><a href="index.php#portfolio"><i class="fa fa-suitcase pet-suitcase"></i> &nbsp;   Portfolio</a></li>
							<li><a href="about.php"><i class="fa fa-question-circle pet-question-circle"></i>   &nbsp; About</a></li>
							<li><a href="about.php#team"><i class="fa fa-group pet-group"></i>  &nbsp;  Team</a></li>
							<li><a href="index.php#contact"><i class="fa fa-envelope pet-envelope"></i> &nbsp;   Contact</a></li>
							<li><a href="#"><i class="fa fa-briefcase pet-breifcase"></i>  &nbsp;  Donate</a></li>
							<li><a href="#"><i class="fa fa-book pet-book"></i>  &nbsp;  FAQs</a></li>
							<li><a href="#"><i class="fa fa-pencil pet-pencil"></i>  &nbsp;  Disclaimer</a></li>
						</ul>
					</div>
					<div class="col-xs-6">
						<ul class="list-unstyled">
							<li><a href="#shop"><i class="fa fa-shopping-cart pet-shopping-cart"></i>  &nbsp;  Shop</a></li>
							<li><a href="#buy/sell"><i class="fa fa-money pet-money"></i>  &nbsp;  Buy/Sell</a></li>
							<li><a href="events.php"><i class="fa fa-spinner pet-spinner"></i>  &nbsp;  Events</a></li>
							<li><a href="#matrimony"><i class="fa fa-heart pet-heart"></i>  &nbsp;  Matrimony</a></li>
							<li><a href="#landf"><i class="fa fa-paw pet-paw"></i>  &nbsp;  Lost &amp; Found</a></li>
							<li><a href="#endangered"><i class="fa fa-frown-o pet-frown-o"></i>  &nbsp;  Endangered</a></li>							
							<li><a href="#sponsors"><i class="fa fa-users pet-users"></i>  &nbsp;  Sponsors</a></li>
							<li><a href="#gallery"><i class="fa fa-sliders pet-sliders"></i>  &nbsp;  Gallery</a></li>
							<li><a href="#tandc"><i class="fa fa-warning pet-warning"></i>  Terms &amp; Conditions</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xs-4">
				<h4> VISIT US </h4>
					<strong style="font-family: monospace; font-style: italic; color: floralwhite" ;="">Our Venue</strong>
					<hr style="border-top-width:medium;">
					<p style="color:lavender;font-family: serif;font-style: initial;"><i class="fa fa-home pet-home"></i>  PetStore Developers. <br> JIIT, A-10, Sector 62, Noida, Uttar Pradesh, India. <br><br> Phone: <i class="fa fa-phone pet-phone"></i>  +91-9811856735 <br> Email: <i class="fa fa-envelope pet-envelope"></i>  upanyasingh@gmail.com <br> </p>
					
					
				</div>
			</div>
            <div class="row" style="text-align:center">
                <div class="col-md-4">
                    <span class="copyright"><b>Copyright © Pet Store 2014</b></span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#" id="twitr"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#" id="link-fb"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#" id="lnkdin"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">  
                        <li><a href="#"><b>Privacy Policy</b></a>
                        </li>
                        <li><a href="#"><b>Terms of Use</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <!--<script src="js/contact_me.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>




</body></html>