<?php include('header.php'); ?>
<?php
	require_once('fns/cart.php');
	$cart = new Cart;
	$pets = $cart->getAllPetsInCart();
	$products = $cart->getAllProductsInCart();
	//var_dump($pets);
?>


    <!-- About Section -->
    <section id="checkout" style="background:orange;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Checkout</h2>
                    <h3 class="section-subheading text-muted">Final Step!</h3>
                </div>
            </div>
			
			<div class="row">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Info</th>
							<th>Add / Remove</th>
							<th>Quantity</th>
							<th>Rate</th>
							<th>Net</th>
						</tr>
					</thead>
					<tbody>
<?php 
$i=1;
$quan = 0;
$total = 0;
if($pets){
	foreach($pets as $pet=>$val){
		$det = $cart->getPetDetails($pet);
		if(!$det) var_dump($pet);
		extract($det);
		$quan += $val;
		$total += $val*$price;
?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td>
								<?php echo $breed_name; ?> 
							</td>
							<td>
								<span class="label label-success">
									<?php echo $gender==1?"Male":"Female"; ?>
								</span> &nbsp;
								<span class="label label-info">
									<?php echo $age; ?>
								</span>
							</td>
							<td>
								<a href="buy-market.php?id=<?php echo $pet;?>" class="badge label-success">
									<i class="fa fa-plus"></i>
								</a> &nbsp;
								<a href="remove-market.php?id=<?php echo $pet;?>" class="badge label-danger">
									<i class="fa fa-minus"></i>
								</a>
							</td>
							<td><?php echo $val; ?></td>
							<td><?php echo $price; ?></td>
							<td><?php echo $val * $price; ?></td>
						</tr>
<?php	
	}
}?>
<?php 
if($products){
	foreach($products as $product=>$val){
		$det = $cart->getProductDetails($product);
		extract($det);
		$quan += $val;
		$total += $val*$cost;
?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $name; ?> </td>
							<td><span class="label label-success"><?php echo $cat; ?></span></td>
							<td>
								<a href="buy-product.php?id=<?php echo $product;?>" class="badge label-success">
									<i class="fa fa-plus"></i>
								</a> &nbsp;
								<a href="remove-product.php?id=<?php echo $product;?>" class="badge label-danger">
									<i class="fa fa-minus"></i>
								</a>
							</td>
							<td><?php echo $val; ?></td>
							<td><?php echo $cost; ?></td>
							<td><?php echo $val * $cost; ?></td>
						</tr>
<?php	
	}
}?>

						<tr>
							<td colspan='3'></td>
							<th>Total Quantity</th>
							<th><?php echo $quan; ?></th>
							<th>Total Cost</th>
							<th><?php echo $total; ?></th>
						</tr>
					</tbody>
				</table>
				
			</div>
			<div class="row">
<?php
			if($logged){
?>
				<!-- Show address form -->
				
				<form action="proceed.php" method="post" class="form">
					<div class="col-md-4  pull-right">
						<div class="alert alert-success">Payment mode: <b>Cash on Delivery</b></div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Please enter your address" required data-validation-required-message="Please enter your address." name="address"></textarea>
							<p class="help-block text-danger"></p>
						</div>
						<div class="form-group">
							<input type="text" name="mob" placeholder="Enter mobile number" class="form-control"></input>
						</div>
						<!-- Show proceed button -->
						<button type="submit" class="btn btn-lg btn-success pull-right">Click to Proceed</button>
					</div>
				</form>
				
<?php
			} else {
?>
				<a href="login_modal.php" class="btn btn-lg btn-warning pull-right">Login to Continue</a>
<?php
			}
?>
			</div>
		</div>
	</section>


<?php include('footer.php'); ?>