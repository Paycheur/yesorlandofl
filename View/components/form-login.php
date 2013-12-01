<div id="modalLogin" class="modal fade"  role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">


				<button type="button" class="btn-border-blue bg-pure" data-toggle="collapse" data-target="#signUp">
				  mange your enquiries - Sign up here <i class="icon-angle-down"></i>
				</button>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body padding-bottom-3em">


					<div class="row">


						<div class="col-lg-6">


							<div id="signUp" class="collapse margin-bottom-1em">
								<form class="form-horizontal" id="formRegister" role="form">
									<legend class="form-signin-heading">Sign up </legend>
								  <div class="form-group">

								    <div class="col-lg-12">
								      <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Email">
								    </div>
								  </div>
								  <div class="form-group">
								    <div class="col-lg-12">
								      <input type="name" class="form-control" id="registerName" name="name" placeholder="Name">
								    </div>
								  </div>

								  <div class="form-group">
								    <div class="col-lg-12">
									    <input type="password" class="form-control" id="registerPassword" name="mdp" placeholder="Password">
									  </div>
								   	</div>

								       <button class="btn btn-primary" type="submit" id="sendFormRegister">Register </button>
								   </form>
							</div>


							<div>
								<legend class="form-signin-heading">Connect with facebook</legend>
								<a href="/page_login.php?EX=doLoginWithFacebook" class="btn btn-default bg-fb white"><i class="icon-facebook"></i> sign in / sign up </a>
							</div>










						</div>


						<div class="col-lg-6">
					       <form class="form-horizontal" id="loginForm" role="form">

					       	<legend class="form-signin-heading">login </legend>

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
							  <button class="btn btn-primary" type="submit" id="sendFormLogin">Sign in </button>

							  </form>

						</div>

					</div>








			</div>
			<div class="modal-footer">



				<button class="btn hover bg-gray-hover " data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
	</div>
	</div><!-- model -->