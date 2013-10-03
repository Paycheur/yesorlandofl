<div id="modalVisitRequest" class="modal fade"  role="dialog">
							<div class="modal-dialog">
							  <div class="modal-content">
							  
								  <div class="modal-header">
								    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								    <h3 id="myModalLabel">PICK UP A DATE AND TIME</h3>
								  </div>
								  <div class="modal-body">
								    <form action="" id="formVisitRequest">
								    	<div id="date" class="input-append">
								    	  <input data-format="yyyy-MM-dd" type="text" placeholder="<?php echo date('y - d - m')?>" class="form-control" name="visit_date"></input>
								    	  <span class="add-on">
								    	    <i data-time-icon="icon-time" data-date-icon="icon-calendar" >
								    	    </i>
								    	  </span>
								    	</div>
								    	<div id="time" class="input-append">
								    	    <input data-format="hh:mm:ss" type="text"  placeholder="9:00 am" class="form-control" name="visit_hour"></input>
								    	    <span class="add-on">
								    	      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
								    	      </i>
								    	    </span>
								    	</div>
								    	<div id="name-holder"  class="input-append">
								    	    <?=$_SESSION['user']['name'] ?>

								    	</div>
								    	<button id="submitVisitRequest" class="btn btn-primary">Submit</button>
								    </form>
								    <hr>
								    <div class="row-fluid">
								    	<div class="col-lg-2">
								    		<img src="img/jere.jpg" class="img-circle">
								    	</div>
								    	<span class="col-lg-10">
								    		<hgroup>
								    			<h5 class="margin-zero lh-100">JERE MATHENY</h5>
								    			<h6 class="margin-zero lh-100"><small>will send a confirmation under 12h</small></h6>
								    		</hgroup>
								    		<p>
								    			<i class="icon-mobile-phone"></i> 407-697-2176
								    		</p>
								    	</span>
								    </div>

								  </div>
								  <div class="modal-footer">
								    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
								  </div>
								</div>
							</div>
						</div><!-- model -->