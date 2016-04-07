<?php
ob_start();
include('config.php');
include('header.php');
 //$sql= mysql_query("select *from product"); 
/*  $row1 = mysql_fetch_array($sql,MYSQL_ASSOC);
 echo '<pre>';
 print_r($row1); */
// $row = mysql_fetch_array($sql);
 //echo '<pre>';
 //print_r ($row);die;
 
 $per_page = PER_PAGE_RECORD;
if(isset($_GET['page'])){
	$page = $_GET['page'];
	$start = ($page -1)*$per_page;
	//$start = ($page*$per_page)-3;
}else{
	$start = 0;
}
//echo "SELECT * FROM `product` LIMIT ".$start.",".$per_page;die;
$cat_sql = mysql_query("SELECT `product`.*,`categories`.* FROM `product` LEFT JOIN `categories` ON `product`.`category_id` = `categories`.`id` LIMIT ".$start.",".$per_page);
$numrows = mysql_num_rows($cat_sql);
//echo $numrows; die;

$sql = mysql_query("SELECT * FROM `product`");
$totalrecord = mysql_num_rows($sql);
$total_page = $totalrecord/$per_page;
$total_page = ceil($total_page);


 ?> 
<div id="content" class="col-lg-10 col-sm-10">
    <div class="box-inner">
         <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Products</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
<div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Category Name</th>
                            <th>Product image</th>
                            <th>Briefly discription</th>
                            <th>Full Discription</th>
							<th>Action</th>
                        </tr>
                        </thead>
						<tbody>
                        <?php 
						if($numrows>0){
						while($row = mysql_fetch_array($cat_sql,MYSQL_ASSOC)){
						//print_r($row);
						
						?>
						<tr>
                           
                            <td><?Php echo $row['p_name'];?></td>
                            <td><?Php echo $row['p_price'];?></td>
                            <td><?Php echo $row['category_name'];?></td>
							
						
							 <td><?php if (!empty($row['product_image'])){
							?>
							<img src="<?php echo WEBSITE_URL ;?>/product_image/small/<?php echo $row['product_image'];?>" alt="Smile"  />
							<?php } ?>
							</td>
							<td><?Php echo $row['short'];?></td>
							<td><?Php echo $row['full'];?></td>
						
                            <td class="center">
                                <a href="view_product.php?p_id=<?php echo $row['p_id'];?>"class="btn btn-success" href="#">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    View
                                </a>
                                <a href="edit_product.php?p_id=<?php echo $row['p_id'];?>"class="btn btn-info" href="#">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
                                </a>
                                <a href="product_delete.php?p_id=<?php echo $row['p_id'];?>" class="btn btn-danger" href="#">
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
						<?php if($total_page >1){?>
					<ul class="pagination pagination-centered paging">
                       <?php for($i=1;$i<=$total_page;$i++){?>
                        <li class="" id="li_<?php echo $i;?>">
                            <a href="product_listing.php?page=<?php echo $i;?>" id="pageNumber_<?php echo $i;?>"><?php echo $i;?></a>
                        </li>
                        <?php } ?>
                        
                    </ul>
                    <?php }?>
                </div>
			</div>	
		</div>	
  <script type ="text/javascript">
	 $(document).ready(function(){
	  var page = '<?php echo isset($_GET['page'])?$_GET['page']:'1';?>';
	    $('#li_'+page).addClass('active');
		$('#pageNumber_'+page).attr('href','javascript:');
	
	});
</script>
  <?php  include('footer.php'); ?>