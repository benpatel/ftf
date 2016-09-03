var geocoder;
var map;
var gmarkers = [];

// Initialize Google Map
function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
      zoom: 17,
      maxZoom:18,
      minZoom:14,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      draggable:false
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var tmp_lat = parseFloat($("#map_lat").val());
    var tmp_lng = parseFloat($("#map_lng").val());

    var options={location:{lat: tmp_lat, lng: tmp_lng}};
    generateMap(options,true);
}

//Get Map based on Address
function codeAddress() {
    var address = $('#addressInput').val()+' ,'+$('#city').val()+' ,'+$('#state').val()+' '+$('#zip').val();
    var option={"address":address}
    generateMap(option,true);
}

// Get Map based on Current Location
function codeCurrentLocation() {

	  if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function(position) {
		var option={location:{lat: position.coords.latitude, lng: position.coords.longitude}};
			generateMap(option,true)
		}, 
		function() {
		      handleLocationError(true);
		      console.log("problem is here");
		      alert("Location Error");
		
		    });
		}else{
			handleLocationError(true);
			alert("Location Error");
		    console.log("problem is here");
		}
}

// Handle Disable Location Error
function handleLocationError(browserHasGeolocation) {
	 	console.log(browserHasGeolocation);
	 	load(0);
}

// Marker Movement Handler
function maekrMoved(lat,lng){
			var option={location:{lat: lat, lng: lng}};


		  generateMap(option,false)
}

// Remove All Markers
function removeMarkers(){
    for(i=0; i<gmarkers.length; i++){
        gmarkers[i].setMap(null);
    }
}

// Generate Map based on Provided Data
function generateMap(options,movedAction){
	    geocoder.geocode( options, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      	removeMarkers();
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
        	draggable:true
	        });
        gmarkers.push(marker);
        marker.addListener('dragend', function(){
        	maekrMoved(this.getPosition().lat(),this.getPosition().lng())
        });
        
        $("#map_lat").val(results[0].geometry.location.lat());
        $("#map_lng").val(results[0].geometry.location.lng());
       
        var formatted_address = results[0].formatted_address;
        var res= formatted_address.split(',');

       	var address1=res[0].trim();
       	var city=res[1].trim();

       	var state_zip = (res[(res.length-2)].trim()).split(" ");
       	var state = state_zip[0].trim();
       	var zip = state_zip[1].trim();

        if(movedAction){
       	$("#addressInput").val(address1);
       	$("#city").val(city);
       	$("#state").val(state);
       	$("#zip").val(zip);
       	$("#addListing").removeClass("disabled");
        $("#updateListing").removeClass("disabled");
        }
      } else {
        
      }
    });
}