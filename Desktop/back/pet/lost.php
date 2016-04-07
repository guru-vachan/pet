<?php
	require_once('fns/lost_fns.php');
	require_once('fns/breed_fns.php');
    $bObj = new Lost;
    $allPets = $bObj->getLostPets();
	$brObj = new Breed;
	$breeds = $brObj->getAllBreeds();
?>

<?php include('header.php'); ?>

    <!-- About Section -->
    <section id="lost">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Lost & Found</h2>
                    <h3 class="section-subheading text-muted">Get back your lovely pet!</h3>
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
							<input type="checkbox" name="breed_type" value="<?php echo $i; ?>" >
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
					foreach($allPets as $pet) {
						extract($pet);
				?>
                    <div class="col-lg-4" style="padding:20px">
						<div>
							<img src="img/lost/<?php echo $pic; ?>" style="width:250px; height:250px;"></img>
							<div class="row" style="padding-top:5px">
								<span class="col-lg-8 btn breed-name"><?php echo $breed_name; ?></span>
								<span class="col-lg-2 btn" style="color:#eee;"><i class="fa fa-paw"></i> <?php echo $age; ?></span>
							</div>
							<div class="row">
								<span class="col-lg-4">
									<span class="btn btn-success"><i class="fa fa-smile-o"></i> Adopt!</span>
								</span>
								<span class="col-lg-5 btn" style="color:#eee;"><i class="fa fa-heart"></i> <?php echo $gender==1?"Male":"Female"; ?></span>
								<span class="col-lg-2 btn btn-danger"><i class="fa fa-paw"></i> </span>
							</div>
						</div>
					</div>
				<?php } ?>
                </div>
            </div>
        </div>
    </section>
	
<?php include('footer.php'); ?>