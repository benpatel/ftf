<?php
if(isset($_REQUEST['addr'])){
	$addr = $_REQUEST['addr'];
}else{
	$addr='';
}
$page='index';
?>
<?php include_once("header.php"); ?>

<div class=""  id="location_section" style="margin:0px;">
<div id="index_container">

</div>

</div>

<?php include_once("footer.php"); ?>