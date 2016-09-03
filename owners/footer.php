	</div>

<script src="js/action.js"></script>
<script src="js/events.js"></script>
<script src="js/map.js"></script>
<script src="js/picupload.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
	 
   $( "#uploaded_image_box" ).sortable({
      update: function( event, ui ) {
        console.log("dragged");
        sort_pics();
      }
    });


 function sort_pics(){
  $("#uploaded_image_box .uploaded_image").each(function(index){
    $(this).find('.image_no').text(index+1);
  })
  }
  $('.review_read_more').on("click",function(){
    console.log("clicked");
    console.log( $(this).parent('.my_reviews_detail'));
    $(this).parent('.my_reviews_detail').css({
                                              "overflow":"visible",
                                              "max-height":""
                                            });
    $(this).parent('.my_reviews_detail').find('.extra_comment').css("display","static");
  })

</script>

</body>
</html>