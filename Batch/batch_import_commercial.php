<?php
//ini_set("memory_limit" , "8048M");
include(dirname(__FILE__).'/../Class/phrets.php');

include(dirname(__FILE__).'/../Inc/require.inc.php');


$connexion2 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'commercial\', \'begin\')';
$connexion2->getConnexion()->query($sql);

recupFichier();

$connexion3 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'commercial\', \'half\')';
$connexion3->getConnexion()->query($sql);

recupDonnees();

$connexion4 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'commercial\', \'end\')';
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
	$property_classes = array("1");
	
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
    
	$all_fichier = array('property_commercial');
	
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
		        	
		        	$value_type='commercial';

		        		
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
			   		$value_style = trim( str_replace('||', '', $row_array[$array_key[77]])); //property style
			   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address391
			   		$lease_rate = trim( str_replace('||', '', $row_array[$array_key[2308]]));
			   		if($lease_rate != '')
			   		{
			   			$value_sqft = trim( str_replace('||', '', $row_array[$array_key[79]])) ;//lotsize sqft
			   			if($lease_rate > 50)
			   			{
			   				$value_price = $lease_rate;
			   			}
			   			else
			   			{
			   				$value_price = ($lease_rate*$value_sqft)/12; //lease rate
			   			}
			   			$value_sale_or_lease = 'lease';
			   			
			   		}
			   		else
			   		{
			   			$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[176]]))); //list price
			   			$value_sqft = trim( str_replace('||', '', $row_array[$array_key[80]])) ;//lotsize sqft
			   			$value_sale_or_lease = 'sale';
			   		}
			   		
			   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
			   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
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
		
			$fichier = 'property_commercial';

			
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
	        			if(strpos($fichier,'property_commercial') !== false)
	        			{
		        			$data['lease_rate'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2308]])), 'lib' => 'Lease Rate');
							$data['property_use'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[86]])), 'lib' => 'Property Use');
							$data['property_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[77]])), 'lib' => 'Property Style');
							$data['sq_ft_gross'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[80]])), 'lib' => 'Sq.Ft. Gross');
							$data['lp_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2763]])), 'lib' => 'LP/SqFt');
							$data['lease_price_per_sf'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2999]])), 'lib' => 'Lease Price per SF');
							$data['net_leasable_sq_ft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[79]])), 'lib' => 'Net Leasable Sq.Ft.');
							$data['total_num_bldg'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[443]])), 'lib' => 'Total Num Bldg');
							$data['floors_number'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[432]])), 'lib' => 'Floors #');
							$data['class_of_space'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2952]])), 'lib' => 'Class of Space');
							$data['lot_size_acres'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2624]])), 'lib' => 'Lot Size [Acres]');
							$data['public_remarks_new'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3187]])), 'lib' => 'Public Remarks New');
							$data['complex_community_name_nccb'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2316]])), 'lib' => 'Complex/Community Name/NCCB');
							$data['zoning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2320]])), 'lib' => 'Zoning');
							$data['taxes'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[104]])), 'lib' => 'Taxes');
							$data['net_operating_income'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[283]])), 'lib' => 'Net Operating Income');
							$data['cam_per_sq_ft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3002]])), 'lib' => 'CAM Per Sq Ft');
							$data['number_of_add_parcels'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2632]])), 'lib' => '# of Add Parcels');
							$data['water_view'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3011]])), 'lib' => 'Water View');
							$data['waterfront_feet'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3022]])), 'lib' => 'Waterfront Feet');
							$data['number_of_hotel_motel_rms'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2644]])), 'lib' => '# of Hotel/Motel Rms');
							$data['number_of_restrooms'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2648]])), 'lib' => '# of Restrooms');
							$data['number_of_offices'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2650]])), 'lib' => '# of Offices');
							$data['warehouse_space_heated'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3118]])), 'lib' => 'Warehouse Space(Heated)');
							$data['warehouse_space_total'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3119]])), 'lib' => 'Warehouse Space(Total)');
							$data['number_of_bays_dock_high'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3120]])), 'lib' => '# of Bays(Dock High)');
							$data['number_of_bays_grade_level'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3121]])), 'lib' => '# of Bays(Grade Level)');
							$data['number_of_restrooms'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2648]])), 'lib' => '# of Restrooms');
							$data['freezer_space_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2654]])), 'lib' => 'Freezer Space Y/N');
							$data['air_conditioning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[487]])), 'lib' => 'Air Conditioning');
							$data['utilities'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[475]])), 'lib' => 'Utilities');
							$data['new_construction'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3084]])), 'lib' => 'New Construction');
							$data['construction_status'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3085]])), 'lib' => 'Construction Status');
							$data['projected_completion_date'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3086]])), 'lib' => 'Projected Completion Date');
							$data['green_site_improvements'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3195]])), 'lib' => 'Green Site Improvements');
							$data['green_water_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3196]])), 'lib' => 'Green Water Features');
							$data['green_energy_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3197]])), 'lib' => 'Green Energy Features');
							$data['financing_terms'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3162]])), 'lib' => 'Financing Terms');
							$data['condo_fees'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3254]])), 'lib' => 'Condo Fees');
							$data['condo_fees_term'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3255]])), 'lib' => 'Condo Fees Term');
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