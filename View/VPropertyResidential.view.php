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
					<img src="<?=$allImg[0] ?>" alt="<?=(isset($_value['results']['address']) ? $_value['results']['address'] : '') ?>" class="display-block margin-bottom-1em">
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
								<section class="col-lg-4 padding-2em">
									<h4 class="margin-top-zero  lh-100">GENERAL INFORMATION:</h4>
									<ul class="no-bullets">

										<?php
												if ( isset( $csv['property_description'] ) ) :
												if($csv['property_description']['val'] != '') :  ?>

												<li>
													<b><?= $csv['property_description']['lib']?>:</b>
													<?=(isset($csv['property_description']) ? $csv['property_description']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['property_style'] ) ) :
												if($csv['property_style']['val'] != '') :  ?>
												<li>
													<b><?= $csv['property_style']['lib']?>:</b>
													<?=(isset($csv['property_style']) ? $csv['property_style']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['architectural_style'] ) ) :
												if($csv['architectural_style']['val'] != '') :  ?>
												<li>
													<b><?= $csv['architectural_style']['lib']?>:</b>
													<?=(isset($csv['architectural_style']) ? $csv['architectural_style']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['beds'] ) ) :
												if($csv['beds']['val'] != '') :  ?>
												<li>
													<b><?= $csv['beds']['lib']?>:</b>
													<?=(isset($csv['beds']) ? $csv['beds']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['full_baths'] ) ) :
												if($csv['full_baths']['val'] != '') :  ?>
												<li>
													<b><?= $csv['full_baths']['lib']?>:</b>
													<?=(isset($csv['full_baths']) ? $csv['full_baths']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['half_baths'] ) ) :
												if($csv['half_baths']['val'] != '') :  ?>
												<li>
													<b><?= $csv['half_baths']['lib']?>:</b>
													<?=(isset($csv['half_baths']) ? $csv['half_baths']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['sq_ft_heated'] ) ) :
												if($csv['sq_ft_heated']['val'] != '') :  ?>
												<li>
													<b><?= $csv['sq_ft_heated']['lib']?>:</b>
													<?=(isset($csv['sq_ft_heated']) ? $csv['sq_ft_heated']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['lot_size'] ) ) :
												if($csv['lot_size']['val'] != '') :  ?>
												<li>
													<b><?= $csv['lot_size']['lib']?>:</b>
													<?=(isset($csv['lot_size']) ? $csv['lot_size']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['lp_sqft'] ) ) :
												if($csv['lp_sqft']['val'] != '') :  ?>
												<li>
													<b><?= $csv['lp_sqft']['lib']?>:</b>
													<?=(isset($csv['lp_sqft']) ? $csv['lp_sqft']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['year_built'] ) ) :
												if($csv['year_built']['val'] != '') :  ?>
												<li>
													<b><?= $csv['year_built']['lib']?>:</b>
													<?=(isset($csv['year_built']) ? $csv['year_built']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['garage_carport'] ) ) :
												if($csv['garage_carport']['val'] != '') :  ?>
												<li>
													<b><?= $csv['garage_carport']['lib']?>:</b>
													<?=(isset($csv['garage_carport']) ? $csv['garage_carport']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>


									</ul>
								</section>
								<section class="col-lg-4 padding-2em">
									<h4 class="margin-top-zero  lh-100">RENT:</h4>
									<ul class="no-bullets">


										<?php
												if ( isset( $csv['annual_rent'] ) ) :
												if($csv['annual_rent']['val'] != '') :  ?>
												<li>
													<b><?= $csv['annual_rent']['lib']?>:</b>
													<?=(isset($csv['annual_rent']) ? $csv['annual_rent']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['seasonal_rent'] ) ) :
												if($csv['seasonal_rent']['val'] != '') :  ?>
												<li>
													<b><?= $csv['seasonal_rent']['lib']?>:</b>
													<?=(isset($csv['seasonal_rent']) ? $csv['seasonal_rent']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['off_season_rent'] ) ) :
												if($csv['off_season_rent']['val'] != '') :  ?>
												<li>
													<b><?= $csv['off_season_rent']['lib']?>:</b>
													<?=(isset($csv['off_season_rent']) ? $csv['off_season_rent']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['weekly_rent'] ) ) :
												if($csv['weekly_rent']['val'] != '') :  ?>
												<li>
													<b><?= $csv['weekly_rent']['lib']?>:</b>
													<?=(isset($csv['weekly_rent']) ? $csv['weekly_rent']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

									</ul>
									<hr>
									<h4 class="margin-top-zero  lh-100">APPLICATION FEE:</h4>
									<ul class="no-bullets">


										<?php
												if ( isset( $csv['application_fee'] ) ) :
												if($csv['application_fee']['val'] != '') :  ?>
												<li>
													<b><?= $csv['application_fee']['lib']?>:</b>
													<?=(isset($csv['application_fee']) ? $csv['application_fee']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

									</ul>
									<hr>
									<h4 class="margin-top-zero  lh-100">RENTAL GUIDELINES:</h4>
									<ul class="no-bullets">

										<?php
												if ( isset( $csv['max_pet_weight'] ) ) :
												if($csv['max_pet_weight']['val'] != '') :  ?>
												<li>
													<b><?= $csv['max_pet_weight']['lib']?>:</b>
													<?=(isset($csv['max_pet_weight']) ? $csv['max_pet_weight']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['minimum_days_leased'] ) ) :
												if($csv['minimum_days_leased']['val'] != '') :  ?>
												<li>
													<b><?= $csv['minimum_days_leased']['lib']?>:</b>
													<?=(isset($csv['minimum_days_leased']) ? $csv['minimum_days_leased']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['pet_deposit'] ) ) :
												if($csv['pet_deposit']['val'] != '') :  ?>
												<li>
													<b><?= $csv['pet_deposit']['lib']?>:</b>
													<?=(isset($csv['pet_deposit']) ? $csv['pet_deposit']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['pet_fee_non_refundable'] ) ) :
												if($csv['pet_fee_non_refundable']['val'] != '') :  ?>
												<li>
													<b><?= $csv['pet_fee_non_refundable']['lib']?>:</b>
													<?=(isset($csv['pet_fee_non_refundable']) ? $csv['pet_fee_non_refundable']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['security_deposit'] ) ) :
												if($csv['security_deposit']['val'] != '') :  ?>
												<li>
													<b><?= $csv['security_deposit']['lib']?>:</b>
													<?=(isset($csv['security_deposit']) ? $csv['security_deposit']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['long_term_y_n'] ) ) :
												if($csv['long_term_y_n']['val'] != '') :  ?>
												<li>
													<b><?= $csv['long_term_y_n']['lib']?>:</b>
													<?=(isset($csv['long_term_y_n']) ? $csv['long_term_y_n']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['association_approval_fee'] ) ) :
												if($csv['association_approval_fee']['val'] != '') :  ?>
												<li>
													<b><?= $csv['association_approval_fee']['lib']?>:</b>
													<?=(isset($csv['association_approval_fee']) ? $csv['association_approval_fee']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['additional_applicant_fee'] ) ) :
												if($csv['additional_applicant_fee']['val'] != '') :  ?>
												<li>
													<b><?= $csv['additional_applicant_fee']['lib']?>:</b>
													<?=(isset($csv['additional_applicant_fee']) ? $csv['additional_applicant_fee']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>


									</ul>
									<h4 class="margin-top-zero  lh-100">ADDITIONAL RENTAL INFO:</h4>
									<ul class="no-bullets">


										<?php
												if ( isset( $csv['furnishings'] ) ) :
												if($csv['furnishings']['val'] != '') :  ?>
												<li>
													<b><?= $csv['furnishings']['lib']?>:</b>
													<?=(isset($csv['furnishings']) ? $csv['furnishings']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['weeks_available_2013'] ) ) :
												if($csv['weeks_available_2013']['val'] != '') :  ?>
												<li>
													<b><?= $csv['weeks_available_2013']['lib']?>:</b>
													<?=(isset($csv['weeks_available_2013']) ? $csv['weeks_available_2013']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

									</ul>
								</section>
								<section class="col-lg-4 padding-2em">
									<h4 class="margin-top-zero  lh-100">BEDROOMS:</h4>
									<ul class="no-bullets">
										<?php
												if ( isset( $csv['master_bedroom_approx'] ) ) :
												if($csv['master_bedroom_approx']['val'] != '') :  ?>
												<li>
													<b><?= $csv['master_bedroom_approx']['lib']?>:</b>
													<?=(isset($csv['master_bedroom_approx']) ? $csv['master_bedroom_approx']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['2nd_bedroom_approx'] ) ) :
												if($csv['2nd_bedroom_approx']['val'] != '') :  ?>
												<li>
													<b><?= $csv['2nd_bedroom_approx']['lib']?>:</b>
													<?=(isset($csv['2nd_bedroom_approx']) ? $csv['2nd_bedroom_approx']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['3rd_bedroom_approx'] ) ) :
												if($csv['3rd_bedroom_approx']['val'] != '') :  ?>
												<li>
													<b><?= $csv['3rd_bedroom_approx']['lib']?>:</b>
													<?=(isset($csv['3rd_bedroom_approx']) ? $csv['3rd_bedroom_approx']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['4th_bedroom_approx'] ) ) :
												if($csv['4th_bedroom_approx']['val'] != '') :  ?>
												<li>
													<b><?= $csv['4th_bedroom_approx']['lib']?>:</b>
													<?=(isset($csv['4th_bedroom_approx']) ? $csv['4th_bedroom_approx']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>

										<?php
												if ( isset( $csv['5th_bedroom_approx'] ) ) :
												if($csv['5th_bedroom_approx']['val'] != '') :  ?>
												<li>
													<b><?= $csv['5th_bedroom_approx']['lib']?>:</b>
													<?=(isset($csv['5th_bedroom_approx']) ? $csv['5th_bedroom_approx']['val'] : '')?>
												</li>
										<?php endif; ?><?php endif; ?>
									</ul>
								</section>

							</div>
							<div class="row">
								<section class="col-lg-4 padding-2em">
									<h4 class="margin-top-zero  lh-100">BATHS:</h4>
									<ul class="no-bullets">

									</ul>
								</section>
								<section class="col-lg-4 padding-2em">
									<h4 class="margin-top-zero  lh-100">KITCHEN AND DINING:</h4>
									<ul class="no-bullets">

									</ul>
								</section>
								<section class="col-lg-4 padding-2em">
									<h4 class="margin-top-zero  lh-100">Other Rooms:</h4>
									<ul class="no-bullets">


									</ul>
								</section>

							</div>
							<hr>
							<!-- Begin list data for this property -->
							<div class="row">
								<div class="col-lg-12">
									<ul class="list-group">
										<?php
										foreach($csv as $tab)
										{
											if($tab['val'] != '')
										{?>
										<li class="list-group-item"><?='<b class="blue">'.$tab['lib'].' :</b> '.$tab['val'] ?></li>
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
											<li><i class="icon-food"></i>  <b>Restaurants (<?=count($_value['proximity']['food']) ?>)</b>
												<ul class="list-unstyled">
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
											<li><i class="icon-leaf"></i>  <b>Grocery and Markets (<?=count($_value['proximity']['grocery']) ?>)</b>
												<ul class="list-unstyled">
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
											<li><i class="icon-stethoscope"></i>  <b>Health clubs and spas (<?=count($_value['proximity']['health']) ?>)</b>
												<ul class="list-unstyled">
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
											<li><i class="icon-book"></i> <b>Public School (<?=count($_value['proximity']['school']) ?>)</b>
												<ul class="list-unstyled">
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
						<img src="/Assets/img/flou.jpg" alt="">
					</div>
				</div>
				<?php
				}
				}