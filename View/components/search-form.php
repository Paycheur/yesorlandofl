    <form action="search.php" class="form-holder padding-r-l-1em padding-1em">
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
          <select id="areas" name="areas" class="selectpicker padding-05em" data-style="btn-primary" multiple data-selected-text-format="count>3" data-width="100%"  data-live-search="true">
            <optgroup label="Most common" >
              <option value="933" class="notranslate">Heathrow</option>
              <option value="462" class="notranslate">Lake Mary</option>
              <option value="494" class="notranslate">Longwood</option>
              <option value="616" class="notranslate">Orlando</option>
              <option value="729" class="notranslate">Sanford</option>
              <option value="868" class="notranslate">Windermere</option>
            </optgroup>
            <optgroup label="More cities">
              <option value="104" class="notranslate">Altamonte Springs</option>
              <option value="114" class="notranslate">Apopka</option>
              <option value="144" class="notranslate">Belle Isle</option>
              <option value="201" class="notranslate">Casselberry</option>
              <option value="920" class="notranslate">Celebration</option>
              <option value="84" class="notranslate">Champions Gate</option>
              <option value="211" class="notranslate">Chuluota</option>
              <option value="217" class="notranslate">Clermont</option>
              <option value="247" class="notranslate">Davenport</option>
              <option value="254" class="notranslate">Debary</option>
              <option value="257" class="notranslate">Deland</option>
              <option value="259" class="notranslate">Deltona</option>
              <option value="281" class="notranslate">Eatonville</option>
              <option value="286" class="notranslate">Edgewood</option>
              <option value="297" class="notranslate">Eustis</option>
              <option value="305" class="notranslate">Fern Park</option>
              <option value="307" class="notranslate">Ferndale</option>
              <option value="335" class="notranslate">Geneva</option>
              <option value="346" class="notranslate">Gotha</option>
              <option value="402" class="notranslate">Howey In The Hills</option>
              <option value="403" class="notranslate">Hudson</option>
              <option value="447" class="notranslate">Kissimmee</option>
              <option value="461" class="notranslate">Lake Helen</option>
              <option value="507" class="notranslate">Maitland</option>
              <option value="550" class="notranslate">Minneola</option>
              <option value="554" class="notranslate">Montverde</option>
              <option value="558" class="notranslate">Mount Dora</option>
              <option value="561" class="notranslate">Mount Plymouth</option>
              <option value="593" class="notranslate">Oakland</option>
              <option value="600" class="notranslate">Ocoee</option>
              <option value="612" class="notranslate">Orange City</option>
              <option value="620" class="notranslate">Osteen</option>
              <option value="622" class="notranslate">Oviedo</option>
              <option value="669" class="notranslate">Poinciana</option>
              <option value="97" class="notranslate">Reunion</option>
              <option value="715" class="notranslate">Saint Cloud</option>
              <option value="754" class="notranslate">Sorrento</option>
              <option value="800" class="notranslate">Tavares</option>
              <option value="810" class="notranslate">Titusville</option>
              <option value="870" class="notranslate">Winter Garden</option>
              <option value="872" class="notranslate">Winter Park</option>
              <option value="873" class="notranslate">Winter Springs</option>
            </optgroup>
          </select>
        </div>
        <div class="col-lg-3 txt-center border-right-gray-light">
          <label for="rangeInput" class="display-block"><b>What is your price range :</b></label>
          <input type="text" class="display-block form-control " value="" data-slider-min="0" data-slider-max="1000000" data-slider-step="5" data-slider-value="[0,1000000]" data-slider-tooltip="hide" id="price-range">
          <label for="rangeInput" class="display-block padding-05em">From <b class="theMin">Any Price</b> to <b class="theMax">Any</b> :</label>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-white active">
              <input type="radio" name="options" id="option1"> For Sale
            </label>
            <label class="btn btn-white">
              <input type="radio" name="options" id="option2"> For Lease
            </label>
          </div>
        </div>
        <div class="col-lg-2 border-right-gray-light">
          <div class="relative">
            <label for="beds" class="display-inline"><b>Beds : </b></label>
            <input type='nummber' placeholder="Any" name='beds' value='' class='qty display-inline input-number form-control' />
            <input type='button' value='+' class='qtyplus' field='beds' />
            <input type='button' value='–' class='qtyminus' field='beds' />
          </div>
          <hr>
          <div class="relative">
            <label for="bathroom" class="display-inline"><b>Bathroom :</b></label>
            <input type='nummber' name='Bathroom' placeholder="Any" value='' class='qty display-inline input-number form-control' />
            <input type='button' value='+' class='qtyplus' field='Bathroom' />
            <input type='button' value='–' class='qtyminus' field='Bathroom' />
          </div>
        </div>
        <div class="col-lg-2 txt-center ">
          <!-- <label for=""><b>258  Matching</b></label> -->
          <h3 class='h4 margin-top-zero'>Matching Homes</h3>
          <h3 id="matching" class=' h1 margin-top-zero'>1958</h3>
          <button id="submit" class="btn btn-danger btn-lg btn-block"><i class="icon-home"></i> See all matching</button>
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
