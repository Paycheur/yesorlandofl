<?php
class VIndex
{

	public function __construct() {return;}

	public function __destruct() {return;}


	public function homeFun($_value)
	{
		?>
<div class="content">
	<!-- Carousel
	================================================== -->
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
		<ol class="carousel-indicators">
		  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		  <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		  <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">
	    <article class="item bg-cover active"  style="background-image:url(Assets/img/slide-bg-health.jpg);">
	      <div class="carousel-caption">
	      	<div class="row">
	      		<h3 class="title h2"><a href="#">Hey there do u like me !</a></h3>
	      		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	      	</div>
	        <div class="row padding-1em">
	        	<a href="#" class="btn-white-border">SEARCH NOW</a>
	        </div>
	      </div>
	    </article>

	    <article class="item bg-cover "  style="background-image:url(Assets/img/slide-bg-golf.jpg);">
	      <div class="carousel-caption">
	      	<div class="row">
	      		<h3 class="title h2"><a href="#">Hey there do u like me !</a></h3>
	      		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	      	</div>
	        <div class="row padding-1em">
	        	<a href="#" class="btn-white-border"> SIGN UP </a>
	        </div>
	      </div>
	    </article>

	    <article class="item bg-cover "  style="background-image:url(Assets/img/slide-bg-com.jpg);">
	      <div class="carousel-caption">
	      	<div class="row">
	      		<h3 class="title h2"><a href="#">Hey there do u like me !</a></h3>
	      		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	      	</div>
	        <div class="row padding-1em">
	        	<a href="#" class="btn-white-border">DOWNLOAD</a>
	        </div>
	      </div>
	    </article>

	  </div>




	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	  </a>
	</div>
	<!-- /.carousel -->
<div class="bg-pure">
	<div class="container">
		<?php require_once('components/search-form.php') ?>
	</div>
</div><!-- container -->

<div class="bg-pure ">
	<div class="container">
		<div class="row" id="holder">
			<div class="col-lg-12 ">
				<?php   require_once('components/section-residential.php'); ?>
				<?php   require_once('components/section-commercial.php'); ?>
				<?php   require_once('components/section-investment.php'); ?>
				<?php   require_once('components/section-central-fl.php'); ?>
				<?php   require_once('components/section-firm.php'); ?>
			</div><!-- col-lg-12 -->
		</div><!-- row -->
		</div><!-- container -->
	</div><!-- pg-pure -->
</div><!-- content -->

		<?php
	}
}