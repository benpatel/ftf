<?php
//$check_log_in="YES";
if(isset($_REQUEST['id'])){
	$list_id=$_REQUEST['id'];
}else{
	header("location:index.php");
}
if(isset($_REQUEST['addr'])){
	$addr = $_REQUEST['addr'];
}else{
	$addr='';
}
$page="review";
?>
<?php 
include_once("header.php"); 
$comment ='';
$rating=0;

if($logged_in){

	$user_logged_in="Yes";
	$sql_r = "select * from reviews where listing_id={$list_id} and user_id={$_SESSION['user_info']['id']}"; 

	$result_set_r = $dtb->query($sql_r);
	if($result_set_r->num_rows > 0){
		while( $result_r = $result_set_r->fetch_object()){
			$comment = $result_r->comment;
			$rating = ($result_r->rating*10);
		}
		$action_id="update_review";
		$action_id_text ="Update";
	}
	else{
		$action_id = 'submit_review';
		$action_id_text = "Submit";
	}


}
else{
	$user_logged_in="No";
	$action_id = 'submit_review';
	$action_id_text = "Sign In & Submit";
}

$sql = "select * from listing where id={$list_id}";
$result_set = $dtb->query($sql);

while( $result = $result_set->fetch_object()){
?>
<div class="container" id="location_section">

<div class="col-sm-12">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="alert alert-danger" role="alert" style="display:none"></div>
		</div>
</div>		
<div class="col-sm-8">
<div class="col-sm-12 clearfix">
<p class="listing_image "><img class="img-rounded pull-left" src="<?php echo SITE_BASE; ?>scripts/image.php?width=70&height=70&cropratio=1:1&image=<?php echo SITE_BASE; ?>location_images/1.jpg"   data-image-id="1" ></p>
<p><a href="location.php?id=<?php echo $list_id; ?>"><?php echo $result->name; ?></a></p>
<p><?php echo $result->address_1; ?></p>
<p><?php echo $result->city.",".$result->state."-".$result->zip; ?></p>
</div>


		<form class="form-vertical" method="post" action="add_review.php" id="submit_review_form">
			<input type="hidden" id="list_id" name="id" value="<?php echo $list_id; ?>">
			<input type="hidden" id="old_rating" name="old_rating" value="<?php echo $rating ; ?>">
			<input type="hidden" id="action" name="action" value="<?php echo $action_id; ?>">
			<input type="hidden" id="rating" name="rating" value="<?php echo $rating/10; ?>">
			<input type="hidden" id="logged_in" name="logged_in" value="<?php echo $user_logged_in; ?>">
			<div class="form-group clearfix padding_10_0">
			    <label for="fname" class="col-sm-12 control-label">Rating</label>
			    <div class="col-sm-12">
			      <div id="rating_box">
			      	<ul class="clearfix brating-<?php echo $rating; ?>">
			      		<li data-rating="10">
			      			<input type="radio" name="rating" value="1">
			      			<label data-rating="10"></label>
			      		</li>
			      		<li data-rating="20">
			      			<input type="radio" name="rating" value="2">
			      			<label  data-rating="20"></label>
			      		</li>
			      		<li data-rating="30">
			      			<input type="radio" name="rating" value="3">
			      			<label  data-rating="30"></label>
			      		</li>
			      		<li  data-rating="40">
			      			<input type="radio" name="rating" value="4">
			      			<label  data-rating="40"></label>
			      		</li>
			      		<li data-rating="50">
			      			<input type="radio" name="rating" value="5">
			      			<label  data-rating="50"></label>
			      		</li>
			      	</ul>

			      </div>
			    </div>
			</div>
			<div class="form-group clearfix padding_10_0">
			    <label for="fname" class="col-sm-12 control-label">Review detail</label>
			    <div class="col-sm-12">
			      <textarea id="listing_review_box" rows="10" name="comment" class="col-sm-12 form-control"><?php echo $comment; ?></textarea>
			      <p class="error_block">Please Eter Detail Name</p>
			    </div>
			</div>
			<div class="form-group clearfix">
			    <div class="col-sm-12">
<?php if($logged_in){  ?>
			      <button type="submit" id="<?php echo $action_id; ?>" class="review_submit_button btn btn-default"><?php echo $action_id_text; ?></button>

<?php }
else{

	?>
			       <p class="btn btn-default" onclick="lock.show();">Sign In & Submit</p>
			      <?php } ?>
			    </div>
			</div>
		</form>

</div>


<div class="col-sm-4">
	<div class="row">
	<p><-- Recent Reviews here --></p>
	</div>
</div>
</div>
<?php
}
?>

<script type="text/javascript">
	
	$("#rating_box input[type='radio']").val($("#old_rating").val()/10);
	var start_posY = -488;
	$("#rating_box ul li label").on("mouseover",function(){

		//console.log($(this).data("rating"));
		var posY = ($(this).data("rating"));
		
		//console.log(posY);
		$("#rating_box ul").removeClass();
		$("#rating_box ul").addClass("clearfix brating-"+posY);
	})

	$("#rating_box ul li label").on("mouseout",function(){

		
		var posY = ($("input[type='radio']").val()*10);

		$("#rating_box ul").removeClass();
		$("#rating_box ul").addClass("clearfix brating-"+posY);
	
	})

	$("#rating_box ul li label").on("click",function(){
		$("li[data-rating='"+$(this).data("rating")+"']").find("input[type='radio']").prop("checked", true)
		$("input[type='radio']").val($(this).data("rating")/10);
	})

	$("#submit_review").on("click",function(e){
		var review_data = $("#submit_review_form").serialize();
	if($("#logged_in").val()=="Yes"){

		$.ajax({
			    url: "add_review.php",
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

							var id = $("#list_id").val();
							window.location = 'location.php?id='+id;
					}
			    },
			     error:function(){
			      $(".working").css("display","none");
			      }
			    });
		}
	else{
		$.colorbox({
			href:"sign_in_pop.html",
			width:"70%"
			});
		}
		e.preventDefault();
	})

	$("#update_review").on("click",function(e){
	var review_data = $("#submit_review_form").serialize();
		$.ajax({
		    url: "add_review.php",
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

						var id = $("#list_id").val();
						window.location = 'location.php?id='+id;
				}
		    },
		     error:function(){
		      $(".working").css("display","none");
		      }
		    });

	e.preventDefault();
})
</script>
<?php include_once("footer.php"); ?>