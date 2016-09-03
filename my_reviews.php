<?php
$page="standard";
$page_title = "My Reviews";
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


$check_log_in="YES";
include_once("header.php"); 
?>
<div class="container" id="location_section">

<div id="review_sort_box" class="">
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    Sort By : <?php  echo $sort_by_text; ?>
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	    <li><a href="http://<?php echo $curr_url; ?>?sort_by=date_desc">Newest First</a></li>
	    <li><a href="http://<?php echo $curr_url; ?>?sort_by=date_asc">Oldest First</a></li>
	    <li><a href="http://<?php echo $curr_url; ?>?sort_by=rating_desc">High to Low</a></li>
	    <li><a href="http://<?php echo $curr_url; ?>?sort_by=rating_asc">Low to High</a></li>

	  </ul>
	</div>
</div>
<?php

$sql =  "select listing.name, listing.featured_image, reviews.rating, reviews.comment, reviews.date from reviews inner join listing on reviews.listing_id=listing.id where reviews.user_id={$_SESSION['user_info']['id']} order by {$sort_with} {$sort_order}  LIMIT 20 OFFSET {$start}";

		$result_set = $dtb->query($sql);
			while( $result = $result_set->fetch_object()){

				$location_image = "location.jpg";
				if(trim($result->featured_image,'-') !=''){
					$location_image = $result->featured_image;
				}
?>

	<div class="review_box">
		<div class="my_reviews_img">
			<p><img src="vendor/uploads/<?php echo $location_image; ?>"></p>
		</div>
		<div  class="my_reviews_detail">
			<p><?php echo $result->name; ?></p>
			<p><span class="location_rating rating-<?php echo ($result->rating)*10; ?>"></span> </p>
			<p><?php echo $result->comment; ?></p>
		</div> 
	</div>	



<?php
	}


?>


					

</div>

</div>
<?php
include_once("footer.php"); 
?>