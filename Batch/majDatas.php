<?php
include(__DIR__.'/../Class/phrets.php');
include(__DIR__.'/../Inc/require.inc.php');


//recupFichier();
$rep = recupDonnees();
//var_dump($rep);

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
	$property_classes = array("1","3","4","5");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$previous_start_time = "2013-08-22T00:00:00";
	
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
	        $fh = fopen(__DIR__.'/'.$file_name, "w+");
	
	        $fields_order = array();
	
	        $query = "({$rets_modtimestamp_field}={$previous_start_time}+)";
	        // run RETS search
	        echo "   + Resource: Property   Class: {$class}   Query: {$query}<br>\n";
	        $search = $rets->SearchQuery("Property", $class, $query, array());
	
	        if ($rets->NumRows($search) > 0) {
	
	                // print filename headers as first line
	                $fields_order = $rets->SearchGetFields($search);
	                fputcsv($fh, $fields_order);
	
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
    
	$all_fichier = array('property_commercial', 'property_rental', 'property_residential', 'property_vacant_land');
	
	$donnees_retour = array();
	foreach($all_fichier as $fichier)
	{
		if($fichier != 'property_commercial') continue;
		$tab_donnees_fichier=array();
		if (file_exists(__DIR__.'/data/'.$fichier.'.csv') != FALSE) 
		{
			
		    $handle  = file_get_contents(__DIR__.'/data/'.$fichier.'.csv') or exit;
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
		        	if($fichier == 'property_commercial')
		        		$value_type='commercial';
		        	else if($fichier == 'property_rental')
		        		$value_type = 'rental';
		        	else if($fichier == 'property_residential')
		        		$value_type = 'residential';
		        	else if($fichier == 'property_vacant_land')
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

				     switch($fichier)
				     {
				     	case 'property_commercial':
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
					   			
					   			echo '['.$value_id.'] => 	'.$lease_rate.' | $ '.number_format($value_price,2);
					   			echo "\n";
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
					   		break;
//				     	case 'property_income':
//				     		$value_id = trim( str_replace('||', '', $row_array[0])); //id
//				     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
//					   		$value_style = trim( str_replace('||', '', $row_array[$array_key[519]])); //property style
//					   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address
//					   		$value_price = trim( str_replace('||', '', $row_array[$array_key[176]])); //list price
//					   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
//					   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
//					   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
//					   		break;
					   	case 'property_rental':
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
					   		break;
					   	case 'property_residential':
					   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
				     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
					   		$value_style = trim( str_replace('||', '', $row_array[$array_key[1349]])); //property style
					   		$value_bed = trim( str_replace('||', '', $row_array[$array_key[32]])); //beds
					   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address
					   		$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[176]]))); //list price
					   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2346]])); //lotsize sqft
					   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
					   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
					   		$value_bathroom = trim( str_replace('||', '', $row_array[$array_key[2294]])); //full bath
					   		$value_sale_or_lease = 'sale';
					   		$value_status = trim( str_replace('||', '', $row_array[$array_key[178]])) ;//status
					   		break;
					   	case 'property_vacant_land':
					   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
				     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
					   		$value_style = trim( str_replace('||', '', $row_array[$array_key[1764]])); //property style
					   		$value_address = trim( str_replace('||', '', $row_array[$array_key[165]])).' '.trim( str_replace('||', '', $row_array[$array_key[421]])).' '.trim( str_replace('||', '', $row_array[$array_key[2306]])); //number, street
					   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
					   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
					   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
					   		if(trim( str_replace('||', '', $row_array[$array_key[2308]])) != '')
					   		{
					   			$value_price = trim( str_replace('||', '', $row_array[$array_key[2308]])); //lease rate
					   			$value_sale_or_lease = 'lease';
					   		}
					   		else
					   		{
					   			$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[176]]))); //list price
					   			$value_sale_or_lease = 'sale';
					   		}
					   		$value_status = trim( str_replace('||', '', $row_array[$array_key[178]])) ;//status
					   		break;
					   		
				     }
				    
				     continue;
				     
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
						foreach ($photos as $photo) {
							if(!isset($photo['Location'])) continue;
							
							$value_img .= $photo['Location'].'|';
						        
						}
						if($value_img != '')
						{
							$value_img .= '#end';
							$value_img = str_replace('|#end', '', $value_img);
						}
				    }

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
					$dbData->setFlagActif(1);
					$dbData->setSaleOrLease($value_sale_or_lease);
					$dbData->setStatus($value_status);
					if($value_price == 0)
						$dbData->setActif(0);
					else
						$dbData->setActif(1);
						
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

	return 'UPDATE DATA DONE';
}