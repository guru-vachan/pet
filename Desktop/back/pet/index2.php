<?php
//session_start();
include('header.php');
include('admin/config.php');
$a = '';
if(isset($_REQUEST['cat']) && !empty($_REQUEST['cat'])){
	$a.= ' WHERE `parent_category_id`='.(int)$_REQUEST['cat'];

}
//echo "SELECT * FROM `product`".$a;die;
$cat_sql = mysql_query("SELECT * FROM `product`".$a); 
?>
<div id="body">
      <div class="inner">
	  <?php 
	  $i=0;
	  while($row = mysql_fetch_array($cat_sql,MYSQL_ASSOC)){
	  if($i%2==0){
	  $br ='';
	  $class = 'leftbox';
	  }else{
	  $class = 'rightbox';
	  $br ='<div class="clear br"></div>';
	  }
	  ?>
        <div class="<?php echo $class;?>">
          <h3><?php echo $row['p_name'];?></h3>
          <img src="product_image/small/<?php echo $row['product_image'];?>" alt="Smile"class="left" />
          <p><b>Price:</b> <b><?Php echo $row['p_price'];?></b> &amp; eligible for FREE Super Saver Shipping on orders over <b>$195</b>.</p>
          <p><b>Availability:</b> Usually ships within 24 hours</p>
          <p class="readmore"><a class="buy_now"  href="javascript:" data-id="<?php echo $row['p_id'];?>">BUY NOW</a></p>
          <div class="clear"></div>
        </div>
		<?php echo $br;?>
		<?php $i++;} ?>
        
      </div>
      <!-- end .inner -->
 </div>
    <!-- end body -->

<script type="text/javascript">
		$(function(){
		
			$(document).on('click','a.buy_now',function(){
			 var p_id = $(this).attr('data-id');
			if(p_id != ''){
				$.ajax({
						url:'add_cart.php',
						type:'POST',
						data:{p_id:p_id},
						success:function(response)
						{
							//alert(response);
							$('#p_qty').html('('+response+')');
							alert('product added successfully');
							//$('div.state_data').html(response);
						}
					});
	            }
			});
		
		})
	</script>
<?php //include('footer.php'); ?>