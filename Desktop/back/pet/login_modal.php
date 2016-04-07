<?php
require_once('fns/auth.php');
    $helper = new AuthHelper;
$lerr =$helper->getError(C_LOGIN);
?>
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
<?php           if($lerr!="")						// if there is some error from previos login attempt
                {               
                    echo "<div class='alert alert-error'>".
                            "<button type='button' class='close' data-dismiss='alert'>&times;</button>".$lerr."</div>";
                }
?>
                            <p>
							<div class="row">
                <div class="col-lg-12">
                    <form id="loginForm" action="do/login.php" method="post" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                    
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
								<div class="form-group">
                                    <input type="password" name="passwd" class="form-control" placeholder="Your Password *" id="password" required data-validation-required-message="Please enter your password.">
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
							</p>
                            
							<button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color: crimson;"><i class="fa fa-times"></i> CLOSE </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>	
	<!------------------------>