<?php
class VSearch
{

	public function __construct() {return;}
		
	public function __destruct() {return;}
	
	  
	public function homeSearch($_value)
	{
		
		?>
		 
		<div class="content">
		
			<div class="container">
				<form action="#" class="row form-holder" id="formSearch">
				  <div class="col-lg-3 padding-1em">
				    <label for="property-type"><b>Property type</b></label>
				    <select class="selectpicker" multiple data-selected-text-format="count>3" name="type">
				      <option>Any</option>
				      <option>Single-Family Home</option>
				      <option>Condo</option>
				      <option>Twonhome</option>
				      <option>Coop</option>
				      <option>Apartment</option>
				      <option>Loft</option>
				      <option>Tic</option>
				      <option>Apt/Condo/Townhow</option>
				    </select>
		
				  </div>
				  <div class="col-lg-3 padding-1em">
				    <label for="areas"><b>Location :</b></label>
				    <div class="typeahead-wrapper">
				      <input class="typeahead form-control" type="text" name="location" placeholder="Cities" id="location" autocomplete="off" spellcheck="false" dir="auto" value="<?=(isset($_GET['city']) ? $_GET['city'] : '')?>">
				    </div>
		
				  </div>
				  <!-- <div class="col-lg-2 padding-1em">
				    <label for="rangeInput"><b>Price :</b> <span id="rangeText" class="label label-info"></span></label>
				    <input type="range" id="rangeInput" name="rangeInput" step="1" min="0"
				    max="10" value="1">
				  </div> -->
				  <div class="col-lg-2 padding-1em">
				    <label for="BEDS"><b>Beds</b></label>
				    <input type='nummber' name='beds' value='0' class='qty form-control' />
				    <input type='button' value='+' class='qtyplus' field='beds' />
				    <input type='button' value='-' class='qtyminus' field='beds' />
				  </div>
		
				  <div class="col-lg-2 padding-1em">
				    <label for="bathroom"><b>Bathroom</b></label>
				    <input type='nummber' name='Bathroom' value='0' class='qty form-control' />
				    <input type='button' value='+' class='qtyplus' field='Bathroom' />
				    <input type='button' value='-' class='qtyminus' field='Bathroom' />
				  </div>
		
		
		
				  <div class="col-lg-2 padding-1em">
				    <label for="" id="nb_match"><b><?=(isset($_value['nbResult']) ? $_value['nbResult'].' Matching' : '' )?></b></label>
				    <button id="submit" class="btn btn-danger btn-lg btn-block"><i class="icon-home"></i> see all</button>
				  </div>
				</form>
			</div>
		
			<div class="container">
				<div class="row" id="searchResult">
					<?php 
					if(isset($_value['data']) && count($_value['data']) > 0)
					{
						foreach($_value['data'] as $d)
						{?>
							<div class="col-lg-4 padding-2em">
								<article class="search-property">
									<div class="bg-header">
										<img src="<?=$d['img'] ?>" alt="">
									</div>
									<div class="padding-r-l-2em search-property-content txt-center">
										<hgroup class="txt-center">
											<h4 class="search-property-type"><span class="visuallyhidden">Property type :</span> <i class="icon-home"></i></h4>
											<h3 class="search-property-title lh-100 margin-zero"><?=$d['address']?></h3>
											<h4 class="lh-100"><?=$d['price']?></h4>
										</hgroup>
										<a href="/property/<?=$d['id'] ?>" class="btn btn-primary">View details</a>
										<ul class="list-inline padding-3em details">
											<li class="text-left"><strong class="display-block number"><?=$d['bed'] ?></strong> BEDS
											<li class="text-left"><strong class="display-block number"><?=$d['bathroom'] ?></strong> BATHS
											<li class="text-left"><strong class="display-block number"><?=$d['sqft'] ?></strong>  SQFT
										</ul>
									</div>
								</article>
							</div>
						<?php 
						}
					}
					else
					{
						?>
						<p>No Result.</p>
					<?php 
					}?>
				</div>
			</div>
		
			<div class="container">
				<div class="row">
					<div class="col-lg-12 padding-2em txt-center">
						<ul class="pagination liste_page">
							<?php
				  // How many adjacent pages should be shown on each side?
				  $adjacents = 3;
				  
				  /* 
				     First get total number of rows in data table. 
				     If you have a WHERE clause in your query, make sure you mirror it here.
				  */
				  if(isset($_value['nbResult']))
				  	$total_items = $_value['nbResult'];
				  else
				  	$total_items = 0;
				 
				  $targetpage = "/search/".(isset($_GET['style']) ? 's_'.$_GET['style'] : '').(isset($_GET['city']) ? '/c_'.$_GET['city'] : '');   //your file name  (the name of this file)
				  $limit = 6;                 //how many items to show per page
				  if(isset($_GET['page'])) {
				    $page = $_GET['page'];
				    $start = ($page - 1) * $limit;      //first item to display on this page
				  } else {
				    $page = 0;
				    $start = 0;               //if no page var is given, set start to 0
				  }
				  /* Setup page vars for display. */
				  if ($page == 0) $page = 1;          //if no page var is given, default to 1.
				  $prev = $page - 1;              //previous page is page - 1
				  $next = $page + 1;              //next page is page + 1
				  $lastpage = ceil($total_items/$limit);    //lastpage is = total pages / items per page, rounded up.
				  $lpm1 = $lastpage - 1;            //last page minus 1
				 
				  /* 
				    Now we apply our rules and draw the pagination object. 
				    We're actually saving the code to a variable in case we want to draw it more than once.
				  */
				  $pagination = "";
				  if($lastpage > 1)
				  { 
				    //previous button
				    if ($page > 1) 
				      $pagination.= "<li><a href=\"$targetpage/p_$prev\">previous</a></li>";
				    else
				      $pagination.= "<li class=\"disabled\"><a href=\"#\">previous</a></li>"; 
				    
				    //pages 
				    if ($lastpage < 7 + ($adjacents * 2)) //not enough pages to bother breaking it up
				    { 
				      for ($counter = 1; $counter <= $lastpage; $counter++)
				      {
				        if ($counter == $page)
				          $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
				        else
				          $pagination.= "<li><a href=\"$targetpage/p_$counter\">$counter</a></li>";         
				      }
				    }
				    elseif($lastpage > 5 + ($adjacents * 2))  //enough pages to hide some
				    {
				      //close to beginning; only hide later pages
				      if($page < 1 + ($adjacents * 2))    
				      {
				        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				        {
				          if ($counter == $page)
				            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
				          else
				            $pagination.= "<li><a href=\"$targetpage/p_$counter\">$counter</a></li>";         
				        }
				        $pagination.= "<li><a href=\"#\">...</a></li>";
				        $pagination.= "<li><a href=\"$targetpage/p_$lpm1\">$lpm1</a></li>";
				        $pagination.= "<li><a href=\"$targetpage/p_$lastpage\">$lastpage</a></li>";   
				      }
				      //in middle; hide some front and some back
				      elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				      {
				        $pagination.= "<li><a href=\"$targetpage/p_1\">1</a></li>";
				        $pagination.= "<li><a href=\"$targetpage/p_2\">2</a></li>";
				        $pagination.= "<li><a href=\"#\">...</a></li>";
				        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				        {
				          if ($counter == $page)
				            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li></li>";
				          else
				            $pagination.= "<li><a href=\"$targetpage/p_$counter\">$counter</a></li>";         
				        }
				        $pagination.= "<li><a href=\"#\">...</a></li>";
				        $pagination.= "<li><a href=\"$targetpage/p_$lpm1\">$lpm1</a></li>";
				        $pagination.= "<li><a href=\"$targetpage/p_$lastpage\">$lastpage</a></li>";   
				      }
				      //close to end; only hide early pages
				      else
				      {
				        $pagination.= "<li><a href=\"$targetpage/p_1\">1</a></li>";
				        $pagination.= "<li><a href=\"$targetpage/p_2\">2</a></li>";
				        $pagination.= "<li><a href=\"#\">...</a></li>";
				        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				        {
				          if ($counter == $page)
				            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
				          else
				            $pagination.= "<li><a href=\"$targetpage/p_$counter\">$counter</a></li>";         
				        }
				      }
				    }
				    
				    //next button
				    if ($page < $counter - 1) 
				      $pagination.= "<li><a href=\"$targetpage/p_$next\">next</a></li>";
				    else
				      $pagination.= "<li class=\"disabled\"><a href=\"#\">next</a></li>";
				  }
				?>
				
				<?php echo $pagination; ?>
						</ul>
					</div>
				</div>
			</div>
		
			<div class="bg-header">
				<img src="/assets/img/flou.jpg" alt="">
			</div>
		</div>
		 
	   <?php 
	}
	
	function showProperty($_value)
	{
		//$_value['data']
		//$_value['gps']
		
		if(isset($_value['data']['img']))
		{
			$allImg = explode('|', $_value['data']['img']);
		}
		else
		{
			$allImg =array();
		}
	?>
	<div class="content">
		<div class="container page-white margin-bottom-2em" >
			<div class="row-fluid" id="holer-content">
				<?php include (__DIR__.'/components/form-visit-request.php')?>
				<article class="col-lg-7 padding-r-l-1em padding-4em" >
					<div class="row-fluid">
						<hgroup class="col-lg-7">
							<input type="hidden" value="<?=$_value['data']['id']?>" id="id_property" /> <!-- important ! -->
							<h4 class="property-type">
									<span class="visuallyhidden">Property type :</span> <i class="icon-home"></i>
							</h4>
							<h2 class="margin-zero lh-100"><?=(isset($_value['data']['address']) ? $_value['data']['address'] : '') ?></h2>
							<h3 class="margin-zero lh-100"><small><?=(isset($_value['data']['address']) ? $_value['data']['address'] : '').' '.(isset($_value['data']['city']) ? ', '.$_value['data']['city'] : '').' '.(isset($_value['data']['state']) && isset($_value['data']['postal_code']) ? ', '.$_value['data']['state'].' '.$_value['data']['postal_code'] : '') ?></small>
							</h3>
						 </hgroup>
						<div class="col-lg-5">
							<h3 class="price margin-top-zero  lh-100">
								<?=(isset($_value['data']['price']) ? '$'.$_value['data']['price'] : '') ?>
							</h3>
							<ul class="no-bullets dotted">
								<li>Maintenance/Common Charges $3,776</li>
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
							    <li data-target="#property-carousel" data-slide-to="1"></li>
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
							<h4 class="margin-top-zero  lh-100">MORE ABOUT THIS PROPERTY :</h4>
							<p>
								LIVE THE TRIBECA LOFT DREAM! A rare opportunity awaits the most discerning buyer to purchase 2 side by side Penthouse Duplex Lofts with interior space totaling over 8,000sf and private wraparound roof terraces totaling approx 4,000sf.
							</p>
						</section>
	
					</div>
				</article>
				<aside class="col-lg-5 padding-r-l-2em padding-4em bg-gray-light property-sidebar" >
					<?php 
					if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_value['like'] == true)
					{?>
						<button id="button_dislike">Dislike</button>
						<button id="button_like" class="hide">Like</button>
					<?php 
					} else if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_value['like'] == false)
					{?>
						<button id="button_like">Like</button>
						<button id="button_dislike" class="hide">Dislike</button>
					<?php 
					}?>
					<h3 class="price margin-top-zero  lh-100">
						<?=(isset($_value['data']['style']) ? $_value['data']['style'] : '') ?>
						<?php 
						if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_value['visitAvailable'] == true)
						{?>
							<a role="button" class="btn btn-info pull-right" data-toggle="modal" href="#modalVisitRequest" id="buttonVisit">Visit available</a>
						<?php 
						}else if($_value['visitAvailable'] == true)
						{?>
							<a role="button" class="btn btn-info pull-right" data-toggle="modal" href="/login.php" id="buttonVisit">Visit available</a>
						<?php 
						}else if($_value['visitAvailable'] == false) //Déjà une demande faite pour ce membre
						{?>
							<a role="button" class="btn btn-info pull-right cancel_request" data-toggle="modal" href="" id="buttonVisit">Cancel Request</a>
						<?php 
						}?>
					</h3>
					<ul class="no-bullets dotted">
					<?php 
					if(isset($_value['data']['bed']) && $_value['data']['bed'] != null)
					{?>
						<li><?=$_value['data']['bed'] ?> Bedrooms</li>
					<?php 
					}?>
					<?php 
					if(isset($_value['data']['bathroom']) && $_value['data']['bathroom'] != null)
					{?>
						<li><?=$_value['data']['bathroom'] ?> bathrooms</li>
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
					  			<li><i class="icon-food"></i>  Restaurants (10)</li>
					  			<li><i class="icon-leaf"></i>  Grocery and Markets (10)</li>
					  			<li><i class="icon-stethoscope"></i>  Health clubs and spas (10)</li>
					  			<li><i class="icon-book"></i> Public School (3)</li>
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
    
?>