<?php
ob_start();
session_start();
include('header.php');
$con = mysql_connect('localhost','root','');
mysql_select_db('chalpeele',$con);
?>
<table class="table table-bordered" border="1" style="border-collapse: collapse; width: 73%; margin-top: 5px;">
                        <thead>
                        <tr>
							<th>Product image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                            
                        </tr>
                        </thead>

<?php if(isset($_SESSION['cart'])){?>
	
						
	<?php 
	$sum =0;
	foreach($_SESSION['cart'] as $key=>$value){
	$sql=mysql_query("SELECT * FROM `product` WHERE p_id=".(int)$key);
	$row = mysql_fetch_array($sql,MYSQL_ASSOC);
	$sum+= ($row['p_price'])*($value['qty']); 
	?>
		<tr>
                           
                            <td style="padding: 10px;"><?php if (!empty($row['product_image'])){
							?>
							<img src="../product_image/small/<?php echo $row['product_image'];?>" alt="Smile"  />
							<?php } ?>
							</td>
							<td><?Php echo $row['p_name'];?></td>
                            <td class="price"><?Php echo $row['p_price'];?></td>
                            <td class="quantity"><?Php echo $value['qty'];?></td>
							<td class="total_price"><?Php echo ($row['p_price'])*($value['qty']);?></td>
							<td>  <a href="add_qty.php?p_id=<?php echo $row['p_id'];?>&action=add" class="add_minus_del">&#x2191</a> <a href="add_qty.php?p_id=<?php echo $row['p_id'];?>&action=minus" class="add_minus_del">&#x2193 </a> <br/> <a  href="add_qty.php?p_id=<?php echo $row['p_id'];?>&action=delete" class="add_minus_del">&#x2716 </a> </td>
							
                        </tr>
	<?php }?>
	<tr><th>Grand Total</th> <td class="grand_total" colspan="4" align="right"><?Php echo $sum;?></td></tr>
	 </table>
	<?php }else{?>
<tr><td colspan="6" style="text-align:center;">shopping cart is empty.</td></tr>
<?php	}
 
?>
<a href="index.php" style="text-align:center;"> CONTINUE SHOPPING</a>
<style>
th, td {
    font-size: 15px;
}
</style>
<script type="text/javascript;">
		$(function(){
		
			$('a.add_minus_del').on('click',function(event){
				event.preventDefault();
				var href = $(this).attr('href');
				var price = $(this).parent().parent().find('td.price').text();
				var Totalprice = $(this).parent().parent().find('td.total_price').text();
				var grand_total = $('td.grand_total').text();
				var actul_price = grand_total- Totalprice;
				var __this = $(this);
				//alert(actul_price);
				//alert(href);
				//return false;
				$.ajax({
					url:href,
					type:'POST',
					data:{price:price},
					
					success:function(response){
						//console.log(response.qty);
						if(response.action){
						__this.parent().parent().find('td.quantity').html(response.qty);
						__this.parent().parent().find('td.total_price').html(response.totalPrice);
						$('td.grand_total').html((response.totalPrice)+(actul_price));
						//$('#p_qty').html('('+response+')');
						//alert('successfully');
						//$('div.state_data').html(response);
						//window.location.reload();
						}else{
						
						__this.parent().parent().remove();
						$('td.grand_total').html(actul_price);
						}
					}
				});
	          
			});
		
			$('a.cancel').on('click',function(){
			 var p_id = $(this).attr('p_id');
			if(p_id != ''){
		$.ajax({
			url:'delete_view.php',
			type:'POST',
			data:{p_id:p_id},
			success:function(response){
				//alert(response);
				//$('#p_qty').html('('+response+')');
				alert('successfully');
				//$('div.state_data').html(response);
			}
		});
	}
			});
		
		})
	</script>