<?php
	require_once('fns/market_fns.php');
	require_once('fns/breed_fns.php');
	include('admin/config.php');
    $bObj = new Market;
	$selected_breeds = array();
	if(isset($_GET) && isset($_GET['breed_type']) && !empty($_GET['breed_type'])){
		$allPets = $bObj->getPets($_GET['breed_type']);
		$selected_breeds = explode(',',$_GET['breed_type']);
	}else{
		$allPets = $bObj->getAllPets();
	}
	$brObj = new Breed;
	$breeds = $brObj->getAllBreeds();
	
		
$a = '';
if(isset($_REQUEST['cat']) && !empty($_REQUEST['cat'])){
	$a.= ' WHERE `parent_category_id`='.(int)$_REQUEST['cat'];

}
//echo "SELECT * FROM `product`".$a;die;
$cat_sql = mysql_query("SELECT * FROM `dog`".$a); 
?>

<?php include('header.php'); ?>

    <!-- About Section -->
    <section id="market">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">The Market</h2>
                    <h3 class="section-subheading text-muted">Add a cute member to your family !</h3>
					<a href="admin/add_dog.php">Click here to fill the registration form </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
					<h4>Sort By Breed</h4>
					<?php 
						$i = 0;
						foreach($breeds as $breed) { $i++; ?>
                    <div class="checkbox">
						<label style="color:#eee">
							<input type="checkbox" name="breed_type" class="breed_type" value="<?php echo $i; ?>" <?php if(in_array($i,$selected_breeds)) echo "checked"; ?>>
							<?php echo $breed['breed_name'];?>
						</label>
					</div>
					<?php } ?>
					<hr>
					<h4>Sort By Gender</h4>
                    <div class="checkbox">
						<label style="color:#eee">
							<input type="checkbox" name="male" value="1" >
							Male
						</label>
					</div>
					<div class="checkbox">
						<label style="color:#eee">
							<input type="checkbox" name="female" value="1" >
							Female
						</label>
					</div>
					<hr>
					<h4>Sort By Age</h4>
                    <div class="checkbox">
						<label style="color:#eee">
							<input type="checkbox" name="male" value="1" >
							0-3
						</label>
					</div>
					<div class="checkbox">
						<label style="color:#eee">
							<input type="checkbox" name="female" value="1" >
							4-8
						</label>
					</div>
					<div class="checkbox">
						<label style="color:#eee">
							<input type="checkbox" name="female" value="1" >
							8-12
						</label>
					</div>
					<div class="checkbox">
						<label style="color:#eee">
							<input type="checkbox" name="female" value="1" >
							> 12
						</label>
					</div>
                </div>
                <div class="col-lg-9">
<?php 
	if(isset($_SESSION['msg']['market']) && !empty($_SESSION['msg']['market'])) {
		echo "<div class='alert alert-info'>".
                            "<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['msg']['market']."</div>";
		unset($_SESSION['msg']['market']);
} ?>
				<?php 
					foreach($allPets as $pet) {
						extract($pet);
				?>
                    <div class="col-lg-4" style="padding:20px">
						<div>
							<img src="img/sell/<?php echo $pic; ?>" style="width:250px; height:280px;"></img>
							<div class="row" style="padding-top:5px">
								<span class="col-lg-8 btn breed-name"><?php echo $breed_name; ?></span>
								<span class="col-lg-2 btn" style="color:#eee;"><i class="fa fa-paw"></i> <?php echo $age; ?></span>
							</div>
							<div class="row">
								<span class="col-lg-4">
									<span class="btn btn-success"><i class="fa fa-inr"></i> <?php echo $price; ?></span>
								</span>
								<span class="col-lg-5 btn" style="color:#eee;"><i class="fa fa-heart"></i> <?php echo $gender==1?"Male":"Female"; ?></span>
								<a href="buy-market.php?id=<?php echo $id; ?>" class="col-lg-2 btn btn-danger"><i class="fa fa-shopping-cart"></i> </a>
							</div>
						</div>
					</div>
				<?php } ?>
				<div>
				<?php 
	  
	  while($row = mysql_fetch_array($cat_sql,MYSQL_ASSOC)){
		  ?>

          <img src="product_image/<?php echo $row['product_image'];?>" alt="Smile"class="left" />
		  		  <h5><?php echo $row['p_name'];?></h5>
	  <p><b>Price:</b> <b><?Php echo $row['p_price'];}?>
		  
	       </div>
                </div>
            </div>
        </div>
    </section>
	
<?php include('footer.php'); ?>