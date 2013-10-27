<?php
class VProperty
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
	?>
	<div class="content">
	<div class="container page-white margin-bottom-2em" >
		<div class="row-fluid" id="holer-content">
		<?php require_once('components/form-visit-request.php'); ?>
		<input type="hidden" value="<?=$_value['results']['id']?>" id="id_property" /> <!-- important ! -->
			<article class="col-lg-7 padding-r-l-1em padding-4em" >
				<div class="row-fluid">
					<hgroup class="col-lg-7">
						<h4 class="property-type">
								<span class="visuallyhidden">Property type :</span> <i class="icon-home"></i>
						</h4>
						<h2 class="margin-zero lh-100"><?=(isset($_value['results']['address']) ? $_value['results']['address'] : '') ?></h2>
							<h3 class="margin-zero lh-100"><small><?=(isset($_value['results']['address']) ? $_value['results']['address'] : '').' '.(isset($_value['results']['city']) ? ', '.$_value['results']['city'] : '').' '.(isset($_value['results']['state']) && isset($_value['results']['postal_code']) ? ', '.$_value['results']['state'].' '.$_value['results']['postal_code'] : '') ?></small>
							<!-- <StreetNumber>  <StreetName>
							<City> , FL  <PostalCode> -->
						</h3>
						<div class="bg-gray-light txt-center">
							<ul class="list-inline social">
								<?php
								if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_value['like'] == true)
								{?>
									<li><a href="#" title="Dislike" id="button_dislike"><i class="icon-heart" style="color:#FF0989"></i></a></li>
									<li class="hide"><a href="#" title="Like" id="button_like"><i class="icon-heart"></i></a></li>
								<?php
								} else if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_value['like'] == false)
								{?>
									<li><a href="#" title="Like" id="button_like"><i class="icon-heart"></i></a></li>
									<li class="hide"><a href="#" title="Dislike" id="button_dislike"><i class="icon-heart" style="color:#FF0989"></i></a></li>
								<?php
								}?>
								
								<li><a href="#" title="Facebook"><i class="icon-facebook"></i></a></li>
								<li><a href="#" title="Twitter"><i class="icon-twitter"></i> </a></li>
								<li><a href="javascript:window.print()" title="Print"><i class="icon-print"></i> </a></li>

							</ul>
						</div>
					 </hgroup>

					<div class="col-lg-5">
						<h3 class="price margin-top-zero  lh-100">
										 <!-- Class salon le staut badge-inactive  badge-hold  -->
							$21,000,000  <?=(isset($_value['results']['status']) && $_value['results']['status'] != '' ? '<span class="badge'.($_value['results']['status'] == 'Active' ? ' badge-active' : '').'"> '.$_value['results']['status'].' </span>' : '')?>
						</h3>
						<ul class="no-bullets dotted">
							<!-- <HOA Fee:> per <HOA Payment Schedule> is <HOA/Comm Assn>  -->
							<li>$1000 per quarter is optional</li>
							<li>Monthly Taxes$5,895</li>
							<li>10% down$2,150,000</li>
						</ul>
					</div>
				</div>
				<div class="row-fluid">
					<div class="col-lg-12">

						<div id="property-carousel" class="carousel slide">
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
						    <li data-target="#property-carousel" data-slide-to="0" class="active"></li>
						    <li data-target="#property-carousel" data-slide-to="1"><img src="http://placehold.it/100x100/07432D/fff" alt=""></li>
						    <li data-target="#property-carousel" data-slide-to="2"></li>

						  </ol>
						  <div class="carousel-inner " >
						   <?php
							 	$first = true;
							 	foreach($allImg as $url)
							 	{?>
							    <div class="item<?=($first== true ? ' active' : '' )?>">
							      <div class="container ">
							      	<img src="<?=$url ?>" alt="">
							      </div>
							    </div>

							   	<?php
							   	$first = false;
							 	}?>
						  </div>
						  <a class="left carousel-control" href="#property-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
						  <a class="right carousel-control" href="#property-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
						</div><!-- /.carousel -->

					</div>
				</div>


				<div class="row-fluid ">

					<section class="col-lg-3 padding-2em">
						<h4 class="margin-top-zero  lh-100">ESSENTIALS</h4>
						<ul class="no-bullets">
							<li>Price$21,500,000
							<li>TypeCondo
							<li>Bedrooms9
							<li>Bathrooms9.5
							<li>Rooms15
							<li>Approx. Sq. Ft.8,018
							<li>Exposure N, S &amp; W
						</ul>

					</section>

					<section class="col-lg-3 padding-2em">
						<h4 class="margin-top-zero  lh-100">KEY FEATURES</h4>
						<ul class="no-bullets">
							<li>Penthouse
							<li>Roof deck
							<li>Terrace
							<li>Elevator
							<li>Pet friendly
							<li>Full city view
							<li>Beamed ceiling
						</ul>
					</section>
					<section class="col-lg-6 padding-2em">
						<h4 class="margin-top-zero  lh-100">Property Description:</h4>
						<p>
							LIVE THE TRIBECA LOFT DREAM! A rare opportunity awaits the most discerning buyer to purchase 2 side by side Penthouse Duplex Lofts with interior space totaling over 8,000sf and private wraparound roof terraces totaling approx 4,000sf.
						</p>
					</section>

				</div>
				<!-- Begin list data for this property -->
				<div>
				<ul>
				<?php 
				foreach($csv as $tab)
				{
					if($tab['val'] != '')
					{?>
						<li><?='<b>'.$tab['lib'].' :</b> '.$tab['val'] ?></li>
					<?php 
					}
				}?>
				</ul>
				</div>
				<!-- end list data -->
				
			</article>
			<aside class="col-lg-5 padding-r-l-2em padding-4em bg-gray-light property-sidebar" >
				
					<h3 class="price margin-top-zero  lh-100">
						<?=(isset($_value['results']['style']) ? $_value['results']['style'] : '') ?>
						<?php
						if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_value['visitAvailable'] == true)
						{?>
							<a role="button" class="btn btn-info pull-right" data-toggle="modal" href="#modalVisitRequest" id="buttonVisit">Visit available</a>
						<?php
						}else if($_value['visitAvailable'] == true)
						{?>
							<a role="button" class="btn btn-info pull-right" data-toggle="modal" href="#modalLogin" id="buttonVisit">Visit available</a>
						<?php
						}else if($_value['visitAvailable'] == false) //Déjà une demande faite pour ce membre
						{?>
							<a role="button" class="btn btn-info pull-right cancel_request" data-toggle="modal" href="" id="buttonVisit">Cancel Request</a>
						<?php
						}?>
					</h3>
				<ul class="no-bullets dotted">
					<?php
					if(isset($_value['results']['bed']) && $_value['results']['bed'] != null)
					{?>
						<li><?=$_value['results']['bed'] ?> Bedrooms</li>
					<?php
					}?>
					<?php
					if(isset($_value['results']['bathroom']) && $_value['results']['bathroom'] != null)
					{?>
						<li><?=$_value['results']['bathroom'] ?> bathrooms</li>
					<?php
					}?>
				</ul>

				<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.fr/maps?dg=opt&ie=UTF8&ll=<?=$_value['gps']['latitude'] ?>,<?=$_value['gps']['longitude'] ?>&q=<?=$_value['gps']['latitude'] ?>,<?=$_value['gps']['longitude'] ?>&spn=0.022904,0.042272&t=m&z=15&output=embed" class="padding-2em"></iframe>

				<ul class="nav nav-tabs" id="myTab">
				  <li class="active"><a href="#area" data-toggle="pill">What's in the area</a></li>
				  <li><a href="#Neighborhood" data-toggle="pill">The Neighborhood</a></li>
				  <li><a href="#building" data-toggle="pill">The Building</a></li>
				</ul>
				<div class="tab-content padding-1em">
				  <div class="tab-pane active" id="area">
				  		<ul class="dotted no-bullets">
				  			<?php if(isset($_value['proximity']['food']) && count($_value['proximity']['food'])  > 0)
				  			{?>
				  			<li><i class="icon-food"></i>  Restaurants (<?=count($_value['proximity']['food']) ?>)
				  				<ul>
				  					<?php 
				  					foreach($_value['proximity']['food'] as $v)
				  					{?>
				  						<li><?=$v['name'] ?></li>
				  					<?php 
				  					}?>
				  				</ul>
				  			</li>
				  			<?php 
				  			}
				  			if(isset($_value['proximity']['grocery']) && count($_value['proximity']['grocery'])  > 0)
				  			{?>
				  			<li><i class="icon-leaf"></i>  Grocery and Markets (<?=count($_value['proximity']['grocery']) ?>)
				  				<ul>
				  					<?php 
				  					foreach($_value['proximity']['grocery'] as $v)
				  					{?>
				  						<li><?=$v['name'] ?></li>
				  					<?php 
				  					}?>
				  				</ul>
				  			</li>
				  			<?php 
				  			}
				  			if(isset($_value['proximity']['health']) && count($_value['proximity']['health'])  > 0)
				  			{?>
				  			<li><i class="icon-stethoscope"></i>  Health clubs and spas (<?=count($_value['proximity']['health']) ?>)
				  				<ul>
				  					<?php 
				  					foreach($_value['proximity']['health'] as $v)
				  					{?>
				  						<li><?=$v['name'] ?></li>
				  					<?php 
				  					}?>
				  				</ul>
				  			</li>
				  			<?php 
				  			}
				  			if(isset($_value['proximity']['school']) && count($_value['proximity']['school'])  > 0)
				  			{?>
				  			<li><i class="icon-book"></i> Public School (<?=count($_value['proximity']['school']) ?>)
				  				<ul>
				  					<?php 
				  					foreach($_value['proximity']['school'] as $v)
				  					{?>
				  						<li><?=$v['name'] ?></li>
				  					<?php 
				  					}?>
				  				</ul>
				  			</li>
				  			<?php 
				  			}?>

				  		</ul>
				  </div>
				  <div class="tab-pane" id="Neighborhood">
						<h5>
							Downtown West, from Canal Street to Park Place and City Hall, from the Hudson River to Lafayette Street.
						</h5>
						<p>
							Tribeca was historically a manufacturing and warehouse district, and the conversion of those buildings has produced some great condo and co-op lofts. Behind the brick and cast-iron façades of Tribeca are apartments big enough to roller-skate in, many with high ceilings, great light, and luxury kitchens. The name TriBeCa itself stands for the Triangle Below Canal, the area running West from Lafayette Street to the Hudson River, north of Battery Park City – an explosion of new condos to the south, some with units for rent, includes 200 Chambers, 101 Warren and Artisan Lofts. In the northern part of Tribeca, the 60 Beach conversion offers arched windows, Valcucine kitchens, and walnut floors, all accessible from private key-locked elevators — and there’s a doorman. For those who love glass, the new development at 56 Leonard is touted as “sculpture in the sky.”
						</p>

				  </div>
				  <div class="tab-pane" id="building">

						<h5>
							The Sugarloaf Building...In the Heart of Tribeca
						</h5>

						<p>
							This is a wonderful boutique condominium with nine beautiful and spacious lofts. Each home features include original timber beams, brick walls and cast iron columns as well as oversized, wood-framed windows.
						</p>
				  </div>
				</div>
			</aside>
		</div>
	</div>
	<div class="bg-header">
		<img src="img/flou.jpg" alt="">
	</div>
</div>
	<?php

	}
}