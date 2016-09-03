<?php 
include_once(__DIR__."/../"."includes/init.php");
include_once(__DIR__."/authParams.php");   

if(!$userInfo){
    echo "some Problem";
 }else{
  $userID = $userInfo['identities'][0]['user_id'];
  
  $email='';
  if(isset($userInfo['email'])){
    $email = $userInfo['email'];
  }

  $fname='';
   if(isset($userInfo['given_name'])){
    $fname = $userInfo['given_name'];
  }


  $lname='';
   if(isset($userInfo['family_name'])){
    $lname = $userInfo['family_name'];
  }
  
  $provider = $userInfo['identities'][0]['provider'];
  $nickname = $userInfo['nickname'];
 }

$user_sql="select * from users where userID='{$userID}' or email='{$email}'";
$user_result_set  =$dtb->query($user_sql);

if($dtb->num_rows($user_result_set) == 0 ){
   include("sign-up.php"); 
}

$user_result_set  =$dtb->query($user_sql);
include("sign-in.php");

redirect_to($_SESSION['redirectURL']);
//$auth0->logOut()
?>