    var map;
    var markers = [];
    var infoWindow;
    var locationSelect;
    var radius = 15;
    var lat = 40.753073;
    var lng = -73.995534;
    var Mapdata={};
    var no_listing = 10;
    var result_listing_count=0;

// Load intial Map for user location
function load(position) {
   

  var address = $(".addressInput").val();
  var geocoder = new google.maps.Geocoder();
  if(address!=''){
  var option={address:address};
  }else{
    if(position){
      var option={location:{lat: position.coords.latitude, lng: position.coords.longitude}};
    }
  }

  geocoder.geocode(option, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        
         map = new google.maps.Map(document.getElementById("map"), {
            center: results[0].geometry.location,
            zoom: 12,
            mapTypeId: 'roadmap',
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
          });

          infoWindow = new google.maps.InfoWindow();
          var center= new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
          searchLocationsNear(center,1);

    } else {
      //alert(address + ' not found');
    }
  });
     //current_loc = new google.maps.LatLng(lat, lng);
}

function not_load(position) {
    console.log("not Loaded")
     map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(40.753073, -73.995534),
             zoom: 17,
        mapTypeId: 'roadmap',
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
      });

      infoWindow = new google.maps.InfoWindow();

      locationSelect = document.getElementById("locationSelect");
      locationSelect.onchange = function() {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        if (markerNum != "none"){
          google.maps.event.trigger(markers[markerNum], 'click');
        }
      };
      var center= new google.maps.LatLng(40.753073,  -73.995534);
        searchLocationsNear(center,1);
}   

function clearLocations() {
     infoWindow.close();
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
     }
     markers.length = 0;

     locationSelect.innerHTML = "";
     var option = document.createElement("option");
     option.value = "none";
     option.innerHTML = "See all results:";
     locationSelect.appendChild(option);
}

function createMarker(latlng, data) {
      var html = "<p><b>" + data.name + "</b> </br></p>";
      html +="<p></p>";
      html +='<p><img src="location_images/1.jpg" width="180" height="90"/></p>';
      html +="<p></p>";
      html +='<p>'+data.address+', '+data.city+' - '+data.zip+'</p>'
      var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        icon:'http://maps.google.com/mapfiles/marker_green.png',
        labelClass: "g_marker"
      });
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
      markers.push(marker);
}

function createOption(name, distance, num) {
  var option = document.createElement("option");
  option.value = num;
  option.innerHTML = name + "(" + distance.toFixed(1) + ")";
}

function searchLocations(x) {

  // Loading Ajax

  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

    console.log(navigator.userAgent);
 // some code..
  }
  else{

  }
  var address = $(".addressInput").val();

  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({address: address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      searchLocationsNear(results[0].geometry.location,x);
    } else {
      //alert(address + ' not found');
    }
  });
}

function createListing(data,i){

  console.log(data);

        var listing_rating=0;
        if((data.reviews*1)>0){
        listing_rating = (data.rating/data.reviews);
        listing_rating = (Math.floor(listing_rating * 2) / 2)*10;
        }

      var odd_even_class ='row_odd';
      if(i%2==0){
        var odd_even_class ='row_even';
      }

        console.log(listing_rating);
  var listing_box = $('<div class="clearfix single_listing row '+odd_even_class+'">'+
    '<div class="listing_image" >'+
        '<a href="location.php?id='+data.id+'">'+


      '<img src="http://localhost/ftf/scripts/image.php?width=100&height=100&cropratio=1:1&image=http://localhost/ftf/location_images/1.jpg">'+




        '</a>'+
    '</div>'+      
    '<div class="listing_info" >'+
      '<p class="listing_name"><a href="location.php?id='+data.id+'">'+data.name+'</a></p >'+
      '<p class="listing_review">'+
        '<span class="location_rating rating-'+listing_rating+'"></span>'+
      '</p>'+      
    '</div>'+      
    '<div class="listing_address" >'+
      '<a href="location.php?id='+data.id+'"><p>'+data.address+'</p>'+        
      '<p>'+data.city+'<span class="hidden-xs hidden-sm">, '+data.state+' '+data.zip+'</span></p>'+        
      '<p  class="hidden-xs hidden-sm">(516) 444 9666</p></a>'+      
    '</div> '+   
    '</div>');
  $("#lisings").append(listing_box);
}

function searchLocationsNear(center,x) {
  
    // clearLocations();
    if(!x){
    x=1;
    }
    var radius = $("#distance").val();
    var location_data = {
    'lat': center.lat(),
    'lng':center.lng(),
    'radius':radius,
    'page':x,
    'no_listing':no_listing
    }

    var LatLng  = new google.maps.LatLng(center.lat(), center.lng());
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({location : LatLng}, function(results, status) {
    //console.log(results[0]);
    $("input.addressInput").val(results[0].address_components[2].long_name+", "+results[0].address_components[5].short_name+", "+results[0].address_components[7].short_name);
      console.log(results[0].address_components[2].long_name+", "+results[0].address_components[5].short_name+", "+results[0].address_components[7].short_name);
    });
    

    // radius distance
    var request = $.ajax({
    url: "get_locations.php",
    method: "POST",
    data: location_data,
    dataType: "json",
    beforeSend:function(){

      $(".working").css("display","block");
    }, 
    success: function(data){

       window.Mapdata = data;
       praseNavigation();
    },
     error:function(){
      $(".working").css("display","none");
      }
    });

/*
    request.done(function( data ) {
    window.Mapdata = data;
    praseNavigation();
    });*/


    if(x<=1){
    $(".location_results_pagination .prev").addClass("disabled");
    }else{
    $(".location_results_pagination .prev").data("page",x-1);
    $(".location_results_pagination .prev").removeClass("disabled");
    }

    $(".location_results_pagination .next").data("page",x+1);
}

function praseNavigation(){
  data = window.Mapdata;
  x = data.page;
  result_listing_count = data.count;


  var last_count = x*no_listing;
  if(last_count>=result_listing_count){
  last_count = result_listing_count;
  }
  $(".location_results_pagination .count").text((((x*no_listing)-no_listing)+1)+"-"+last_count);


  //console.log(x*no_listing);
  //console.log(result_listing_count);

  if((x*no_listing) >= result_listing_count){

  $(".location_results_pagination .next").addClass("disabled");   
  }else{
  $(".location_results_pagination .next").removeClass("disabled");
  //console.log("remove");
  }

  $(".location_current_count p").text(result_listing_count+" Found in ");

  if(data.error=="none"){

  var markerNodes = window.Mapdata.location;
  var bounds = new google.maps.LatLngBounds();
  $("#lisings").empty();

  for(i=0; i<markers.length; i++){
  markers[i].setMap(null);
  }

  for (var i = 0; i < markerNodes.length; i++) {
  var name = markerNodes[i].name;
  var address = markerNodes[i].address;
  var distance = parseFloat(markerNodes[i].distance);
  var latlng = new google.maps.LatLng(
  parseFloat(markerNodes[i].lat),
  parseFloat(markerNodes[i].lng));
  createListing(markerNodes[i],i);
  createOption(name, distance, i);
  createMarker(latlng, markerNodes[i]);
  bounds.extend(latlng);
  }


  map.fitBounds(bounds);
  }
  else{
  alert("No Location Found")

  }

  $(".working").css("display","none");
}
