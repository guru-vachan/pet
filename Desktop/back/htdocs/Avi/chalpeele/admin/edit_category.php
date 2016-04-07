<?php
ob_start();
include('config.php');
include('header.php');
include('../classes/upload.php');
  if(!isset($_SESSION['LoginUser']) && empty($_SESSION['LoginUser'])){
	header('Location:index.php');
}

if(isset($_GET['id'])){
/* On page load show default values */
	$editsql = mysql_query("SELECT * FROM `categories` WHERE `id` =".(int)$_GET['id']);
	$editData = mysql_fetch_array($editsql,MYSQL_ASSOC);
	//print_r($editData);die;

}
/* Show all categories in select box */
$cat_sql = mysql_query("SELECT * FROM `categories` WHERE `parent_id` = 0");
 if($_POST){
 /* echo '<pre>';
print_r($_POST); 
die;  */
 
	$id = $_POST['id'];
	$category_name = $_POST['category_name'];
	$parent_id = !empty($_POST['parent_id'])?$_POST['parent_id']:0;
	$flag =true;
	if(empty($category_name)){
		$categoryErr = 'Please Enter Category Name.';
		$flag = false;
	}
	if(isset($_FILES['category_image']['name']) && $_FILES['category_image']['name']!='')
	{
			$file=pathinfo($_FILES['category_image']['name']);
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
				@unlink(CATEGORY_IMAGE_SMALL_THUMB. $_POST['pcategory_picture']);
				@unlink(CATEGORY_IMAGE_LARGE_THUMB. $_POST['pcategory_picture']);
				@unlink(CATEGORY_IMAGE. $_POST['pcategory_picture']);
				$category_image  =  $upload->result;
			}
			
		}	
		/* 	if(move_uploaded_file($_FILES["category_image"]["tmp_name"], "category_image/" . $file_name)){
			@unlink("category_image/" . $_POST['pcategory_picture']);
				$category_image = $file_name;
		} */
	}
	else{
	  $category_image = $_POST['pcategory_picture'];
	}
	if($flag){
		//echo "UPDATE `categories` set `category_name`='".$category_name."',`parent_id`=".$parent_id.",`category_image`='".$category_image."' where id = ".(int)$id;die;
		$sql = mysql_query("UPDATE `categories` set `category_name`='".$category_name."',`parent_id`=".$parent_id.",`category_image` = '".$category_image."' where id = ".(int)$id);
		
		if($sql){
			
			$_SESSION['update'] = true;
			header("Location:category_listing.php");	
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
                <h2><i class="glyphicon glyphicon-edit"></i> Edit Category Form</h2>

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
				<input type="hidden" name ="id" value="<?php echo $_GET['id'];?>" /> 
				<div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category_name"class="form-control" id="category_name" placeholder="Enter Category Name" value ="<?php echo isset($editData['category_name'])?$editData['category_name']:$_POST['category_name'];?>">
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
                            <?php while($row = mysql_fetch_array($cat_sql)) {
							
								$select ='';
								if($row['id']==$editData['parent_id']){
									$select ='selected = "selected"';
								}
							
							?>
							<option value="<?php echo $row['id'];?>" <?php echo $select;?>><?php echo $row['category_name'];?></option>
							<?php } ?>
                        </select>
                    </div>
                
                    </div>
                <div class="form-group">
                   <label>Category Image</label>
				    
                     <input type="file" name="category_image" id="category_image" /></br/>
					 <?php if(isset($fileErr)) {?>
						<p class="help-block error"><?php echo $fileErr;?></p>
						<?php }else{
						echo '';
						}?>
					 <?php if(isset($editData['category_image']) && $editData['category_image']!=NULL)
					{?>
	               <img src="<?php echo WEBSITE_URL ;?>/category_image/small_thumb/<?php echo $editData['category_image'];?>" alt="smile" /><br/>
	              <input type="hidden" name="pcategory_picture" value="<?php echo $editData['category_image'];?>"/>
	              <?php } ?>
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