<?php include_once("../../includes/initialize.php"); ?>
<?php
$data = array();
$data['status']='error';

	$vendor_id 			= $dtb->escape_value(trim(1));
	$name 				= $dtb->escape_value(trim($_POST['name']));
	$address_1 			= $dtb->escape_value(trim($_POST['address1']));
	$address_2 			= $dtb->escape_value(trim($_POST['address2']));
	$city 				= $dtb->escape_value(trim($_POST['city']));
	$state 				= $dtb->escape_value(trim($_POST['state']));
	$zip 				= $dtb->escape_value(trim($_POST['zip']));
	$phone 				= $dtb->escape_value(trim('-'));
	$featured_image 	= $dtb->escape_value(trim('-'));
	$images 			= $dtb->escape_value(trim('-'));
	$hours 				= $dtb->escape_value(trim('-'));
	$lat				= $dtb->escape_value(trim($_POST['lat']));
	$lng 				= $dtb->escape_value(trim($_POST['lng']));

$sql = "INSERT INTO listing
(	
	status, 
	vendor_id, 
	name, 
	address_1, 
	address_2, 
	city, 
	state, 
	zip, 
	phone, 
	featured_image, 
	images, 
	rating, 
	reviews, 
	hours, 
	featured, 
	lat, 
	lng
						) VALUES (
	'INACTIVE', 
	{$vendor_id}, 
	'{$name}', 
	'{$address_1}', 
	'{$address_2}', 
	'{$city}', 
	'{$state}', 
	'{$zip}', 
	'{$phone}', 
	'{$featured_image}', 
	'{$images}', 
	'0', 
	'0', 
	'{$hours}', 
	'NO', 
	'{$lat}', 
	'{$lng}'
)";

if($dtb->query($sql)){
	$data['status']='success';
	$data['listing_id']=$dtb->last_insert_id();
}
echo json_encode($data);
?>