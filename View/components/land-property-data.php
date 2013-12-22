<div class="row">

	<?php  if ( ( isset ($csv['lease_rate']) || isset($csv['public_remarks_new']) ) ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">PROPERTY DESCRIPTION: </h4>
		<ul class="list-data">
			<?php test_value($csv, 'public_remarks_new')?>
		</ul>
	</div>

	<?php endif; ?>


	<?php  if ( (isset($csv['zoning'])  ) ) : ?>


	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">ZONING: </h4>
		<ul class="list-data">
			<?php test_value($csv, 'zoning') ?>
		</ul>
	</div>

	<?php endif; ?>


	<?php  if ( (isset($csv['lot_size_sqft'])  )  ) : ?>


	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">LOT SIZE:</h4>
		<ul class="list-data">
			<?php test_value($csv, 'lot_size_sqft')?>

			<?php test_value($csv, 'lot_size_acres')?>

			<?php test_value($csv, 'lot_dimensions')?>

			<?php test_value($csv, 'total_acreage')?>

		</ul>
	</div>

	<?php endif; ?>

	<?php  if ( ( isset ($csv['site_improvements']) )  ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">SITE IMPROVEMENTS: </h4>
		<ul class="list-data">
			<?php test_value($csv, 'site_improvements')?>
			<?php test_value($csv, 'fences')?>
		</ul>
	</div>

	<?php endif; ?>


	<?php  if ( (isset($csv['taxes'])  ) ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">ECONOMICS: </h4>
		<ul class="list-data">
			<?php test_value($csv, 'taxes')?>

			<?php test_value($csv, 'hoa_comm_assn')?>

			<?php test_value($csv, 'hoa_fee')?>

			<?php test_value($csv, 'hoa_payment_schedule')?>

			<?php test_value($csv, 'annual_cdd_fee')?>

			<?php test_value($csv, 'financing_available')?>
		</ul>
	</div>

	<?php endif; ?>

	<?php  if ( (isset($csv['water_name'])  ) ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">WATER VIEW AND ACCESS:</h4>
		<ul class="list-data">

			<?php test_value($csv, 'water_name')?>

			<?php test_value($csv, 'water_frontage')?>

			<?php test_value($csv, 'water_access')?>

			<?php test_value($csv, 'waterfront_feet')?>

			<?php test_value($csv, 'driving_directions')?>

		</ul>
	</div>

	<?php endif; ?>

	<?php  if ( (isset($csv['driving_directions'])  ) ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">DIRECTIONS:</h4>
		<ul class="list-data">
			<?php test_value($csv, 'driving_directions')?>
		</ul>
	</div>


	<?php endif; ?>



	<?php  if ( (isset($csv['office_name'])  ) ) : ?>

	<div class="col-lg-12 propety-data-group">
		<h4 class="feature-title">LISTING PROVIDED COURTESY OF:</h4>
		<ul class="list-data">
			<?php test_value($csv, 'office_name')?>
		</ul>
	</div>


	<?php endif; ?>





</div>

