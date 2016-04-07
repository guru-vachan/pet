<?php
ob_start();
include('header.php');
include('config.php');
if (isset($_GET['p_id']))
{
//echo 'hii';
//echo $_GET['p_id'];
$id=$_GET['p_id'];
$row=mysql_query("SELECT * FROM dog where p_id=".(int)$id);
$view= mysql_fetch_array($row,MYSQL_ASSOC);
 }
?>
<div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><center>view Table</center></h2>

                    
                </div>
                <div class="box-content">
                    <table class="table table-condensed" border="1">
                      <tbody> 
                        <tr>
                            <th>Product Name</th>
                            
                           <td> <?php echo $view['p_name'];?></td> 
                           
                        </tr>
                        
                        <tr>
                            
                           <th>Product Price</th>
						 <td>   <?php echo $view['p_price'];?> </td> 
                        </tr>
                        <tr>
                           <th>Product Type</th>
						  <td>   <?php echo $view['p_type']; ?> </td> 
                        </tr>
                        <tr>
                            <th>Product Image</th>
							<td><?php if (!empty($view['product_image'])){
							?>
							<img src="<?php echo WEBSITE_URL ;?>/product_image/<?php echo $view['product_image'];?>" alt="Smile" width="100" height="100" />
							<?php } ?>
							</td>
							
                        </tr>
                        <tr>
                           <th>Product Short Description</th>
						  <td>   <?php echo $view['short']; ?> </td> 
                        </tr>
						
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
<?php include('footer.php');?>