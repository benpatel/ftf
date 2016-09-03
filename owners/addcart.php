<?php include_once("../includes/initialize.php"); 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script src="../functions.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



</head>
<body>
<div class="container">
<div class="row">

</div>
<div class="row">
	<div class="col-sm-7">
	<form class="form-horizontal">
	  <div class="form-group">
	    <label for="CartName" class="col-sm-2 control-label">Cart Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="CartName" placeholder="Cart Name">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="add1" class="col-sm-2 control-label">Address</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="add1" placeholder="Address">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="landMark" class="col-sm-2 control-label">Land mark</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="landMark" placeholder="Land Mark">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="city" class="col-sm-2 control-label">City</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="city" placeholder="City">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="state" class="col-sm-2 control-label">State</label>
	    <div class="col-sm-10">
	      <select class="form-control" id="landMark">
	      	<option>  -- Select State -- </option>
	      	<option>New York</option>
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="zip" class="col-sm-2 control-label">Zip</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="zip" placeholder="Zip">
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <div class="checkbox">
	        <label>
	          <input type="checkbox"> Remember me
	        </label>
	      </div>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default">Sign in</button>
	    </div>
	  </div>
	</form>
	</div>

	<div class="col-sm-5">
	</div>
</div>	
</div>
</body>
</html>