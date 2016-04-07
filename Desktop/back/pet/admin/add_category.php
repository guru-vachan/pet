  <?php
 ob_start();
 include('config.php');
  include('header.php');
  include('../classes/upload.php');
  if(!isset($_SESSION['LoginUser']) && empty($_SESSION['LoginUser'])){
	header('Location:index.php');
}
$categoryErr="";

$cat_sql = mysql_query("SELECT * FROM `categories` WHERE `parent_id` = 0");
/* echo '<pre>';
print_r ($_FILES);die; */
 if($_POST){
/* echo '<pre>';
print_r($_POST); 
echo md5($_POST['password']);
die; 
 */
  $flag =true;
	$category_name = $_POST['category_name'];
	 if(empty($_POST['category_name'])) 
	{
            $categoryErr="category_name is Required.";
           $flag=false;
	 }
       else if(!preg_match("/^[a-zA-Z]*$/",$category_name))
   {
        $categoryErr="Only contain white space and letters.";
		$flag=false;
	}
   else{
        $flag=true;
      }		
	  
	$parent_id = !empty($_POST['parent_id'])?$_POST['parent_id']:0;
	
	
	
	if( isset($_FILES['category_image']['name']) && $_FILES['category_image']['name'] !="")
	{
	    $file=pathinfo($_FILES['category_image']['name']);
       
	    $filename=$file['file_name'].time();
	  
	    $extension=$file['extension'];
	  
	   
	   $fileArr = array('jpg','jpeg','png');
		if(!in_array(strtolower($extension),$fileArr))
		{
				$fileErr = 'Please upload only jpg,jpeg and png file.';
				
				$flag = false;
		}
	  else
	  //{
	    //$flag=true;
	  //}
	  {
		$flag = true;
		
		$category_image = $_FILES['category_image'];
		$up = new Upload();
		
		$small_thumb = array('size' => array(CATEGORY_IMAGE_SMALL_WIDTH,CATEGORY_IMAGE_SMALL_HEIGHT), 'type' => 'resizecrop');
		$smallthumbResult = $up->fileupload($category_image, CATEGORY_IMAGE_SMALL_THUMB, '', $small_thumb);
		
		$large_thumb = array('size' => array(CATEGORY_IMAGE_LARGE_WIDTH,CATEGORY_IMAGE_LARGE_HEIGHT), 'type' => 'resizecrop');
		$largethumbResult = $up->fileupload($category_image, CATEGORY_IMAGE_LARGE_THUMB, '', $large_thumb);
		
		
		$res1 = $up->fileupload($category_image,CATEGORY_IMAGE, '');
		
		if (!empty($up->result) && empty($up->errors)) {
		
		$category_image  =  $up->result;
		//echo 'hii';
		}
		
		
	  }
	
	
	//if(isset($_FILES['category_image']['name']) && $_FILES['category_image']['name']!='')
	//{
		/* echo '<pre>';
        print_r ($_FILES);die; */
		//$file = pathinfo($_FILES['category_image']['name']);
		//$filename = $file['filename'].time(); 
		//$extension = $file['extension']; 
		//$fileArr = array('jpg','jpeg','png');
		//if(!in_array(strtolower($extension),$fileArr))
		//{
			//	$fileErr = 'Please upload only jpg,jpeg and png file.';
				//$flag = false;
	//	}else
		//{
		//$flag = true;
		
		
		
		
		
/*//$filename = $filename.'.'.$extension; 
		$category_image = $_FILES['category_image'];
		$upload = new Upload();
		// small thub
		$small_thumb = array('size' => array(CATEGORY_IMAGE_SMALL_THUMB_WIDTH,CATEGORY_IMAGE_SMALL_THUMB_HEIGHT), 'type' => 'resizecrop');
		$smallthumbResult = $upload->fileupload($category_image, CATEGORY_IMAGE_SMALL_THUMB, '', $small_thumb);
		//large thumb
		$large_thumb = array('size' => array(CATEGORY_IMAGE_LARGE_THUMB_WIDTH,CATEGORY_IMAGE_LARGE_THUMB_HEIGHT), 'type' => 'resizecrop');
		$largethumbResult = $upload->fileupload($category_image, CATEGORY_IMAGE_LARGE_THUMB, '', $large_thumb);
		
		//Main file upload
		$res1 = $upload->fileupload($category_image, CATEGORY_IMAGE, '');
		//print_r($upload->errors);
		if (!empty($upload->result) && empty($upload->errors)) {
		
		$category_image  =  $upload->result;
		}*/
		
		/* if(move_uploaded_file($_FILES["category_image"]["tmp_name"], "category_image/" . $filename))
		{
			$category_image = $filename;
			
	    } */
	  }
	
	else{
	  $fileErr = "please upload image";
	  $flag=false;
	}
	
	if($flag){
		//echo "INSERT INTO `categories`(`category_name`, `parent_id`,`category_image`) VALUES ('".$category_name."',".$parent_id.",'".$category_image."')";die;
		$sql = mysql_query("INSERT INTO `categories`(`category_name`, `parent_id`,`category_image`) VALUES ('".$category_name."',".$parent_id.",'".$category_image."')");
		
		if($sql>0){
			$_SESSION['add'] = true;
			header('Location:category_listing.php');	
		}{
		
		$errorMsg =  "Invalid email and password .";
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
                <h2><i class="glyphicon glyphicon-edit"></i> Add Category</h2>

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
				<div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category_name"class="form-control" id="category_name" placeholder="Enter Category Name" value ="<?php echo isset($_POST['category_name'])?$_POST['category_name']:'';?>">
						<?php if(isset($categoryErr)) {?>
						<p class="help-block error"><?php echo $categoryErr;?></p>
						<?php }else{
						echo '';
						}?>
                    </div>
					<div class="form-group">
                        <label>Select Category</label>
                        <div class="controls">
                        <select data-placeholder="Please Select Your Category" id="selectError2" data-rel="chosen" name="parent_id">
                            <option value=""></option>
                            <?php while($row = mysql_fetch_array($cat_sql)) {?>
							<option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option>
							<?php } ?>
                        </select>
                    </div>
                
                    </div>
                    <div class="form-group">
                        <label>Category Image</label>
                        <input type="file" name="category_image" id="category_image" >
						<?php if(isset($fileErr)) {?>
						<p class="help-block error"><?php echo $fileErr;?></p>
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