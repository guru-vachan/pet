<?php
	if(!isset($_GET) || !isset($_GET['id']) || empty($_GET['id'])){
		echo "K";
		header('Location: breeds.php');
		exit;
	}
	require_once('fns/breed_fns.php');
    $bObj = new Breed;
    $id = $_GET['id'];
    $breedInfo = $bObj->getBreedDetailsById($id);
    //var_dump($breedInfo);
	extract($breedInfo);
?>


<?php include('header.php'); ?>

    <!-- About Section -->
    <section id="about" style="background-color:rgb(39, 38, 38);">
        <div class="container" style="color:rgb(81, 118, 86);">
            <div class="row" style=" margin-right: -210px;">
                <div class="col-lg-12 text-center" style=" background-color:rgb(126, 35, 2); margin-left: -105px; margin-right: -180px; ">
                    <h2 class="section-heading" style="background-color: rgb(0, 0, 0); padding-bottom:15px; padding-top:15px;margin-right: -230px;"><?php echo $breed_name; ?></h2>
                    <h3 class="section-subheading text-muted" style="margin-right: -200px;">Meet this breed !</h3>
                </div>
            </div>
			<div style="color:rgb(199, 172, 172)">
				<div class="row" style="padding-top:60px; background-color: rgb(67, 87, 32);margin-left: -150px;margin-right: -105px;">
					<div class="col-lg-offset-1 col-lg-5 img-circle">
						<a href="#" style="" class="circle-anim-parent">
							<img src="img/breed/large/<?php echo $pic_big1;?>"  class=" img-circle" style="width:370px; height:370px;"></img>
						<!--	<div style="position: absolute;top: 0;text-align: center;font-weight: bold;color: #000;font-size: 24px;width:100%">-->
							<div class="anim-wrapper">
								<div class="to-circle-from-left" style="">Hi !</div>
								<div class="to-circle-from-right" style="">Watch me.</div>
							</div>
						
						</a>
					</div>
					<div class="col-lg-5" style="padding-top:75px">
						<?php echo $long_desc1; ?> 
					</div>
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-lg-offset-1 col-lg-5" style="padding-top:75px">
						<?php echo $long_desc2;?>
					</div>
					<a href="#" style="" class="circle-anim-parent">
							<img src="img/breed/large/<?php echo $pic_big2; ?>"  class=" img-circle" style="width:370px; height:370px;"></img>
						<!--	<div style="position: absolute;top: 0;text-align: center;font-weight: bold;color: #000;font-size: 24px;width:100%">-->
							<div class="anim-wrapper">
								<div class="to-circle-from-left" style="">Hey !</div>
								<div class="to-circle-from-right" style="">I am here.</div>
							</div>
						
						</a>
			<!--		<a href="" id="pic-hov"><img src="img/about/4.jpg"  class="col-lg-5 img-circle"> </img> </a>  -->
				</div>
			</div>
			
			
        </div>
    </section>
	
<?php include('footer.php'); ?>