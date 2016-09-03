<?php

  // Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

use Auth0\SDK\Auth0;

$auth0 = new Auth0(array(
    'domain'        => 'syntextech.auth0.com',
    'client_id'     => 'gK02v3NYIGziS7VfyEY9qnFwV4qID8Z3',
    'client_secret' => 'y9GYFgg3iUdAZOr4zp0qHMcDq89kod079K4CgpQbAb3X-xtUPS9PvgkZcV09mPYt',
    'redirect_uri'  => 'http://localhost/ftf/test.php'
));

  $userInfo = $auth0->getUser();

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

<div id="root" style="width: 320px; margin: 40px auto; padding: 10px; border-style: dashed; border-width: 1px; box-sizing: border-box;">
    embeded area
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
</body>
</html>