<?php include_once("includes/initialize.php"); 

if(isset($_REQUEST['addr'])){
	$addr = $_REQUEST['addr'];
}else{
	$addr='';
}


$page="Log In";
$page_title='Log In';

?>

<?php include_once("header.php"); 
$_SESSION['redirectURL']=SITE_BASE;
?>

<div class="container"  id="location_section">
	
<div id="root" style="width: 320px; margin: 20px auto; border-radius: 5px; padding: 10px; box-shadow: 2px 2px 10px #ccc; box-sizing: border-box;">
    
</div>
<script src="https://cdn.auth0.com/js/lock/10.0/lock.min.js"></script>
<script>
   var lock = new Auth0Lock('gK02v3NYIGziS7VfyEY9qnFwV4qID8Z3', 'syntextech.auth0.com', {
     container: 'root',
     auth: {
       redirectUrl: 'http://localhost/ftf/authentication/authenticate.php',
       responseType: 'code',
       params: {
         scope: 'openid email' // Learn about scopes: https://auth0.com/docs/scopes
       }
     }
   });
   lock.show();
</script>
</div>

<?php include_once("footer.php"); ?>
