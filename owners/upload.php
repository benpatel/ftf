<?php include_once("../includes/initialize.php");

$target_dir = "uploads/";
$uploaded_files =array();
$id = $_POST['list_id'];
$img_string = '';
$separator=',';
/*echo "<pre>";
print_r($_FILES);*/

$sqlm = "select images from listing where id={$id}";
            $result_setm = $dtb->query($sqlm);
            while( $resultm = $result_setm->fetch_object()){
                $img_string = $resultm->images;
            }

if($img_string=='-'){
    $img_string='';
}

for($x=0; $x<count($_FILES["fileToUpload"]["name"]); $x++){
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$x]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$target_file = date("Ymds").uniqid().".".$imageFileType;
$target_path = $target_dir.$target_file ;
$uploadOk = 1;


// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"][$x]);
    //echo image_type_to_extension($check["mime"])."<-->";
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/
// Check if file already exists
if (file_exists($target_path)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$x], $target_path)) {
       // echo "The file ". basename( $_FILES["fileToUpload"]["name"][$x]). " has been uploaded.";
        $uploaded_files[$x]=$target_file;
    } else {
       
    }
}

}


$total_img = count($uploaded_files);

for($a=0; $a<$total_img; $a++){

    $img_string.=$uploaded_files[$a].$separator;
}

$sql = "UPDATE listing SET images = '{$img_string}' WHERE id = {$id}";

if($dtb->query($sql)){
    echo json_encode($uploaded_files);
}
else{
    echo '{"status":"error"}';
}
?>