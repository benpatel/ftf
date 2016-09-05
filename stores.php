<?php
if(isset($_REQUEST['addr'])){
	$addr = $_REQUEST['addr'];
	
}else{
	$addr='';
	
}

if(isset($_REQUEST['page'])){
	$page= $_REQUEST['page'];
}else{
	$page=1;
}

?>
<?php include_once("header.php"); ?>


<div class="container" id="location_section"><!-- Main Container -->
<input id="page_no" type="hidden" name="page" value="<?php echo $page; ?>" />
<div id="section_left"  class="col-md-8 col-sm-12">

	<div id="lisings" class="">

		<div class="clearfix single_listing row">
			<div class="listing_image" >

			<img src="<?php echo SITE_BASE; ?>scripts/image.php?width=100&height=100&cropratio=1:1&image=<?php echo SITE_BASE; ?>location_images/1.jpg"   data-image-id="1" >
			</div>

			<div class="listing_info" >
				<p class="listing_name">Metro PCS Franklin Square</p>
				<p class="listing_review">

				

				<img src="location_images/star.png"> <span><a href="">(10)</a></span></p>
			</div>
			<div class="listing_address" >
				<p>972 Hempstad tpke</p>
				<p>Franklin square, <span class="hidden-xs hidden-sm">NY 11010</span></p>
				<p class="hidden-xs hidden-sm">(516) 444 9666</p>
			</div>
		</div>
	</div>

	<div col-sm-12>
			<div class="clearfix">
				<div class="col-xs-6">
					<a class="btn pull-left btn-default btn-prev" href="stores.php?addr=<?php echo $addr; ?>&page=<?php echo $page-1; ?>">Previous</a>
				</div>
				<div class="col-xs-6">
					<a  class="btn pull-right btn-default btn-next" href="stores.php?addr=<?php echo $addr; ?>&page=<?php echo $page+1; ?>">Next</a>
				</div>
			</div>
	</div>
</div>

<div id="section_right" class="col-md-4 col-sm-12 hidden-sm hidden-xs " style="position:relative">
	<div id="main_map" class="">
		<div id="map" ></div>
	</div>
</div>





<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApwcx3uIrS893GPZPx8e3Oq2LJ-xGt0Go&callback=initialize" async defer></script>
<script type="text/javascript">

$(function(){

	var current_address ='';	

	$('input.addressInput').focus(function() { 
		current_address = $(this).val();
		$(this).val('');
	});
	$('input.addressInput').focusout(function(){

		if($(this).val()==''){
			$(this).val(current_address);	
		}
	});
})
	
function initialize(){
	if(navigator.geolocation){
	  navigator.geolocation.getCurrentPosition(function(position) {	
		  load(position);
	}, 
	function() {
	      handleLocationError(true);
	      console.log("problem is here");
	
	    });
	} 
	else {
	    // Browser doesn't support Geolocation
	    handleLocationError(false);
	   
	}
}

function handleLocationError(browserHasGeolocation) {
 	console.log(browserHasGeolocation);
 	load(0);
}


</script>


<?php include_once("footer.php"); ?>