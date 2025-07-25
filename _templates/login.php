<?php

$login = true;
//Session::set('mode', 'web');
//Session::set('test', 'websdkjfnsdkjfn');
if (isset($_POST['email_address']) and isset($_POST['password'])) {
    $email_address = $_POST['email_address'];
    $password = $_POST['password'];

    $result = UserSession::authenticate($email_address, $password);
    $login = false;
}
if (!$login) {
    if ($result) {
		 $should_redirect = Session::get('_redirect');
        $redirect_to = get_config('base_path');
        if (isset($should_redirect)) {
            $redirect_to = $should_redirect;
		Session::set('_redirect', false);
		}

        ?>
<script>
	window.location.href = "<?=$redirect_to?>"
</script>

<?php
    } else {
        ?>
<main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Login Failed</h1>
		<p class="lead">This example is a quick exercise to do basic login with html forms.</p>
	</div>
</main>
<?php
    }
} else {
    ?>


<main class="form-signin">
	<form method="post" action="login.php">
		<img class="mb-4" src="https://git.selfmade.ninja/uploads/-/system/appearance/logo/1/Logo_Dark.png" alt=""
			height="50">
		<input name="fingerprint" type="hidden" id="fingerprint" value="">
		<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

		<div class="form-floating">
			<input name="email_address" type="text" class="form-control" id="floatingInput"
				placeholder="name@example.com">
			<label for="floatingInput">Email address or Username</label>
		</div>
		<div class="form-floating">
			<input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
			<label for="floatingPassword">Password</label>
		</div>

		<div class="checkbox mb-3">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="w-100 btn btn-lg btn-primary hvr-grow-rotate" type="submit">Sign in</button>
	</form>
</main>

<?php
}
?>