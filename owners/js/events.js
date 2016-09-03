$(function(){

 	// Load Map
	$("#loadMap").on("click",function(e){
				codeAddress();
				e.preventDefault();
	})

	//Submit Listing
	$("#addListing").on("click",function(e){
		e.preventDefault();
		var data_validation = true;
			$("input[required]").each(function(){
			var required_length = $(this).data("min-length");
			if($(this).val().length < required_length){
				$(this).next('p').addClass("error");
				data_validation = false;
			}else{
				$(this).next('p').removeClass("error");
			}
		});

		if(data_validation){
			var data = $("#listing_form").serialize();
			addListing(data,function(result){
				window.location.href = "managepictures.php?id="+result.listing_id;
			});
		}
		else{

		}		
	});

		//Submit Listing
	$("#updateListing").on("click",function(e){
		e.preventDefault();
		var data_validation = true;
			$("input[required]").each(function(){
			var required_length = $(this).data("min-length");
			if($(this).val().length < required_length){
				$(this).next('p').addClass("error");
				data_validation = false;
			}else{
				$(this).next('p').removeClass("error");
			}
		});

		if(data_validation){
			var data = $("#listing_form").serialize();
			updateListing(data,function(result){
				console.log(result);
				$("#listingUpdatealert .msg").remove();
          		$("#listingUpdatealert").append("<strong class='msg'>Address Updated</strong>").fadeIn(1500);
			});
		}
		else{

		}		
	});


	// Get Current Location Event
	$('#useCurrentLocation').on("click",function(e){

		e.preventDefault();
		codeCurrentLocation();
	})

	// Opt in for manual Address
	$("#typeAddress").on("click",function(e){
		$(this).addClass("btn-primary");
		$("#useCurrentLocation").removeClass("btn-primary");
		$("#location_box").addClass("hidden").empty();
		$("#address_box").removeClass("hidden");
		e.preventDefault();
	})


	$('.alert .close').on('click', function(e) {
	    $(this).parent().hide();
	});

});
