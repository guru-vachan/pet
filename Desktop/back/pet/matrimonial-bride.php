<?php
	require_once('fns/matrimonial_fns.php');
	require_once('fns/breed_fns.php');
    $bObj = new Matrimonial;
    $allPets = $bObj->getAllBrides();
	$brObj = new Breed;
	$breeds = $brObj->getAllBreeds();
?>

<?php include('header.php'); ?>

    <!-- About Section -->
    <section id="matrimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Matrimonial</h2>
                    <h3 class="section-subheading text-muted">Let your lovely pet get a partner!</h3>
					
				<!--	<form class="navbar-form navbar-left" style="padding-left:5px;" role="search">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form> -->
	
                </div>
            </div>
			
            <div class="row">
                <div class="col-lg-3">
					<h4>Sort By Breed</h4>
					<?php 
						foreach($breeds as $breed) { ?>
                    <div class="checkbox">
						<label style="color:#eee">
							<input type="checkbox" name="first_q" value="1" >
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
	if(isset($_SESSION['matri']['bride']) && !empty($_SESSION['matri']['bride'])) {
		echo "<div class='alert alert-info'>".
                            "<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['matri']['bride']."</div>";
		unset($_SESSION['matri']['bride']);
} ?>
				<?php 
					foreach($allPets as $pet) {
						extract($pet);
				?>
                    <div class="col-lg-4" style="padding:20px">
						<div>
							<img src="img/matrimonial/<?php echo $pic; ?>" style="width:250px; height:250px;"></img>
							<div class="row" style="padding-top:5px">
								<span class="col-lg-8 btn breed-name"><?php echo $breed_name; ?></span>
								<span class="col-lg-2 btn" style="color:#eee;"><i class="fa fa-paw"></i> <?php echo $age; ?></span>
							</div>
							<div class="row">
								<span class="col-lg-4">
									<span class="btn btn-success"><i class="fa fa-inr"></i> <?php echo $price; ?></span>
								</span>
								<span class="col-lg-5 btn" style="color:#eee;"><i class="fa fa-heart"></i> <?php echo $gender==1?"Male":"Female"; ?></span>
								<a href="buy-bride.php?id=<?php echo $mid; ?>" class="col-lg-2 btn btn-danger"><i class="fa fa-heart"></i> </a>
							</div>
						</div>
					</div>
				<?php } ?>
                </div>
            </div>
        </div>
    </section>
	
<?php include('footer.php'); ?>