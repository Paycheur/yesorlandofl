<?php
class VPropertyCommercial
{

	public function __construct() {return;}

	public function __destruct() {return;}


	public function showProperty($_value)
	{
		/*
		 * Données sur les point d'interet à proximité :
		 * - school : $_value['proximity']['school']
		 * - grocery and supermarket : $_value['proximity']['grocery']
		 * - health : $_value['proximity']['health']
		 * - restaurant : $_value['proximity']['food']
		 */

		$csv = $_value['dataCsv'];


		if(isset($_value['results']['img']))
		{
			$allImg = explode('|', $_value['results']['img']);
		}
		else
		{
			$allImg =array();
		}

		setlocale(LC_MONETARY, 'en_US'); //prix format americain

	?>
	<article class="content">
		<?php require_once('components/form-visit-request.php'); ?>
		<input type="hidden" value="<?=$_value['results']['id']?>" id="id_property" /> <!-- important ! -->
		<?php if(isset($_value['gps']['latitude']) && isset($_value['gps']['longitude']))
		{?>
			<input type="hidden" value="<?=$_value['gps']['latitude'] ?>;<?=$_value['gps']['longitude'] ?>" id="coord_gps"/>
			<input type="hidden" value="<?=(isset($_value['results']['address']) ? $_value['results']['address'] : '').' '.(isset($_value['results']['city']) ? ', '.$_value['results']['city'] : '').' '.(isset($_value['results']['state']) && isset($_value['results']['postal_code']) ? ', '.$_value['results']['state'].' '.$_value['results']['postal_code'] : '') ?>" id="address_property"/>
		<?php
		}?>


		<div class="container margin-top-2em margin-bottom-2em " id="holder-content" >




			<div class="row">
				<div class="col-lg-7">

					<div class="row">
						<header class="col-lg-12 border-1px-gray margin-top-2em  border-top-2px-blue  bg-pure padding-2em" >
							<div class="row">
								<div class="col-lg-5">

									<h1 class="h3 margin-zero lh-100 "><?=(isset($_value['results']['address']) ? $_value['results']['address'] : '') ?></h1>

									<h2 class="h5 margin-zero lh-100  padding-top-05em ">
										<small><?=(isset($_value['results']['address']) ? $_value['results']['address'] : '').' '.(isset($_value['results']['city']) ? ', '.$_value['results']['city'] : '').' '.(isset($_value['results']['state']) && isset($_value['results']['postal_code']) ? ', '.$_value['results']['state'].' '.$_value['results']['postal_code'] : '') ?></small>
									</h2>


								</div>
								<div class="col-lg-7">

									<h2 class="h2 margin-zero lh-100 black pull-left ">
										$ <?=str_replace('.00', '', $_value['results']['price'])?>
									</h2>

									<h4 class="h5 margin-zero  lh-100 gray pull-right "> <small>
										<?=(isset($_value['results']['style']) ? $_value['results']['style'] : '') ?>
										<?=(isset($_value['results']['status']) && $_value['results']['status'] != '' ? '<span class="badge'.($_value['results']['status'] == 'Active' ? ' badge-active' : '').'"> '.$_value['results']['status'].' </span>' : '')?>
									</small>
									</h4>

									<div class="row">
										<div class="col-lg-12 padding-top-05em ">
											<ul class="property-main-ul">

												<?php if ( isset( $csv['beds'] ) && $csv['beds'] != '0'  ):  ?>
													<li><?=(isset($csv['beds']) ? $csv['beds']['val'] : '')?> BED(S)</li>
												<?php endif; ?>


												<?php if ( isset( $csv['full_baths'] ) && $csv['full_baths'] != '0'  ):  ?>

												<li><?=(isset($csv['full_baths']) ? $csv['full_baths']['val'] : '')?> BATHROOM(S)</li>
												<?php endif; ?>

												<?php if ( isset( $csv['lp_sqft'] ) && $csv['lp_sqft'] != '0'  ):  ?>
													<li><?=(isset($csv['lp_sqft']) ? $csv['lp_sqft']['val'] : '')?> SQFT</li>
												<?php endif; ?>
											</ul>
										</div>
									</div>



								</div>
							</div>
						</header>
					</div>

					<div class="row">
						<div class="col-lg-12 border-1px-gray margin-top-4em  bg-pure padding-2em ">
							<div class="row">
								<div class="col-lg-6">
									<!-- Nav tabs -->
									<ul class="nav nav-pills padding-1em">
									  <li class="active"><a href="#images-tab" data-toggle="tab"><i class="icon-camera translate-always"></i>  IMAGES</a></li>
									  <li class="dropdown"><a href="#map-tab" data-toggle="tab"><i class="icon-map-marker size-20 translate-always"></i> WHAT'S IN THE AREA </a></li>
									</ul>
								</div>
								<div class="col-lg-6 text-right">
									<ul class="social text-right">

										<?php
											$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
										 ?>
										<?php
										if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_value['like'] == true)
										{?>
										<li><a href="#" title="like" id="button_dislike" class="bg-pinky"><i class="icon-heart"></i></a></li>
										<li class="hide"><a href="#" title="Like" id="button_like"><i class="icon-heart"></i></a></li>
										<?php
										} else if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_value['like'] == false)
										{?>
										<li><a href="#" title="Like" id="button_like" class="bg-grey"><i class="icon-heart"></i></a></li>
										<li class="hide"><a href="#" title="Dislike" id="button_dislike"><i class="icon-heart"></i></a></li>
										<?php
										}?>
										<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link ?>" title="Facebook" class="bg-fb"><i class="icon-facebook"></i></a></li>
										<li><a target="_blank" href="http://twitter.com/intent/tweet?source=sharethiscom&text=I found this on the portfolio group website&url=<?php echo $actual_link ?>" title="Twitter" class="bg-twitter"><i class="icon-twitter"></i> </a></li>

										<li><a target="_blank" href="https://plus.google.com/share?url=<?php echo $actual_link ?>" title="google plus" class="bg-googleplus"><i class="icon-google-plus"></i> </a></li>
										<li><a href="javascript:window.print()" title="Print" class="bg-grey"><i class="icon-print"></i> </a></li>
									</ul>
								</div>
							</div>





							<!-- Tab panes -->
							<div class="tab-content">
								  <div class="tab-pane active" id="images-tab">
										<div id="property-carousel" class="carousel slide">

											  <div class="carousel-inner " >
											   <?php
												 	$first = true;
												 	foreach($allImg as $url)
												 	{?>
												    <div class="item<?=($first== true ? ' active' : '' )?> bg-cover" style="background-image:url(<?=$url ?>)" >
												      <div class="container">
												      	<h6 class="visuallyhidden">Property Image</h6>
												      </div>
												    </div>

												   	<?php
												   	$first = false;
												}?>
											  </div>

											  <a class="left carousel-control" href="#property-carousel" data-slide="prev"><span class="icon-angle-left"></span></a>
											  <a class="right carousel-control" href="#property-carousel" data-slide="next"><span class="icon-angle-right"></span></a>


									  		 <!-- Indicators -->
									  		<ol class="carousel-indicators">
									  		     <?php
									  		  	 	$first = true;
									  		  	 	$i = 0;
									  		  	 	foreach($allImg as $url){

									  		  	 	?>

									  		  	    <li data-target="#property-carousel" data-slide-to="<?=$i?>" class="<?=($first== true ? ' active' : '' )?>">
									  		  	    	<img src="<?=$url ?>" alt="">
									  		  	    </li>

									  		  	   	<?php
									  		  	   	$first = false;
									  		  	   	$i++;
									  		  	}?>
									  		</ol>

								  	</div>
								 </div>

							 	    <div class="tab-pane" id="map-tab">

							 	    	<?php if(isset($_value['gps']['latitude']) && isset($_value['gps']['longitude']))
							 	    	{?>

							  			<iframe width="100%" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.fr/maps?dg=opt&ie=UTF8&ll=<?=$_value['gps']['latitude'] ?>,<?=$_value['gps']['longitude'] ?>&q=<?=$_value['gps']['latitude'] ?>,<?=$_value['gps']['longitude'] ?>&spn=0.022904,0.042272&t=m&z=15&output=embed"></iframe>
							  			<div id="googleMap">
							  			</div>

							  			<div class="row padding-2-em">

							  			  <?php if(isset($_value['proximity']['food']) && count($_value['proximity']['food'])  > 0) : ?>
							  				  <div class="col-lg-6">
							  				  		<h4>
							  				  			<i class="icon-food"></i>  Food(<?=count($_value['proximity']['food']) ?>)
							  				  		</h4>
							  						<ul class="list-unstyled dotted padding-1em">
							  							<?php
							  							foreach($_value['proximity']['food'] as $v)
							  							{
							  							?>
							  							<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
							  							<?php
							  							}?>
							  						</ul>
							  				  </div>
							  			  <?php endif ?>
							  			  <?php if(isset($_value['proximity']['amenities']) && count($_value['proximity']['amenities'])  > 0) : ?>
							  				  <div class="col-lg-6">
							  				  	<h4>
							  				  		<i class="icon-building"></i>  Amenities (<?=count($_value['proximity']['amenities']) ?>)
							  				  	</h4>

							  				  		<ul class="list-unstyled dotted padding-1em">
							  				  			<?php
							  				  			foreach($_value['proximity']['amenities'] as $v)
							  				  			{?>
							  				  			<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
							  				  			<?php
							  				  			}?>
							  				  		</ul>
							  				  </div>
							  			  <?php endif ?>
							  			</div>
							  			<div class="row padding-2-em">

							  			  <?php if(isset($_value['proximity']['school']) && count($_value['proximity']['school'])  > 0) : ?>
							  				  <div class="col-lg-6">
							  				  		<h4>
							  				  			<i class="icon-book"></i> Schools (<?=count($_value['proximity']['school']) ?>)
							  				  		</h4>
							  				  		<ul class="list-unstyled dotted padding-1em">
							  				  			<?php
							  				  			foreach($_value['proximity']['school'] as $v)
							  				  			{?>
							  				  			<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
							  				  			<?php
							  				  			}?>
							  				  		</ul>


							  				  </div>
							  			  <?php endif ?>
							  			  <?php if(isset($_value['proximity']['transportation']) && count($_value['proximity']['transportation'])  > 0) : ?>
							  				  <div class="col-lg-6">
							  				  	<h4>
							  				  		<i class="icon-compass"></i> Transport (<?=count($_value['proximity']['transportation']) ?>)
							  				  	</h4>
							  						<ul class="list-unstyled dotted padding-1em">
							  							<?php
							  							foreach($_value['proximity']['transportation'] as $v)
							  							{?>
							  							<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
							  							<?php
							  							}?>
							  						</ul>

							  				  </div>
							  			  <?php endif ?>
							  			 </div>
							  			 <div class="row padding-2-em">

							  			  <?php  if(isset($_value['proximity']['retail']) && count($_value['proximity']['retail'])  > 0) : ?>

							  				  <div class="col-lg-6">

							  				  		<h4>
							  				  			<i class="icon-coffee"></i> Retail (<?=count($_value['proximity']['retail']) ?>)
							  				  		</h4>

							  				  		<ul class="list-unstyled dotted padding-1em">
							  				  			<?php
							  				  			foreach($_value['proximity']['retail'] as $v)
							  				  			{?>
							  				  			<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
							  				  			<?php
							  				  			}?>
							  				  		</ul>



							  				  </div>
							  			  <?php endif ?>

							  			</div>

							  		</div>
							</div>

						</div>
					</div>

					<div class="row">

						<div class="col-lg-12 page-blue margin-top-2em   padding-2em">

							<div class="row">
								<div class="col-lg-3">
									<img src="/Assets/img/jere.jpg" alt="agent jere" class="img-circle border-img-white  ">
								</div>
								<div class="col-lg-9">
									<ul class="list-unstyled padding-top-1em">

										<li class="white">
											<strong> <i class="icon-phone"></i> 321-230-2337   </strong> | <i class="icon-envelope-alt"></i>  69 E. Pine St Orlando, Fl 32801
										</li>
										<li class="padding-top-1em ">
											<?php
											if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_value['visitAvailable'] == true)
											{?>
											<a role="button" class="btn btn-white white" data-toggle="modal" href="#modalVisitRequest" id="buttonVisit">Visit available</a>
											<?php
											}else if($_value['visitAvailable'] == true)
											{?>
											<a role="button" class="btn btn-white white " data-toggle="modal" href="#modalLogin" id="buttonVisit">Enquire Now / ask to visit </a>
											<?php
											}else if($_value['visitAvailable'] == false) //Déjà une demande faite pour ce membre
											{?>
											<a role="button" class="btn btn-white white cancel_request" data-toggle="modal" href="" id="buttonVisit">Cancel Request</a>
											<?php
											}?>
										</li>
									</ul>

								</div>
							</div>


						</div>
					</div>

				</div>

				<div class="col-lg-5">
					<div class="row">
						<div class="col-lg-11 col-lg-offset-1 margin-top-2em">
							<?php include('components/comm-property-data.php'); ?>
						</div>
					</div>
				</div>

			</div><!-- Main row -->
		</div><!--  container -->











				<?php
				}?>
	</article>
	<?php

	}
}