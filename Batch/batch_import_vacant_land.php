<?php
//ini_set("memory_limit" , "8048M");

include(dirname(__FILE__).'/../Class/phrets.php');

include(dirname(__FILE__).'/../Inc/require.inc.php');



$connexion2 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'vacant_land\', \'begin\')';
$connexion2->getConnexion()->query($sql);


recupFichier();

$connexion3 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'vacant_land\', \'half\')';
$connexion3->getConnexion()->query($sql);
	
recupDonnees();

$connexion4 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'vacant_land\', \'end\')';
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
	$property_classes = array("5");
	
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
    
	$all_fichier = array('property_vacant_land');
	
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

		        	$value_type = 'vacant_land';
		        		
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
			   		$value_style = trim( str_replace('||', '', $row_array[$array_key[1764]])); //property style
			   		$value_address = trim( str_replace('||', '', $row_array[$array_key[165]])).' '.trim( str_replace('||', '', $row_array[$array_key[421]])).' '.trim( str_replace('||', '', $row_array[$array_key[2306]])); //number, street
			   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
			   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
			   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
			   		$lease_rate = trim( str_replace('||', '', $row_array[$array_key[2308]]));
			   		if($lease_rate!= '')
			   		{
			   			$value_price = $lease_rate; //lease rate
			   			$value_sale_or_lease = 'lease';
			   		}
			   		else
			   		{
			   			$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[176]]))); //list price
			   			$value_sale_or_lease = 'sale';
			   		}
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

			$fichier = 'property_vacant_land';
			
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
	        			if(strpos($fichier,'property_vacant_land') !== false)
	        			{
	        				$data['property_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1764]])), 'lib' => 'Property Style');
							$data['list_price'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[176]])), 'lib' => 'List Price');
							$data['lease_rate'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2308]])), 'lib' => 'Lease Rate');
							$data['public_remarks_new'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3187]])), 'lib' => 'Public Remarks New');
							$data['zoning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2320]])), 'lib' => 'Zoning');
							$data['lot_size_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2622]])), 'lib' => 'Lot Size [SqFt]');
							$data['lot_size_acres'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2624]])), 'lib' => 'Lot Size [Acres]');
							$data['lot_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2322]])), 'lib' => 'Lot Dimensions');
							$data['total_acreage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2328]])), 'lib' => 'Total Acreage');
							$data['site_improvements'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2678]])), 'lib' => 'Site Improvements');
							$data['fences'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2134]])), 'lib' => 'Fences');
							$data['taxes'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1790]])), 'lib' => 'Taxes');
							$data['hoa_comm_assn'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3074]])), 'lib' => 'HOA/Comm Assn');
							$data['hoa_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1833]])), 'lib' => 'HOA Fee');
							$data['hoa_payment_schedule'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2901]])), 'lib' => 'HOA Payment Schedule');
							$data['annual_cdd_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2793]])), 'lib' => 'Annual CDD Fee');
							$data['financing_available'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2124]])), 'lib' => 'Financing Available');
							$data['water_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2350]])), 'lib' => 'Water Name');
							$data['water_frontage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3067]])), 'lib' => 'Water Frontage');
							$data['water_access'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3068]])), 'lib' => 'Water Access');
							$data['waterfront_feet'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3022]])), 'lib' => 'Waterfront Feet');
							$data['driving_directions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2300]])), 'lib' => 'Driving Directions');
							$data['office_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2368]])), 'lib' => 'Office Name');
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