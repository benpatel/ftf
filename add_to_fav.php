<?php 
$check_log_in="YES";
$data=array('status' => 'error');
include_once("includes/initialize.php"); 
if(isset($_REQUEST['id']) && $_REQUEST['id'] !=''){
	$id = $_REQUEST['id'];
	$user_id = $_SESSION['user_info']['id'];
	$sql = "UPDATE users SET favs = concat(favs, 'f{$id}f,') WHERE id = $user_id";
	if($dtb->query($sql)){
		$data['status']="success";
	}

	$sql = "select * from users where id={$user_id}";
	$result_set = $dtb->query($sql);
				while( $result = $result_set->fetch_object()){
				$user_favs = trim($result->favs,',');
				$user_favs = explode(",", $user_favs);
				$_SESSION['user_info']['favs'] = $user_favs;
				foreach ($_SESSION['user_info']['favs'] as $key => $favs) {
					$_SESSION['user_info']['favs'][$key]=trim($favs,'f');
				}
			}
}
echo json_encode($data);
?>