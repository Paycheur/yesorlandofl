<div class="row">

	<?php  if ( ( isset ($csv['lease_rate']) || ($csv['property_use']) ) ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">PROPERTY: </h4>
		<ul class="list-data">
			<?php test_value($csv, 'lease_rate') ?>
			<?php test_value($csv, 'property_use') ?>
			<?php test_value($csv, 'property_style') ?>
			<?php test_value($csv, 'sq_ft_gross') ?>
			<?php test_value($csv, 'lp_sqft') ?>
			<?php test_value($csv, 'lease_price_per_sf') ?>
			<?php test_value($csv, 'net_leasable_sq_ft') ?>
			<?php test_value($csv, 'total_num_bldg') ?>
			<?php test_value($csv, 'floors_number') ?>
			<?php test_value($csv, 'class_of_space') ?>
			<?php test_value($csv, 'lot_size_acres') ?>
			<?php test_value($csv, 'public_remarks_new') ?>
		</ul>
	</div>

	<?php endif; ?>


	<?php  if ( (isset($csv['complex_community_name_nccb'])  ) && !empty ( $csv['complex_community_name_nccb']['val'])  ) : ?>


	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">COMMUNITY & ZONING: </h4>
		<ul class="list-data">
			<?php test_value($csv, 'complex_community_name_nccb') ?>
			<?php test_value($csv, 'zoning') ?>
		</ul>
	</div>

	<?php endif; ?>


	<?php  if ( (isset($csv['number_of_add_parcels'])  )  && !empty ( $csv['number_of_add_parcels']['val']) ) : ?>


	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">LAND & WATERVIEW:</h4>
		<ul class="list-data">
			<?php test_value($csv, 'number_of_add_parcels') ?>
			<?php test_value($csv, 'water_view') ?>
			<?php test_value($csv, 'waterfront_feet') ?>

		</ul>
	</div>

	<?php endif; ?>

	<?php  if ( ( isset ($csv['number_of_hotel_motel_rms']) )  ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">DETAILS: </h4>
		<ul class="list-data">
			<?php test_value($csv, 'number_of_hotel_motel_rms') ?>
			<?php test_value($csv, 'number_of_restrooms') ?>
			<?php test_value($csv, 'number_of_offices') ?>
			<?php test_value($csv, 'warehouse_space_heated') ?>
			<?php test_value($csv, 'warehouse_space_total') ?>
			<?php test_value($csv, 'number_of_bays_dock_high') ?>
			<?php test_value($csv, 'number_of_bays_grade_level') ?>
			<?php test_value($csv, 'freezer_space_y_n') ?>
		</ul>
	</div>

	<?php endif; ?>


	<?php  if ( (isset($csv['utilities'])  ) ) : ?>
	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">AIR CONDITIONING & UTILITIES: </h4>
		<ul class="list-data">
			<?php test_value($csv, 'utilities') ?>
			<?php test_value($csv, 'new_construction') ?>
		</ul>
	</div>

	<?php endif; ?>


	<?php  if ( (isset($csv['construction_status'])  ) ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">CONSTRUCTION STATUS: </h4>
		<ul class="list-data">
			<?php test_value($csv, 'new_construction') ?>
			<?php test_value($csv, 'construction_status') ?>
			<?php test_value($csv, 'projected_completion_date') ?>
		</ul>
	</div>

	<?php endif; ?>

	<?php  if ( (isset($csv['green_site_improvements'])  ) ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">GREEN ENERGY IMPROVEMENTS:</h4>
		<ul class="list-data">
			<?php test_value($csv, 'green_site_improvements') ?>
			<?php test_value($csv, 'green_water_features') ?>
			<?php test_value($csv, 'green_energy_features') ?>
		</ul>
	</div>

	<?php endif; ?>

	<?php  if ( (isset($csv['financing_terms'])  ) ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">FINANCIAL INFORMATION:</h4>
		<ul class="list-data">
			<?php test_value($csv, 'financing_terms') ?>
			<?php test_value($csv, 'condo_fees') ?>
			<?php test_value($csv, 'condo_fees_term') ?>
			<?php test_value($csv, 'taxes') ?>
		</ul>
	</div>


	<?php endif; ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">LISTING PROVIDED COURTESY OF:</h4>
		<ul class="list-data">
			<?php test_value($csv, 'office_name')?>
		</ul>
	</div>




</div>

