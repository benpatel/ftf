<?php
$page="standard";
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

</div>
<?php
include_once("footer.php"); 
?>