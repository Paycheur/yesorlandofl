<?php
class MSearch
{

	private $dbData;
	
    public function __construct($valeurs = array())
    {
    	$this->dbData = new BddData();
    }
    
	public function searchForm($style, $city, $beds, $bathroom, $page)
	{
		$n = ($page-1)*6;
		$where = array('actif' => 1);
		$whereSpe = array();
		if($style != '')
			$whereSpe[0] = array('style', array('LIKE', '%'.$style.'%'));
		if($beds != 0 && $beds != '')
			$where['beds'] = $beds;
		if($bathroom != 0 && $bathroom != '')
			$where['bathroom'] = $bathroom;
		if($city != '')
			$whereSpe[1] = array('city', array('LIKE', '%'.$city.'%'));
			
		$result = $this->dbData->select($where, $whereSpe, array(), array($n, '6'));
        return $result;
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
	
	public function countSearchForm($style, $location, $beds, $bathroom)
	{
		$where = array('actif' => 1);
		if($style != '')
			$whereSpe[0] = array('style', array('LIKE', '%'.$style.'%'));
		if($beds != 0 && $beds != '')
			$where['beds'] = $beds;
		if($bathroom != 0 && $bathroom != '')
			$where['bathroom'] = $bathroom;
		if($location != '')
			$whereSpe[1] = array('city', array('LIKE', '%'.$location.'%'));
			
		$result = $this->dbData->selectFunction(array('COUNT', '1'), $where, $whereSpe);
		
        return $result;
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
    
}
?>
    