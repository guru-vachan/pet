<?php
	require_once('fns/product_fns.php');
	include('admin/config.php');
    $bObj = new Products;
	$selected_prods = array();
	if(isset($_GET) && isset($_GET['prod_type'])& !empty($_GET['prod_type'])){
		$products = $bObj->getProducts($_GET['prod_type']);
		
		$selected_prods = explode(',',$_GET['prod_type']);
	}else{
		$products = $bObj->getAllProducts();
	}
	$prods = $bObj->getAllProductTypes();
	
$a = '';
if(isset($_REQUEST['cat']) && !empty($_REQUEST['cat'])){
	$a.= ' WHERE `parent_category_id`='.(int)$_REQUEST['cat'];

}
//echo "SELECT * FROM `product`".$a;die;
$cat_sql = mysql_query("SELECT * FROM `product`".$a); 
?>

<?php include('header.php'); ?>

    <!-- About Section -->
    <section id="market">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Pet Products</h2>
                    <h3 class="section-subheading text-muted">For the happiness of your pet !</h3>
					<a href="admin/add_product.php">Click here to fill the registration form </a>
                </div>
            </div>
			
            <div class="row">
                <div class="col-lg-3">
					<h4>Sort By Type</h4>
					<?php 
						$i = 0;
						foreach($prods as $prod) { $i++; ?>
                    <div class="checkbox">
						<label style="color:#eee">
							<input type="checkbox" class="prod_type" name="prod_type" value="<?php echo $i; ?>" <?php if(in_array($i,$selected_prods)) echo "checked"; ?>>
							<?php echo $prod['cat'];?>
						</label>
					</div>
					<?php } ?>
					
                </div>
                <div class="col-lg-9">
<?php 
	if(isset($_SESSION['msg']['product']) && !empty($_SESSION['msg']['product'])) {
		echo "<div class='alert alert-info'>".
                            "<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['msg']['product']."</div>";
		unset($_SESSION['msg']['product']);
} ?>
				<?php 
				foreach($products as $product) {
				extract($product);
				?>
                    <div class="col-lg-4" style="padding:20px">
						<div>
							<img src="img/products/<?php echo $pic; ?>" style="width:250px; height:300px;"></img>
							<div class="row" style="padding-top:5px">
								<span class="col-lg-8 btn breed-name"><?php echo $name; ?></span>
								<span class="col-lg-2 btn" style="color:#eee;"><i class="fa fa-thumbs-up"></i> <?php echo $thumbsup; ?></span>
							</div>
							<div class="row">
								<span class="col-lg-4">
									<span class="btn btn-success"><i class="fa fa-inr"></i> <?php echo $cost; ?></span>
								</span>
								<span class="col-lg-5 btn" style="color:#eee;"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </span>
								<a href="buy-product.php?id=<?php echo $pid; ?>" class="col-lg-2 btn btn-danger"><i class="fa fa-shopping-cart"></i> </a>
							</div>
						</div>
					</div>
				<?php } ?>
				<div>
				<?php 
	  
	  while($row = mysql_fetch_array($cat_sql,MYSQL_ASSOC)){
		  ?>
		  <h3><?php echo $row['p_name'];?></h3>
          <img src="product_image/small/<?php echo $row['product_image'];?>" alt="Smile"class="left" />
	  <p><b>Price:</b> <b><?Php echo $row['p_price'];}?>
		  
	       </div>
                </div>
            </div>
        </div>
    </section>
	
<?php include('footer.php'); ?>