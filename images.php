<?php

include 'libs/load.php';


$upload_path = get_config('upload_path'); // This should be the path where images are uploaded from home path
$fname = $_GET['name'];
$image_path = $upload_path . $fname;
//print("Image path: $image_path\n"); // Pastedimage.png

if (is_file($image_path)) {
    //TODO: Lot of security things to think about here 
    // url sample http://localhost:8080/images.php?name=Pastedimage.png
    // url sample by user http://localhost:8080/images.php?name=../../../../etc/passwd
   //print("File exists, serving it.\n");
   //.htaccess file should be used to prevent direct access to this file
   // http://photogram.project.com/images/6108a5b09ab85be891e598ead93da054.png












































































































































































   
    header("Content-Type:".mime_content_type($image_path));
    header("Content-Length:".filesize($image_path));
    echo file_get_contents($image_path);

}else{
    echo "File not found.";
}
?>



