  //Initialize Fcebook Log in Script
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1760499644205722',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5', // use graph api version 2.5
    status     : true
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  
   // Check Facebook Log In Status
  function checkLoginState() { 
          FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
              fbLogInProcess(response.authResponse.userID);
            }
            else {
            FB.login(function(response) {
              fbLogInProcess(response.authResponse.userID);
              }, {scope: 'public_profile,email'});
            }
          });
  }
  
  //Process Log In or Sign Up
  function fbLogInProcess(userID) {
      FB.api(
                "/"+userID, 
                {fields: 'first_name,last_name,email,name,picture'},
                function (response) { 
                  appLogin(response);
                }
          );
  }


  function appLogin(response){
    
      review_data = {
        fname:response.first_name,
        lname:response.last_name,
        email:response.email,
        password:response.id
      }
    		$.ajax({
		    url: "ajax_sign_in.php",
		    method: "POST",
		    data: review_data,
		    dataType: "json", 
		    success: function(data){
					if(data.status=='success'){
						 window.location = "index.php";
				  }
		    },
		     error:function(){
		      $(".working").css("display","none");
		      }
		    });
  }