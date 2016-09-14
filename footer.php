<div class="working">
<img src="images/loading.gif" />
</div>
	<script type="text/javascript" src="scripts/lightslider.js"></script>
	<script type="text/javascript" src="http://sachinchoolur.github.io/lightGallery/lightgallery/js/lightgallery.js"></script>

<script type="text/javascript">



// Navigation JS
$(window).click(function() {
	$("#menu_content").animate({
	left:'-100%'
	},500,function(){
		$("#location_section").css("position","static");
	});
});

$('.left_controll').click(function(event){
	 event.stopPropagation();
	$("#menu_content").animate({
	left:'0'
	},500,function(){
		$("#location_section").css("position","fixed");
	});	
});

$("#menu_content").click(function(event){
	event.stopPropagation();
})






	$("#mobile_navigation").css('height',$(".block_center").outerHeight()+'px');
	$("#location_section").css('padding-top',$("#site_nav").outerHeight()+'px');

	
	$( window ).resize(function() {
		  $("#mobile_navigation").css('height',$(".block_center").outerHeight()+'px');
		  $("#location_section").css('padding-top',$("#site_nav").outerHeight()+'px');
		
	})






$("#header_search .location").click(function(){
	$("#addressInput").val('');
	window.location = "stores.php";
});

$("form").submit(function( event ) {


			var data_validation = true;
			$(this).find("input[required]").each(function(){
			var required_length = $(this).data("min-length");
			if($(this).val().length < required_length){
				$(this).next('p').addClass("error");
				data_validation = false;
			}else{
				$(this).next('p').removeClass("error");
			}
		});

		if(data_validation){
			return true;
		}else{
			return false;
		}
});

$("#add_to_fav_btn").on("click",function(){

	var self = $(this);
	if($(this).hasClass("disabled")){

	}else{
	console.log($(this).data('list-id'));
	var id = $(this).data('list-id');
	var review_data = {
		'id':id
	}

	    // radius distance
    var request = $.ajax({
    url: "add_to_fav.php",
    method: "POST",
    data: review_data,
    dataType: "json"
    });


    request.done(function( data ) {
    	self.addClass("favrite_listing");
    	console.log(data);
    });

	}
})

$("body").on("click","#sign_up_box_switch",function(){
	
	$.colorbox({
			href:"sign_up_pop.html",
			width:"70%"
			});		
})

$("body").on("click","#sign_in_box_switch",function(){
	
	$.colorbox({
			href:"sign_in_pop.html",
			width:"70%"
			});		
})


$("body").on("click","#ajax_sign_in",function(e){
	console.log("clicked sign in");
	var review_data = $("#sign_in_form").serialize();
			$.ajax({
		    url: "ajax_sign_in.php",
		    method: "POST",
		    data: review_data,
		    dataType: "json",
		    beforeSend:function(){

		      $(".working").css("display","block");
		    }, 
		    success: function(data){
				$(".working").css("display","none");
				console.log(data.status);
					if(data.status=='success'){
						$.colorbox.close();
						$("#logged_in").val("Yes");
						$( "#submit_review" ).trigger( "click" )
				}
		    },
		     error:function(){
		      $(".working").css("display","none");
		      }
		    });

	e.preventDefault();
})

$("body").on("click","#ajax_sign_up",function(e){
	console.log("clicked sign up");
	var review_data = $("#sign_up_form").serialize();

			$.ajax({
		    url: "ajax_sign_up.php",
		    method: "POST",
		    data: review_data,
		    dataType: "json",
		    beforeSend:function(){

		      $(".working").css("display","block");
		    }, 
		    success: function(data){
				$(".working").css("display","none");
				console.log(data.status);
					if(data.status=='success'){
						$.colorbox.close();
						$("#logged_in").val("Yes");
						$( "#submit_review" ).trigger( "click" )
				}
		    },
		     error:function(){
		      $(".working").css("display","none");
		      }
		    });

	e.preventDefault();
})



$("#lightSlider").lightSlider({
                loop:true,
                item:3,
                keyPress:true,
                slideMargin:0,
                pager:false,
                gallery:true,
                autoWidth:true,
                freeMove:true,
                responsive : [
					           
					            {
					                breakpoint:500,
					                settings: {
					                    item:2,
					                    slideMove:1
					                  }
					            },
					            {
					                breakpoint:400,
					                settings: {
					                    item:1,
					                    slideMove:1
					                  }
					            }
					        ],
				onSliderLoad: function(el) {
			            el.lightGallery({
			                selector: '#lightSlider .lslide'
			            });
        		}
            });


	</script>
	<script type="text/javascript" src="scripts/lightbox/js/lightbox.js"></script>
	<script type="text/javascript" src="js/jquery.colorbox.js"></script>

<script src="https://cdn.auth0.com/js/lock/10.0/lock.min.js"></script>
<script type="text/javascript">
  var lock = new Auth0Lock('gK02v3NYIGziS7VfyEY9qnFwV4qID8Z3', 'syntextech.auth0.com', {
    auth: {
      redirectUrl: 'http://localhost/ftf/authentication/authenticate.php',
      responseType: 'code',
      params: {
        scope: 'openid email' // Learn about scopes: https://auth0.com/docs/scopes
      }
    },
    theme: {
    	logo: '<?php echo SITE_BASE;?>/images/logo.jpg',
    	primaryColor: '#f00'
  	},
  	languageDictionary: {
	    emailInputPlaceholder: "something@youremail.com",
	    title: "Log in"

  	}  
  });
</script>


</div>
</body>
</html>