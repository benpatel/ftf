<?php
while ($user_result = $user_result_set->fetch_object()) {
	
				$_SESSION['user_info']['logged_in']="YES";
				$_SESSION['user_info']['id']=$user_result->id;
				$_SESSION['user_info']['fname']=$user_result->fname;
				$_SESSION['user_info']['lname']=$user_result->lname;
				$_SESSION['user_info']['email']=$user_result->email;

				unset($_SESSION['error']);

				$user_favs = trim($user_result->favs,',');
				$user_favs = explode(",", $user_favs);
				$_SESSION['user_info']['favs'] = $user_favs;
				foreach ($_SESSION['user_info']['favs'] as $key => $favs) {
					$_SESSION['user_info']['favs'][$key]=trim($favs,'f');
				}
				

}
?>