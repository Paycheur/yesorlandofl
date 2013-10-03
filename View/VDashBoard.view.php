<?php
class VDashBoard
{

	public function __construct() {return;}
		
	public function __destruct() {return;}
	
	  
	public function homeDashboard($_value)
	{
		$member = $_value['member'];
		?>
		  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">The Portfolio Group</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link"><?=$_SESSION['user']['name']?></a> <a href="/dashboard.php?EX=logout">[Log out]</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Dashboard</a></li>
              <li><a href="#about">Website</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Sidebar</li>
              <li class="active"><a href="#">Favorites</a></li>
              <li><a href="#">Reportes</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="nav-header">Sidebar</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h2>Hello, <?=$_SESSION['user']['name']?></h2> <br>
           <form method="post" action="" >
           		 <div class="span3">
			    <input type="text" name="name" value="<?=$member->getName();?>" class="input-block-level" placeholder="Name"/>

			    
			    <input type="text" name="email" value="<?=$member->getEmail()?>" class="input-block-level" placeholder="Email"/>

			    </div>
			  <div class="span3">
			    <input type="text" name="company" value="<?=$member->getCompany()?>" class="input-block-level" placeholder="Company"/>

			    
			    <input type="text" name="occupation" value="<?=$member->getOccupation()?>" class="input-block-level" placeholder="Occupation"/>

			    </div>
			    
			     <div class="span3">
			    <input type="text" name="address" value="<?=$member->getAddress()?>" class="input-block-level" placeholder="Address"/>

			    
			    
			    <input type="text" name="phone" value="<?=$member->getPhone() ?>" class="input-block-level" placeholder="Phone"/>

			    </div>
			     <div class="span3">
			    <input type="password" name="mdp" value="" class="input-block-level" placeholder="Password"/>

			    
			    <input type="password" name="check_mdp" value="" class="input-block-level" placeholder="Password again"/>

			     </div>
			 	<br />
			    <input type="submit" class="btn btn-large btn-primary" value="Save changes" />
			</form>
          </div>
          <div class="row-fluid">
            <h2 class="span12">Recently visited</h2>
          </div>
          <div class="row-fluid">
            <div class="span4">
              <img src="http://placehold.it/500x200&text= Property Img" alt="">
              <h4>property #01</h4>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <img src="http://placehold.it/500x200&text= Property Img" alt="">
              <h4>property #02</h4>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <img src="http://placehold.it/500x200&text= Property Img" alt="">
              <h4>property #03</h4>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
            <hr class="span12">
          </div>
          <div class="row-fluid">
            <h2 class="span12">Recommanded</h2>
          </div>
          <div class="row-fluid">
            <div class="span4">
              <img src="http://placehold.it/500x200&text= Property Img" alt="">
              <h4>property #01</h4>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <img src="http://placehold.it/500x200&text= Property Img" alt="">
              <h4>property #02</h4>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <img src="http://placehold.it/500x200&text= Property Img" alt="">
              <h4>property #03</h4>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->




        </div><!--/span-->
      </div><!--/row-->

		
		<?php
	}
}