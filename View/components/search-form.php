<?php
$arrayCityMost = array('Heathrow','Lake Mary','Longwood','Orlando','Sanford','Windermere');
$arrayCityMore = array('Altamonte Springs','Apopka','Belle Isle','Casselberry','Celebration','Champions Gate','Chuluota','Clermont','Davenport','Debary','Deland','Deltona','Eatonville','Edgewood','Eustis','Fern Park','Ferndale','Geneva','Gotha','Howey In The Hills','Hudson','Kissimmee','Lake Helen','Maitland','Minneola','Montverde','Mount Dora','Mount Plymouth','Oakland','Ocoee','Orange City','Osteen','Oviedo','Poinciana','Reunion','Saint Cloud','Sorrento','Tavares','Titusville','Winter Garden','Winter Park','Winter Springs');?>
<form action="search" method="GET" class="form-holder padding-r-l-1em padding-1em" id="formSearch">
  <div class="row">
    <div class="col-lg-2 border-right-gray-light">
      <label for="property-type"><b>What Would you like to Buy ?</b></label>
      <div data-toggle="buttons" id='types-btns'>
        <ul class="list-inline font-12 size-12">
          <li>
            <a href="#" id="residential-type-btn" class="display-block padding-05em txt-left">
            Residential <i class="icon-angle-down"></i>
            </a>
          </li>
          <li>
            <a href="#" id="commercial-type-btn" class="display-block  padding-05em  txt-left">
            Commercial <i class="icon-angle-down"></i>
            </a>
          </li>
          <li>
            <a href="#" id="vacant_land-type-btn" class="display-block   padding-05em txt-left">
            Vacant land <i class="icon-angle-down"></i>
            </a>
          </li>
           <li>
            <a href="#" id="rental-type-btn" class="display-block   padding-05em txt-left">
            Rental <i class="icon-angle-down"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-lg-3 border-right-gray-light">
      <label for="areas"><b>Where do you want to buy?</b></label>
      <select id="areas" name="city[]" class="selectpicker padding-05em" data-style="btn-primary" multiple data-selected-text-format="count>3" data-width="100%"  data-live-search="true">
        <optgroup label="Most common" >
          <?php foreach($arrayCityMost as $city)
          {
          $stringOption = '<option value="'.$city.'" class="notranslate"';
            if(isset($_REQUEST['city']))
            {
            foreach($_REQUEST['city'] as $reqCity)
            {
            if($reqCity == $city)
            {
            $stringOption .= ' selected';
            }
            }
            }
          $stringOption .= '>'.$city.'</option>';
          echo $stringOption;
          }?>
        </optgroup>
        <optgroup label="More cities">
          <?php foreach($arrayCityMore as $city)
          {
          $stringOption = '<option value="'.$city.'" class="notranslate"';
            if(isset($_REQUEST['city']))
            {
            foreach($_REQUEST['city'] as $reqCity)
            {
            if($reqCity == $city)
            {
            $stringOption .= ' selected';
            }
            }
            }
          $stringOption .= '>'.$city.'</option>';
          echo $stringOption;
          }?>
        </optgroup>
      </select>
    </div>
    <div class="col-lg-3 txt-center border-right-gray-light">


      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="tabOne">

            <label for="rangeInput" class="display-block"><b>What is your price range :</b></label>
            <input type="text" class="display-block form-control " value="<?=(isset($_REQUEST['price']) ? $_REQUEST['price'] : '') ?>" name="price_sale" data-slider-min="0" data-slider-max="1000000" data-slider-step="1000" data-slider-value="[0,1000000]" data-slider-tooltip="hide" id="price-range">
            <label for="rangeInput" class="display-block padding-05em">From <b class="theMin">Any Price</b> to <b class="theMax">Any</b></label>

        </div>
        <div class="tab-pane" id="tabTwo">

            <label for="rangeInput" class="display-block"><b>What is your price range lease :</b></label>
            <input type="text" class="display-block form-control " value="<?=(isset($_REQUEST['price']) ? $_REQUEST['price'] : '') ?>" name="price_lease" data-slider-min="0" data-slider-max="5000" data-slider-step="100" data-slider-value="[0,5000]" data-slider-tooltip="hide" id="price-range-lease">
            <label for="rangeInput" class="display-block padding-05em">From <b class="theMin">Any Price</b> to <b class="theMax">Any</b></label>
        </div>
      </div>




      <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-white padding-zero">
              <input type="radio" name="option" id="option1" value="sale"> <a href="#tabOne" data-toggle="tab" class="btn-padding inline-block">For Sale</a>
            </label>

          <label class="btn btn-white padding-zero">
            <input type="radio" name="option" id="option2" value="lease"><a href="#tabTwo" data-toggle="tab" class="btn-padding inline-block">For Lease</a>
          </label>


      </div>


    </div>
    <div class="col-lg-2 border-right-gray-light">
      <div class="relative">
        <label for="beds" class="display-inline"><b>Beds : </b></label>
        <input type='nummber' placeholder="Any" autocomplete="off" name='beds' value='<?=(isset($_REQUEST['beds']) ? $_REQUEST['beds'] : '') ?>' class='qty display-inline input-number form-control' />
        <input type='button' value='+' class='qtyplus' field='beds' />
        <input type='button' value='–' class='qtyminus' field='beds' />
      </div>
      <hr>
      <div class="relative">
        <label for="bathroom" class="display-inline"><b>Bathroom :</b></label>
        <input type='nummber' name='Bathroom' autocomplete="off" placeholder="Any" value='<?=(isset($_REQUEST['bathroom']) ? $_REQUEST['bathroom'] : '') ?>' class='qty display-inline input-number form-control' />
        <input type='button' value='+' class='qtyplus' field='Bathroom'  autocomplete="off"/>
        <input type='button' value='–' class='qtyminus' field='Bathroom' autocomplete="off" />
      </div>
    </div>
    <div class="col-lg-2 txt-center ">
      <!-- <label for=""><b>258  Matching</b></label> -->
      <h3 class='h4 margin-top-zero'>Matching Homes</h3>
      <h3 id="matching" class=' h1 margin-top-zero'><?=isset($_value['nbResults']) ? $_value['nbResults'] : '' ?></h3>
      <button type="submit" id="submitSearch" class="btn btn-danger btn-lg btn-block"><i class="icon-home"></i> See all matching</button>
    </div>
  </div>
  <div class="row display-none"  id="residentail-types">
    <div class="row-fluid">
      <div class="col-lg-12">
        <hr>
        <h4 >Choose a Residential type : </h4>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="checkbox">
        <label>
          <input value="RES_1/2 Duplex" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('RES_1/2 Duplex', $_REQUEST['style']) ? 'checked' : '') ?>> 1/2 Duplex
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input value="RES_Co-Op" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('RES_Co-Op', $_REQUEST['style']) ? 'checked' : '') ?>> Co-op
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input value="RES_Condo" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('RES_Condo', $_REQUEST['style']) ? 'checked' : '') ?>> Condo
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input value="RES_Condo-Hotel" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('RES_Condo-Hotel', $_REQUEST['style']) ? 'checked' : '') ?>> Condo-Hotel
        </label>
      </div>
      </div> <!-- 4 col -->
      <div class="col-lg-3">
        <div class="checkbox">
          <label>
            <input value="RES_Dock-Rackominium" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('RES_Dock-Rackominium', $_REQUEST['style']) ? 'checked' : '') ?>> Dock-Rackominium
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input value="RES_Farm" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('RES_Farm', $_REQUEST['style']) ? 'checked' : '') ?>> Farm
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input value="RES_Single Family Home" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('RES_Single Family Home', $_REQUEST['style']) ? 'checked' : '') ?>> Single Family Home
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input value="RES_Townhouse" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('RES_Townhouse', $_REQUEST['style']) ? 'checked' : '') ?>> Townhouse
          </label>
        </div>
        </div> <!-- 4 col -->
        <div class="col-lg-3">
          <div class="checkbox">
            <label>
              <input value="RES_Villa" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('RES_Villa', $_REQUEST['style']) ? 'checked' : '') ?>> Villa
            </label>
          </div>
          </div> <!-- 4 col -->
        </div>
        <div class="row display-none"  id="commercial-types">
          <div class="row-fluid">
            <div class="col-lg-12">
              <hr>
              <h4 >Choose a Commercial type : </h4>
            </div>
          </div>
          <div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="COM_Acreage/Ranch/Grove" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Acreage/Ranch/Grove', $_REQUEST['style']) ? 'checked' : '') ?>> Acreage/Ranch/Grove
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Aeronautical" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Aeronautical', $_REQUEST['style']) ? 'checked' : '') ?>> Aeronautical
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Agricultural" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Agricultural', $_REQUEST['style']) ? 'checked' : '') ?>> Agricultural
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Apartments" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Apartments', $_REQUEST['style']) ? 'checked' : '') ?>> Apartments
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Automotive" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Automotive', $_REQUEST['style']) ? 'checked' : '') ?>> Automotive
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Bar/Club" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Bar/Club', $_REQUEST['style']) ? 'checked' : '') ?>> Bar/Club
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Beauty/Barber" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Beauty/Barber', $_REQUEST['style']) ? 'checked' : '') ?>> Beauty/Barber
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Business Opportunity" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Business Opportunity', $_REQUEST['style']) ? 'checked' : '') ?>> Business Opportunity
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Business Opportunity (No Real Estate)" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Business Opportunity (No Real Estate)', $_REQUEST['style']) ? 'checked' : '') ?>> Business Opportunity (No Real Estate)
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Car Wash" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Car Wash', $_REQUEST['style']) ? 'checked' : '') ?>> Car Wash
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Churches" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Churches', $_REQUEST['style']) ? 'checked' : '') ?>> Churches
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Cold Storage" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Cold Storage', $_REQUEST['style']) ? 'checked' : '') ?>> Cold Storage
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Community Shopping Center" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Community Shopping Center', $_REQUEST['style']) ? 'checked' : '') ?>> Community Shopping Center
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Construction Service" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Construction Service', $_REQUEST['style']) ? 'checked' : '') ?>> Construction Service
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Day Care" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Day Care', $_REQUEST['style']) ? 'checked' : '') ?>> Day Care
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Distribution" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Distribution', $_REQUEST['style']) ? 'checked' : '') ?>> Distribution
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Distributor Routine Ven" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Distributor Routine Ven', $_REQUEST['style']) ? 'checked' : '') ?>> Distributor Routine Ven
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Executive Suites" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Executive Suites', $_REQUEST['style']) ? 'checked' : '') ?>> Executive Suites
		        </label>
		      </div>
</div> <!-- 4 col -->
<div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="COM_Fashion / Specialty" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Fashion / Specialty', $_REQUEST['style']) ? 'checked' : '') ?>> Fashion / Specialty
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Flex Space" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Flex Space', $_REQUEST['style']) ? 'checked' : '') ?>> Flex Space
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Food/Drink Sell/Service" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Food/Drink Sell/Service', $_REQUEST['style']) ? 'checked' : '') ?>> Food/Drink Sell/Service
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Free Standing" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Free Standing', $_REQUEST['style']) ? 'checked' : '') ?>> Free Standing
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_General Commercial" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_General Commercial', $_REQUEST['style']) ? 'checked' : '') ?>> General Commercial
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Grocery" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Grocery', $_REQUEST['style']) ? 'checked' : '') ?>> Grocery
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Group Housing/Aclf" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Group Housing/Aclf', $_REQUEST['style']) ? 'checked' : '') ?>> Group Housing/Aclf
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Heavy Weight Sales Serv" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Heavy Weight Sales Serv', $_REQUEST['style']) ? 'checked' : '') ?>> Heavy Weight Sales Serv
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Industrial" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Industrial', $_REQUEST['style']) ? 'checked' : '') ?>> Industrial
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Light Items Sales Only" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Light Items Sales Only', $_REQUEST['style']) ? 'checked' : '') ?>> Light Items Sales Only
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Manufacturing" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Manufacturing', $_REQUEST['style']) ? 'checked' : '') ?>> Manufacturing
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Marine/Marina" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Marine/Marina', $_REQUEST['style']) ? 'checked' : '') ?>> Marine/Marina
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Medical Offices" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Medical Offices', $_REQUEST['style']) ? 'checked' : '') ?>> Medical Offices
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Mini-Warehouse" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Mini-Warehouse', $_REQUEST['style']) ? 'checked' : '') ?>> Mini-Warehouse
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Mixed Use" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Mixed Use', $_REQUEST['style']) ? 'checked' : '') ?>> Mixed Use
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Mobile Home/RV Park" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Mobile Home/RV Park', $_REQUEST['style']) ? 'checked' : '') ?>> Mobile Home/RV Park
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Motel/Hotel" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Motel/Hotel', $_REQUEST['style']) ? 'checked' : '') ?>> Motel/Hotel
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Neighborhood Center" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Neighborhood Center', $_REQUEST['style']) ? 'checked' : '') ?>> Neighborhood Center
		        </label>
		      </div>
</div> <!-- 4 col -->
<div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="COM_Net Leased" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Net Leased', $_REQUEST['style']) ? 'checked' : '') ?>> Net Leased
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Office" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Office', $_REQUEST['style']) ? 'checked' : '') ?>> Office
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Office/Warehouse" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Office/Warehouse', $_REQUEST['style']) ? 'checked' : '') ?>> Office/Warehouse
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Other" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Other', $_REQUEST['style']) ? 'checked' : '') ?>> Other
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Outlet Center" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Outlet Center', $_REQUEST['style']) ? 'checked' : '') ?>> Outlet Center
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Outside Storage only" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Outside Storage only', $_REQUEST['style']) ? 'checked' : '') ?>> Outside Storage only
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Personal Services" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Personal Services', $_REQUEST['style']) ? 'checked' : '') ?>> Personal Services
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Power Center" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Power Center', $_REQUEST['style']) ? 'checked' : '') ?>> Power Center
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Recreation" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Recreation', $_REQUEST['style']) ? 'checked' : '') ?>> Recreation
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Regional Mall" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Regional Mall', $_REQUEST['style']) ? 'checked' : '') ?>> Regional Mall
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Research & Development" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Research & Development', $_REQUEST['style']) ? 'checked' : '') ?>> Research & Development
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Restaurants/Bars" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Restaurants/Bars', $_REQUEST['style']) ? 'checked' : '') ?>> Restaurants/Bars
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Retail" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Retail', $_REQUEST['style']) ? 'checked' : '') ?>> Retail
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_School/Institute" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_School/Institute', $_REQUEST['style']) ? 'checked' : '') ?>> School/Institute
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Self-Storage" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Self-Storage', $_REQUEST['style']) ? 'checked' : '') ?>> Self-Storage
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Service/Fueling Station" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Service/Fueling Station', $_REQUEST['style']) ? 'checked' : '') ?>> Service/Fueling Station
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Showroom/Office" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Showroom/Office', $_REQUEST['style']) ? 'checked' : '') ?>> Showroom/Office
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Single Family Home" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Single Family Home', $_REQUEST['style']) ? 'checked' : '') ?>> Single Family Home
		        </label>
		      </div>
</div> <!-- 4 col -->
<div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="COM_Special Purpose" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Special Purpose', $_REQUEST['style']) ? 'checked' : '') ?>> Special Purpose
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Strip Center" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Strip Center', $_REQUEST['style']) ? 'checked' : '') ?>> Strip Center
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Subdivided Vacant Land" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Subdivided Vacant Land', $_REQUEST['style']) ? 'checked' : '') ?>> Subdivided Vacant Land
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Theatre" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Theatre', $_REQUEST['style']) ? 'checked' : '') ?>> Theatre
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Theme / Festival" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Theme / Festival', $_REQUEST['style']) ? 'checked' : '') ?>> Theme / Festival
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Townhouse" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Townhouse', $_REQUEST['style']) ? 'checked' : '') ?>> Townhouse
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Vehicle Repair" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Vehicle Repair', $_REQUEST['style']) ? 'checked' : '') ?>> Vehicle Repair
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Vehicle Related" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Vehicle Related', $_REQUEST['style']) ? 'checked' : '') ?>> Vehicle Related
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Vehicle Sales" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Vehicle Sales', $_REQUEST['style']) ? 'checked' : '') ?>> Vehicle Sales
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Warehouse" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Warehouse', $_REQUEST['style']) ? 'checked' : '') ?>> Warehouse
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Warehouse-Storage" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Warehouse-Storage', $_REQUEST['style']) ? 'checked' : '') ?>> Warehouse-Storage
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="COM_Wholesale" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('COM_Wholesale', $_REQUEST['style']) ? 'checked' : '') ?>> Wholesale
		        </label>
		      </div>
		 </div> <!-- 4 col -->
                </div>
                <div class="row display-none"  id="vacant_land-types">
    <div class="row-fluid">
      <div class="col-lg-12">
        <hr>
        <h4 >Choose a Vacant Land type : </h4>
      </div>
    </div>
    <div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="REN_Billboard Site" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Billboard Site', $_REQUEST['style']) ? 'checked' : '') ?>> Billboard Site
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Business" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Business', $_REQUEST['style']) ? 'checked' : '') ?>> Business
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Commercial" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Commercial', $_REQUEST['style']) ? 'checked' : '') ?>> Commercial
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Crop Producing Farm" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Crop Producing Farm', $_REQUEST['style']) ? 'checked' : '') ?>> Crop Producing Farm
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Dude Ranch" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Dude Ranch', $_REQUEST['style']) ? 'checked' : '') ?>> Dude Ranch
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Duplex Use" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Duplex Use', $_REQUEST['style']) ? 'checked' : '') ?>> Duplex Use
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Farmland" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Farmland', $_REQUEST['style']) ? 'checked' : '') ?>> Farmland
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Fish Farm" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Fish Farm', $_REQUEST['style']) ? 'checked' : '') ?>> Fish Farm
		        </label>
		      </div>
</div> <!-- 4 col -->
<div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="REN_Four Units Use" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Four Units Use', $_REQUEST['style']) ? 'checked' : '') ?>> Four Units Use
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Groves" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Groves', $_REQUEST['style']) ? 'checked' : '') ?>> Groves
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Home and Income Housing" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Home and Income Housing', $_REQUEST['style']) ? 'checked' : '') ?>> Home and Income Housing
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Industrial" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Industrial', $_REQUEST['style']) ? 'checked' : '') ?>> Industrial
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Land fill" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Land fill', $_REQUEST['style']) ? 'checked' : '') ?>> Land fill
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Mining" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Mining', $_REQUEST['style']) ? 'checked' : '') ?>> Mining
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Mixed Use" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Mixed Use', $_REQUEST['style']) ? 'checked' : '') ?>> Mixed Use
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Mobile Home Use" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Mobile Home Use', $_REQUEST['style']) ? 'checked' : '') ?>> Mobile Home Use
		        </label>
		      </div>
</div> <!-- 4 col -->
<div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="REN_Multi-Family" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Multi-Family', $_REQUEST['style']) ? 'checked' : '') ?>> Multi-Family
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Other" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Other', $_REQUEST['style']) ? 'checked' : '') ?>> Other
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Plant Nursery" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Plant Nursery', $_REQUEST['style']) ? 'checked' : '') ?>> Plant Nursery
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Pud" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Pud', $_REQUEST['style']) ? 'checked' : '') ?>> Pud
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Ranchland" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Ranchland', $_REQUEST['style']) ? 'checked' : '') ?>> Ranchland
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Residential Development" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Residential Development', $_REQUEST['style']) ? 'checked' : '') ?>> Residential Development
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Single Family Use" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Single Family Use', $_REQUEST['style']) ? 'checked' : '') ?>> Single Family Use
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Sod Farm" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Sod Farm', $_REQUEST['style']) ? 'checked' : '') ?>> Sod Farm
		        </label>
		      </div>
</div> <!-- 4 col -->
<div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="REN_Timberland" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Timberland', $_REQUEST['style']) ? 'checked' : '') ?>> Timberland
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Trans/Cell Tower" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Trans/Cell Tower', $_REQUEST['style']) ? 'checked' : '') ?>> Trans/Cell Tower
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Tree Farm" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Tree Farm', $_REQUEST['style']) ? 'checked' : '') ?>> Tree Farm
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Triplex Use" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Triplex Use', $_REQUEST['style']) ? 'checked' : '') ?>> Triplex Use
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Well Field" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Well Field', $_REQUEST['style']) ? 'checked' : '') ?>> Well Field
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Working Ranch" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Working Ranch', $_REQUEST['style']) ? 'checked' : '') ?>> Working Ranch
		        </label>
		      </div>
</div> <!-- 4 col -->
        </div>
        <div class="row display-none"  id="rental-types">
    <div class="row-fluid">
      <div class="col-lg-12">
        <hr>
        <h4 >Choose a Rental type : </h4>
      </div>
    </div>
    <div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="REN_1/2 Duplex" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_1/2 Duplex', $_REQUEST['style']) ? 'checked' : '') ?>> 1/2 Duplex
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_1st Floor Multi-Story" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_1st Floor Multi-Story', $_REQUEST['style']) ? 'checked' : '') ?>> 1st Floor Multi-Story
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_2nd Floor Multi-Story" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_2nd Floor Multi-Story', $_REQUEST['style']) ? 'checked' : '') ?>> 2nd Floor Multi-Story
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_3rd Fl + above Multi-Story" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_3rd Fl + above Multi-Story', $_REQUEST['style']) ? 'checked' : '') ?>> 3rd Fl + above Multi-Story
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Apartment" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Apartment', $_REQUEST['style']) ? 'checked' : '') ?>> Apartment
		        </label>
		      </div>
</div> <!-- 4 col -->
<div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="REN_Co-op" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Co-op', $_REQUEST['style']) ? 'checked' : '') ?>> Co-op
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Condo" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Condo', $_REQUEST['style']) ? 'checked' : '') ?>> Condo
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Condo-Hotel" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Condo-Hotel', $_REQUEST['style']) ? 'checked' : '') ?>> Condo-Hotel
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Efficiency" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Efficiency', $_REQUEST['style']) ? 'checked' : '') ?>> Efficiency
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Fourplex" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Fourplex', $_REQUEST['style']) ? 'checked' : '') ?>> Fourplex
		        </label>
		      </div>
</div> <!-- 4 col -->
<div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="REN_Garage Apt" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Garage Apt', $_REQUEST['style']) ? 'checked' : '') ?>> Garage Apt
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Manufactured/Mobile Home" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Manufactured/Mobile Home', $_REQUEST['style']) ? 'checked' : '') ?>> Manufactured/Mobile Home
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Modular" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Modular', $_REQUEST['style']) ? 'checked' : '') ?>> Modular
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Single Family Home" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Single Family Home', $_REQUEST['style']) ? 'checked' : '') ?>> Single Family Home
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Stilt Home" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Stilt Home', $_REQUEST['style']) ? 'checked' : '') ?>> Stilt Home
		        </label>
		      </div>
</div> <!-- 4 col -->
<div class="col-lg-3">

		      <div class="checkbox">
		        <label>
		          <input value="REN_Townhouse" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Townhouse', $_REQUEST['style']) ? 'checked' : '') ?>> Townhouse
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Tri-Level" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Tri-Level', $_REQUEST['style']) ? 'checked' : '') ?>> Tri-Level
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Triplex" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Triplex', $_REQUEST['style']) ? 'checked' : '') ?>> Triplex
		        </label>
		      </div>
		      <div class="checkbox">
		        <label>
		          <input value="REN_Villa" name="style[]" class="checkbox_style" type="checkbox" <?=(isset($_REQUEST['style']) && in_array('REN_Villa', $_REQUEST['style']) ? 'checked' : '') ?>> Villa
		        </label>
		      </div>
          </div> <!-- 4 col -->
        </div>
              </form>