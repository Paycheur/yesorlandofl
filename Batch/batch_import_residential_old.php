<?php
ini_set("memory_limit" , "32000M");
include(dirname(__FILE__).'/../Class/phrets.php');
include(dirname(__FILE__).'/../Inc/require.inc.php');

$connexion2 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'residential\', \'begin\')';
$connexion2->getConnexion()->query($sql);

$anneeCourante = date('Y', time());

recupFichier($anneeCourante);

$connexion3 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'residential\', \'half\')';
$connexion3->getConnexion()->query($sql);
	
recupDonnees();

$connexion4 = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$sql = 'INSERT INTO import (date, type, text) VALUES (\''.date('Y-m-d H:i:s', time()).'\', \'residential\', \'end\')';
$connexion4->getConnexion()->query($sql);

function recupFichier($anneeCourante)
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("4");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$previous_start_time = "2013-01-01T00:00:00";
	//'01-1' => '2013-01-01-2013-01-15', '01-2' => '2013-01-15-2013-02-01', '02-1' => '2013-02-01-2013-02-15', '02-2' => '2013-02-15-2013-03-01', '03-1' => '2013-03-01-2013-03-15','03-2' => '2013-03-15-2013-04-01',
	//'04-1' => '2013-04-01-2013-04-15', '04-2' => '2013-04-15-2013-05-01', '05-1' => '2013-05-01-2013-05-15', '05-2' => '2013-05-15-2013-05-20', '05-3' => '2013-05-20-2013-05-25', 
	//'05-4' => '2013-05-25-2013-06-01',
	//'06-1' => '2013-06-01-2013-06-10','06-2' => '2013-06-10-2013-06-20','06-3' => '2013-06-20-2013-07-01','07-1' => '2013-07-01-2013-07-10', '07-2' => '2013-07-10-2013-07-20', '07-3' => '2013-07-20-2013-08-01', '08-1' => '2013-08-01-2013-08-10','08-2' => '2013-08-10-2013-08-20','08-3' => '2013-08-20-2013-09-01',
	//'09-1' => '2013-09-01-2013-09-10', '09-2' => '2013-09-10-2013-09-20', 
	$time_between = array('11-6' => '2013-11-16-2013-11-17', '11-7' => '2013-11-17-2013-11-18', '11-8' => '2013-11-18-2013-11-19', '11-9' => '2013-11-18-2013-11-20');
	
	foreach($time_between as $month=>$between)
	{
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
		        $file_name = strtolower("data/property_".$name."_".$anneeCourante."-".$month.".csv");
		        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
		

		        $fields_order = array();

		        $query = "({$rets_modtimestamp_field}={$between})";
		        // run RETS search
		        
		        
		        echo "   + Query: {$query}  Limit: {$limit}  Offset: {$offset}<br>\n";
		        $search = $rets->SearchQuery("Property", $class, $query,  array());
		
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

	
}

function recupDonnees()
{
	$phrets = new phRETS;
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
    $phrets->Connect($rets_login_url, $rets_username, $rets_password);
    
	$all_fichier = array('property_residential_2013-11-6','property_residential_2013-11-7','property_residential_2013-11-8','property_residential_2013-11-9');
	
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

		        	$value_type = 'residential';
		        		
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

				    //for property_residential
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
					$dbData->setFlagActif(1);
					$dbData->setSaleOrLease($value_sale_or_lease);
					$dbData->setStatus($value_status);
					$dbData->setFile(str_replace('property_residential_', '', $fichier));
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