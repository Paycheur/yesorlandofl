<?php
include('../Class/phrets.php');
	    $this->load->library('phrets');
		$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
		$rets_username = "RETS689";
		$rets_password = "2e7Retru";
	    $this->phrets->Connect($rets_login_url, $rets_username, $rets_password);
	    
		$all_fichier = array('property_commercial', 'property_income', 'property_rental', 'property_residential', 'property_vacant_land');
		
		$donnees_retour = array();
		foreach($all_fichier as $fichier)
		{
			$tab_donnees_fichier=array();
			if (file_exists(__DIR__.'/../../data/'.$fichier.'.csv') != FALSE) 
			{
				
			    $handle  = file_get_contents(__DIR__.'/../../data/'.$fichier.'.csv') or exit;
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
			        	$value_type='property';
			        	$value_style = '';
			        	$value_bed = '';
			        	$value_bathroom = '';
			        	$value_price = '';
			        	$value_sqft ='';
			        	$value_address = '';
			        	$value_img = '';
			        	$value_state = '';
			        	$value_postalCode = '';
			        	
			        	
					     switch($fichier)
					     {
					     	case 'property_commercial':
					     		$value_id = trim( str_replace('||', '', $row_array[0])); //id
					     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
						   		$value_style = trim( str_replace('||', '', $row_array[$array_key[77]])); //property style
						   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address391
						   		$value_price = trim( str_replace('||', '', $row_array[$array_key[176]])); //list price
						   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])) ;//lotsize sqft
						   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
						   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
						   		break;
					     	case 'property_income':
					     		$value_id = trim( str_replace('||', '', $row_array[0])); //id
					     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
						   		$value_style = trim( str_replace('||', '', $row_array[$array_key[519]])); //property style
						   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address
						   		$value_price = trim( str_replace('||', '', $row_array[$array_key[176]])); //list price
						   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
						   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
						   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
						   		break;
						   	case 'property_rental':
						   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
					     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
						   		$value_style = trim( str_replace('||', '', $row_array[$array_key[934]])); //property style
						   		$value_bed = trim( str_replace('||', '', $row_array[$array_key[32]])); //beds
						   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address
						   		$value_price = trim( str_replace('||', '', $row_array[$array_key[2364]])); //rent price
						   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
						   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
						   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
						   		break;
						   	case 'property_residential':
						   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
					     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
						   		$value_style = trim( str_replace('||', '', $row_array[$array_key[1349]])); //property style
						   		$value_bed = trim( str_replace('||', '', $row_array[$array_key[32]])); //beds
						   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address
						   		$value_price = trim( str_replace('||', '', $row_array[$array_key[176]])); //list price
						   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
						   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
						   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
						   		break;
						   	case 'property_vacant_land':
						   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
					     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
						   		$value_style = trim( str_replace('||', '', $row_array[$array_key[1764]])); //property style
						   		$value_address = trim( str_replace('||', '', $row_array[$array_key[165]])).' '.trim( str_replace('||', '', $row_array[$array_key[421]])); //number, street
						   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
						   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
						   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
						   		$value_price = trim( str_replace('||', '', $row_array[$array_key[176]])); //list price
						   		break;
						   		
					     }
					    
					    
			        	$photos = $this->phrets->GetObject("Property", "Photo", $value_id, "*", 1);
						foreach ($photos as $photo) {
							$value_img .= $photo['Location'].'|';
						        
						}
						if($value_img != '')
						{
							$value_img .= '#end';
							$value_img = str_replace('|#end', '', $value_img);
						}
					     $req = $this->db->select('id, type')
		                     ->from('data')
		                     ->where('id', $value_id)
		                     ->where('type', $value_type)
		                     ->limit(1)
		                     ->get()
		                     ->result();
		                 
	                    if($value_city != '')
                 		 	$this->db->set('city',  $value_city);
                 		else
                 			$this->db->set('city',  'DEFAULT', false);
                 		if($value_style != '')
                 		 	$this->db->set('style',  $value_style);
                 		else 
                 			$this->db->set('style',  'DEFAULT', false);
                 		if($value_bed != '')
                 		 	$this->db->set('bed',  $value_bed);
                 		else
                 			$this->db->set('bed',  'DEFAULT', false);
                 		if($value_bathroom != '')
                 		 	$this->db->set('bathroom',  $value_bathroom);
                 		else 
                 			$this->db->set('bathroom',  'DEFAULT', false);
                 		if($value_price != '')
                 		 	$this->db->set('price',  $value_price);
                 		else 
                 			$this->db->set('price',  'DEFAULT', false);
                 		if($value_sqft != '')
                 			 $this->db->set('sqft',  $value_sqft);
                 		else
                 			$this->db->set('sqft',  'DEFAULT', false);
                 		if($value_address != '')
                 		 	$this->db->set('address',  $value_address);
                 		else 
                 			$this->db->set('address',  'DEFAULT', false);
                 		
                 		if($value_img != '')
                 		 	$this->db->set('img',  $value_img);
                 		else 
                 			$this->db->set('img',  'DEFAULT', false);
                 		if($value_state != '')
                 		 	$this->db->set('state',  $value_state);
                 		else 
                 			$this->db->set('state',  'DEFAULT', false);
                 		if($value_postalCode != '')
                 		 	$this->db->set('postal_code',  $value_postalCode);
                 		else 
                 			$this->db->set('postal_code',  'DEFAULT', false);
		                 if(count($req) > 0) //update
		                 {
	                 		 $this->db->where('id', $value_id);
	                 		 $this->db->where('type', $value_type);
        
       						$this->db->update('data');
		                 }
		                 else
		                 {
	                 		 $this->db->set('id',  $value_id);
	                 		if($value_type != '')
	                 			 $this->db->set('type',  $value_type);
	                 		else
	                 			$this->db->set('type',  'DEFAULT', false);
	                 		 
	                 		$result = $this->db->insert('data');
		                 }
		                 
				        
					     
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