<?php

include 'libs/load.php';

$upload_path = rtrim(get_config('upload_path'), '/') . '/';

// Validate and sanitize the file name
$fname = basename($_GET['name']); // removes directory paths
$image_path = $upload_path . $fname;

// Check if the file exists and is a regular file
if (is_file($image_path) && file_exists($image_path)) {
    // Set appropriate headers
    $mime = mime_content_type($image_path);
    $size = filesize($image_path);
    $mtime = filemtime($image_path);

    header("Content-Type: $mime");
    header("Content-Length: $size");
    header('Cache-Control: max-age=' . (60 * 60 * 24 * 365));
    header('Expires: ' . gmdate(DATE_RFC1123, time() + 60 * 60 * 24 * 365));
    header('Last-Modified: ' . gmdate(DATE_RFC1123, $mtime));
    header_remove('Pragma');

    // Output the file
    readfile($image_path);
    exit;
} else {
    http_response_code(404);
    echo "File not found.";
}
?>