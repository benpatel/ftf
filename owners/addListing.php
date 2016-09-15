<?php include_once("header.php"); 
if(isset($_REQUEST['id']) && $_REQUEST['id'] !=''){

	$action_id = 'updateListing';
	$listing_id = "?id=".$_REQUEST['id'];
	$list_id = $_REQUEST['id'];
	$action_text = "Update Listing";


			$sql = "select * from listing where id={$list_id}";
			$result_set = $dtb->query($sql);
			while( $result = $result_set->fetch_object()){
				$name = $result->name;
				$address1 = $result->address_1;
				$address2 = $result->address_2;
				$city = $result->city;
				$state = $result->state;
				$zip = $result->zip;
				$lat = $result->lat;
				$lng = $result->lng;
			}




}else{

	$action_id = 'addListing';
	$listing_id='';
	$list_id='';
	$action_text = "Submit Listing";
	$name = '';
	$address1 = '';
	$address2 = '';
	$city = '';
	$state = '';
	$zip = '';
	$lat = '';
	$lng = '';
}
?>
<div class="row">

<div id="listingNav">
<p id="list_id" style="display:none"><?php echo $list_id; ?></p>
	<ul>
		<li><a href="addListing.php<?php echo $listing_id; ?>" class="active">Address</a></li>
		<li><a href="details.php<?php echo $listing_id; ?>" class="">Details</a></li>
		<li><a href="managepictures.php<?php echo $listing_id; ?>"  class="">Images</a></li>
		<li><a href="managevideos.php<?php echo $listing_id; ?>"  class="">Videos</a></li>
		<li><a href="managereviews.php<?php echo $listing_id; ?>"  class="">Reviews</a></li>
	</ul>

</div>

<div class="row" id="listingDetail" style="margin:0px;">

	<div class="alert alert-success fade in" id="listingUpdatealert">
	    <a href="#" class="close"  aria-label="close">&times;</a>
  	</div>

<div class="col-sm-12" style="margin:0px;">
	<div class="col-sm-7"  id="section_left" >



		<form class="form-horizontal" id="listing_form" method="post">
		<input type="hidden" name="id" value="<?php echo $list_id; ?>">
		  <div class="form-group">
		    <label for="CartName" class="col-sm-2 control-label">Location Name</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="CartName" name="name"  required data-min-length="2"  placeholder="Cart Name" value="<?php echo $name; ?>">
		      <p class="error_block">Enter valid Cart Name</p>
		    </div>
		  </div>

		  <!-- 
			<div class="form-group">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-10">
						  	<div class="col-sm-4">
						      <p class="btn btn-default" id="useCurrentLocation">Use Current Location</p>
						    </div>
						    <div class="col-sm-4">
						      <p class="" style="text-align:center"> OR </p>
						    </div>
						    <div class="col-sm-4">
						      <p class="btn  btn-default btn-primary" id="typeAddress">Type Address</p>
						    </div>
				</div>
			</div>
			-->



		<div id="address_box"  class="">
		  <div class="form-group">
		    <label for="addressInput" class="col-sm-2 control-label">Address</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control"  name="address1"  required data-min-length="2" id="addressInput" placeholder="Address"  value="<?php echo $address1; ?>">
		      <p class="error_block">Enter Address</p>
		    </div>
		    <div class="col-sm-4">
				<p class="btn btn-default" id="useCurrentLocation">Use Current Location</p>
			</div>
		  </div>

		  <div class="form-group">
		    <label for="landMark" class="col-sm-2 control-label">Land mark</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="landMark" name="address2" placeholder="Land Mark"  value="<?php echo $address2; ?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="city" class="col-sm-2 control-label">City</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="city"  required data-min-length="3"  id="city" placeholder="City"  value="<?php echo $city; ?>">
		      <p class="error_block">Enter City Name</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="state" class="col-sm-2 control-label">State</label>
		    <div class="col-sm-10">
		      <select class="form-control" id="state" name="state"  >
		      		<option value="AL">Alabama</option>
					<option value="AK">Alaska</option>
					<option value="AZ">Arizona</option>
					<option value="AR">Arkansas</option>
					<option value="CA">California</option>
					<option value="CO">Colorado</option>
					<option value="CT">Connecticut</option>
					<option value="DE">Delaware</option>
					<option value="DC">District Of Columbia</option>
					<option value="FL">Florida</option>
					<option value="GA">Georgia</option>
					<option value="HI">Hawaii</option>
					<option value="ID">Idaho</option>
					<option value="IL">Illinois</option>
					<option value="IN">Indiana</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="ME">Maine</option>
					<option value="MD">Maryland</option>
					<option value="MA">Massachusetts</option>
					<option value="MI">Michigan</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NV">Nevada</option>
					<option value="NH">New Hampshire</option>
					<option value="NJ">New Jersey</option>
					<option value="NM">New Mexico</option>
					<option value="NY">New York</option>
					<option value="NC">North Carolina</option>
					<option value="ND">North Dakota</option>
					<option value="OH">Ohio</option>
					<option value="OK">Oklahoma</option>
					<option value="OR">Oregon</option>
					<option value="PA">Pennsylvania</option>
					<option value="RI">Rhode Island</option>
					<option value="SC">South Carolina</option>
					<option value="SD">South Dakota</option>
					<option value="TN">Tennessee</option>
					<option value="TX">Texas</option>
					<option value="UT">Utah</option>
					<option value="VT">Vermont</option>
					<option value="VA">Virginia</option>
					<option value="WA">Washington</option>
					<option value="WV">West Virginia</option>
					<option value="WI">Wisconsin</option>
					<option value="WY">Wyoming</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="zip" class="col-sm-2 control-label">Zip</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control"  value="<?php echo $zip; ?>"   name="zip"  required data-min-length="5" id="zip" placeholder="Zip">
		      <p class="error_block">Enter 5 Digit Zip</p>
		    </div>
		  </div>
		 </div>
		 <div id="location_box" class="hidden">
		 </div>


		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<input type="hidden" name="lat" id="map_lat" value="<?php echo $lat; ?>">
		    	<input type="hidden" name="lng" id="map_lng"  value="<?php echo $lng; ?>">
		      	<button type="submit" id="loadMap" class="btn btn-default">Show On Map</button>
		      	<button type="submit" id="<?php echo $action_id?>" class="btn btn-default btn-success disabled"><?php echo $action_text; ?></button>
		    </div>
		  </div>
		</form>
	</div>

	<div id="section_right"  class="col-sm-5">
		<p class="error"> You can Move Marker to Target Accurate Location</p>
		<div id="main_map" class="">
			<div id="map" ></div>
		</div>
	</div>
</div>	
</div>	
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApwcx3uIrS893GPZPx8e3Oq2LJ-xGt0Go&callback=initialize" async defer></script>
<script type="text/javascript">
	$("#state").val("<?php echo $state; ?>");
</script>
<?php include_once("footer.php"); ?>