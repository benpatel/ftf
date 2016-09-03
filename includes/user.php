<?php
require_once("functions.php");
require_once("database.php");


class User{


	   

		public function get_avatar($id){
		global $dtb;
		$img='avatar.jpg';
		$sql =  "select * from users where id={$id} limit 1";
		$result_set = $dtb->query($sql);
			while( $result = $result_set->fetch_object()){

				if($result->avatar !=''){
						$img=$result->avatar;
				}
			
			}
		return $img;
		}

		public function check_log_in($username,$password){
			global $dtb;
			$sql = "select * from users where email = '".$username."' AND password = '".$password."'";
			$result_set = $dtb->query($sql);
			if($dtb->num_rows($result_set) ==1){
				while( $result = $result_set->fetch_object()){

				$_SESSION['user_info']['logged_in']="YES";
				$_SESSION['user_info']['id']=$result->id;
				$_SESSION['user_info']['fname']=$result->fname;
				$_SESSION['user_info']['lname']=$result->lname;
				$_SESSION['user_info']['email']=$result->email;

				unset($_SESSION['error']);
				$user_favs = trim($result->favs,',');
				$user_favs = explode(",", $user_favs);
				$_SESSION['user_info']['favs'] = $user_favs;
				foreach ($_SESSION['user_info']['favs'] as $key => $favs) {
					$_SESSION['user_info']['favs'][$key]=trim($favs,'f');
				}
					//header("Location: index.php");
				}
			}else{

				$_SESSION['error']='signIn';
			
			}

		}

		public function review_exists($list_id){
		
		global $dtb;

		$sql_r = "select * from reviews where listing_id={$list_id} and user_id={$_SESSION['user_info']['id']}"; 
		$result_set = $dtb->query($sql_r);
			if($dtb->num_rows($result_set)>=1){
				return "Yes";
			}else{
				return "No";
			}
		}

		public function review_old_rating($list_id){
			global $dtb;
				$sql_r = "select * from reviews where listing_id={$list_id} and user_id={$_SESSION['user_info']['id']}"; 
				$result_set = $dtb->query($sql_r);
				while( $result = $result_set->fetch_object()){

					$old_rating = ($result->rating)*10;
				}
				return $old_rating;
		}

}

$user = new User;
?>