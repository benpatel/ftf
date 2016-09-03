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
  <title>
    
  </title>
</head>
<body>
<pre>
<?php
print_r($userInfo);
?>
</pre>
</body>
</html>