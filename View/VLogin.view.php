<?php
class VLogin
{

	public function __construct() {return;}

	public function __destruct() {return;}


	public function homeLogin($_value)
	{
		?>
		  <form class="form-signin" action="" method="POST">
        <h2>Register</h2>
        <a href="#myModal" data-toggle="modal">Click here to register</a>
        <hr>
        <h2 class="form-signin-heading">Please log in</h2>
        <input type="text" class="input-block-level" placeholder="Email address" name="email" value="">
        <input type="password" class="input-block-level" placeholder="Password" name="mdp" value="">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-secondary btn-large" type="submit">Sign in</button>
        <hr>
        <a href="login.php?EX=doLoginWithFacebook" class="btn btn-large btn-primary" type="submit">Sign in with Facebook account</a>


      </form>

		<?php
	}
}