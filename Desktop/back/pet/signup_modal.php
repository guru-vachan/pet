<?php
require_once('fns/auth.php');
    $helper = new AuthHelper;
$serr =$helper->getError(C_SIGNUP);
	?>

	
	 <!-- Portfolio Modal 4 -->
<body background="img/dogs/bg3.jpg"> 	 
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
                            <p class="item-intro text-muted" style="color:red;">Sign up to create your new account.</p>
<?php           if($serr!="")						// if there is some error from previos signup attempt
                {               
                    echo "<div class='alert alert-error'>".
                            "<button type='button' class='close' data-dismiss='alert'>&times;</button>".$serr."</div>";
                }
?>
								<div class="row">
									<div class="col-lg-12">
										<form method="post" action="do/signup.php" id="signupForm" novalidate>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input name="name" type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
														<p class="help-block text-danger"></p>
													</div>
													<div class="form-group">
														<input name="email" type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
														<p class="help-block text-danger"></p>
													</div>
													<div class="form-group">
														<input name="passwd" type="password" class="form-control" placeholder="Your Password *" id="password" required data-validation-required-message="Please enter your password.">
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
									<button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color: bluegreen;"><i class="fa fa-times"></i> CLOSE </button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>    
	<!------------------------>
