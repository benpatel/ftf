<?php
include_once(__DIR__."/../"."includes/init.php");  
include_once(__DIR__."/authParams.php"); 
$auth0->logOut();
$_SESSION['user_info']['logged_in']="NO";
$_SESSION['user']=array();
redirect_to($_SESSION['redirectURL']);
?>