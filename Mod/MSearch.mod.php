<?php
class MSearch
{

	private $dbData;
	
    public function __construct($valeurs = array())
    {
    	$this->dbData = new BddData();
    }
    
	public function searchForm($style, $city, $beds, $bathroom, $option, $price, $page)
	{
		$n = ($page-1)*6;
		$req = 'SELECT id,type,style,city,address,bed,bathroom,sqft,price,img,postal_code,state,actif,flag_actif FROM data'.
				' WHERE actif = 1';
		if($style != '')
				$req .= ' AND style LIKE \'%'.$style.'%\'';
		if($beds != 0 && $beds != '')
			$req .= ' AND beds = \''.protegeChaine($beds).'\'';
		if($bathroom != 0 && $bathroom != '')
			$req .= ' AND bathroom = \''.protegeChaine($bathroom).'\'';
		if($city != '')
		{
			if(is_array($city))
			{
				$req .=' AND (';
				foreach($city as $c)
				{
					$req .= ' city LIKE \'%'.$c.'%\' OR ';
				}
				$req.='#end;';
				$req = str_replace('OR #end;', '', $req);
				$req.=')';
				
			}
			else
			{
				$req .= ' AND city LIKE \'%'.$city.'%\'';
			}
			
			
		}
		if($price != '')
		{
			$explPrice = explode(',', $price);
			if(count($explPrice) == 2)
			{
				$minPrice = $explPrice[0];
				$maxPrice = $explPrice[1];
				
				$req .= ' AND price BETWEEN \''.protegeChaine($minPrice).'\' AND \''.protegeChaine($maxPrice).'\' ';
			}
		}
		
		if($option != '')
			$req .= ' AND sale_or_lease = \''.protegeChaine($option).'\' ';
		
		$req .= ' LIMIT '.$n.', 6';

		$tabRows =  array();
		$res = $this->dbData->getConnexion()->query($req); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
        return $tabRows;
	}
    
	public function searchLink($style, $city, $id, $page)
	{
		if($id != '')
		{
			$result = $this->dbData->select(array('id' => $id), array(), array(), array('0', '1'));
		}
		else
		{
			$n = ($page-1)*6;
			$where = array('actif' => 1);
			$whereSpe = array();
			if($style != '' && $city != '')
			{
				$whereSpe[0] = array('style', array('LIKE', '%'.$style.'%'));
				$where['city'] = urldecode($city);
			}
			else if($style == '')
			{
				$where['city'] = urldecode($city);
			}
			else if($city == '')
			{
				$whereSpe[0] = array('style', array('LIKE', '%'.$style.'%'));
			}
			$result = $this->dbData->select($where, $whereSpe, array(), array($n, '6'));
		}
			
		
        return $result;
	}
	
	public function countSearchLink($style, $city, $id)
	{
		$where = array('actif' => 1);
		$whereSpe = array();
		$whereSpe[0] = array('style', array('LIKE', '%'.$style.'%'));
		if($style != '' && $city != '' && $id != '')
		{
			$where['city'] = urldecode($city);
			$where['id'] = $id;
		}
		else if($style != '' && $city != '')
		{
			$where['city'] = urldecode($city);
		}

		$result = $this->dbData->selectFunction(array('COUNT', '1'), $where, $whereSpe);
		
        return $result;
	}
	
	public function countSearchForm($style, $city, $beds, $bathroom, $option, $price)
	{
		$req = 'SELECT COUNT(1) value FROM data'.
				' WHERE actif = 1';
		if($style != '')
				$req .= ' AND style LIKE \'%'.$style.'%\'';
		if($beds != 0 && $beds != '')
			$req .= ' AND beds = \''.protegeChaine($beds).'\'';
		if($bathroom != 0 && $bathroom != '')
			$req .= ' AND bathroom = \''.protegeChaine($bathroom).'\'';
		if($city != '')
		{
		
			if(is_array($city))
			{
				$req .=' AND (';
				foreach($city as $c)
				{
					$req .= ' city LIKE \'%'.$c.'%\' OR ';
				}
				$req.='#end;';
				$req = str_replace('OR #end;', '', $req);
				$req.=')';
				
			}
			else
			{
				$req .= ' AND city LIKE \'%'.$city.'%\'';
			}
			
			
		}
		
		if($price != '')
		{
			$explPrice = explode(',', $price);
			if(count($explPrice) == 2)
			{
				$minPrice = $explPrice[0];
				$maxPrice = $explPrice[1];
				
				$req .= ' AND price BETWEEN \''.protegeChaine($minPrice).'\' AND \''.protegeChaine($maxPrice).'\' ';
			}
		}
		
		if($option != '')
			$req .= ' AND sale_or_lease = \''.protegeChaine($option).'\' ';
			
		$tabRows =  array();
		$res = $this->dbData->getConnexion()->query($req);
		$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
		return $tabRows[0]['value'];
	}
	
	
	public function getCoordGPS($adresse='', $coord='')
	{

		$adresses = array();
		
		$url = '';
		if($adresse != '')
		{
			$adresse = urlencode($adresse);
			//$url = 'http://maps.google.com/maps/geo?q=' . $adresse . '&output=xml&oe=utf8&gl=fr&sensor=false&key=' . GMAP_KEY;
			
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . $adresse . '&sensor=false';
		}
		else if($coord != '')
		{	
			$coord = urlencode($coord);
			//$url = 'http://maps.google.com/maps/geo?q=' . $adresse . '&output=xml&oe=utf8&gl=fr&sensor=false&key=' . GMAP_KEY;
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $coord . '&sensor=false';
		}
		
		if($url != '')
		{
			$page = file_get_contents($url);
			$result = json_decode($page, true);
			$code_postal = '';
			$ville = '';
			$adresse_complete = '';;
			$latitude = '';
			$longitude = '';
			
			if($result['status'] == 'OK')
			{
				// Charge les adresses
				
				
				foreach ($result['results'] as $adresseResult)
				{
					foreach($adresseResult['address_components'] as $components)
					{
						
						//if($components['types'][O] == 'street_number')
						if(isset($components['types'][0]) && $components['types'][0] == 'postal_code')
							$code_postal = $components['long_name'];
						
						else if(isset($components['types'][0]) && $components['types'][0] == 'locality')
							$ville = $components['long_name'];
								
					}
					
					$adresse_complete = $adresseResult['formatted_address'];
					
					$latitude = $adresseResult['geometry']['location']['lat'];
					$longitude = $adresseResult['geometry']['location']['lng'];
					$adresses[] = array(
							'adresse_complete' => $adresse_complete,
							'latitude' => $latitude,
							'longitude' => $longitude,
							'code_postal' => $code_postal,
							'ville' => $ville
					);
				}
			}
		}
		return $adresses;
	}
	
	public function getAllDatasCsv($id_property, $type_property)
	{
		
		if($type_property == 'commercial')
			$fichier = 'property_commercial';
		else if($type_property == 'rental')
			$fichier = 'property_rental';
		else if($type_property == 'residential')
			$fichier = 'property_residential';
		else if($type_property == 'vacant_land')
			$fichier = 'property_vacant_land';
			
		if (file_exists(__DIR__.'/../Batch/data/'.$fichier.'.csv') != FALSE) 
		{
			
		    $handle  = file_get_contents(__DIR__.'/../Batch/data/'.$fichier.'.csv') or exit;
		    $handle_row = explode("\n", $handle);
		    $first = true;
		    $array_key = array();
		    $array_donnees = array();
		    foreach ($handle_row as $key => $val) 
		    {
		    	if($val == '') continue;
		    	$row_array = array();
		    	if($first == true)
		       		$row_array = explode(',', str_replace('"', '', $val));
		       	else
		       		$row_array = explode('||,', str_replace('"', '', $val));

		       
	       		if($first == true)
	        	{
			        foreach ($row_array as $key2 => $val2) 
			        {
			        	
			        	$array_key[$val2] = $key2;
			        }
			       
	        	}
	        	else
	        	{
	        		if(trim( str_replace('||', '', $row_array[0])) == $id_property)
	        		{
	        			var_dump($row_array);
	        			exit;
	        		}
	        		else
	        		{
	        			continue;
	        		}
	        	}
	        	
	        	$first = false;
		    }
		}
	        	
//		        if($first == false)
//		        {	
//		        		
//		        	$value_id = '';
//		        	$value_city = '';
//		        	if($fichier == 'property_commercial')
//		        		$value_type='commercial';
//		        	else if($fichier == 'property_rental')
//		        		$value_type = 'rental';
//		        	else if($fichier == 'property_residential')
//		        		$value_type = 'residential';
//		        	else if($fichier == 'property_vacant_land')
//		        		$value_type = 'vacant_land';
//		        		
//		        	$value_style = '';
//		        	$value_bed = '';
//		        	$value_bathroom = '';
//		        	$value_price = '';
//		        	$value_sqft ='';
//		        	$value_address = '';
//		        	$value_img = '';
//		        	$value_state = '';
//		        	$value_postalCode = '';
//		        	$value_sale_or_lease = '';
//					$value_status = '';
//
//				     switch($fichier)
//				     {
//				     	case 'property_commercial':
//				     		$value_id = trim( str_replace('||', '', $row_array[0])); //id
//				     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
//					   		$value_style = trim( str_replace('||', '', $row_array[$array_key[77]])); //property style
//					   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address391
//					   		if(trim( str_replace('||', '', $row_array[$array_key[2308]])) != '')
//					   		{
//					   			$value_price = trim( str_replace('||', '', $row_array[$array_key[2308]])); //lease rate
//					   			$value_sale_or_lease = 'lease';
//					   		}
//					   		else
//					   		{
//					   			$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[176]]))); //list price
//					   			$value_sale_or_lease = 'sale';
//					   		}
//					   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[80]])) ;//lotsize sqft
//					   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
//					   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
//					   		$value_status = trim( str_replace('||', '', $row_array[$array_key[178]])) ;//status
	}
    
}
?>
    