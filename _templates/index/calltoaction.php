
<?php

if (isset($_POST['post_text']) && isset($_FILES['post_image'])) {
    $image_tmp = $_FILES['post_image']['tmp_name'];
    $text = $_POST['post_text'];
    Post::registerPost($text, $image_tmp);
}?>

<!-- <section class="py-5 text-center container">
    <div class="row py-lg-5">
        <form method="post" action="sg.php" enctype="multipart/form-data">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">What are you upto,
					<?//Session::getUser()->getUsername()?>?</h1>


            <h1 class="fw-light">What are you upto ?</h1>
            <p class="lead text-muted">Share a photo that talks about it.</p>
            <textarea id="post_text" name="post_text" class="form-control" placeholder="What are you upto?" rows="3"></textarea>
				<div class="input-group mb-3">
					<input type="file" class="form-control" name="post_image" id="inputGroupFile02">
					<label class="input-group-text" for="inputGroupFile02">Upload</label>
				</div>

            <p>
                <button class="btn btn-success my-2" type="submit">Share memory</button>
                <a href="#" class="btn btn-primary my-2">upload</a>
                <a href="#" class="btn btn-secondary my-2">clear</a>
            </p>
        </div>
        </form>
    </div>
</section> -->

<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <form method="post" action="/" enctype="multipart/form-data">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">
          What are you up to, <?= Session::getUser()->getUsername() ?>?
        </h1>

        <p class="lead text-muted">Share a photo that talks about it.</p>

        <!-- Text area for post -->
        <textarea id="post_text" name="post_text" class="form-control mb-3" placeholder="What are you up to?" rows="3"></textarea>

        <!-- File input with label -->
        <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupFile02">Upload</label>
          <input type="file" class="form-control" name="post_image" id="inputGroupFile02" accept="image/*">
        </div>

        <!-- Form buttons -->
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <!-- Submit button -->
          <button class="btn btn-success" type="submit">Share Memory</button>

          <!-- Reset button to clear form inputs -->
          <button class="btn btn-secondary" type="reset">Clear</button>
        </div>
      </div>
    </form>
  </div>
</section>