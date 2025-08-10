<div class="album py-5 bg-light">
    <div class="container">
       
        <div class="row">
        <!-- <div class="row" data-masonry='{"percentPosition": true }'> -->
            
            <?php
            //     $posts = Post::getAllPosts();
			// 	use Carbon\Carbon;
            // foreach ($posts as $post) {
            // $p = new Post($post['id']);
            // $uploaded_time = Carbon::parse($p->getUploadedTime());
            // $uploaded_time_str = $uploaded_time->diffForHumans();
                ?>

            <div class="col -lg-4 col-md-4">
                <div class="card ">
                        <img class="bd-placeholder-img card-img-top" src="<?//$p->getImageUri()?>">

                    <div class="card-body">
                        <p class="card-text"><?//$p->getPostText()?>This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Like</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                                <?php
								// $user = Session::getUser();
								// if (Session::isOwnerOf($p->getOwner())) {
								?>
								<button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
								<?//}?>

                            </div>
                            <small class="text-muted">9 min<?//$uploaded_time_str?></small>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    	<?php
				//}
				?>

    </div>
</div>