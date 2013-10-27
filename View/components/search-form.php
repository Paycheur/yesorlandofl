    <?php
    $arrayCityMost = array('Heathrow','Lake Mary','Longwood','Orlando','Sanford','Windermere');
    $arrayCityMore = array('Altamonte Springs','Apopka','Belle Isle','Casselberry','Celebration','Champions Gate','Chuluota','Clermont','Davenport','Debary','Deland','Deltona','Eatonville','Edgewood','Eustis','Fern Park','Ferndale','Geneva','Gotha','Howey In The Hills','Hudson','Kissimmee','Lake Helen','Maitland','Minneola','Montverde','Mount Dora','Mount Plymouth','Oakland','Ocoee','Orange City','Osteen','Oviedo','Poinciana','Reunion','Saint Cloud','Sorrento','Tavares','Titusville','Winter Garden','Winter Park','Winter Springs');?>

    <form action="search" method="POST" class="form-holder padding-r-l-1em padding-1em" id="formSearch">
      <div class="row">
        <div class="col-lg-2 border-right-gray-light">
          <label for="property-type"><b>What Would you like to Buy ?</b></label>
          <div data-toggle="buttons" id='types-btns'>
            <a href="#" id="residential-type-btn" class="display-block padding-05em txt-left"> Residential <i class="icon-angle-down"></i>
            </a>
            <a href="#" id="commercial-type-btn" class="display-block txt-left">
              Commercial <i class="icon-angle-down"></i>
            </a>
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
          <label for="rangeInput" class="display-block"><b>What is your price range :</b></label>
          <input type="text" class="display-block form-control " value="<?=(isset($_REQUEST['price']) ? $_REQUEST['price'] : '') ?>" name="price" data-slider-min="0" data-slider-max="1000000" data-slider-step="1000" data-slider-value="[0,1000000]" data-slider-tooltip="hide" id="price-range">
          <label for="rangeInput" class="display-block padding-05em">From <b class="theMin">Any Price</b> to <b class="theMax">Any</b></label>

          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-white active">
              <input type="radio" name="option" id="option1" value="sale"> For Sale
            </label>
            <label class="btn btn-white">
              <input type="radio" name="option" id="option2" value="lease"> For Lease
            </label>
          </div>
        </div>
        <div class="col-lg-2 border-right-gray-light">
          <div class="relative">
            <label for="beds" class="display-inline"><b>Beds : </b></label>
            <input type='nummber' placeholder="Any" name='beds' value='<?=(isset($_REQUEST['beds']) ? $_REQUEST['beds'] : '') ?>' class='qty display-inline input-number form-control' />
            <input type='button' value='+' class='qtyplus' field='beds' />
            <input type='button' value='–' class='qtyminus' field='beds' />
          </div>
          <hr>
          <div class="relative">
            <label for="bathroom" class="display-inline"><b>Bathroom :</b></label>
            <input type='nummber' name='Bathroom' placeholder="Any" value='<?=(isset($_REQUEST['bathroom']) ? $_REQUEST['bathroom'] : '') ?>' class='qty display-inline input-number form-control' />
            <input type='button' value='+' class='qtyplus' field='Bathroom' />
            <input type='button' value='–' class='qtyminus' field='Bathroom' />
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
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
        </div> <!-- 4 col -->
        <div class="col-lg-3">
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
        </div> <!-- 4 col -->
        <div class="col-lg-3">
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
        </div> <!-- 4 col -->
        <div class="col-lg-3">
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
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
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
        </div> <!-- 4 col -->
        <div class="col-lg-3">
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
        </div> <!-- 4 col -->
        <div class="col-lg-3">
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
        </div> <!-- 4 col -->
        <div class="col-lg-3">
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
          <div class="checkbox">
           <label>
             <input type="checkbox"> Type
           </label>
          </div>
        </div> <!-- 4 col -->
      </div>
    </form>
