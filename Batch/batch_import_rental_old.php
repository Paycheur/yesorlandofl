<?php
//ini_set("memory_limit" , "8048M");

include(dirname(__FILE__).'/../Class/phrets.php');
include(dirname(__FILE__).'/../Inc/require.inc.php');

$connexion2 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'rental\', \'begin\')';
$connexion2->getConnexion()->query($sql);

$day = date('d', time());
$month = date('m', time());
$year = date('Y', time());

recupFichier($day, $month, $year);

$connexion3 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'rental\', \'half\')';
$connexion3->getConnexion()->query($sql);
	
recupDonnees($day, $month, $year);

$connexion4 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'rental\', \'end\')';
$connexion4->getConnexion()->query($sql);

function recupFichier($day, $month, $year)
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
	
	$between = $dateBegin.'-'.$dateEnd;
	
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
	        $file_name = strtolower("data/property_".$name."_".$year."-".$month."-".$day.".csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	
	        $fields_order = array();
	
	        $query = "({$rets_modtimestamp_field}={$between})";
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

function recupDonnees($day, $month, $year)
{
	
	$phrets = new phRETS;
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
    $phrets->Connect($rets_login_url, $rets_username, $rets_password);
    
	$all_fichier = array('property_rental_'.$year.'-'.$month.'-'.$day);
	
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
					$dbData->setFile($year.'-'.$month.'-'.$day);
					$dbData->setActif($actif);
						
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
?>