<?php
		if ( isset( $csv['property_description'] ) ) :
		if($csv['property_description']['val'] != '') :  ?>

		<li>
			<b><?= $csv['property_description']['lib']?>:</b>
			<?=(isset($csv['property_description']) ? $csv['property_description']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['property_style'] ) ) :
		if($csv['property_style']['val'] != '') :  ?>
		<li>
			<b><?= $csv['property_style']['lib']?>:</b>
			<?=(isset($csv['property_style']) ? $csv['property_style']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['architectural_style'] ) ) :
		if($csv['architectural_style']['val'] != '') :  ?>
		<li>
			<b><?= $csv['architectural_style']['lib']?>:</b>
			<?=(isset($csv['architectural_style']) ? $csv['architectural_style']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['beds'] ) ) :
		if($csv['beds']['val'] != '') :  ?>
		<li>
			<b><?= $csv['beds']['lib']?>:</b>
			<?=(isset($csv['beds']) ? $csv['beds']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['full_baths'] ) ) :
		if($csv['full_baths']['val'] != '') :  ?>
		<li>
			<b><?= $csv['full_baths']['lib']?>:</b>
			<?=(isset($csv['full_baths']) ? $csv['full_baths']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['half_baths'] ) ) :
		if($csv['half_baths']['val'] != '') :  ?>
		<li>
			<b><?= $csv['half_baths']['lib']?>:</b>
			<?=(isset($csv['half_baths']) ? $csv['half_baths']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['sq_ft_heated'] ) ) :
		if($csv['sq_ft_heated']['val'] != '') :  ?>
		<li>
			<b><?= $csv['sq_ft_heated']['lib']?>:</b>
			<?=(isset($csv['sq_ft_heated']) ? $csv['sq_ft_heated']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['lot_size'] ) ) :
		if($csv['lot_size']['val'] != '') :  ?>
		<li>
			<b><?= $csv['lot_size']['lib']?>:</b>
			<?=(isset($csv['lot_size']) ? $csv['lot_size']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['lp_sqft'] ) ) :
		if($csv['lp_sqft']['val'] != '') :  ?>
		<li>
			<b><?= $csv['lp_sqft']['lib']?>:</b>
			<?=(isset($csv['lp_sqft']) ? $csv['lp_sqft']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['year_built'] ) ) :
		if($csv['year_built']['val'] != '') :  ?>
		<li>
			<b><?= $csv['year_built']['lib']?>:</b>
			<?=(isset($csv['year_built']) ? $csv['year_built']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['garage_carport'] ) ) :
		if($csv['garage_carport']['val'] != '') :  ?>
		<li>
			<b><?= $csv['garage_carport']['lib']?>:</b>
			<?=(isset($csv['garage_carport']) ? $csv['garage_carport']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['annual_rent'] ) ) :
		if($csv['annual_rent']['val'] != '') :  ?>
		<li>
			<b><?= $csv['annual_rent']['lib']?>:</b>
			<?=(isset($csv['annual_rent']) ? $csv['annual_rent']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['seasonal_rent'] ) ) :
		if($csv['seasonal_rent']['val'] != '') :  ?>
		<li>
			<b><?= $csv['seasonal_rent']['lib']?>:</b>
			<?=(isset($csv['seasonal_rent']) ? $csv['seasonal_rent']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['off_season_rent'] ) ) :
		if($csv['off_season_rent']['val'] != '') :  ?>
		<li>
			<b><?= $csv['off_season_rent']['lib']?>:</b>
			<?=(isset($csv['off_season_rent']) ? $csv['off_season_rent']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['weekly_rent'] ) ) :
		if($csv['weekly_rent']['val'] != '') :  ?>
		<li>
			<b><?= $csv['weekly_rent']['lib']?>:</b>
			<?=(isset($csv['weekly_rent']) ? $csv['weekly_rent']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['application_fee'] ) ) :
		if($csv['application_fee']['val'] != '') :  ?>
		<li>
			<b><?= $csv['application_fee']['lib']?>:</b>
			<?=(isset($csv['application_fee']) ? $csv['application_fee']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['max_pet_weight'] ) ) :
		if($csv['max_pet_weight']['val'] != '') :  ?>
		<li>
			<b><?= $csv['max_pet_weight']['lib']?>:</b>
			<?=(isset($csv['max_pet_weight']) ? $csv['max_pet_weight']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['minimum_days_leased'] ) ) :
		if($csv['minimum_days_leased']['val'] != '') :  ?>
		<li>
			<b><?= $csv['minimum_days_leased']['lib']?>:</b>
			<?=(isset($csv['minimum_days_leased']) ? $csv['minimum_days_leased']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['pet_deposit'] ) ) :
		if($csv['pet_deposit']['val'] != '') :  ?>
		<li>
			<b><?= $csv['pet_deposit']['lib']?>:</b>
			<?=(isset($csv['pet_deposit']) ? $csv['pet_deposit']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['pet_fee_non_refundable'] ) ) :
		if($csv['pet_fee_non_refundable']['val'] != '') :  ?>
		<li>
			<b><?= $csv['pet_fee_non_refundable']['lib']?>:</b>
			<?=(isset($csv['pet_fee_non_refundable']) ? $csv['pet_fee_non_refundable']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['security_deposit'] ) ) :
		if($csv['security_deposit']['val'] != '') :  ?>
		<li>
			<b><?= $csv['security_deposit']['lib']?>:</b>
			<?=(isset($csv['security_deposit']) ? $csv['security_deposit']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['long_term_y_n'] ) ) :
		if($csv['long_term_y_n']['val'] != '') :  ?>
		<li>
			<b><?= $csv['long_term_y_n']['lib']?>:</b>
			<?=(isset($csv['long_term_y_n']) ? $csv['long_term_y_n']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['association_approval_fee'] ) ) :
		if($csv['association_approval_fee']['val'] != '') :  ?>
		<li>
			<b><?= $csv['association_approval_fee']['lib']?>:</b>
			<?=(isset($csv['association_approval_fee']) ? $csv['association_approval_fee']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['additional_applicant_fee'] ) ) :
		if($csv['additional_applicant_fee']['val'] != '') :  ?>
		<li>
			<b><?= $csv['additional_applicant_fee']['lib']?>:</b>
			<?=(isset($csv['additional_applicant_fee']) ? $csv['additional_applicant_fee']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['furnishings'] ) ) :
		if($csv['furnishings']['val'] != '') :  ?>
		<li>
			<b><?= $csv['furnishings']['lib']?>:</b>
			<?=(isset($csv['furnishings']) ? $csv['furnishings']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['weeks_available_2013'] ) ) :
		if($csv['weeks_available_2013']['val'] != '') :  ?>
		<li>
			<b><?= $csv['weeks_available_2013']['lib']?>:</b>
			<?=(isset($csv['weeks_available_2013']) ? $csv['weeks_available_2013']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['master_bedroom_approx'] ) ) :
		if($csv['master_bedroom_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['master_bedroom_approx']['lib']?>:</b>
			<?=(isset($csv['master_bedroom_approx']) ? $csv['master_bedroom_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['2nd_bedroom_approx'] ) ) :
		if($csv['2nd_bedroom_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['2nd_bedroom_approx']['lib']?>:</b>
			<?=(isset($csv['2nd_bedroom_approx']) ? $csv['2nd_bedroom_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['3rd_bedroom_approx'] ) ) :
		if($csv['3rd_bedroom_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['3rd_bedroom_approx']['lib']?>:</b>
			<?=(isset($csv['3rd_bedroom_approx']) ? $csv['3rd_bedroom_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['4th_bedroom_approx'] ) ) :
		if($csv['4th_bedroom_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['4th_bedroom_approx']['lib']?>:</b>
			<?=(isset($csv['4th_bedroom_approx']) ? $csv['4th_bedroom_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['5th_bedroom_approx'] ) ) :
		if($csv['5th_bedroom_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['5th_bedroom_approx']['lib']?>:</b>
			<?=(isset($csv['5th_bedroom_approx']) ? $csv['5th_bedroom_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['master_bath_features'] ) ) :
		if($csv['master_bath_features']['val'] != '') :  ?>
		<li>
			<b><?= $csv['master_bath_features']['lib']?>:</b>
			<?=(isset($csv['master_bath_features']) ? $csv['master_bath_features']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['kitchen_features'] ) ) :
		if($csv['kitchen_features']['val'] != '') :  ?>
		<li>
			<b><?= $csv['kitchen_features']['lib']?>:</b>
			<?=(isset($csv['kitchen_features']) ? $csv['kitchen_features']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['kitchen_approx'] ) ) :
		if($csv['kitchen_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['kitchen_approx']['lib']?>:</b>
			<?=(isset($csv['kitchen_approx']) ? $csv['kitchen_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['great_room_approx'] ) ) :
		if($csv['great_room_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['great_room_approx']['lib']?>:</b>
			<?=(isset($csv['great_room_approx']) ? $csv['great_room_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['family_room_approx'] ) ) :
		if($csv['family_room_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['family_room_approx']['lib']?>:</b>
			<?=(isset($csv['family_room_approx']) ? $csv['family_room_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['living_room_approx'] ) ) :
		if($csv['living_room_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['living_room_approx']['lib']?>:</b>
			<?=(isset($csv['living_room_approx']) ? $csv['living_room_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['dinette_approx'] ) ) :
		if($csv['dinette_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['dinette_approx']['lib']?>:</b>
			<?=(isset($csv['dinette_approx']) ? $csv['dinette_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['bonus_room_approx'] ) ) :
		if($csv['bonus_room_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['bonus_room_approx']['lib']?>:</b>
			<?=(isset($csv['bonus_room_approx']) ? $csv['bonus_room_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['studio_dimensions'] ) ) :
		if($csv['studio_dimensions']['val'] != '') :  ?>
		<li>
			<b><?= $csv['studio_dimensions']['lib']?>:</b>
			<?=(isset($csv['studio_dimensions']) ? $csv['studio_dimensions']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['study_den_dimensions'] ) ) :
		if($csv['study_den_dimensions']['val'] != '') :  ?>
		<li>
			<b><?= $csv['study_den_dimensions']['lib']?>:</b>
			<?=(isset($csv['study_den_dimensions']) ? $csv['study_den_dimensions']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['balcony_porch_lanai_approx'] ) ) :
		if($csv['balcony_porch_lanai_approx']['val'] != '') :  ?>
		<li>
			<b><?= $csv['balcony_porch_lanai_approx']['lib']?>:</b>
			<?=(isset($csv['balcony_porch_lanai_approx']) ? $csv['balcony_porch_lanai_approx']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['interior_layout'] ) ) :
		if($csv['interior_layout']['val'] != '') :  ?>
		<li>
			<b><?= $csv['interior_layout']['lib']?>:</b>
			<?=(isset($csv['interior_layout']) ? $csv['interior_layout']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['interior_features'] ) ) :
		if($csv['interior_features']['val'] != '') :  ?>
		<li>
			<b><?= $csv['interior_features']['lib']?>:</b>
			<?=(isset($csv['interior_features']) ? $csv['interior_features']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['floor_covering'] ) ) :
		if($csv['floor_covering']['val'] != '') :  ?>
		<li>
			<b><?= $csv['floor_covering']['lib']?>:</b>
			<?=(isset($csv['floor_covering']) ? $csv['floor_covering']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['roof'] ) ) :
		if($csv['roof']['val'] != '') :  ?>
		<li>
			<b><?= $csv['roof']['lib']?>:</b>
			<?=(isset($csv['roof']) ? $csv['roof']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['foundation'] ) ) :
		if($csv['foundation']['val'] != '') :  ?>
		<li>
			<b><?= $csv['foundation']['lib']?>:</b>
			<?=(isset($csv['foundation']) ? $csv['foundation']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['exterior_features'] ) ) :
		if($csv['exterior_features']['val'] != '') :  ?>
		<li>
			<b><?= $csv['exterior_features']['lib']?>:</b>
			<?=(isset($csv['exterior_features']) ? $csv['exterior_features']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['lot_size_acres'] ) ) :
		if($csv['lot_size_acres']['val'] != '') :  ?>
		<li>
			<b><?= $csv['lot_size_acres']['lib']?>:</b>
			<?=(isset($csv['lot_size_acres']) ? $csv['lot_size_acres']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['lot_size_sqft'] ) ) :
		if($csv['lot_size_sqft']['val'] != '') :  ?>
		<li>
			<b><?= $csv['lot_size_sqft']['lib']?>:</b>
			<?=(isset($csv['lot_size_sqft']) ? $csv['lot_size_sqft']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['lot_dimensions'] ) ) :
		if($csv['lot_dimensions']['val'] != '') :  ?>
		<li>
			<b><?= $csv['lot_dimensions']['lib']?>:</b>
			<?=(isset($csv['lot_dimensions']) ? $csv['lot_dimensions']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['total_acreage'] ) ) :
		if($csv['total_acreage']['val'] != '') :  ?>
		<li>
			<b><?= $csv['total_acreage']['lib']?>:</b>
			<?=(isset($csv['total_acreage']) ? $csv['total_acreage']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['garage_features'] ) ) :
		if($csv['garage_features']['val'] != '') :  ?>
		<li>
			<b><?= $csv['garage_features']['lib']?>:</b>
			<?=(isset($csv['garage_features']) ? $csv['garage_features']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['air_conditioning'] ) ) :
		if($csv['air_conditioning']['val'] != '') :  ?>
		<li>
			<b><?= $csv['air_conditioning']['lib']?>:</b>
			<?=(isset($csv['air_conditioning']) ? $csv['air_conditioning']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['heating_and_fuel'] ) ) :
		if($csv['heating_and_fuel']['val'] != '') :  ?>
		<li>
			<b><?= $csv['heating_and_fuel']['lib']?>:</b>
			<?=(isset($csv['heating_and_fuel']) ? $csv['heating_and_fuel']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['fireplace_y_n'] ) ) :
		if($csv['fireplace_y_n']['val'] != '') :  ?>
		<li>
			<b><?= $csv['fireplace_y_n']['lib']?>:</b>
			<?=(isset($csv['fireplace_y_n']) ? $csv['fireplace_y_n']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['fireplace_description'] ) ) :
		if($csv['fireplace_description']['val'] != '') :  ?>
		<li>
			<b><?= $csv['fireplace_description']['lib']?>:</b>
			<?=(isset($csv['fireplace_description']) ? $csv['fireplace_description']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['utilities'] ) ) :
		if($csv['utilities']['val'] != '') :  ?>
		<li>
			<b><?= $csv['utilities']['lib']?>:</b>
			<?=(isset($csv['utilities']) ? $csv['utilities']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['appliances_included'] ) ) :
		if($csv['appliances_included']['val'] != '') :  ?>
		<li>
			<b><?= $csv['appliances_included']['lib']?>:</b>
			<?=(isset($csv['appliances_included']) ? $csv['appliances_included']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['pool'] ) ) :
		if($csv['pool']['val'] != '') :  ?>
		<li>
			<b><?= $csv['pool']['lib']?>:</b>
			<?=(isset($csv['pool']) ? $csv['pool']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['pool_type'] ) ) :
		if($csv['pool_type']['val'] != '') :  ?>
		<li>
			<b><?= $csv['pool_type']['lib']?>:</b>
			<?=(isset($csv['pool_type']) ? $csv['pool_type']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['pool_dimensions'] ) ) :
		if($csv['pool_dimensions']['val'] != '') :  ?>
		<li>
			<b><?= $csv['pool_dimensions']['lib']?>:</b>
			<?=(isset($csv['pool_dimensions']) ? $csv['pool_dimensions']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['water_name'] ) ) :
		if($csv['water_name']['val'] != '') :  ?>
		<li>
			<b><?= $csv['water_name']['lib']?>:</b>
			<?=(isset($csv['water_name']) ? $csv['water_name']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['water_view_y_n'] ) ) :
		if($csv['water_view_y_n']['val'] != '') :  ?>
		<li>
			<b><?= $csv['water_view_y_n']['lib']?>:</b>
			<?=(isset($csv['water_view_y_n']) ? $csv['water_view_y_n']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['water_frontage_y_n'] ) ) :
		if($csv['water_frontage_y_n']['val'] != '') :  ?>
		<li>
			<b><?= $csv['water_frontage_y_n']['lib']?>:</b>
			<?=(isset($csv['water_frontage_y_n']) ? $csv['water_frontage_y_n']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['water_frontage'] ) ) :
		if($csv['water_frontage']['val'] != '') :  ?>
		<li>
			<b><?= $csv['water_frontage']['lib']?>:</b>
			<?=(isset($csv['water_frontage']) ? $csv['water_frontage']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['water_access'] ) ) :
		if($csv['water_access']['val'] != '') :  ?>
		<li>
			<b><?= $csv['water_access']['lib']?>:</b>
			<?=(isset($csv['water_access']) ? $csv['water_access']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['waterfront_feet'] ) ) :
		if($csv['waterfront_feet']['val'] != '') :  ?>
		<li>
			<b><?= $csv['waterfront_feet']['lib']?>:</b>
			<?=(isset($csv['waterfront_feet']) ? $csv['waterfront_feet']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['elementary_school'] ) ) :
		if($csv['elementary_school']['val'] != '') :  ?>
		<li>
			<b><?= $csv['elementary_school']['lib']?>:</b>
			<?=(isset($csv['elementary_school']) ? $csv['elementary_school']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['middle_or_junior_school'] ) ) :
		if($csv['middle_or_junior_school']['val'] != '') :  ?>
		<li>
			<b><?= $csv['middle_or_junior_school']['lib']?>:</b>
			<?=(isset($csv['middle_or_junior_school']) ? $csv['middle_or_junior_school']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['high_school'] ) ) :
		if($csv['high_school']['val'] != '') :  ?>
		<li>
			<b><?= $csv['high_school']['lib']?>:</b>
			<?=(isset($csv['high_school']) ? $csv['high_school']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['community_features'] ) ) :
		if($csv['community_features']['val'] != '') :  ?>
		<li>
			<b><?= $csv['community_features']['lib']?>:</b>
			<?=(isset($csv['community_features']) ? $csv['community_features']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['flood_zone_code'] ) ) :
		if($csv['flood_zone_code']['val'] != '') :  ?>
		<li>
			<b><?= $csv['flood_zone_code']['lib']?>:</b>
			<?=(isset($csv['flood_zone_code']) ? $csv['flood_zone_code']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['location'] ) ) :
		if($csv['location']['val'] != '') :  ?>
		<li>
			<b><?= $csv['location']['lib']?>:</b>
			<?=(isset($csv['location']) ? $csv['location']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['pets_allowed_y_n'] ) ) :
		if($csv['pets_allowed_y_n']['val'] != '') :  ?>
		<li>
			<b><?= $csv['pets_allowed_y_n']['lib']?>:</b>
			<?=(isset($csv['pets_allowed_y_n']) ? $csv['pets_allowed_y_n']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>

<?php
		if ( isset( $csv['green_certifications'] ) ) :
		if($csv['green_certifications']['val'] != '') :  ?>
		<li>
			<b><?= $csv['green_certifications']['lib']?>:</b>
			<?=(isset($csv['green_certifications']) ? $csv['green_certifications']['val'] : '')?>
		</li>
<?php endif; ?><?php endif; ?>
