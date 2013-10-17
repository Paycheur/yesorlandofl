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
	
	public function countSearchForm($style, $city, $beds, $bathroom)
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
    
}
?>
    