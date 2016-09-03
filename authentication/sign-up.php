<?php


	$sql ="INSERT INTO users (fname, lname, email,userID,provider,favs) VALUES 
	('{$fname}', '{$lname}', '{$email}','{$userID}','{$provider}','')";
	if(!$dtb->query($sql)){
		exit;
	}	


?>