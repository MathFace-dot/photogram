<?php
include 'libs/load.php';

$image_tmp = $_FILES['post_image']['tmp_name'];
$text = $_POST['post_text'];
//print("Image tmp: $image_tmp\n");

$result = Post::registerPost($text, $image_tmp);

print("Result: $result\n");

?>
