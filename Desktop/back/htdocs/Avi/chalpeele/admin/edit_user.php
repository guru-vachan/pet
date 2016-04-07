<?php
ob_start();
include('config.php');
include('header.php');
  if(isset($_GET['id']))
   {
     
     $sql= mysql_query("SELECT * FROM `users` WHERE id=".(int)$_GET['id']);
	 
	  $step=mysql_fetch_array($sql,MYSQL_ASSOC);
	 // print_r ($step);die;
	}
 
if($_POST)
{
  $u_id=$_REQUEST['id'];
  //echo $u_id;die;
  $f_name=$_POST['f_name'];
  $l_name=$_POST['l_name'];
  $email=$_POST['email'];
  
  $created=date('Y-m-d H:i:s');
  $flag=true;
    
   if(empty($f_name))
   {
		$categoryErr1 = 'Please Enter First Name.';
		$flag = false;
		
	}
	if(empty($l_name)){
		$categoryErr2 = 'Please Enter Last Name.';
		$flag = false;
		
	}
	if(empty($email)){
		$categoryErr3 = 'Please Enter email.';
		$flag = false;
		
	}
	//echo $flag;die;
	if($flag)
	{	
	 //echo ("UPDATE `users` SET `f_name`='".$f_name."',`l_name`='".$l_name."',`email`='".$email."'where id=".(int)$u_id);die;
     $sql=mysql_query("UPDATE `users` SET `f_name`='".$f_name."',`l_name`='".$l_name."',`email`='".$email."'where id=".(int)$u_id);
	 
		if($sql)
		{
			$message= "öperation success";
			header("Location:user_listing.php");
		}
		else
		{
			$message= "failed";
		}
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
                <h2><i class="glyphicon glyphicon-edit"></i> Edit User Form</h2>

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
				<input type="hidden" name="id" value="<?php echo $_GET['id'] ;?>"/>
				<div class="form-group">
                        <label>First Name</label>
                      <input type="text" name="f_name" class="form-control" id="f_name" placeholder="Enter User Name" value="<?php echo $step['f_name'];?>" />
						<?php if(isset($categoryErr1)) {?>
						<p class="help-block error"><?php echo $categoryErr1;?></p>
						<?php }else{
						echo '';
						}?>
						<label>Last Name</label>
                        <input type="text" name="l_name"class="form-control" id="l_name" placeholder="Enter last Name" value="<?php echo $step['l_name'];?>"/>
						<?php if(isset($categoryErr2)) {?>
						<p class="help-block error"><?php echo $categoryErr2;?></p>
						<?php }else{
						echo '';
						}?>
                    </div>
					<div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?php echo $step['email'];?>"/>
						<?php if(isset($categoryErr3)) {?>
						<p class="help-block error"><?php echo $categoryErr3;?></p>
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