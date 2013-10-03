<form action="search.php" class="row form-holder">
	  <div class="col-lg-3 padding-1em">
	    <label for="property-type"><b>Property type</b></label>
	    <select class="selectpicker" multiple data-selected-text-format="count>3">
	      <option>Any</option>
	      <option>Single-Family Home</option>
	      <option>Condo</option>
	      <option>Twonhome</option>
	      <option>Coop</option>
	      <option>Apartment</option>
	      <option>Loft</option>
	      <option>Tic</option>
	      <option>Apt/Condo/Townhow</option>
	    </select>
	  </div>
	  <div class="col-lg-3 padding-1em">
	    <label for="areas"><b>Location :</b></label>
	    <div class="typeahead-wrapper">
	      <input class="typeahead form-control" type="text" placeholder="Cities" id="location" autocomplete="off" spellcheck="false" dir="auto">
	    </div>
	  </div>
	  <!-- <div class="col-lg-2 padding-1em">
	    <label for="rangeInput"><b>Price :</b> <span id="rangeText" class="label label-info"></span></label>
	    <input type="range" id="rangeInput" name="rangeInput" step="1" min="0"
	    max="10" value="1">
	  </div> -->
	  <div class="col-lg-2 padding-1em">
	    <label for="BEDS"><b>Beds</b></label>
	    <input type='nummber' name='beds' value='0' class='qty form-control' />
	    <input type='button' value='+' class='qtyplus' field='beds' />
	    <input type='button' value='-' class='qtyminus' field='beds' />
	  </div>

	  <div class="col-lg-2 padding-1em">
	    <label for="bathroom"><b>Bathroom</b></label>
	    <input type='nummber' name='Bathroom' value='0' class='qty form-control' />
	    <input type='button' value='+' class='qtyplus' field='Bathroom' />
	    <input type='button' value='-' class='qtyminus' field='Bathroom' />
	  </div>

	  <div class="col-lg-2 padding-1em">
	    <label for=""><b>258  Matching</b></label>
	    <button id="submit" class="btn btn-danger btn-lg btn-block"><i class="icon-home"></i> see all</button>
	  </div>
	</form>