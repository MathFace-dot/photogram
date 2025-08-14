
<?php
require 'vendor/autoload.php';
include 'libs/load.php';
// use Carbon\Carbon;
//     $now = Carbon::now();
//     echo $now; // e.g., 2025-08-11 07:52:00

//       $uploaded_time = Carbon::parse($p->getUploadedTime());
// 			     $uploaded_time_str = $uploaded_time->diffForHumans();
    


// Assuming Post::getAllPosts() returns an array of Post objects or arrays
$posts = Post::getAllPosts();
use Carbon\Carbon;

foreach ($posts as $post) {
    // If $post is an array, and index 15 is the ID
    $p = new Post($post["id"]); 
    // print($p->getImageUri());
    // print($p->getUploadedTime());

    // If getUploadedTime() returns a datetime string
    $uploaded_time = Carbon::parse($p->getUploadedTime());
    $uploaded_time_str = $uploaded_time->diffForHumans();

    print($p->getOwner());

    print_r($uploaded_time_str);
}
    
    ?>