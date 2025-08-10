<pre>
<?php
include 'libs/load.php';

$p = new Post(14);
print($p->uploadTime());
print_r($p->getAllPosts());

// This file is used to test the Post class functionality
// It includes the Post class and creates an instance of it
// to test the upload time and fetching all posts.
// The output will show the upload time of the post with ID 14
// and a list of all posts in the database.
// Make sure to run this file in a PHP environment with the necessary database setup.  
?>


</pre>