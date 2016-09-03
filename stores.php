<?php
if(isset($_REQUEST['addr'])){
	$addr = $_REQUEST['addr'];
}else{
	$addr='';
}
$page='';
?>
<?php include_once("header.php"); ?>


<div class="container" id="location_section"><!-- Main Container -->

<div id="section_left"  class="col-md-8 col-sm-12">

	<div id="location_filter ">
	<div class="location_results_count clearfix">
		<div class="col-xs-6 location_current_count"	>
			<p style="display: inline-block;" class="hidden-xs pull-left"></p>
			 <div class="distance_text pull-left clearfix">
				 	<span class="arr"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
					 <select id="distance">
						<option value="5" selected="">5 Miles</option>
						<option value="15">15 Miles</option>
						<option value="25">25 Miles</option>
						<option value="50">50 Miles</option>
					 </select>
			</div>
		</div>


		<div class="location_results_pagination col-xs-6 clearfix">
			<ul>
				<li><a href=""><i class="prev fa fa-caret-square-o-left fa-2x" aria-hidden="true" data-page="0"></i></a></li>
				<li class="count"></li>
				<li><a href=""><i class="next fa fa-caret-square-o-right fa-2x" aria-hidden="true" data-page="1"></i></a></li>
			</ul>
		</div>
	</div>
	</div>
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


	$("#distance").change(function(){
		
		searchLocations();
	});

	$('input.addressInput').focus(function() { 
		current_address = $(this).val();
		$(this).val('');
	});

	$('input.addressInput').focusout(function(){

		if($(this).val()==''){
			$(this).val(current_address);	
		}
	});

	$(".find_truck").click(function(){
					
		searchLocations();
	});

	$(".location_results_pagination .next").click(function(e){
		

		if($(".location_results_pagination .next").hasClass("disabled")){
			e.preventDefault();
		}
		else{
		searchLocations($(".location_results_pagination .next").data("page"));	
		}
		 e.preventDefault();
	})

	$(".location_results_pagination .prev").click(function(e){

		if($(".location_results_pagination .prev").hasClass("disabled")){
			e.preventDefault();
		}
		else{
		searchLocations($(".location_results_pagination .prev").data("page"));	
		}
		 e.preventDefault();
	})

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