<?php
global $page;
if(isset($page['class']))
	$vpage = new $page['class'];	


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
 <title><?=$page['title']?></title>

  		<link rel="stylesheet" media="screen" type="text/css" title="General" href="/Assets/Css/style.css" />
  		<link rel="stylesheet" media="screen" type="text/css" title="General" href="/Assets/Css/default.css" />
  		<link rel="stylesheet" media="screen" type="text/css" title="General" href="/Assets/Css/carousel.css" />
  		<link rel="stylesheet" media="screen" type="text/css" title="General" href="/Assets/Css/bootstrap.min.css" />
  		<?php if(defined('CSS_PAGE'))
  		{?>
		<style type="text/css">@import url('<?=CSS_PAGE?>');</style>
		<?php 
  		}
  		if(defined('JS_PAGE'))
  		{?>
   			<script type="text/javascript" src="<?=JS_PAGE?>"></script>
   		<?php 
  		}?>
</head>

<body>
    	<div class="navbar-wrapper">
	    <div class="container">
	
	      <div class="navbar navbar-inverse navbar-static-top" id="navbar">
	        <nav class="container">
	  	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
	  	      <span class="icon-bar"></span>
	  	      <span class="icon-bar"></span>
	  	      <span class="icon-bar"></span>
	  	    </button>
	          <hgroup class="margin-zero navbar-brand">
	            <h2 class="margin-zero lh-80 "><a class="white serif bold size-16" rel="tab"  href="index.php">THE <span class="italic">PORTFOLIO</span> GROUP</a></h2>
	            <h6 class="margin-zero lh-80">
	              <a class="color-sec  sans  size-14" rel="tab"  href="index.php">International real Estate Experts </a>
	            </h6>
	          </hgroup>
	
	
	          <div class="nav-collapse collapse">
	            <ul class="nav navbar-nav fr-lg">
	              <li><a rel="tab" href="index.php">Home</a></li>
	              <li><a rel="tab" href="about.php">About</a></li>
	              <li><a rel="tab" href="contact.php">Contact</a></li>
	            </ul>
	          </div>
	        </nav>
	      </div>
	
	    </div>
	  </div>
	  
	  
        <div id="container">
            <?php $vpage->$page['method']($page['arg']) ?>
        </div>
        

    
    <!-- FOOTER -->
<footer class="bg-white margin-top-2em">
	<div class="container">
			<section class="row padding-2em">
					<div class="col-lg-6">
						<hgroup >
						  <h2 class="margin-zero lh-80 "><a class=" serif bold size-16" rel="tab"  href="index.php">THE <span class="italic">PORTFOLIO</span> GROUP</a></h2>
						  <h6 class="margin-zero lh-80">
						    <a class="color-sec  sans  size-14" rel="tab"  href="index.php">International real Estate Experts </a>
						  </h6>
						</hgroup>
						<ul class="list-inline padding-1em">
							<li><a href="#" class="btn btn-default"><i class="icon-facebook"></i></a></li>
							<li><a href="#" class="btn btn-default"><i class="icon-twitter"></i> </a></li>
							<li><a href="#" class="btn btn-default"><i class="icon-linkedin"></i> </a></li>
							<li><a href="#" class="btn btn-default"><i class="icon-foursquare"></i></a></li>
							<li><a href="#" class="btn btn-default"><i class="icon-pinterest"></i></a></li>
							<li><a href="#" class="btn btn-default"><i class="icon-google-plus"></i></a></li>
							<li><a href="#" class="btn btn-default"><i class="icon-skype"></i></a></li>
						</ul>
					</div>
				<div class="col-lg-6">
					<h4>
						<i class="icon-phone"></i> 407-697-2176  | <i class="icon-mobile-phone"></i> 407-697-2176
					</h4>
				</div>

			</section>
		<div class="row">
			<aside class="col-lg-3">
				<h4>KEY WORDS </h4>
				<ul class="list-no-bullets">
					<li><a href="#">buy lorem bla bla Orlando</a></li>
					<li><a href="#">Rent lorem bla bla Orlando</a></li>
					<li><a href="#">Rent lorem bla bla Orlando</a></li>
					<li><a href="#">Rent lorem bla bla Orlando</a></li>
					<li><a href="#">Rent lorem bla bla Orlando</a></li>
				</ul>
			</aside>
			<aside class="col-lg-3">
				<h4>KEY WORDS </h4>
				<ul class="list-no-bullets">
					<li><a href="#">Rent lorem bla bla Miami</a></li>
					<li><a href="#">Rent lorem bla bla Miami</a></li>
					<li><a href="#">Rent lorem bla bla Miami</a></li>
					<li><a href="#">Rent lorem bla bla Miami</a></li>
					<li><a href="#">Rent lorem bla bla Miami</a></li>
				</ul>
			</aside>
			<aside class="col-lg-3">
				<h4>KEY WORDS </h4>
				<ul class="list-no-bullets">
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
				</ul>
			</aside>
			<aside class="col-lg-3">
				<h4>KEY WORDS </h4>
				<ul class="list-no-bullets">
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
					<li><a href="#">Rent lorem bla bla Neywork</a></li>
				</ul>
			</aside>

		</div>
		<div class="row">
			<div class="col-lg-6 padding-1em">
				<p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</div>
		    <div class="col-lg-6  padding-1em">
		    	<p class="pull-right"><a href="http://mondedesign.net" target="_blank">By : Monde Design</a></p>
		    </div>
		</div>
	</div>
</footer>
   
</body>
</html>