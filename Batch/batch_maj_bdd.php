<?php
ini_set("memory_limit" , "64048M");
include(dirname(__FILE__).'/../Class/phrets.php');

include(dirname(__FILE__).'/../Inc/require.inc.php');

var_dump("FUCK !");
$connexion = new CConnexion(BD_NAME, BD_LOGIN, BD_PASSWORD);
$connexion->getConnexion()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Ligne 4
$req = 'SELECT type,file FROM data'.
	   ' WHERE actif=1 GROUP BY type, file ';
$res = $connexion->getConnexion()->query($req);
$i=0;
var_dump("BITCH !");
foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row)
{
	var_dump("FUCKING BITCH !");
	$handler = '';
	$handle_row = array();

	$fichier = 'property_'.$row['type'].'_'.$row['file'];
	
	
	if (file_exists(dirname(__FILE__).'/data/'.$fichier.'.csv') != FALSE) 
	{
		
	    $handle  = file_get_contents(dirname(__FILE__).'/data/'.$fichier.'.csv');
	    if($handle === false)
	    {
	    	continue;
	    }
	    $handle_row = explode("\n", $handle);
	    $test = true;
	    $n = 0;
	    //$fo_req = fopen(dirname(__FILE__).'/data/RESULTS_req_'.$fichier.'.txt', "a+");
			$req = 'SELECT id FROM data'.
			   ' WHERE actif = 1 AND json_data = \'\' AND type = \''.$row['type'].'\' AND file = \''.$row['file'].'\' ';
			
			$res2 = $connexion->getConnexion()->query($req);

			
		    foreach($res2->fetchAll(PDO::FETCH_ASSOC) as $rowId)
		    {
			    $tabCsv = array();
				$tabCsv = getAllDatasCsv($rowId['id'], $handle_row, $fichier);
				$req = 'UPDATE data SET json_data = \''.protegeChaine(json_encode($tabCsv)).'\' WHERE id = \''.$rowId['id'].'\' AND type = \''.$row['type'].'\' ';
				//fwrite($fo_req, $req);
				$i++;
				$res3 = $connexion->getConnexion()->exec($req);
		    }
	}
}

var_dump($i);

	function getAllDatasCsv($id_property, $handle_row, $fichier)
	{
		
		$data = array();


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
	        			else if(strpos($fichier,'property_rental') !== false)
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
	        			else if(strpos($fichier,'property_residential') !== false)
	        			{
	        				$data['special_sale_provision'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3062]])), 'lib' => 'Special Sale Provision');
							$data['list_price'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[176]])), 'lib' => 'List Price');
							$data['property_description'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2819]])), 'lib' => 'Property Description');
							$data['property_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1349]])), 'lib' => 'Property Style');
							$data['architectural_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1716]])), 'lib' => 'Architectural Style');
							$data['full_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2294]])), 'lib' => 'Full Baths');
							$data['half_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2296]])), 'lib' => 'Half Baths');
							$data['sq_ft_heated'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2346]])), 'lib' => 'Sq Ft Heated');
							$data['lot_size'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2362]])), 'lib' => 'Lot Size');
							$data['lp_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2763]])), 'lib' => 'LP/SqFt');
							$data['year_built'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[55]])), 'lib' => 'Year Built');
							$data['garage_carport'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2805]])), 'lib' => 'Garage/Carport');
							$data['beds'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[32]])), 'lib' => 'Beds');
							$data['master_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1466]])), 'lib' => 'Master Bedroom (Approx.)');
							$data['2nd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1495]])), 'lib' => '2nd Bedroom (Approx.)');
							$data['3rd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1514]])), 'lib' => '3rd Bedroom (Approx.)');
							$data['4th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1518]])), 'lib' => '4th Bedroom (Approx.)');
							$data['5th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1522]])), 'lib' => '5th Bedroom (Approx.)');
							$data['full_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2294]])), 'lib' => 'Full Baths');
							$data['half_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2296]])), 'lib' => 'Half Baths');
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
							$data['taxes'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1375]])), 'lib' => 'Taxes');
							$data['hoa_comm_assn'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3074]])), 'lib' => 'HOA/Comm Assn');
							//$data['hoa_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1833]])), 'lib' => 'HOA Fee');
							$data['hoa_payment_schedule'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2901]])), 'lib' => 'HOA Payment Schedule');
							$data['condo_maintenance_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3189]])), 'lib' => 'Condo Maintenance Fee');
							$data['condo_maint_fee_schedule'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3190]])), 'lib' => 'Condo Maint. Fee Schedule');
							$data['cdd_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2795]])), 'lib' => 'CDD Y/N');
							$data['annual_cdd_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2793]])), 'lib' => 'Annual CDD Fee');
							$data['elementary_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1397]])), 'lib' => 'Elementary School');
							$data['middle_or_junior_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1425]])), 'lib' => 'Middle or Junior School');
							$data['high_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1420]])), 'lib' => 'High School');
							$data['community_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1743]])), 'lib' => 'Community Features');
							$data['flood_zone_code'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3148]])), 'lib' => 'Flood Zone Code');
							$data['location'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1718]])), 'lib' => 'Location');
							$data['pets_allowed_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3075]])), 'lib' => 'Pets Allowed Y/N');
							$data['green_certifications'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3015]])), 'lib' => 'Green Certifications');
							$data['office_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2368]])), 'lib' => 'Office Name');
	        				
	        			}
	        			else if(strpos($fichier,'property_vacant_land') !== false)
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
		return $data;
	}
?>