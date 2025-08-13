  <pre>
  <?php
  include 'libs/load.php';
  require 'vendor/autoload.php';

            //     $posts = Post::getAllPosts();
			// 	use Carbon\Carbon;
            // foreach ($posts as $post) {
            // $p = new Post(14);
            // $uploaded_time = Carbon::parse($p->getUploadedTime());
            // $uploaded_time_str = $uploaded_time->diffForHumans();
            // print($p->getImageUri());
            // print($uploaded_time_str);
            //}
            // $p = new Post(14);

            // print($p->uploadTime());
            // print_r($p->getAllPosts());

            $posts = Post::getAllPosts();
            foreach ($posts as $post) {
                $p = new Post($post['id']);
            
           // $p->getImageUri();
                
            }
            //$p = new Post(14);

           // print($p->uploadTime());
            // print_r($p->getAllPosts());


?>
</pre