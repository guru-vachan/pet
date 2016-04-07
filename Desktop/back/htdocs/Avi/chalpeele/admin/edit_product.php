<?php
ob_start();
include('config.php');
include('header.php');
include('../classes/upload.php');

  if(!isset($_SESSION['LoginUser']) && empty($_SESSION['LoginUser']))
  {
	header('Location:index.php');
  } 
$cat_sql = mysql_query("SELECT * FROM `categories` WHERE parent_id<>0");
//echo "hiii";
if(isset($_GET['p_id']))
{   //echo "hiii4";
	$sql = mysql_query("SELECT * FROM `product` WHERE `p_id` =".(int)$_GET['p_id']);
	$Data = mysql_fetch_array($sql,MYSQL_ASSOC);
	

}
if($_POST)
{
    $p_id = $_POST['p_id'];
	$p_name = $_POST['p_name'];
	$p_price = $_POST['p_price'];
	$p_type = $_POST['p_type'];
	$p_cat=$_POST['category'];
	$flag =true;
	if(isset($_FILES['product_image']['name']) && $_FILES['product_image']['name']!='')
	{
			$file=pathinfo($_FILES['product_image']['name']);
			//$file_name=$file['file_name'].time();
			$file_extension=$file['extension'];
			$fileArr = array('jpg','jpeg','png');
			if(!in_array(strtolower($file_extension),$fileArr))
			{
					$fileErr = 'Please upload only jpg,jpeg and png file.';
					$flag = false;
			}else
			{
			$flag = true;
			$product_image = $_FILES['product_image'];
			$upload = new Upload();
			//echo PRODUCT_IMAGE;die;
			$small_thumb = array('size' => array(PRODUCT_IMAGE_SMALL_WIDTH,	PRODUCT_IMAGE_SMALL_HEIGHT), 'type' => 'resizecrop');
			$smallthumbResult = $upload->fileupload($product_image, PRODUCT_IMAGE_SMALL, '', $small_thumb);
			
			$large_thumb = array('size' => array(PRODUCT_IMAGE_LARGE_WIDTH,PRODUCT_IMAGE_LARGE_HEIGHT), 'type' => 'resizecrop');
			$largethumbResult = $upload->fileupload($product_image, PRODUCT_IMAGE_LARGE, '', $large_thumb);
			
			
			$res1 = $upload->fileupload($product_image, PRODUCT_IMAGE, '');
			//print_r($upload->errors);die;
			if (!empty($upload->result) && empty($upload->errors)) {
				@unlink(PRODUCT_IMAGE_SMALL. $_POST['pre_product_image']);
				@unlink(PRODUCT_IMAGE_LARGE. $_POST['pre_product_image']);
				@unlink(PRODUCT_IMAGE. $_POST['pre_product_image']);
				$product_image  =  $upload->result;
			}
			
		}	
			
			/* if(move_uploaded_file($_FILES["product_image"]["tmp_name"], "product_image/" . $file_name))
			{
			@unlink("product_image/" . $_POST['pre_product_image']);
				$product_image = $file_name;
		    } */
	}
	else
	{
	  $product_image = $_POST['pre_product_image'];
	}
	$short = $_POST['short'];
	$full = $_POST['full'];
	
	if($flag)
	{
	  //echo $flag;
	  //die;
	  //echo  ("UPDATE `product` SET `p_name`='".$p_name."',`p_price`=".$p_price.",`product_image`='".$product_image."',`p_type`='".$p_type."' WHERE p_id =".(int)$p_id);die;
	  $editsql = mysql_query("UPDATE `product` SET `p_name`='".$p_name."',`p_price`=".$p_price.",`product_image`='".$product_image."',`category_id`='".$p_cat."',`p_type`='".$p_type."',`short`='".$short."',`full`='".$full."'  WHERE p_id =".(int)$p_id);
	  
	    if($editsql)
		{
			echo  "success";
			$_SESSION['update'] = true;
			header("Location:product_listing.php");	
		}{
		
		$errorMsg =  "operation fail.";
		} 
	}
}	
?> 
  <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
		
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Edit Product Form</h2>

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
                <form role="form" action ="<?php echo $_SERVER['PHP_SELF'];?>" method ="post" enctype="multipart/form-data">
				<input type="hidden" name ="p_id" value="<?php echo $_GET['p_id'];?>" /> 
				<div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="p_name"class="form-control" id="p_name" placeholder="Enter Product Name" value ="<?php echo isset($Data['p_name'])?$Data['p_name']:$_POST['p_name'];?>">
						<?php if(isset($categoryErr)) {?>
						<p class="help-block error"><?php echo $categoryErr;?></p>
						<?php }else{
						echo '';
						}?>
                    </div>
					<div class="form-group">
                        <label>Product Price</label>
                       
                        <input type="text" name="p_price"class="form-control" id="p_price" placeholder="Enter Product price" value ="<?php echo isset($Data['p_price'])?$Data['p_price']:$_POST['p_price'];?>">
                   
                
                   </div>
				   <div class="form-group">
                        <label>Product Type</label>
                        
                        <input type="text" name="p_type"class="form-control" id="p_type" placeholder="Enter Product type" value ="<?php echo isset($Data['p_type'])?$Data['p_type']:$_POST['p_type'];?>">
                    
                
                   </div>
					
                <div class="form-group">
                   <label>Product Image</label>
				    
                     <input type="file" name="product_image" id="product_image" /></br/>
					 <?php if(isset($Data['product_image']) && $Data['product_image']!=NULL)
					{?>
	               <img src="<?php echo WEBSITE_URL ;?>/product_image/<?php echo $Data['product_image'];?>" alt="smile" width="100" height="100"/><br/>
	              <input type="hidden" name="pre_product_image" value="<?php echo $Data['product_image'];?>"/>
	              <?php } ?>
                 </div>
				 
				 <div class="control-group">
                    <label class="control-label" >Modern Select Category</label>

                    <div class="controls">
                        <select id="category" name ="category" data-rel="chosen" data-placeholder="Please Select Your Category" style="width: 136px;">
                           <option value=""></option>
                            <?php while($row = mysql_fetch_array($cat_sql)) {
							
								$select ='';
								if($row['id']==$Data['category_id']){
									$select ='selected = "selected"';
								}
							
							?>
							<option value="<?php echo $row['id'];?>" <?php echo $select;?>><?php echo $row['category_name'];?></option>
							<?php } ?>
                        </select>
                    </div>
                </div> </br>
				
                   
				   <div class="form-group">
                        <label>Briefly Discription</label>
						
                        <textarea type="text" rows=2 cols=8  name="short" class="form-control" id="short"><?php echo isset($Data['short'])?$Data['short']:$_POST['short'];?></textarea><br/>
					</div>	
				    <div class="form-group">
						<label>Full Discription</label>
						
                        <textarea type="text" rows=4 cols=15  name="full" class="form-control" id="full" ><?php echo isset($Data['full'])?$Data['full']:$_POST['full'];?></textarea>
                      
					
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