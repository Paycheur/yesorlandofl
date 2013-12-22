<?php

header ('Content-Type:text/html; charset=UTF-8');
//define ('ICONE_PAGE', '../Img/bdd.png');
//define ('CSS_PAGE', '../Css/index.css');
define ('JS_PAGE', '/Assets/js/app/search.js');
define ('JS_PAGE_2', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCfUWMe6dpjGdY0-uflHdscZgUpH9m7yj8&sensor=true');

define ('CONTROLER', 'page_search.php');

require ('Inc/require.inc.php');

$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';

//Variables
$page['error']='';
$page['confirmation']='';

// Contr�leur
switch ($EX)
{
  case 'home'   : home ();   break;
  case 'searchLink'   : searchLink ();   break;
  case 'searchAJAX'   : searchAJAX();   exit;
  case 'ajaxSendVisitRequest' : ajaxSendVisitRequest(); exit;
  case 'ajaxCancelVisitRequest' : ajaxCancelVisitRequest(); exit;
  case 'ajaxLikeProperty' : ajaxLikeProperty(); exit;
  case 'ajaxDislikeProperty' : ajaxDislikeProperty(); exit;
}

/**
 * R�cup�ration de la mise en page
 */
require ('View/inc/main.view.php');

/********* Fonctions de contr�le *********/

/**
 * Affiche le formulaire et le tableau
 *
 * @return none
 */


function home()
{
    global $page;

    $tab = array();

    	if(isset($_GET['option']))
			$option = urlencode($_GET['option']);
		else
			$option = '';

		if(isset($_GET['price']) && ($option == 'sale' || $option == '') )
			$price = urldecode($_GET['price_sale']);
		else if(isset($_GET['price']) && $option == 'lease')
			$price = urldecode($_GET['price_lease']);
		else
			$price = '';

	    if(isset($_GET['style']))
			$style = $_GET['style'];
		else
			$style = '';

		if(isset($_GET['city']))
			$location = $_GET['city'];
		else
			$location = '';

		if(isset($_GET['beds']))
			$beds = $_GET['beds'];
		else
			$beds = '';

		if(isset($_GET['bathroom']))
			$bathroom = $_GET['bathroom'];
		else
			$bathroom = '';

		if(isset($_GET['page']))
			$p = $_GET['page'];
		else
			$p = 1;


		$search = new MSearch();
		$datas = $search->searchForm($style, $location, $beds, $bathroom, $option, $price, $p);

		$nbResultMax = $search->countSearchForm($style, $location, $beds, $bathroom, $option, $price);

		if($p == 1 && $nbResultMax > 0)
		{
			if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']))
			{

				$memberSearch = new BddMemberSearch();
				$memberSearch->setBathroom($bathroom);
				$memberSearch->setBed($beds);
				$memberSearch->setCity($location);
				$memberSearch->setIdMember($_SESSION['user']['id']);
				$memberSearch->setPrice($price);
				$memberSearch->setStyle($style);
				$memberSearch->setDate(date('Y-m-d H:i:s', time()));
				$memberSearch->setNbResults($nbResultMax);
				$memberSearch->insert('REPLACE');
			}
		}

		$tab['nbResults'] = $nbResultMax;
		$tab['results'] = $datas;

    $page['title'] = 'Search Engine';
    $page['class'] = 'VSearch';
    $page['method'] = 'homeSearch';
    $page['arg'] = $tab;

}

function searchLink()
{
    global $page;

    $style = '';
    $city = '';
    $id = '';
    $p = 1;

    if(isset($_GET['style']))
    {
    	$style = $_GET['style'];
    }
    if(isset($_GET['city']))
    {
    	$city = $_GET['city'];
    }
    if(isset($_GET['id']))
    {
    	$id = $_GET['id'];
    }
    if(isset($_GET['page']))
    {
    	$p = $_GET['page'];
    }

    $search = new MSearch();
	$datas = $search->searchLink($style, $city, $id, $p);
	$nbResult = $search->countSearchLink($style, $city, $id);

	$tab = array();
	$tab['results'] = $datas;
	$tab['nbResult'] = $nbResult;

	if($id != '')
	{
		if(count($datas) > 0)
		{

			afficherProperty($tab['results']);

		}
		else
		{
			$page['title'] = 'Search Engine';
		    $page['class'] = 'VSearch';
		    $page['method'] = 'homeSearch';
		    $page['arg'] = $tab;
		}
	}
	else
	{

	    $page['title'] = 'Search Engine';
	    $page['class'] = 'VSearch';
	    $page['method'] = 'homeSearch';
	    $page['arg'] = $tab;
	}

}

function searchAJAX() //JSON
{
    global $page;

    if(isset($_GET['style']))
		$style = $_GET['style'];
	else
		$style = '';

	if(isset($_GET['option']))
		$option = urlencode($_GET['option']);
	else
		$option = '';


	if(isset($_GET['price']) && ($option == 'sale' || $option == '') )
		$price = urldecode($_GET['price_sale']);
	else if(isset($_GET['price']) && $option == 'lease')
		$price = urldecode($_GET['price_lease']);
	else
		$price = '';

	if(isset($_GET['city']))
		$location = $_GET['city'];
	else
		$location = '';

	if(isset($_GET['beds']))
		$beds = $_GET['beds'];
	else
		$beds = '';

	if(isset($_GET['bathroom']))
		$bathroom = $_GET['bathroom'];
	else
		$bathroom = '';

	if(isset($_GET['page']))
		$p = $_GET['page'];
	else
		$p = '';

	$search = new MSearch();
	if(isset($_GET['action']) && $_GET['action'] == 'count')
	{
		$nbResultMax = $search->countSearchForm($style, $location, $beds, $bathroom, $option, $price);
		$tab['nbResults'] = $nbResultMax;
		echo json_encode($tab);
	}
	else if(!isset($_GET['action']))
	{
		$datas = $search->searchForm($style, $location, $beds, $bathroom, $option, $price, $p);
		$nbResultMax = $search->countSearchForm($style, $location, $beds, $bathroom, $option, $price);



		if($p == 1 && $nbResultMax > 0)
		{
			if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']))
			{

				$memberSearch = new BddMemberSearch();
				$memberSearch->setBathroom($bathroom);
				$memberSearch->setBed($beds);
				$memberSearch->setCity(json_encode($location));
				$memberSearch->setIdMember($_SESSION['user']['id']);
				$memberSearch->setPrice($price);
				$memberSearch->setStyle(json_encode($style));
				$memberSearch->setDate(date('Y-m-d H:i:s', time()));
				$memberSearch->setNbResults($nbResultMax);
				$memberSearch->insert('REPLACE');
			}
		}
		$tab = array();
		$tab['nbResults'] = $nbResultMax;
		$datas2 = $datas;
		foreach($datas as $k => $t)
		{
			$url = format_url($t['style'].'-'.$t['address']);
			$datas2[$k]['url'] = $url;
		}
		$tab['results'] = $datas2;

	    echo json_encode($tab);
	}
}

function afficherProperty($data)
{
	global $page;

    $tab = array();

	if(isset($_SESSION['user']['id']))
	{
		$propertieViewed = new BddPropertiesViewed();
		$propertieViewed->setDate(date('Y-m-d H:i:s', time()));
		$propertieViewed->setIdMember($_SESSION['user']['id']);
		$propertieViewed->setIdProperty($data[0]['id']);
		$propertieViewed->insert('REPLACE');
	}
	
    $search = new MSearch();
  	$tabGps = $search->getCoordGPS($data[0]['address'].', '.$data[0]['city'].', '.$data[0]['state'].' '.$data[0]['postal_code']);

  	$tab['proximity'] = array();

 	if(count($tabGps) > 0 && isset($tabGps[0]['latitude']) && isset($tabGps[0]['longitude']))
  	{
  		if($data[0]['type'] == 'commercial')
  		{
  		 	$retail = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$tabGps[0]['latitude'].','.$tabGps[0]['longitude'].'&types=book_store|electronics_store|florist|clothing_store|convenience_store|department_store|shopping_mall|shoe_store|hardware_store|furniture_store|pet_store|hair_care&rankby=distance&sensor=false&key=AIzaSyCfUWMe6dpjGdY0-uflHdscZgUpH9m7yj8');
	  		 $retail = json_decode($retail, true);
	  		 if(isset($retail['results']))
	  		 {
	  		 	$i=0;
	  		 	$tabResults = array();
	  		 	foreach($retail['results'] as $r)
	  		 	{
	  		 		$tabResults[] = $r;
	  		 		$i++;
	  		 		if($i==5)
	  		 			break;
	  		 	}
	  		 	$tab['proximity']['retail'] = $tabResults;
	  		 }
  		}
  		else
  		{
  			$school = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$tabGps[0]['latitude'].','.$tabGps[0]['longitude'].'&types=school|university&rankby=distance&sensor=false&key=AIzaSyCfUWMe6dpjGdY0-uflHdscZgUpH9m7yj8');
	  		$school = json_decode($school, true);
	  		if(isset($school['results']))
	  		{
	  			$i=0;
	  		 	$tabResults = array();
	  		 	foreach($school['results'] as $r)
	  		 	{
	  		 		$tabResults[] = $r;
	  		 		$i++;
	  		 		if($i==5)
	  		 			break;
	  		 	}
	  		 	
	  		 	$tab['proximity']['school'] = $tabResults;
	  		}
	  			
  		}
  		 $food = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$tabGps[0]['latitude'].','.$tabGps[0]['longitude'].'&types=cafe|bar|bakery|restaurant|food|grocery_or_supermarket&rankby=distance&sensor=false&key=AIzaSyCfUWMe6dpjGdY0-uflHdscZgUpH9m7yj8');
  		 $food = json_decode($food, true);
  		 if(isset($food['results']))
  		 {
  		 	$i=0;
  		 	$tabResults = array();
  		 	foreach($food['results'] as $r)
  		 	{
  		 		$tabResults[] = $r;
  		 		$i++;
  		 		if($i==5)
  		 			break;
  		 	}
  		 	$tab['proximity']['food'] = $tabResults;
  		 }

  		
  		 	
  		 $amenities = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$tabGps[0]['latitude'].','.$tabGps[0]['longitude'].'&types=atm|gym|post_office|bank|gas_station|fire_station|police|library&rankby=distance&sensor=false&key=AIzaSyCfUWMe6dpjGdY0-uflHdscZgUpH9m7yj8');
  		 $amenities = json_decode($amenities, true);
  		 if(isset($amenities['results']))
  		 {
  			 $i=0;
  		 	$tabResults = array();
  		 	foreach($amenities['results'] as $r)
  		 	{
  		 		$tabResults[] = $r;
  		 		$i++;
  		 		if($i==5)
  		 			break;
  		 	}
  		 	
  		 	$tab['proximity']['amenities'] = $tabResults;
  		 }
  		 	
  		 	
  		 $transportation = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$tabGps[0]['latitude'].','.$tabGps[0]['longitude'].'&types=airport|bus_station|car_rental|taxi_stand|train_station&rankby=distance&sensor=false&key=AIzaSyCfUWMe6dpjGdY0-uflHdscZgUpH9m7yj8');
  		 $transportation = json_decode($transportation, true);

  		 if(isset($transportation['results']))
  		 {
  		  	$i=0;
  		 	$tabResults = array();
  		 	foreach($transportation['results'] as $r)
  		 	{
  		 		$tabResults[] = $r;
  		 		$i++;
  		 		if($i==5)
  		 			break;
  		 	}
  		 	
  		 	$tab['proximity']['transportation'] = $tabResults;
  		 }

  		 $health = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$tabGps[0]['latitude'].','.$tabGps[0]['longitude'].'&types=dentist|hospital|doctor|pharmacy|beauty_salon|spa&rankby=distance&sensor=false&key=AIzaSyCfUWMe6dpjGdY0-uflHdscZgUpH9m7yj8');
  		 $health = json_decode($health, true);
  		 if(isset($health['results']))
  		 {
  		 	 $i=0;
  		 	$tabResults = array();
  		 	foreach($health['results'] as $r)
  		 	{
  		 		$tabResults[] = $r;
  		 		$i++;
  		 		if($i==5)
  		 			break;
  		 	}
  		 	
  		 	$tab['proximity']['health'] = $tabResults;
  		 }

  		
  	}


  	if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']))
  	{
	  	$visitRequest = new BddVisitRequest();
	  	$rows = $visitRequest->select(array('id_property' => $data[0]['id'], 'id_member' => $_SESSION['user']['id']));
	  	if(count($rows) > 0)
	  	{
	  		$tab['visitAvailable'] = false;
	  	}
	  	else
	  	{
	  		$tab['visitAvailable'] = true;
	  	}

	  	$bddLike = new BddFavorite();
	  	$rows = $bddLike->select(array('id_property' => $data[0]['id'], 'id_member' => $_SESSION['user']['id']));
  		if(count($rows) > 0)
	  	{
	  		$tab['like'] = true;
	  	}
	  	else
	  	{
	  		$tab['like'] = false;
	  	}

  	}
  	else
  	{
  		$tab['visitAvailable'] = true;
  		$tab['like'] = false;
  	}

  	$allDatasCsv = $search->getAllDatasCsv($data[0]['id'], $data[0]['type'], $data[0]['file']);

	if(isset($tabGps[0]))
  		$tab['gps'] = $tabGps[0];
    $tab['results'] = $data[0];
    $tab['dataCsv'] = $allDatasCsv;

	if($data[0]['type'] == 'residential')
	{
	    $page['title'] = 'Residential - '.$data[0]['address'].', '.$data[0]['city'].', '.$data[0]['state'].' '.$data[0]['postal_code'];
	    $page['class'] = 'VPropertyResidential';
	}
	else if($data[0]['type'] == 'commercial')
	{
	    $page['title'] = 'Commercial - '.$data[0]['address'].', '.$data[0]['city'].', '.$data[0]['state'].' '.$data[0]['postal_code'];
	    $page['class'] = 'VPropertyCommercial';
	}
	else if($data[0]['type'] == 'rental')
	{
	    $page['title'] = 'Rental - '.$data[0]['address'].', '.$data[0]['city'].', '.$data[0]['state'].' '.$data[0]['postal_code'];
	    $page['class'] = 'VPropertyRental';
	}
	else if($data[0]['type'] == 'vacant_land')
	{
	    $page['title'] = 'Vacant Land - '.$data[0]['address'].', '.$data[0]['city'].', '.$data[0]['state'].' '.$data[0]['postal_code'];
	    $page['class'] = 'VPropertyVacantLand';
	}
	
    $page['method'] = 'showProperty';
    $page['arg'] = $tab;
}

function ajaxSendVisitRequest() //return json
{
	$statut = false;
	if(isset($_GET['visit_date']) && isset($_GET['visit_hour']) && isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && isset($_GET['id_property']))
	{
		$date = $_GET['visit_date'];
		$hour = $_GET['visit_hour'];
		$id = $_GET['id_property'];

		$visitRequest = new BddVisitRequest();
		$visitRequest->setDate(date('Y-m-d', strtotime($date)));
		$visitRequest->setHour($hour);
		$visitRequest->setIdProperty($id);
		$visitRequest->setDateInsert(date('Y-m-d H:i:s', time()));
		$visitRequest->setIdMember($_SESSION['user']['id']);
		$visitRequest->insert();
		$statut = true;
	}

	print json_encode($statut);


}

function ajaxCancelVisitRequest()
{
	$statut = false;
	if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && isset($_GET['id_property']))
	{
		$visitRequest = new BddVisitRequest();
		$rows = $visitRequest->select(array('id_property' => $_GET['id_property'], 'id_member' => $_SESSION['user']['id']));
	  	if(count($rows) > 0)
	  	{
	  		$visitRequest->load($rows[0]);
	  		$visitRequest->delete();
	  		$statut = true;
	  	}
	}

	print json_encode($statut);

}

function ajaxLikeProperty()
{
	$statut = false;
	if(isset($_GET['id_property']) && !empty($_GET['id_property']) && isset($_SESSION['user']['id']))
	{
		$bddLike = new BddFavorite();
		$bddLike->setIdMember($_SESSION['user']['id']);
		$bddLike->setIdProperty($_GET['id_property']);
		$bddLike->insert('REPLACE');

		$statut = true;
	}

	print json_encode($statut);
}

function ajaxDislikeProperty()
{
	$statut = false;
	if(isset($_GET['id_property']) && !empty($_GET['id_property']) && isset($_SESSION['user']['id']))
	{
		$bddLike = new BddFavorite();
		$bddLike->setIdMember($_SESSION['user']['id']);
		$bddLike->setIdProperty($_GET['id_property']);
		$bddLike->delete();

		$statut = true;
	}

	print json_encode($statut);
}
?>