<?php
ob_start();
  include('config.php');
  include('header.php');
  if(!isset($_SESSION['LoginUser']) && empty($_SESSION['LoginUser'])){
	 header('Location:index.php');
}
$per_page = PER_PAGE_RECORD;
if(isset($_GET['page'])){
	$page = $_GET['page'];
	$start = ($page -1)* $per_page;
}else{
	$start = 0;
}

$cat_sql = mysql_query("SELECT * FROM `categories` LIMIT ".$start.",".$per_page);
$numrows = mysql_num_rows($cat_sql);

$totalsql = mysql_query("SELECT * FROM `categories`");
$totalrecord = mysql_num_rows($totalsql);
$total_page = $totalrecord/$per_page;
$total_page = ceil($total_page);
//echo $total_page;die;
 ?> 
  <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
<div class="box col-md-12">
<?php if(isset($_SESSION['update']) && $_SESSION['update']==1){?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			Category updated successfully.
        </div>
		<?php } 
		unset($_SESSION['update']);
		?>
		<?php if(isset($_SESSION['add']) && $_SESSION['add']==1){?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			Category Added successfully.
        </div>
		<?php } 
		unset($_SESSION['add']);
		?>
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Categories</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>Category Image</th>
                            <th>Category Name</th>
							<th>Parent Category Name</th>
                            <th>Status</th>
                            
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php 
							if($numrows>0){
							while($rows = mysql_fetch_array($cat_sql)){?>
								
                        <tr>
                            <td><?php if (!empty($rows['category_image'])){
							?>
							<img src="<?php echo WEBSITE_URL ;?>/category_image/small_thumb/<?php echo $rows['category_image'];?>" alt="Smile"  />
							<?php } ?>
							</td>
                            <td class="center"><?php echo $rows['category_name'];?></td>
                            <td class="center"><?php  if($rows['parent_id']!=0){ echo getParentCategoryName($rows['parent_id']);}else{ echo '';};?></td>
                            <td class="center">
							<?php if($rows['status']==1){?>
                                <span class="label-success label label-default">Active</span>
								<?php } else {?>
								<span class="label-default label">Inactive</span>
								<?php }?>
                            </td>
                            <td class="center">
                                <a href="view_category.php?id=<?php echo $rows['id'];?>"class="btn btn-success" href="#">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    View
                                </a>
                                <a href="edit_category.php?id=<?php echo $rows['id'];?>" class="btn btn-info" >
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
                                </a>
                                <a  href="delete_category.php?id=<?php echo $rows['id'];?>"class="btn btn-danger" href="#">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
							<?php }
							}else{?>
							
							<tr><td colspan="5" style="text-align:center;">No record found.</td></tr>
							<?php }?>

                       </tbody>
                    </table>
						<?php if($total_page>1){?>
						<ul class="pagination pagination-centered paging">
                       <?php for($i=1;$i<=$total_page;$i++){?>
                        <li class="" id="li_<?php echo $i;?>">
                            <a href="category_listing.php?page=<?php echo $i;?>" id="pageNumber_<?php echo $i;?>"><?php echo $i;?></a>
                        </li>
                        <?php } ?>
                        
                    </ul>
					<?php }?>
                </div>
            </div>
        </div>

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
<script type ="text/javascript">
	$(document).ready(function(){
		var page = '<?php echo isset($_GET['page'])?$_GET['page']:'1';?>';
		$('#li_'+page).addClass('active');
		$('#pageNumber_'+page).attr('href','javascript:');
	
	});
</script>
  <?php 
 
  include('footer.php');?> 