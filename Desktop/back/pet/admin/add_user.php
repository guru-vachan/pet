<?php
include('config.php');
include('header.php');
//echo $_POST();die;
include('classes/PHPMailer/PHPMailerAutoload.php');
$mail = new PHPMailer();
if($_POST)
{
 /* echo '<pre>';
 print_r($_POST); die;  */
$f_name=test($_POST['f_name']);

$l_name=test($_POST['l_name']);
$email=$_POST['email'];
$password=$_POST['password'];
$created=date('Y-m-d H:i:s');
$msg = '<html><body>';
$msg.= '<p>Hello'.$f_name.' '.$l_name.'</p>';
$msg.= '<p>Thanks for registration.</p>';
$msg.= '<p>Please login your detail.</p>';
$msg.= '<p>Email:'.$email.'</p>';
$msg.= '<p>Password:'.$password.'</p>';
$msg.= '</body></html>';
sendMail($mail,$email,$msg,'Registration',$from=null,$attachment=null);die;
$flag=true;
    
   if(empty($f_name))
  {
		$userErr1 = 'Please Enter First Name.';
		$flag = false;
  }
   else if(!preg_match("/^[a-zA-Z]*$/",$f_name))
	{
      $userErr1='Only Contain White space and contain letters.';
	 }
	  else
	  {
	    $flag=true;
	  }
	if(empty($l_name)){
		$userErr2 = 'Please Enter Last Name.';
		$flag = false;
	}
	else if(!preg_match("/^[a-zA-Z]*$/",$l_name))
	{
      $userErr2='Only Contain White space and contain letters.';
	 }
	  else
	  {
	    $flag=true;
	  }
	if(empty($email)){
		$userErr3 = 'Please Enter email.';
		$flag = false;
	}
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$emailErr="Invalid email format";
		$flag = false;
	}else{
		$flag = true;
	} 
	
	if(empty($password)){
		$userErr4 = 'Please Enter password.';
		$flag = false;
	}
	if($flag)
	{	
//	echo "INSERT INTO `users`(`f_name`,`l_name`,`email`,`password`,`created`) VALUES('".$f_name."','".$l_name."','".$email."','".$password."','".$created."')";die;
	
$sql=mysql_query("INSERT INTO `users`(`f_name`,`l_name`,`email`,`password`,`created`) VALUES('".$f_name."','".$l_name."','".$email."','".$password."','".$created."')");

$msg = '<html><body>';
$msg.= '<p>Hello'.$f_name.' '.$l_name.'</p>';
$msg.= '<p>Thanks for registration.</p>';
$msg.= '<p>Please login your detail.</p>';
$msg.= '<p>Email:'.$email.'</p>';
$msg.= '<p>Password:'.$password.'</p>';
$msg.= '</body></html>';

		if($sql)
		{
		
			sendMail($mail,$email,$msg,'Registration',$from=null,$attachment=null);
			$message= "öperation success";
			header("Location:user_listing.php");
		}
		else
		{
			$message= "failed";
		}
	}
}
function test($data)
	{
	 $data=trim($data);
	 $data=stripslashes($data);
	 $data=htmlspecialchars($data);
	 return $data;
	}
?>
<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
		<?php if(isset($message) && !empty($message)){?>
		<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo $message;?>
                </div>
				<?php } ?>
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Add Users</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form role="form" action ="<?php echo $_SERVER['PHP_SELF'];?>" method ="post" >
				<div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name"class="form-control" id="f_name" placeholder="Enter User Name" value ="<?php echo isset($_POST['f_name'])?$_POST['f_name']:'';?>"/>
						<?php if(isset($userErr1)) {?>
						<p class="help-block error"><?php echo $userErr1;?></p>
						<?php }else{
						echo '';
						}?>
						<label>Last Name</label>
                        <input type="text" name="l_name"class="form-control" id="l_name" placeholder="Enter last Name" value ="<?php echo isset($_POST['l_name'])?$_POST['l_name']:'';?>"/>
						<?php if(isset($userErr2)) {?>
						<p class="help-block error"><?php echo $userErr2;?></p>
						<?php }else{
						echo '';
						}?>
                    </div>
					<div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email"class="form-control" id="email" placeholder="Enter your email" value ="<?php echo isset($_POST['email'])?$_POST['email']:'';?>"/>
						<?php if(isset($emailErr)) {?>
						<p class="help-block error"><?php echo $emailErr;?></p>
						<?php }else{
						echo '';
						}?>
                    </div>
					<div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password"class="form-control" id="password" placeholder="Enter your Password" value ="<?php echo isset($_POST['password'])?$_POST['password']:'';?>"/>
						<?php if(isset($categoryErr4)) {?>
						<p class="help-block error"><?php echo $categoryErr4;?></p>
						<?php }else{
						echo '';
						}?>
                    </div>

                   
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
  <?php include('footer.php');?> 