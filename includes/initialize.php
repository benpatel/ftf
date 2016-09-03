<?php 
date_default_timezone_set('America/New_York');
require_once("functions.php");
require_once("user.php");
require_once("database.php");
require_once("orders.php");
require_once("product_data.php");
$today_date= date("Y-m-d");

if(isset($_REQUEST['addr'])){
	$addr = $_REQUEST['addr'];
}else{
	$addr='';
}

if(isset($page_title)){

}else{
	$page_title='';
}
if(isset($_REQUEST['id'])  && $_REQUEST['id'] !=''){
	$list_id = $_REQUEST['id'];
	$sqli = "select * from listing where id={$list_id}";
	$result_seti = $dtb->query($sqli);
	while( $resulti = $result_seti->fetch_object()){
		$page_title = $resulti->name;
	}
}
else{
	$list_id = 0;
}
$logged_in=false;
if(isset($_SESSION['user_info']['logged_in']) && $_SESSION['user_info']['logged_in']=="YES"){
	$logged_in=true;
}

if(isset($check_log_in) && $check_log_in=="YES"){
	if($logged_in){

		$diasbled_btn='';
	}
	else{
		header("location:index.php");

	}
}
$fav_cls='';
if($logged_in){

		$diasbled_cls='';
		$hidden_cls='';

		if (in_array($list_id, $_SESSION['user_info']['favs'])) {
    		$fav_cls='favrite_listing';
		}	

	}else{
		$diasbled_cls='disabled ';
		$hidden_cls = 'hidden ';
}

?>
