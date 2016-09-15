<?php 
if(isset($_REQUEST['id'])){
	$listing_id = "?id=".$_REQUEST['id'];
	$list_id = $_REQUEST['id'];
}else{
	header( 'Location: addListing.php' ) ;
}
include_once("header.php"); 
?>
<div class="row">

<div id="listingNav">
<p id="list_id" style="display:none"><?php echo $list_id; ?></p>
	<ul>
		<li><a href="addListing.php<?php echo $listing_id; ?>">Address</a></li>
		<li><a href="details.php<?php echo $listing_id; ?>" class="active">Details</a></li>
		<li><a href="managepictures.php<?php echo $listing_id; ?>"  class="">Images</a></li>
		<li><a href="managevideos.php<?php echo $listing_id; ?>"  >Videos</a></li>
		<li><a href="managereviews.php<?php echo $listing_id; ?>"  class="">Reviews</a></li>
	</ul>
</div>

<div class="row" id="listingDetail" style="margin:0px;">
	
</div>	
</div>
<?php include_once("footer.php"); ?>