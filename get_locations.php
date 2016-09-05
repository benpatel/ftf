<?php include_once("includes/initialize.php"); 
	if(isset($_POST['radius']) && intval($_POST['radius'])>0){

	$distance=intval($_POST['radius']);
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$radius = $_POST['radius'];
	$page_start = (($_POST['page']*$_POST['no_listing'])-$_POST['no_listing']);
	$page_end = $_POST['page']*$_POST['no_listing'];
	$no_listing = $_POST['no_listing'];
	$sqlx = "SELECT id,name,phone,address_1,city,zip,state,reviews,rating,featured_image,lat,lng, ( 3959 * acos( cos( radians({$lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin( radians( lat ) ) ) ) AS distance FROM listing HAVING distance < {$radius}";
	$product['count'] = $dtb->num_rows($dtb->query($sqlx));
	$product['page'] = $_POST['page'];
	$sql = "SELECT id,name,phone,address_1,city,zip,state,reviews,rating,featured_image,lat,lng, ( 3959 * acos( cos( radians({$lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin( radians( lat ) ) ) ) AS distance FROM listing HAVING distance < {$radius} ORDER BY distance LIMIT {$no_listing} OFFSET {$page_start}";


			$result_set = $dtb->query($sql);
			$x=0;
			while( $result = $result_set->fetch_object()){
				
				$product['location'][$x]= array(
				'id'=>$result->id,
				'name'=>$result->name,
				'phone'=>$result->phone,
				'address'=>$result->address_1,
				'city'=>$result->city,
				'zip'=>$result->zip,
				'state'=>$result->state,
				'pic'=>$result->featured_image,
				'reviews'=>$result->reviews,
				'rating'=>$result->rating,
				'distance'=>$result->distance,
				'lat'=>$result->lat,
				'lng'=>$result->lng
				);
				$x++;
			}

			//$product['sql']=$sql;
	}
else{
$product['status']=$_POST;
}


if(isset($product['location']) && count($product['location'])!=0 ){
	$product['error']="none";
}
else{
		$product['error']="Location Not Found";
}
echo json_encode($product);

?>