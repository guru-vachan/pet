<?php
ob_start();
include('config.php');
include('header.php');
include('../classes/upload.php');
$cat_sql = mysql_query("SELECT * FROM `categories` WHERE parent_id=0");

if($_POST)
{
 
 $p_name=$_POST['p_name'];
 $p_price=$_POST['p_price'];
 $p_type=$_POST['p_type'];
 $p_cat=$_POST['category'];
 
 $short = $_POST['short'];
 
 $flag=true;
    if(empty($p_name))
   {
		$ProductErr1 = 'Please Enter First Name.';
		$flag = false;
	}
	else if(!preg_match("/^[a-zA-Z]*$/",$p_name)){
      $ProductErr1='Only Contain White space and contain letters.';
	  }else{
	    $flag=true;
		}
	  
	if(empty($p_price))
	{
		$ProductErr2 = 'Please Enter Last Name.';
		$flag = false;
	}
	else if(!preg_match("/^[0-9]*$/",$p_price)){
      $ProductErr2='Only Contain numbers.';
	  }
	  else{
	    $flag=true;
		}
	if(empty($p_type))
	{
		$ProductErr3 = 'Please Enter Type of product.';
		$flag = false;
	}
    else if(!preg_match("/^[a-zA-Z]*$/",$p_type))
	{
      $ProductErr3='Only Contain White space and contain letters.';
	 }
	  else
	  {
	    $flag=true;
	  }
	if( isset($_FILES['product_image']['name']) && $_FILES['product_image']['name'] !="")
	{
	    $file=pathinfo($_FILES['product_image']['name']);
       
	    $filename=$file['file_name'].time();
	  
	    $extension=$file['extension'];
	  
	   
	   $fileArr = array('jpg','jpeg','png');
		if(!in_array(strtolower($extension),$fileArr))
		{
				$fileErr = 'Please upload only jpg,jpeg and png file.';
				
				$flag = false;
		}
		else
		{
		$flag = true;
		
		$product_image = $_FILES['product_image'];
		$upload = new Upload();
		
		$small_thumb = array('size' => array(PRODUCT_IMAGE_SMALL_WIDTH,PRODUCT_IMAGE_SMALL_HEIGHT), 'type' => 'resizecrop');
		$smallthumbResult = $upload->fileupload($product_image, PRODUCT_IMAGE_SMALL, '', $small_thumb);
		
		$large_thumb = array('size' => array(PRODUCT_IMAGE_LARGE_WIDTH,PRODUCT_IMAGE_LARGE_HEIGHT), 'type' => 'resizecrop');
		$largethumbResult = $upload->fileupload($product_image, PRODUCT_IMAGE_LARGE, '', $large_thumb);
		
		
		$res1 = $upload->fileupload($product_image,PRODUCT_IMAGE, '');
		
		if (!empty($upload->result) && empty($upload->errors)) {
		
		$product_image  =  $upload->result;
		//echo 'hii';
		}
		
		
	  }
	}
	else{
	  $fileErr = "please upload image";
	  $flag=false;
	}
	
if($flag==1)
{ 
   //echo  "INSERT INTO `product`(`p_name`,`p_price`,`product_image`,`p_type`,`short`,`full`) VALUES('".$p_name."',".$p_price.",'".$product_image."','".$p_type."','".$short."','".$full."')"; die;
  $sql=mysql_query("INSERT INTO `dog`(`p_name`,`p_price`,`product_image`,`category_id`,`short`) VALUES('".$p_name."',".$p_price.",'".$product_image."','".$p_cat."','".$short."')");
   if($sql)
   {
			
     header("Location:../market.php");
	}
 else{
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
                <h2><i class="glyphicon glyphicon-edit"></i> Add Breed</h2>

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
                <form role="form" action ="<?php echo $_SERVER['PHP_SELF'];?>" method ="post" enctype= "multipart/form-data">
				<div class="form-group">
                        <label>Name</label>
                        <input type="text" name="p_name"class="form-control" id="p_name" placeholder="Enter Product Name" value ="<?php echo isset($_POST['P_name'])?$_POST['P_name']:'';?>"/>
						<?php if(isset($ProductErr1)) {?>
						<p class="help-block error"><?php echo $ProductErr1;?></p>
						<?php }else{
						echo '';
						}?>
						
                    </div>
					<div class="form-group">
                        <label>Price</label>
                        <input type="text" name="p_price"class="form-control" id="p_price" placeholder="Enter Product's Price"  value ="<?php echo isset($_POST['p_price'])?$_POST['p_price']:'';?>"/>
						<?php if(isset($ProductErr2)) {?>
						<p class="help-block error"><?php echo $ProductErr2;?></p>
						<?php }else{
						echo '';
						}?>
						
                    </div>
					
					<div class="form-group">
                        <label>Product Type</label>
                        <input type="text" name="p_type"class="form-control" id="p_type" placeholder="Enter your Product Type" value ="<?php echo isset($_POST['p_type'])?$_POST['p_type']:'';?>"/>
						<?php if(isset($ProductErr3)) {?>
						<p class="help-block error"><?php echo $ProductErr3;?></p>
						<?php }else{
						echo '';
						}?>
                    </div>
					<div class="form-group">
                        <label>Product Image</label>
						
                        <input type="file" name="product_image" id="product_image" >
                        <?php if(isset($fileErr)) {?>
						<p class="help-block error"><?php echo $fileErr;?></p>
						<?php }else{
						echo '';
						}?>
					
					</div>
					<div class="form-group">
                        <label>Select Category</label>
                    <div class="controls">
                        <select data-placeholder="Please Select Your Category" id="selectError2" data-rel="chosen" name="category">
                            <option value=""></option>
                            <?php while($row = mysql_fetch_array($cat_sql)) {?>
							<option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option>
							<?php } ?>
                        </select>
                    </div>
					</div>
					
					<div class="form-group">
                        <label>Briefly Discription</label>
						
                        <textarea type="text" rows="2" cols="5" class="form-control" name="short" id="short" ></textarea><br/>
						
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