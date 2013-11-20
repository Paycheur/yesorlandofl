<?php
class VPropertyResidential
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
	
	<div class="content">

		<div class="container margin-top-2em margin-bottom-2em " >

			<div class="row page-white " id="holder-content">
				<?php require_once('components/form-visit-request.php'); ?>
				<input type="hidden" value="<?=$_value['results']['id']?>" id="id_property" /> <!-- important ! -->
				<?php if(isset($_value['gps']['latitude']) && isset($_value['gps']['longitude']))
				{?>
					<input type="hidden" value="<?=$_value['gps']['latitude'] ?>;<?=$_value['gps']['longitude'] ?>" id="coord_gps"/>
					<input type="hidden" value="<?=(isset($_value['results']['address']) ? $_value['results']['address'] : '').' '.(isset($_value['results']['city']) ? ', '.$_value['results']['city'] : '').' '.(isset($_value['results']['state']) && isset($_value['results']['postal_code']) ? ', '.$_value['results']['state'].' '.$_value['results']['postal_code'] : '') ?>" id="address_property"/>
				<?php 
				}?>
				<article class="col-lg-7 padding-4em" >
					<div class="row">
						<div class="col-lg-7">
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
						</div>
						<div class="col-lg-5">
							<h3 class="price margin-top-zero  lh-100">
							<!-- Class salon le staut badge-inactive  badge-hold  -->
							$ <?=str_replace('.00', '', $_value['results']['price'])?>  <?=(isset($_value['results']['status']) && $_value['results']['status'] != '' ? '<span class="badge'.($_value['results']['status'] == 'Active' ? ' badge-active' : '').'"> '.$_value['results']['status'].' </span>' : '')?>
							</h3>
							<ul class="no-bullets dotted">
								<!-- <HOA Fee:> per <HOA Payment Schedule> is <HOA/Comm Assn>  -->
								<li>$1000 per quarter is optional</li>
								<li>Monthly Taxes$5,895</li>
								<li>10% down$2,150,000</li>
							</ul>
						</div>
					</div>
					<div class="row ">
						<div class="col-lg-12">
							<img src="<?=$allImg[0] ?>" alt="<?=(isset($_value['results']['address']) ? $_value['results']['address'] : '') ?>" class="display-block margin-bottom-1em img_property">
							<a data-toggle="modal" href="#more-images" class="btn btn-info btn-lg"><i class="icon-camera"></i> See more images</a>

							<!-- Button trigger modal -->


							 <!-- Modal -->
							 <div class="modal fade" id="more-images" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							   <div class="modal-dialog">
							     <div class="modal-content">
							       <div class="modal-header">
							         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							         <h4 class="modal-title">Property images</h4>
							       </div>
							       <div class="modal-body">
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

							         	  <!-- Indicators -->
							         	  <!-- <ol class="carousel-indicators">
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
							         	  </ol> -->


							         	  <a class="left carousel-control" href="#property-carousel" data-slide="prev"><span class="icon-angle-left"></span></a>
							         	  <a class="right carousel-control" href="#property-carousel" data-slide="next"><span class="icon-angle-right"></span></a>


							         </div><!-- /.carousel -->
							       </div>
							       <div class="modal-footer">
							         <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
							       </div>
							     </div><!-- /.modal-content -->
							   </div><!-- /.modal-dialog -->
							 </div><!-- /.modal -->
						</div>
					</div>
					<hr>
					<div class="row ">
						<section class="col-lg-3 padding-2em">
							<h4 class="margin-top-zero  lh-100">ESSENTIALS</h4>
							<ul class="no-bullets">
								<li>Price$21,500,000</li>
								<li>TypeCondo</li>
								<li>Bedrooms9</li>
								<li>Bathrooms9.5</li>
								<li>Rooms15</li>
								<li>Approx. Sq. Ft.8,018</li>
								<li>Exposure N, S &amp; W</li>
							</ul>
						</section>
						<section class="col-lg-3 padding-2em">
							<h4 class="margin-top-zero  lh-100">KEY FEATURES</h4>
							<ul class="no-bullets">
								<li>Penthouse</li>
								<li>Roof deck</li>
								<li>Terrace</li>
								<li>Elevator</li>
								<li>Pet friendly</li>
								<li>Full city view</li>
								<li>Beamed ceiling</li>
							</ul>
						</section>
						<section class="col-lg-6 padding-2em">
							<h4 class="margin-top-zero  lh-100">Property Description:</h4>
							<p>
							LIVE THE TRIBECA LOFT DREAM! A rare opportunity awaits the most discerning buyer to purchase 2 side by side Penthouse Duplex Lofts with interior space totaling over 8,000sf and private wraparound roof terraces totaling approx 4,000sf.
							</p>
						</section>
					</div>
					<hr>
					<!-- Begin list data for this property -->
					<div class="row">
						<div class="col-lg-12">
							<ul class="list-unstyled">


								<?php
								foreach($csv as $tab)
								{
									if($tab['val'] != '')
								{?>
								<li><?='<b class="blue">'.$tab['lib'].' :</b> '.$tab['val'] ?></li>
								<?php
								}
								}?>
							</ul>
						</div>
					</div>
				<!-- end list data -->
				</article>
				<aside class="col-lg-5 bg-gray-light padding-4em" >
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
					<?php if(isset($_value['gps']['latitude']) && isset($_value['gps']['longitude']))
					{?>
					<div id="googleMap">
					</div>
<!--					<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.fr/maps?dg=opt&ie=UTF8&ll=<?=$_value['gps']['latitude'] ?>,<?=$_value['gps']['longitude'] ?>&q=<?=$_value['gps']['latitude'] ?>,<?=$_value['gps']['longitude'] ?>&spn=0.022904,0.042272&t=m&z=15&output=embed" class="padding-2em"></iframe>-->
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
								<li><i class="icon-food"></i>  <b>Restaurants & Food(<?=count($_value['proximity']['food']) ?>)</b>
									<ul class="list-unstyled">
										<?php
										foreach($_value['proximity']['food'] as $v)
										{
										?>
										<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
										<?php
										}?>
									</ul>
								</li>
								<?php
								}
								if(isset($_value['proximity']['amenities']) && count($_value['proximity']['amenities'])  > 0)
								{?>
								<li><i class="icon-leaf"></i>  <b>Amenities (<?=count($_value['proximity']['amenities']) ?>)</b>
									<ul class="list-unstyled">
										<?php
										foreach($_value['proximity']['amenities'] as $v)
										{?>
										<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
										<?php
										}?>
									</ul>
								</li>
								<?php
								}
								if(isset($_value['proximity']['health']) && count($_value['proximity']['health'])  > 0)
								{?>
								<li><i class="icon-stethoscope"></i>  <b>Health, Health Clubs and Spas (<?=count($_value['proximity']['health']) ?>)</b>
									<ul class="list-unstyled">
										<?php
										foreach($_value['proximity']['health'] as $v)
										{?>
										<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
										<?php
										}?>
									</ul>
								</li>
								<?php
								}
								if(isset($_value['proximity']['school']) && count($_value['proximity']['school'])  > 0)
								{?>
								<li><i class="icon-book"></i> <b>Schools (<?=count($_value['proximity']['school']) ?>)</b>
									<ul class="list-unstyled">
										<?php
										foreach($_value['proximity']['school'] as $v)
										{?>
										<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
										<?php
										}?>
									</ul>
								</li>
								<?php
								}
								if(isset($_value['proximity']['transportation']) && count($_value['proximity']['transportation'])  > 0)
								{?>
								<li><i class="icon-book"></i> <b>Transportation (<?=count($_value['proximity']['transportation']) ?>)</b>
									<ul class="list-unstyled">
										<?php
										foreach($_value['proximity']['transportation'] as $v)
										{?>
										<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
										<?php
										}?>
									</ul>
								</li>
								<?php
								}
								if(isset($_value['proximity']['retail']) && count($_value['proximity']['retail'])  > 0)
								{?>
								<li><i class="icon-book"></i> <b>Retail (<?=count($_value['proximity']['retail']) ?>)</b>
									<ul class="list-unstyled">
										<?php
										foreach($_value['proximity']['retail'] as $v)
										{?>
										<li class="list-area"><input type="hidden" value="<?=$v['geometry']['location']['lat'].';'.$v['geometry']['location']['lng']?>"><span><?=$v['name'] ?></span></li>
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
					<?php 
					}?>
				</aside>
			</div>
		</div>
		<div class="bg-header">
			<img src="/Assets/img/flou.jpg" alt="">
		</div>
	</div>
	<?php

	}
}