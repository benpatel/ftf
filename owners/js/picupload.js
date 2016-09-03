$(function(){

$("#uploadTrigger").click(function(){
    $("#fileToUpload").click();
});


 $("#fileToUpload").change(function(){

        var $fileUpload = $("input[type='file']");
        var current_image_count = parseInt($fileUpload.get(0).files.length);
        var id= $("#list_id").text();
        if(($(".uploaded_image").length+current_image_count) < 17){
            if(current_image_count > 5){
                      $("#imgUploadAlert .msg").remove();
                      $("#imgUploadAlert").append("<strong  class='msg'>You can only upload a maximum of 5 files at a time</strong>").fadeIn(1500);
                      setTimeout(function(){
                        $("#imgUploadAlert").fadeOut(2000)
                      },5000)
              }
            else{
              $("#uploadTrigger img").attr("src","images/loading_spinner.gif");
              setTimeout(function(){
              var fd = new FormData(document.querySelector("#file_upload"));
              console.log(fd);
              var upload_request =  $.ajax({
              url: "upload.php",
              type: "POST",
              data:fd,
              //data: {"images":fd,"id":id},
              processData: false,  // tell jQuery not to process the data
              contentType: false,  // tell jQuery not to set contentType
              dataType: "json"
              });

              upload_request.done(function( data ) {
                 for(var a=0; a<data.length; a++){
                  var image_div = $('<div  class="uploaded_image"><p class="image_no"></p><img src="uploads/'+data[a]+'" class="prd_images" /><p class="delate_image"><span>Delete</span></p></div>');
                  $("#uploaded_image_box").prepend(image_div);
                  //$("#product_images").append($('<input type="hidden" name="images[]" value="'+data[a]+'">'))
                 }
                 $(".image_Error_Display").text('');
                 $("#uploadTrigger img").attr("src","images/add_image.jpg");
                 sort_pics();
               });
              $("#fileToUpload").val('');
              return false;
              }, 1000);
            }
        }else{
          $("#imgUploadAlert .msg").remove();
          $("#imgUploadAlert").append("<strong class='msg'>Free Account allows only 15 Images, upgrade to primium for image space</strong>").fadeIn(1500);
           setTimeout(function(){
            $("#imgUploadAlert").fadeOut(2000)
           },5000)
        }

    });



});