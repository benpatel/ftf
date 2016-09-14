<?php include_once("includes/initialize.php"); 
$_SESSION['redirectURL']='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Stores</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
 <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="functions.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="scripts/lightbox/css/lightbox.css">
	<link rel="stylesheet" type="text/css" href="http://sachinchoolur.github.io/lightslider/src/css/lightslider.css">
	<link rel="stylesheet" type="text/css" href="http://sachinchoolur.github.io/lightGallery/lightgallery/css/lightgallery.css">

		
	<link rel="stylesheet" type="text/css" href="css/slider.css">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/tablet.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	
	

	<link rel="stylesheet" type="text/css" href="css/colorbox.css">
	<link rel="stylesheet" type="text/css" href="css/auth.css">
	<script type="text/javascript">
	var site_base ='<?php echo SITE_BASE; ?>';
	</script>
</head>
<body>
<div id="site_nav">
<div  class="container">
<div id="mobile_navigation" clsss="clearfix">


<?php if($page!='Log In'){  ?>
	<div class="nav_blocks block_left left_controll">
		<i class="fa fa-list  fa-lg"></i>
	</div>
<?php }else{ ?>

	<div class="nav_blocks block_left">
		<a href="index.php"><i class="fa fa-long-arrow-left  fa-lg"></i></a>
	</div>

	<?php } ?>


	<div class=" nav_blocks block_center">
		<div class="title_action_div_mobile">

		<?php if($page=='location'){
				echo "<h2 class=\"location_title\">".$page_title."</h2>";
		}
		elseif ($page=='search') {
			
		}elseif($page=='standard'){
				echo "<h2 class=\"location_title\">".$page_title."</h2>";
		}
		elseif ($page=='Log In') {
				echo "<h2 class=\"location_title\">".$page_title."</h2>";
		}
		elseif ($page=='index') {
				echo '<p style="text-align:center"><img src="images/logo.jpg" height="35" /></p>';
		}
		else{
		?>
				<div id="nav_search_box" class="clearfix">
					<div class="col-xs-12" style="position:relative"  id="header_search">
						<form method="get" action="stores.php">	
							<input id="" class="col-xs-12 addressInput" name="addr"  placeholder="Street address, City, State" value="<?php echo $addr; ?>" />

							<span class="location">
								<i class="fa fa-map-marker " aria-hidden="true"></i>
							</span>
							 
							<span class="find_truck">
								<button class="button_search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
							</span>
						</form>
					</div>
				</div>

		<?php 
		}
		?>			
		</div>
		<div class="title_action_div_desktop">
	
				<div class="nav row">
					
					<div class="col-sm-2 no_paddiing">
						<a href="index.php"><img class="logo img-responsive" src="images/logo.jpg"></a>
					</div>

					<div class="col-sm-8 col-xs-12">

							<div id="nav_search_box" class="clearfix">
								<div class="col-xs-12" style="position:relative"  id="header_search">
									<form method="get" action="stores.php">	
									<input id="" class="col-xs-12 addressInput" name="addr" value="<?php echo $addr; ?>" placeholder="Street address, City, State">

									<span class="location">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
									</span>
									 
									<span class="find_truck">
										<button class="button_search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
									</span>
									</form>
								</div>
							</div>
							<div id="nav_sub_menu_box" class="clearfix">
								<ul>
									<li>About Us</li>
									<li>Deals</li>
									<li>Coupons</li>
								</ul>
							</div>
					</div>
					<div class="col-sm-2">
										<!-- Split button -->
							<?php if(isset($_SESSION['user_info']['logged_in']) && $_SESSION['user_info']['logged_in']=="YES"){
								?>
											<div class="btn-group pull-right">
											  <button type="button" class="btn ftf_btn btn-default  dropdown-toggle"  data-toggle="dropdown">My Account <span class="caret"></span></button>
											  <ul class="dropdown-menu dropdown-menu-right">
											    <li><a href="#">Profile</a></li>
											    <li><a href="#">My Favorites</a></li>
											    <li><a  href="my_reviews.php">My Reviews</a></li>
											    <li role="separator" class="divider"></li>
											    <li><a href="log_out.php">Log Out</a></li>
											  </ul>
											</div>
							<?php }
							else{  ?>
										<p onclick="lock.show();" class="pull-right btn ftf_btn">Sign In</p>
								
							<?php	} ?>

					</div>
					</div>
		</div>
	</div>
	
	<div class="nav_blocks block_right">
	<?php if($page=='location'){  ?>
			<i class="fa fa-ellipsis-v  fa-lg"></i>
	<?php	}
		?>
	</div>

	<div class="" id="menu_content">
			<ul class="site_main_ul">
				<li><a href="index.php"><img src="images/logo.jpg"></a></li>
				<?php if(isset($_SESSION['user_info']['logged_in']) &&  $_SESSION['user_info']['logged_in']=="YES"){ ?>
					<li><a href="log_out.php" class="btn btn-default">Log Out</a></li>
				
				<?php } 
				else{ ?>
					<li><a href="#" onclick="lock.show();"  class="btn btn-default">SIGN UP OR LOG IN</a></li>
					<?php }?>
			</ul>
			<ul id="site_nav_ul">
				<li><a href="#"> <i class="fa fa-check-square-o fa-lg"> </i> Check In</a></li>
				<li><a href="my_reviews.php"><i class="fa  fa-pencil-square-o fa-lg"></i> My Review</a></li>				
				<li><a href="#"><i class="fa  fa-heart fa-lg"></i> My Favorites</a></li>
			</ul>		
	</div>	
</div>
<?php if($page=='index') { ?>
<div style="background:#f00; padding:0px 5px 5px 5px;" class="title_action_div_mobile">

				<div id="nav_search_box" class="clearfix">
					<div class="col-xs-12" style="position:relative"  id="header_search">
						<form method="get" action="stores.php">	
							<input id="" class="col-xs-12 addressInput" name="addr"  placeholder="Street address, City, State" value="<?php echo $addr; ?>" />

							<span class="location">
								<i class="fa fa-map-marker " aria-hidden="true"></i>
							</span>
							 
							<span class="find_truck">
								<button class="button_search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
							</span>
						</form>
					</div>
				</div>
</div>
<?php } ?>
</div>
</div>

