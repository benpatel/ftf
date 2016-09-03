<?php 
//$check_log_in="YES";
$data=array('status' => 'error');
$page='';
$page_title='';
include_once("includes/initialize.php"); 

 // echo "Line:08 start  <br>";
 // echo "<pre>";
 // Print_r($_REQUEST);


if(
		isset($_REQUEST['id']) && 
		$_REQUEST['id'] !='' && 
		isset($_REQUEST['comment']) && 
		$_REQUEST['comment'] !='' 
		&& isset($_REQUEST['rating']) 
		&& $_REQUEST['rating'] >=1 
		&& $_REQUEST['rating'] <=5
	)
{
	 // echo "Line:19 condition Met <br>";
	$id = $_REQUEST['id'];
	$user_id = $_SESSION['user_info']['id'];
	$comment = $dtb->escape_value(trim($_REQUEST['comment']));
	$rating = $_REQUEST['rating'];
	$old_rating = $_REQUEST['old_rating']/10;
if($_REQUEST['action']=='submit_review'){


	if($user->review_exists($id)=="Yes"){
		$old_rating=($user->review_old_rating($id))/10;
	// echo "Line:33 Update review <br>";
	$sql = "UPDATE reviews SET rating = {$rating},comment='{$comment}', update_date='{$today_date}'  WHERE listing_id = {$id} AND user_id={$user_id}";	
	$sql1 = "UPDATE listing SET rating = (rating+{$rating}-{$old_rating}) WHERE id = {$id} ";
	}
	else{
	// echo "Line:36 Submit review <br>";
	$sql ="INSERT INTO reviews (user_id, rating, comment, listing_id,date) VALUES ('{$user_id}', '{$rating}', '{$comment}', '{$id}','{$today_date}')";
	$sql1 = "UPDATE listing SET rating = (rating+{$rating}),reviews = (reviews+1) WHERE id = $id ";	
	}

}

if($_REQUEST['action']=='update_review'){
	 // echo "Line:33 Update review <br>";

$sql = "UPDATE reviews SET rating = {$rating},comment='{$comment}', update_date='{$today_date}' WHERE listing_id = {$id} AND user_id={$user_id}";	
$sql1 = "UPDATE listing SET rating = (rating+{$rating}-{$old_rating}) WHERE id = {$id} ";	

}


	if($dtb->query($sql) && $dtb->query($sql1)){
		$data['status']="success";
	}
}
echo json_encode($data);
?>