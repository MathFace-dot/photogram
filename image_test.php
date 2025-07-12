<?php

include 'libs/load.php';


// Build the full path to the image
$image_path = $_SERVER['DOCUMENT_ROOT'] . '/photogram_uploads/Pastedimage.png';

// Optional: For debugging
// print_r($image_path);

if (is_file($image_path)) {
    // Set the correct headers so the browser knows it's an image
    header("Content-Type: " . mime_content_type($image_path));
    header("Content-Length: " . filesize($image_path));

    // Output the image content
    echo file_get_contents($image_path);
    exit;
} 

//..........................Note.. things to do....................................
// Folder Permissions: The web server (Apache/Nginx) user (www-data on Ubuntu) needs permission to read the file:

// bash
// Copy
// Edit
// chmod +r /var/www/photogram/photogram_uploads/Pastedimage.png

?>