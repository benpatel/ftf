<?php 

if(isset($_REQUEST['addr'])){
	$addr = $_REQUEST['addr'];
}else{
	$addr='';
}
if(isset($_REQUEST['id'])){

}else{
	header("location:index.php");
}
$page='location';
$page_title='';
?>
<?php include_once("header.php"); ?>
<?php 
$action ='Write Review';
if(isset($_SESSION['user_info']['logged_in']) && $_SESSION['user_info']['logged_in']=="YES"){
	$sql_r = "select * from reviews where listing_id={$list_id} and user_id={$_SESSION['user_info']['id']}"; 
	$result_set_r = $dtb->query($sql_r);
	if($result_set_r->num_rows > 0){
		$action ='Edit Review';
	}
}

$sql = "select * from listing where id={$list_id}";
$result_set = $dtb->query($sql);

while( $result = $result_set->fetch_object()){

	?>
<input type="hidden" value="<?php echo $result->lat; ?>" id="location_lat" />
<input type="hidden" value="<?php echo $result->lng; ?>" id="location_lng" />
	<div class="container" id="location_section"><!-- Main Container -->
        <div class="contentInfoContainer col-sm-12">
	        <!-- TITLE -->
	        <?php
				$listing_rating=0;
				if($result->reviews>0){
				$listing_rating = ($result->rating/$result->reviews);
				$listing_rating = (floor($listing_rating * 2) / 2)*10;
				}
			?>
	        <div class="listing_title">
	            <h2 class=""><?php echo $result->name; ?></h2>
	            <p>
					<span class="location_rating rating-<?php echo $listing_rating; ?>"></span> 
					<span class="location_reviews">
						<a href="location_review.php?id=<?php echo $list_id; ?>">(<?php echo $result->reviews; ?>  Reviews)</a>
					</span>
				</p>
	       </div> 


			<div class="hidden visible-xs visible-sm">
			
				<p  class="location_address">
						<?php echo $result->address_1; ?>
						<?php echo $result->address_2; ?>                        
						<?php echo ",".$result->city." ".$result->state."-".$result->zip; ?>

				</p>
			</div>


	       	<section  class="hidden visible-xs visible-sm">
					<ul id="location_controls">
<span id="add_to_fav_btn" data-list-id="<?php echo $list_id; ?>" class=""><i class="fa fa-heart <?php echo $diasbled_cls." ".$fav_cls; ?>"></i>Favorite</span>

<span id="share_btn" class=""><a href="write_review.php?id=<?php echo $list_id; ?>"><i class="fa fa-edit"> <?php echo $action; ?></i></a></span>
					</ul>
				</section>

		</div>


		<div id="section_left"  class="col-md-8 col-sm-12">
			<div class="interiorLeft">			

				<!-- MAP FIELD -->
				<div id="list_map" class="row">
					<div id="map">
					</div>
				</div>

				<div class="clearfix" style="margin:10px 0px;">

<div class="addthis_native_toolbox row"></div>

				</div>

				<div class="info_table row hidden visible-xs visible-sm">
					<table style="width:100%" class="table-responsive table-striped">
						<tr>
							<td>Phone</td>
							<td>516 444 9666</td>
						</tr>
						<tr>
							<td>Website</td>
							<td>www.yahoo.com</td>
						</tr>
						<tr>
							<td>Email : </td>
							<td>ben@existmobile.com</td>
						</tr>
					</table>
				</div>

				<?php
					$listing_images = $result->images;
					$listing_images = trim($listing_images,',');
					$listing_image = explode(",", $listing_images);
					$listing_image = array_reverse($listing_image);
					$no_of_images = count($listing_image);
					if($no_of_images >=10){
							$no_of_display_images=10;
					}else{
						$no_of_display_images= $no_of_images;
					}
					?>
		<div class="row">
            <ul id="lightSlider" class="content-slider">



					<?php

					for($im=0; $im<$no_of_display_images; $im++){
						if($listing_image[$im]!=''){

					?>


				<li data-src="vendor/uploads/<?php echo $listing_image[$im]; ?>">
                    <img src="vendor/uploads/<?php echo $listing_image[$im]; ?>">
                </li>
					<?php
						}
					}
					?>
         
            </ul>
        </div>



				<!-- SUMMARY/DESCRIPTION -->
				<div class="contentFulltext hidden-xs hidden-sm" >
						<p>Located in South Los Angeles.</p> <p>Two unique lounge areas, featuring floor seating with thick and comfortable cushions + tables and chairs. WiFi available, with two TV's and music for your choice of entertainment. Be old school and smoke your hookah/cigar playing backgammon and chess!</p> <p>Also a Smoke Shop specializing in all sorts of smoking products from a wide variety of cigarettes, rolling papers, wraps, cigarillos to hand pipes, animal pipes, water pipes and a premium cigar selection. From vaporizers, detox, scales, cleaners, hookah tobacco and accessories and more, we have it all! Don't expect your traditional hookah only, come experience and even customize for yourself a modern hookah like never before.
						</p>           
			    </div>

				<!-- REVIEWS TAB -->
				<div id="reviewsTab">

					<!-- BEGIN USER REVIEW SUMMARY -->
					<h3 class="jrHeading">
						<i aria-hidden="true" class="fa fa-users"></i>
						<span class="jrHeadingText">User reviews</span>
					</h3>
					<div class="clear"></div>

					</div>

<?php
//////////////// Location review ///////////////////////////////

$sort_by="date_desc";
$start = 0;
$sort_with='date';
$sort_order='desc';
$sort_by_text = 'Newest First';

$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$curr_url =$_SERVER['HTTP_HOST'] . $uri_parts[0];

if(isset($_REQUEST['start'])){
	$start = $_REQUEST['start'];
	}
if(isset($_REQUEST['sort_by'])){


	switch ($_REQUEST['sort_by']) {
    case 'rating_asc':
		$sort_with='rating';
		$sort_order='asc';
		$sort_by_text = 'Low to High';
        break;
    case 'rating_desc':
        $sort_with='rating';
		$sort_order='desc';
		$sort_by_text = 'High to Low';
        break;
    case 'date_asc':
        $sort_with='date';
		$sort_order='asc';
		$sort_by_text = 'Oldest First';
        break;
    default:
        $sort_with='date';
		$sort_order='desc';
		$sort_by_text = 'Newest First';
}

}
?>

<div class="" id="location_section">

<div id="review_sort_box" class="">
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    Sort By : <?php  echo $sort_by_text; ?>
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	    <li><a href="http://<?php echo $curr_url; ?>?id=<?php echo $list_id; ?>&sort_by=date_desc">Newest First</a></li>
	    <li><a href="http://<?php echo $curr_url; ?>?id=<?php echo $list_id; ?>&sort_by=date_asc">Oldest First</a></li>
	    <li><a href="http://<?php echo $curr_url; ?>?id=<?php echo $list_id; ?>&sort_by=rating_desc">High to Low</a></li>
	    <li><a href="http://<?php echo $curr_url; ?>?id=<?php echo $list_id; ?>&sort_by=rating_asc">Low to High</a></li>

	  </ul>
	</div>
</div>

<?php

$sql_lr =  "select listing.name, listing.featured_image, reviews.rating, reviews.comment, reviews.date, reviews.user_id from reviews inner join listing on reviews.listing_id=listing.id where listing.id={$list_id}  order by {$sort_with} {$sort_order}  LIMIT 20 OFFSET {$start}";
		$result_set_lr = $dtb->query($sql_lr);
			while( $result_lr = $result_set_lr->fetch_object()){
?>


	<div class="review_box">
		<div class="my_reviews_img">
			<p><img src="users/<?php echo $user->get_avatar($result_lr->user_id); ?>"></p>
		</div>
		<div  class="my_reviews_detail">
				
			<p><span class="location_rating rating-<?php echo ($result_lr->rating)*10; ?>"></span> </p>
			<p><?php echo $result_lr->comment; ?></p>
		</div> 
	</div>

<?php
}
?>
</div>
<?php
/////////////// Location Rewview End ///////////////////////
?>
				</div>
		     </div>



		<div id="section_right" class="col-md-4 col-sm-12 hidden-xs hidden-sm" style="position:relative">
			<div class="interiorRight">
				<!-- CUSTOM FIELDS -->
				<section>
					<ul id="location_controls">
<span id="add_to_fav_btn" data-list-id="<?php echo $list_id; ?>" class=""><i class="fa fa-heart <?php echo $diasbled_cls." ".$fav_cls; ?>"></i>Favorite</span>

<span id="share_btn" class=""><a href="write_review.php?id=<?php echo $list_id; ?>"><i class="fa fa-edit"> <?php echo $action; ?></i></a></span>
					</ul>
				</section>
				<section class="listingInfo ">
					<div class="location">
						<h3 class="detailtitle">Location</h3>
						<p><?php echo $result->address_1; ?></p>
						<p><?php echo $result->address_2; ?></p>                        
						<p><?php echo $result->city." ".$result->state."-".$result->zip; ?></p>                       
					</div>

					<div class="info_table hidden-xs hidden-sm">
					<table style="width:100%" class="table-responsive table-striped">
						<tr>
							<td>Phone</td>
							<td>516 444 9666</td>
						</tr>
						<tr>
							<td>Website</td>
							<td>www.yahoo.com</td>
						</tr>
						<tr>
							<td>Email : </td>
							<td>ben@existmobile.com</td>
						</tr>
					</table>
				</div>

					<div class="details">
						<h3 class="detailtitle">Details</h3>
						<span title="Outdoor Seating" class="icon pre-outdoor-seating"><span class="innerText">Outdoor Seating</span></span>                    
					</div>
					<div class="hours">
						<h3 class="detailtitle">Hours</h3>

						<?php
						if($result->hours !='-'){
							$hour = json_decode($result->hours,true);
							foreach ($hour as $day => $timing) {
								?>	
								<div class="col-sm-12">
									<div class="col-sm-4">
											<p><?php echo $day.":"; ?></p>
									</div>
									<div class="col-sm-8">
											<p><?php echo $timing['open']." - ".$timing['close'] ?></p>
									</div>

								</div>
								<?php
							}
						}
						else{
							echo "<p>Location hours are note Available</p>";
						}
						?>                  
					</div>
				</section>
				<!-- GALLERY FIELD -->
				<section id="galleryTab">
					<h3 class="detailtitle">Photos</h3>

					<div class="clear"></div>
				</section>
			</div>
		</div>
	</div>

<?php
}
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApwcx3uIrS893GPZPx8e3Oq2LJ-xGt0Go&callback=initialize" async defer></script>
<script type="text/javascript">
var gmarkers = [];

	function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
      zoom: 17,
      scrollwheel: false,
      maxZoom:17,
      minZoom:17,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      draggable:false
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var tmp_lat = parseFloat($("#location_lat").val());
    var tmp_lng = parseFloat($("#location_lng").val());
    

    var options={location:{lat: tmp_lat, lng: tmp_lng}};
    generateMap(options,true);
}

// Generate Map based on Provided Data
function generateMap(options,movedAction){
	    geocoder.geocode( options, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      	removeMarkers();
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
	        });
        gmarkers.push(marker);
     
      } else {
        
      }
    });
	}
function removeMarkers(){
    for(i=0; i<gmarkers.length; i++){
        gmarkers[i].setMap(null);
    }
}	

</script>
<?php include_once("footer.php"); ?>