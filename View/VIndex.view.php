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
	<div id="ei-slider" class="ei-slider">
		<ul class="ei-slider-large">
			<li>
				<img src="/Assets/img/slide-bg-golf.jpg"/>
				<div class="ei-title">
					<h2>Passionate</h2>
					<h3>Seeker</h3>
				</div>
			</li>
			<li>
				<img src="/Assets/img/slide-bg-com.jpg"/>
				<div class="ei-title">
					<h2>Passionate</h2>
					<h3>Seeker</h3>
				</div>
			</li>
			<li>
				<img src="/Assets/img/slide-bg-health.jpg"/>
				<div class="ei-title">
					<h2>Passionate</h2>
					<h3>Seeker</h3>
				</div>
			</li>
			<li>
				<img src="/Assets/img/slide-bg-com.jpg"/>
				<div class="ei-title">
					<h2>Passionate</h2>
					<h3>Seeker</h3>
				</div>
			</li>
			<li>
				<img src="/Assets/img/slide-bg-com.jpg"/>
				<div class="ei-title">
					<h2>Passionate</h2>
					<h3>Seeker</h3>
				</div>
			</li>
			<li>
				<img src="/Assets/img/slide-bg-com.jpg"/>
				<div class="ei-title">
					<h2>Passionate</h2>
					<h3>Seeker</h3>
				</div>
			</li>
			<li>
				<img src="/Assets/img/slide-bg-com.jpg"/>
				<div class="ei-title">
					<h2>Passionate</h2>
					<h3>Seeker</h3>
				</div>
			</li>
			</ul><!-- ei-slider-large -->
			<ul class="ei-slider-thumbs">
				<li class="ei-slider-element">Current</li>
				<li><a href="#">Slide 6</a><img src="/Assets/img/thumbs/6.jpg" alt="thumb06" /></li>
				<li><a href="#">Slide 1</a><img src="/Assets/img/thumbs/1.jpg" alt="thumb01" /></li>
				<li><a href="#">Slide 2</a><img src="/Assets/img/thumbs/2.jpg" alt="thumb02" /></li>
				<li><a href="#">Slide 6</a><img src="/Assets/img/thumbs/6.jpg" alt="thumb06" /></li>
				<li><a href="#">Slide 1</a><img src="/Assets/img/thumbs/1.jpg" alt="thumb01" /></li>
				<li><a href="#">Slide 2</a><img src="/Assets/img/thumbs/2.jpg" alt="thumb02" /></li>
				<li><a href="#">Slide 2</a><img src="/Assets/img/thumbs/2.jpg" alt="thumb02" /></li>
			</ul><!-- ei-slider-thumbs -->
	</div><!-- ei-slider -->
	<!-- /.carousel -->
<div class="bg-pure">
	<div class="container">
		<?php require_once('components/search-form.php') ?>
	</div>
</div><!-- container -->

<div class="container">
	<div class="row" id="holder">
		<div class="col-lg-12 ">
			<?php  require_once('components/section-residential.php'); ?>
			<?php  require_once('components/section-commercial.php'); ?>
			<?php  require_once('components/section-investment.php'); ?>
			<?php  require_once('components/section-central-fl.php'); ?>
			<?php  require_once('components/section-firm.php'); ?>
		</div><!-- col-lg-12 -->
	</div><!-- row -->
	</div><!-- container -->
	</div><!-- pg-pure -->
</div><!-- content -->

		<?php
	}
}