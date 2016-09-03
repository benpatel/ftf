function addListing (data,callback){
	$.ajax({
              //url: '/nycbusiness/comparision.html',
			  url: 'actions/addListing.php',
              type: "post",
              data: data, // this is data object that we build few lines above
              dataType:'json',
              success: function(jsondata){
              		callback(jsondata)
              }
          });
};

function updateListing (data,callback){
	$.ajax({
              //url: '/nycbusiness/comparision.html',
			  url: 'actions/updateListing.php',
              type: "post",
              data: data, // this is data object that we build few lines above
              dataType:'json',
              success: function(jsondata){
              		callback(jsondata)
              }
          });
};