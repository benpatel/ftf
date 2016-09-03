<?php include_once("../../includes/initialize.php"); ?>
<?php

$data = array();
$data['status']='error';
	$id = $_POST['id'];
	$name 				= $dtb->escape_value(trim($_POST['name']));
	$address_1 			= $dtb->escape_value(trim($_POST['address1']));
	$address_2 			= $dtb->escape_value(trim($_POST['address2']));
	$city 				= $dtb->escape_value(trim($_POST['city']));
	$state 				= $dtb->escape_value(trim($_POST['state']));
	$zip 				= $dtb->escape_value(trim($_POST['zip']));
	$lat				= $dtb->escape_value(trim($_POST['lat']));
	$lng 				= $dtb->escape_value(trim($_POST['lng']));

$sql = "UPDATE listing SET

	name = '{$name}', 
	address_1 = '{$address_1}', 
	address_2 = '{$address_2}', 
	city = '{$city}', 
	state = '{$state}', 
	zip = '{$zip}',  
	lat = '{$lat}', 
	lng ='{$lng}'

	where id={$id}
";

if($dtb->query($sql)){
	$data['status']='success';
	$data['listing_id']=$id;
}
echo json_encode($data);
?>