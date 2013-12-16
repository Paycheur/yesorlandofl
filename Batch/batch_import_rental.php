<?php
//ini_set("memory_limit" , "8048M");

include(dirname(__FILE__).'/../Class/phrets.php');
include(dirname(__FILE__).'/../Inc/require.inc.php');

$connexion2 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'rental\', \'begin\')';
$connexion2->getConnexion()->query($sql);


recupFichier();

$connexion3 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'rental\', \'half\')';
$connexion3->getConnexion()->query($sql);
	
recupDonnees();

$connexion4 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'rental\', \'end\')';
$connexion4->getConnexion()->query($sql);

function recupFichier()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("3");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything

	$dateBegin = date('Y-m-d', strtotime('-1 day'));

	$dateEnd = date('Y-m-d', time());
	

		
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        	
	       
	        $file_name = strtolower("data/property_".$name.".csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	
	        
			$first = true;
			$i=0;
			$h_p = 0;
			$h_s = 0;
			while($i<=23)
			{
				$h_p = $i;
				$i = $i+3;
				if($i > 23)
				{
					$h_s = 0;
				}
				else
				{
					$h_s = $i;
				}
				if(strlen($h_s) == 1)
					$h_s = '0'.$h_s;
				if(strlen($h_p) == 1)
					$h_p = '0'.$h_p;	
				if($i > 23)
				{
					$between = $dateBegin.'T'.$h_p.':00:00-'.$dateEnd.'T'.$h_s.':00:00';
				}
				else
				{
					$between = $dateBegin.'T'.$h_p.':00:00-'.$dateBegin.'T'.$h_s.':00:00';
				}
				
				$fields_order = array();
				
		        $query = "({$rets_modtimestamp_field}={$between})";
		        // run RETS search
		        echo "   + Resource: Property   Class: {$class}   Query: {$query}<br>\n";
		        $search = $rets->SearchQuery("Property", $class, $query, array());
		
		        if ($rets->NumRows($search) > 0) {
		
		                // print filename headers as first line
		                $fields_order = $rets->SearchGetFields($search);
		      		  	if($first == true)
		                {
		                	fputcsv($fh, $fields_order);
		                	$first = false;
		                }
		
		                // process results
		                while ($record = $rets->FetchRow($search)) {
		                        $this_record = array();
		                        foreach ($fields_order as $fo) {
		                                $this_record[] = "||".$record[$fo]."||";
		                        }
		                        fputcsv($fh, $this_record);
		                }
		
		        }
		
		        echo "    + Total found: {$rets->TotalRecordsFound($search)}<br>\n";
		
		        $rets->FreeResult($search);
			}
	        fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
	
}

function recupDonnees()
{
	
	$phrets = new phRETS;
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
    $phrets->Connect($rets_login_url, $rets_username, $rets_password);
    
	$all_fichier = array('property_rental');
	
	$donnees_retour = array();
	foreach($all_fichier as $fichier)
	{
		$tab_donnees_fichier=array();
		if (file_exists(dirname(__FILE__).'/data/'.$fichier.'.csv') != FALSE) 
		{
			
		    $handle  = file_get_contents(dirname(__FILE__).'/data/'.$fichier.'.csv') or exit;
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

		        if($first == false)
		        {	
		        		
		        	$value_id = '';
		        	$value_city = '';

		        	$value_type = 'rental';
		        		
		        	$value_style = '';
		        	$value_bed = '';
		        	$value_bathroom = '';
		        	$value_price = '';
		        	$value_sqft ='';
		        	$value_address = '';
		        	$value_img = '';
		        	$value_state = '';
		        	$value_postalCode = '';
		        	$value_sale_or_lease = '';
					$value_status = '';

				    
			   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
		     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
			   		$value_style = trim( str_replace('||', '', $row_array[$array_key[934]])); //property style
			   		$value_bed = trim( str_replace('||', '', $row_array[$array_key[32]])); //beds
			   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address
			   		$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[2364]]))); //rent price
			   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
			   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
			   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
			   		$value_bathroom = trim( str_replace('||', '', $row_array[$array_key[2294]])); //full bath
			   		$value_sale_or_lease = 'lease';
			   		$value_status = trim( str_replace('||', '', $row_array[$array_key[178]])) ;//status
					   	
				    
				    if($value_status == 'Sold' || $value_status == '' || $value_price == 0)
				    	$actif = 0;
				    else
				    	$actif=1;
				    
				    $recup_img = true;
				    $dbData = new BddData();
				    $rows = $dbData->select(array('id' => $value_id, 'type' => $value_type));
				    if(count($rows) > 0)
				    {
				    	$dbData->load($rows[0]);
				    	if($dbData->getImg() != null && $dbData->getImg() != '')
				    	{
				    		$recup_img = false;
				    		$value_img = $dbData->getImg();
				    	}
				    }

				    if($recup_img == true)
				    {
				    	
			        	$photos = $phrets->GetObject("Property", "Photo", $value_id, "*", 1);
			        	var_dump($photos);
			        	if(count($photos) > 0)
			        	{
							foreach ($photos as $photo) {
								if(!isset($photo['Location'])) continue;
								
								$value_img .= $photo['Location'].'|';
							        
							}
			        	}
						if($value_img != '')
						{
							$value_img .= '#end';
							$value_img = str_replace('|#end', '', $value_img);
						}
				    }

					$json_csv = getAllDatasCsv($value_id, $value_type);
			
					$dbData = new BddData();
					$dbData->setId($value_id);
					$dbData->setType($value_type);
					$dbData->setCity($value_city);
					$dbData->setStyle($value_style);
					$dbData->setBed($value_bed);
					$dbData->setBathroom($value_bathroom);
					$dbData->setPrice($value_price);
					$dbData->setSqft($value_sqft);
					$dbData->setAddress($value_address);
					$dbData->setImg($value_img);
					$dbData->setState($value_state);
					$dbData->setPostalCode($value_postalCode);
					$dbData->setSaleOrLease($value_sale_or_lease);
					$dbData->setStatus($value_status);
					$dbData->setActif($actif);
					$dbData->setJsonData(json_encode($json_csv));
					$dbData->insert('REPLACE');
				    
					var_dump('['.$value_type.'] '.$value_id.' : '.$value_status);
		        }
		        else
		        {
		        	 $first = false;
		        }
		    }
		   
	    }

	}


}

function getAllDatasCsv($id_property, $type_property)
	{
		
		$data = array();
		
			$fichier = 'property_rental';
			
		if (file_exists(dirname(__FILE__).'/data/'.$fichier.'.csv') != FALSE) 
		{
			
		    $handle  = file_get_contents(dirname(__FILE__).'/data/'.$fichier.'.csv') or exit;
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
	        			if(strpos($fichier,'property_rental') !== false)
	        			{
	        				$data['property_description'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2819]])), 'lib' => 'Property Description');
							$data['property_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1349]])), 'lib' => 'Property Style');
							$data['architectural_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1716]])), 'lib' => 'Architectural Style');
							$data['beds'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[32]])), 'lib' => 'Beds');
							$data['full_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2294]])), 'lib' => 'Full Baths');
							$data['half_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2296]])), 'lib' => 'Half Baths');
							$data['sq_ft_heated'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2346]])), 'lib' => 'Sq Ft Heated');
							$data['lot_size'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2362]])), 'lib' => 'Lot Size');
							$data['lp_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2763]])), 'lib' => 'LP/SqFt');
							$data['year_built'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[55]])), 'lib' => 'Year Built');
							$data['garage_carport'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2805]])), 'lib' => 'Garage/Carport');
							$data['annual_rent'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3211]])), 'lib' => 'Annual Rent');
							$data['seasonal_rent'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3213]])), 'lib' => 'Seasonal Rent');
							$data['off_season_rent'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3214]])), 'lib' => 'Off Season Rent');
							$data['weekly_rent'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3215]])), 'lib' => 'Weekly Rent');
							$data['application_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[927]])), 'lib' => 'Application Fee');
							$data['max_pet_weight'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1055]])), 'lib' => 'Max Pet Weight');
							$data['minimum_days_leased'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1117]])), 'lib' => 'Minimum Days Leased');
							$data['pet_deposit'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1213]])), 'lib' => 'Pet Deposit');
							$data['pet_fee_non_refundable'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1215]])), 'lib' => 'Pet Fee (Non-Refundable)');
							$data['security_deposit'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1231]])), 'lib' => 'Security Deposit');
							$data['long_term_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1248]])), 'lib' => 'Long Term Y/N');
							$data['association_approval_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3219]])), 'lib' => 'Association Approval Fee');
							$data['additional_applicant_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3220]])), 'lib' => 'Additional Applicant Fee');
							$data['furnishings'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3224]])), 'lib' => 'Furnishings');
							$data['weeks_available_2013'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3228]])), 'lib' => 'Weeks Available 2013');
							$data['master_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1466]])), 'lib' => 'Master Bedroom (Approx.)');
							$data['2nd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1495]])), 'lib' => '2nd Bedroom (Approx.)');
							$data['3rd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1514]])), 'lib' => '3rd Bedroom (Approx.)');
							$data['4th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1518]])), 'lib' => '4th Bedroom (Approx.)');
							$data['5th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1522]])), 'lib' => '5th Bedroom (Approx.)');
							$data['master_bath_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1724]])), 'lib' => 'Master Bath Features');
							$data['kitchen_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1727]])), 'lib' => 'Kitchen Features');
							$data['kitchen_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1426]])), 'lib' => 'Kitchen (Approx.)');
							$data['great_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3021]])), 'lib' => 'Great Room (Approx.)');
							$data['family_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1405]])), 'lib' => 'Family Room (Approx.)');
							$data['living_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1415]])), 'lib' => 'Living Room (Approx.)');
							$data['dinette_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1384]])), 'lib' => 'Dinette (Approx.)');
							$data['bonus_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1354]])), 'lib' => 'Bonus Room (Approx.)');
							$data['studio_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2945]])), 'lib' => 'Studio Dimensions');
							$data['study_den_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3077]])), 'lib' => 'Study/Den Dimensions');
							$data['balcony_porch_lanai_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2789]])), 'lib' => 'Balcony/Porch/Lanai (Approx)');
							$data['interior_layout'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1725]])), 'lib' => 'Interior Layout');
							$data['interior_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1726]])), 'lib' => 'Interior Features');
							$data['architectural_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1716]])), 'lib' => 'Architectural Style');
							$data['floor_covering'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1729]])), 'lib' => 'Floor Covering');
							$data['roof'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1735]])), 'lib' => 'Roof');
							$data['foundation'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1739]])), 'lib' => 'Foundation');
							$data['exterior_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1734]])), 'lib' => 'Exterior Features');
							$data['lot_size_acres'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2624]])), 'lib' => 'Lot Size [Acres]');
							$data['lot_size_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2622]])), 'lib' => 'Lot Size [SqFt]');
							$data['lot_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2322]])), 'lib' => 'Lot Dimensions');
							$data['total_acreage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2328]])), 'lib' => 'Total Acreage');
							$data['garage_carport'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2805]])), 'lib' => 'Garage/Carport');
							$data['garage_features	character'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1736]])), 'lib' => 'Garage Features	Character');
							$data['air_conditioning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1732]])), 'lib' => 'Air Conditioning');
							$data['heating_and_fuel'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1731]])), 'lib' => 'Heating and Fuel');
							$data['fireplace_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2801]])), 'lib' => 'Fireplace Y/N');
							$data['fireplace_description'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1723]])), 'lib' => 'Fireplace Description');
							$data['utilities'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1720]])), 'lib' => 'Utilities');
							$data['appliances_included'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1728]])), 'lib' => 'Appliances Included');
							$data['pool'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3186]])), 'lib' => 'Pool');
							$data['pool_type'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1737]])), 'lib' => 'Pool Type');
							$data['pool_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3233]])), 'lib' => 'Pool Dimensions');
							$data['water_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2350]])), 'lib' => 'Water Name');
							$data['water_view_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3064]])), 'lib' => 'Water View Y/N');
							$data['water_frontage_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3065]])), 'lib' => 'Water Frontage Y/N');
							$data['water_frontage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3067]])), 'lib' => 'Water Frontage');
							$data['water_access'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3068]])), 'lib' => 'Water Access');
							$data['waterfront_feet'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3022]])), 'lib' => 'Waterfront Feet');
							$data['elementary_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1397]])), 'lib' => 'Elementary School');
							$data['middle_or_junior_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1425]])), 'lib' => 'Middle or Junior School');
							$data['high_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1420]])), 'lib' => 'High School');
							$data['community_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1743]])), 'lib' => 'Community Features');
							$data['flood_zone_code'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3148]])), 'lib' => 'Flood Zone Code');
							$data['location'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1718]])), 'lib' => 'Location');
							$data['pets_allowed_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3075]])), 'lib' => 'Pets Allowed Y/N');
							$data['green_certifications'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3015]])), 'lib' => 'Green Certifications');
	        			}
	        			
						return $data;
	        		}
	        		else
	        		{
	        			continue;
	        		}
	        	}
	        	
	        	$first = false;
		    }
		}

		return $data;
	}
?>