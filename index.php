<?php
if(isset($_REQUEST['addr'])){
	$addr = $_REQUEST['addr'];
}else{
	$addr='';
}
$page='index';
?>
<?php include_once("header.php"); ?>

<div class=""  id="location_section" style="margin:0px;">
	<div id="index_container" class="clearfix">

		<div class="container clearfix">
			<div class="foot_type_container">
				<div class="home_tile clearfix">
				<img src="<?php echo SITE_BASE; ?>scripts/image.php?height=250&width=500&image=<?php echo SITE_BASE;?>images/gyro.jpg&cropratio=2:1" />
					<div class="title_title">Food Court</div>
				</div>
			</div>

			<div class="foot_type_container">
				<div class="home_tile clearfix">
				<img src="<?php echo SITE_BASE; ?>scripts/image.php?height=250&width=500&image=<?php echo SITE_BASE;?>images/salad.jpg&cropratio=2:1" />
					<div class="title_title">Food Court</div>
				</div>
			</div>

			<div class="foot_type_container">
				<div class="home_tile clearfix">
				<img src="<?php echo SITE_BASE; ?>scripts/image.php?height=250&width=500&image=<?php echo SITE_BASE;?>images/taco.jpg&cropratio=2:1" />
					<div class="title_title">Food Court</div>
				</div>
			</div>

			<div class="foot_type_container">
				<div class="home_tile clearfix">
				<img src="<?php echo SITE_BASE; ?>scripts/image.php?height=250&width=500&image=<?php echo SITE_BASE;?>images/rolls.jpg&cropratio=2:1" />
					<div class="title_title">Food Court</div>
				</div>
			</div>

			<div class="foot_type_container">
				<div class="home_tile clearfix">
				<img src="<?php echo SITE_BASE; ?>scripts/image.php?height=250&width=500&image=<?php echo SITE_BASE;?>images/wow.jpg&cropratio=2:1" />
					<div class="title_title">Food Court</div>
				</div>
			</div>


		
		</div>
	</div>

</div>

<?php include_once("footer.php"); ?>