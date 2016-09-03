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
		<li><a href="managepictures.php<?php echo $listing_id; ?>"  class="active">Images</a></li>
		<li><a href="managevideos.php<?php echo $listing_id; ?>"  class="">Videos</a></li>
		<li><a href="managereviews.php<?php echo $listing_id; ?>"  class="">Reviews</a></li>
	</ul>
</div>

<div class="row" id="listingDetail" style="margin:0px;">

	<div class="alert alert-danger fade in" id="imgUploadAlert">
	    <a href="#" class="close"  aria-label="close">&times;</a>
  	</div>

		<div class="col-sm-12">
			<h2>Upload Images <span class="image_Error_Display"></span></h2>
			</br>
			<form action="upload.php" method="post" id="file_upload" enctype="multipart/form-data">
			<input name="list_id" type="hidden" value="<?php echo $list_id; ?>" />
			    <input type="file" name="fileToUpload[]" class="hidden" multiple id="fileToUpload">
			</form>
	<div id="uploaded_image_box">
			<?php
			$sql = "select images from listing where id={$list_id}";
			$result_set = $dtb->query($sql);
			while( $result = $result_set->fetch_object()){
				$listing_images = $result->images;
			}
			$listing_images = trim($listing_images,',');
			$listing_images = trim($listing_images,'-');
			$listing_image = explode(",", $listing_images);
			$listing_image = array_reverse($listing_image);

				for($im=0; $im<count($listing_image); $im++){
					if($listing_image[$im]!=''){
				?>
				<div class="uploaded_image">
				<img src="uploads/<?php echo $listing_image[$im]; ?>" class="prd_images">
				<p class="image_no"><?php echo $im+1; ?></p>
				<p class="delate_image"><span>Delete</span></p>
				</div>
				<?php
					}
				}

			?>
			
				
				<div style="clear:both"></div>
			</div>

			<div  class="uploaded_image" id="uploadTrigger"><img src="images/add_image.jpg"></div>

	</div>

</div>	
</div>
<?php include_once("footer.php"); ?>