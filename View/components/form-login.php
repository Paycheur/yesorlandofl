<div id="modalLogin" class="modal fade"  role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3>Register/Login</h3>
			</div>
			<div class="modal-body padding-bottom-3em">
			        <h2>Register</h2>
			        <a href="#modalRegister" data-toggle="modal">Click here to register</a>
			        <hr>
			        <h2 class="form-signin-heading">Please log in</h2>
			       <form class="form-horizontal" id="loginForm" role="form">
					  <div class="form-group">
					  	
					    <div class="col-lg-12">
					      <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Email">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-lg-12">
					      <input type="password" class="form-control" id="loginPassword" name="mdp" placeholder="Password">
					    </div>
					  </div>
					  <p class="error"></p>
					  <button class="btn btn-large" type="submit" id="sendFormLogin">Sign in</button>
					  
					  </form>
			        
			        <hr>
			        <a href="/page_login.php?EX=doLoginWithFacebook" class="btn btn-large btn-primary">Sign in with Facebook account</a>
				
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
	</div>
	</div><!-- model -->