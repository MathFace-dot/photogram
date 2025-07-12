<?php

include 'libs/load.php';


$upload_path = get_config('upload_path'); // This should be the path where images are uploaded from home path
$fname = $_GET['name'];
$image_path = $upload_path . $fname;
//print("Image path: $image_path\n"); // Pastedimage.png

if (is_file($image_path)) {
    //TODO: Lot of security things to think about here
   // print("File exists, serving it.\n");
    header("Content-Type:".mime_content_type($image_path));
    header("Content-Length:".filesize($image_path));
    echo file_get_contents($image_path);

}else{
    echo "File not found.";
}
?>



