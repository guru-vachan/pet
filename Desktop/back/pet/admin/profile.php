  <?php
  include('config.php');  
  include('header.php');
  if(!isset($_SESSION['LoginUser']) && empty($_SESSION['LoginUser'])){
	header('Location:index.php');
}
 //echo '<pre>';
 //print_r($_SESSION);die;
 $id = isset($_SESSION['LoginUser']['id'])?$_SESSION['LoginUser']['id']:'';

 if($_POST){
/* echo '<pre>';
print_r($_POST); 
echo md5('12345678');
die; 
 */	
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$email = $_POST['email'];
	
	//$password = md5($password);
	$sql = mysql_query("UPDATE `profile` SET `f_name`='".$f_name."',`l_name`='".$l_name."',`email`='".$email."' WHERE id=".(int)$id);
	
	if($sql){
	 $sql = mysql_query("SELECT * FROM `profile` WHERE `id` =".(int)$id);
	$data =mysql_fetch_array($sql,MYSQL_ASSOC);
	$_SESSION['LoginUser'] = $data;
		$message="Profile updated successfully";
		//header('Location:profile.php');
		
	}{
	
	$errorMsg =  "Invalid email and password .";
	}
	
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
                <h2><i class="glyphicon glyphicon-edit"></i> Profile</h2>

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
                <form role="form" action ="<?php echo $_SERVER['PHP_SELF'];?>" method ="post">
				<div class="form-group">
                        <label for="f_name">First Name</label>
                        <input type="text" name="f_name"class="form-control" id="f_name" placeholder="Enter First Name" value ="<?php echo isset($_SESSION['LoginUser']['f_name'])?$_SESSION['LoginUser']['f_name']:'';?>">
                    </div>
					<div class="form-group">
                        <label for="l_name">Last Name</label>
                        <input type="text" name="l_name"class="form-control" id="l_name" placeholder="Enter Last Name" value ="<?php echo isset($_SESSION['LoginUser']['l_name'])?$_SESSION['LoginUser']['l_name']:'';?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name = "email"class="form-control" id="exampleInputEmail1" placeholder="Enter email" value ="<?php echo isset($_SESSION['LoginUser']['email'])?$_SESSION['LoginUser']['email']:'';?>">
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