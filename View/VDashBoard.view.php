<?php
class VDashBoard
{

	public function __construct() {return;}

	public function __destruct() {return;}


	public function homeDashboard($_value)
	{
		
		?>


		      <div class="col-lg-4">
		          <!--widget start-->
		          <aside class="profile-nav alt green-border">
		              <section class="panel">
		                  <div class="user-heading alt green-bg">
		                      <h1>Hello <?=$_SESSION['user']['name'] ?></h1>
		                  </div>

		                  <ul class="nav nav-pills nav-stacked">
		                  <?php if(isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1)
		                  {?>
		                      <li><a href="/dashboard/admin/visits"> <i class="icon-bell-alt"></i> Visits <?php if($_value['nbVisitsRequest'] > 0){ ?><span class="label label-warning pull-right r-activity"><?=$_value['nbVisitsRequest'] ?></span><?php }?></a></li>
		                  <?php 
		                  }?>
		                      <li><a href="/dashboard/mail"> <i class="icon-envelope-alt"></i> Message <?php if($_value['nbMessageNonLu'] > 0){ ?><span class="label label-success pull-right r-activity"><?=$_value['nbMessageNonLu'] ?></span><?php }?></a></li>
		                  </ul>

		              </section>
		          </aside>
		          <!--widget end-->
		          <!--widget start-->
		          <section class="panel">
		              <header class="panel-heading tab-bg-dark-navy-blue">
		                  <ul class="nav nav-tabs nav-justified ">
		                      <li class="active">
		                          <a href="#popular" data-toggle="tab">
		                              Favorites properties
		                          </a>
		                      </li>
		                      <li>
		                          <a href="#recent" data-toggle="tab">
		                              Recently viewed
		                          </a>
		                      </li>
		                  </ul>
		              </header>
		              <div class="panel-body">
		                  <div class="tab-content tasi-tab">
		                      <div class="tab-pane active" id="popular">
		                      <?php 
		                      $i=0;
		                      if(count($_value['favoritesProperties']) > 0)
		                      {
		                      foreach($_value['favoritesProperties'] as $prop)
		                      {
		                      	$allImg = $prop['img'];
		                      	$explImg = explode('|', $allImg);
		                      	?>
		                          <article class="media">
		                              <a class="pull-left thumb p-thumb">
		                                  <?=(isset($explImg[0]) ? '<img src="'.$explImg[0].'">' : '') ?>
		                              </a>
		                              <div class="media-body">
		                                  <a href="/property/<?=format_url($prop['type'].'-'.$prop['address'])?>/<?=$prop['id'] ?>" target="_blank" class=" p-head"><?=$prop['address'].', '.$prop['city'].', '.$prop['state'].' '.$prop['postal_code'] ?></a>
		                                  <p><?=(isset($prop['price']) && $prop['price'] != 0 ? 'Price : $'.$prop['price'].' |' : '')?><?=(isset($prop['sqft']) && $prop['sqft'] != 0 ? ' SQFT : '.$prop['sqft'].' |' : '')?><?=(isset($prop['bed']) ? ' Beds : '.$prop['sqft'].' |' : '')?><?=(isset($prop['bathroom']) ? ' Bathrooms : '.$prop['bathroom'].' |' : '')?></p>
		                              </div>
		                          </article>
		                          <hr>
		                       <?php 
		                       $i++;
		                       if($i==3)
		                       	break;
		                      }
		                      }
		                      if(count($_value['favoritesProperties']) > 3)
		                      {?>
		                          <a href="/dashboard/favorites" type="button" class="btn btn-success"><i class="icon-eye-open"></i> View more </a>
		                       <?php 
		                      }?>
		                      </div>

		                      <div class="tab-pane " id="recent">
		                          <?php 
		                      $i=0;
		                      if(count($_value['recentlyViewed']) > 0)
		                      {
		                      foreach($_value['recentlyViewed'] as $prop)
		                      {
		                      	$allImg = $prop['img'];
		                      	$explImg = explode('|', $allImg);
		                      	?>
		                          <article class="media">
		                              <a class="pull-left thumb p-thumb">
		                                  <?=(isset($explImg[0]) ? '<img src="'.$explImg[0].'">' : '') ?>
		                              </a>
		                              <div class="media-body">
		                                  <a href="/property/<?=format_url($prop['type'].'-'.$prop['address'])?>/<?=$prop['id'] ?>" target="_blank" class=" p-head"><?=$prop['address'].', '.$prop['city'].', '.$prop['state'].' '.$prop['postal_code'] ?></a>
		                                  <p><?=(isset($prop['price']) && $prop['price'] != 0 ? 'Price : $'.$prop['price'].' |' : '')?><?=(isset($prop['sqft']) && $prop['sqft'] != 0 ? ' SQFT : '.$prop['sqft'].' |' : '')?><?=(isset($prop['bed']) ? ' Beds : '.$prop['sqft'].' |' : '')?><?=(isset($prop['bathroom']) ? ' Bathrooms : '.$prop['bathroom'].' |' : '')?></p>
		                              </div>
		                          </article>
		                          <hr>
		                       <?php 
		                       $i++;
		                       if($i==3)
		                       	break;
		                      }
		                      }
		                      if(count($_value['recentlyViewed']) > 3)
		                      {?>
		                          <a href="/dashboard/recently_viewed" type="button" class="btn btn-success"><i class="icon-eye-open"></i> View more </a>
		                       <?php 
		                      }?>
		                      </div>
		                  </div>
		              </div>
		          </section>
		          <!--widget end-->
		      </div>
		      <div class="col-lg-8">
					<section class="panel">
						<header class="panel-heading">
						    Visits status
						</header>
						<table class="table table-striped table-advance table-hover">
						    <thead>
						    <tr>
						        <th><i class="icon-home"></i> Type</th>
						        <th class="hidden-phone"><i class="icon-road"></i> Address </th>
						        <th><i class="icon-time"></i> Date</th>
						        <th><i class="icon-time"></i> Hour</th>
						        <th><i class=" icon-edit"></i> Status</th>
						        <th></th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php 
						    if(count($_value['allRequestVisit']) > 0)
						    {
						    foreach($_value['allRequestVisit'] as $requestVisit)
						    {?>
							    <tr id="request-<?=$requestVisit['id_visit_request']?>">
							        <td><?=($requestVisit['type'] == 'vacant_land' ? 'Vacant Land' : ($requestVisit['type'] == 'commercial' ? 'Commercial' : ($requestVisit['type'] == 'rental' ? 'Rental' : ($requestVisit['type'] == 'residential' ? 'Residential' : ''))))?></td>
							        <td class="hidden-phone"><a href="/property/<?=format_url($requestVisit['type'].'-'.$requestVisit['address'])?>/<?=$requestVisit['data_id'] ?>" target="_blank" ><?=$requestVisit['address'].', '.$requestVisit['city'].', '.$requestVisit['state'].' '.$requestVisit['postal_code'] ?></a></td>
							        <td class="request-date"><?=date('Y-m-d', strtotime($requestVisit['date'])) ?></td>
							        <td class="request-hour"><?=$requestVisit['hour'] ?></td>
							        <td class="col_status"><span class="label <?=($requestVisit['status'] == 0 ? 'label-info' : ($requestVisit['status'] == 1 ? 'label-success' : ($requestVisit['status'] == 2 ? 'label-warning' : '')))?> label-mini" ><?=($requestVisit['status'] == 0 ? 'On confirmation' : ($requestVisit['status'] == 1 ? 'Approved' : ($requestVisit['status'] == 2 ? 'Suspended' : '')))?></span></td>
							        <td>
							            <a href="/property/<?=format_url($requestVisit['type'].'-'.$requestVisit['address'])?>/<?=$requestVisit['data_id'] ?>" target="_blank" class="btn btn-success btn-xs"><i class="icon-eye-open"></i></a>
							            <button class="btn btn-primary btn-xs edit-request" data-toggle="modal" href="#modalVisitRequest"><i class="icon-pencil"></i></button>
							            <button class="btn btn-danger btn-xs deleteVisitRequest"><i class="icon-trash "></i></button>
							        </td>
							    </tr>
							 <?php 
						    }
						    }?>
						    
						    </tbody>
						</table>
					</section>
	          </div>




	<?php 
	}
	
	public function showAllRencentlyViewed($_value)
	{
		?>
		
		 <div class="">
					<section class="panel">
						<header class="panel-heading">
						    20 Recently viewed
						</header>
						<table class="table table-striped table-advance table-hover">
						    <thead>
						    <tr>
						        <th><i class="icon-home"></i> Type</th>
						        <th class="hidden-phone"><i class="icon-road"></i> Address </th>
						        <th><i class="icon-time"></i> Price</th>
						        <th><i class="icon-time"></i> SQFT</th>
						        <th><i class=" icon-edit"></i> Beds</th>
						        <th><i class=" icon-edit"></i> Bathroom</th>
						        <th></th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php 
						    if(count($_value['recentlyViewed']) > 0)
						    {
						    foreach($_value['recentlyViewed'] as $prop)
						    {?>
							    <tr>
							        <td><?=($prop['type'] == 'vacant_land' ? 'Vacant Land' : ($prop['type'] == 'commercial' ? 'Commercial' : ($prop['type'] == 'rental' ? 'Rental' : ($prop['type'] == 'residential' ? 'Residential' : ''))))?></td>
							        <td class="hidden-phone"><?=$prop['address'].', '.$prop['city'].', '.$prop['state'].' '.$prop['postal_code'] ?></td>
							        <td><?=$prop['price'] ?></td>
							        <td><?=$prop['sqft'] ?></td>
							        <td><?=(isset($prop['bed']) ? $prop['bed'] : '') ?></td>
							        <td><?=(isset($prop['bathroom']) ? $prop['bathroom'] : '') ?></td>
							        <td>
							            <a href="/property/<?=format_url($prop['type'].'-'.$prop['address'])?>/<?=$prop['data_id'] ?>" target="_blank" class="btn btn-success btn-xs"><i class="icon-eye-open"></i></a>
							        </td>
							    </tr>
							 <?php 
						    }
						    }?>
						    
						    </tbody>
						</table>
					</section>
	          </div>
	          
		<?php
	}
	
	public function showAllFavoritesProperties($_value)
	{
		?>
		
		 <div class="">
					<section class="panel">
						<header class="panel-heading">
						    Favorites properties
						</header>
						<table class="table table-striped table-advance table-hover">
						    <thead>
						    <tr>
						        <th><i class="icon-home"></i> Type</th>
						        <th class="hidden-phone"><i class="icon-road"></i> Address </th>
						        <th><i class="icon-time"></i> Price</th>
						        <th><i class="icon-time"></i> SQFT</th>
						        <th><i class=" icon-edit"></i> Beds</th>
						        <th><i class=" icon-edit"></i> Bathroom</th>
						        <th></th>
						    </tr>
						    </thead>
						    <tbody>
						    <?php
						    if(count($_value['favoritesProperties']) > 0)
						    { 
						    foreach($_value['favoritesProperties'] as $prop)
						    {?>
							    <tr>
							        <td><?=($prop['type'] == 'vacant_land' ? 'Vacant Land' : ($prop['type'] == 'commercial' ? 'Commercial' : ($prop['type'] == 'rental' ? 'Rental' : ($prop['type'] == 'residential' ? 'Residential' : ''))))?></td>
							        <td class="hidden-phone"><?=$prop['address'].', '.$prop['city'].', '.$prop['state'].' '.$prop['postal_code'] ?></td>
							        <td><?=$prop['price'] ?></td>
							        <td><?=$prop['sqft'] ?></td>
							        <td><?=(isset($prop['bed']) ? $prop['bed'] : '') ?></td>
							        <td><?=(isset($prop['bathroom']) ? $prop['bathroom'] : '') ?></td>
							        <td>
							            <a href="/property/<?=format_url($prop['type'].'-'.$prop['address'])?>/<?=$prop['data_id'] ?>" target="_blank" class="btn btn-success btn-xs"><i class="icon-eye-open"></i></a>
							        </td>
							    </tr>
							 <?php 
						    }
						    }?>
						    
						    </tbody>
						</table>
					</section>
	          </div>
	          
		<?php
	}
	
	public function adminShowAllVisitsRequest($_value)
	{
//		if($_value['nbPageMax'] > 1)
//		{
//			if($_value['pageActuel'] > 1)
//			{
//				echo '<a href="/dashboard/admin/visits/'.($_value['pageActuel']-1).'"><= Previous Page</a>';
//			}
//			
//			if($_value['nbPageMax'] > $_value['pageActuel'])
//			{
//				echo '<a href="/dashboard/admin/visits/'.($_value['pageActuel']+1).'">Next Page =></a>';
//			}
//		}	

					
		?>
		<div class="col-lg-5">
            <section class="panel">
              <header class="panel-heading">
                  Visits approved today
              </header>
              <table class="table table-striped table-advance table-hover">
                  <thead>
                  <tr>
                  		<th><i class="icon-user"></i> Property</th>
                      <th><i class="icon-user"></i> Client name</th>
                      <th><i class="icon-time"></i> Hour</th>
                  </tr>
                  </thead>
                  <tbody>
                 <?php 
                 	if(count($_value['allRequestVisitsToday']) > 0)
                 	{
					    foreach($_value['allRequestVisitsToday'] as $requestVisit)
					    {?>
						    <tr id="request-<?=$requestVisit['id_visit_request']?>">
						       <td class="hidden-phone"><a href="/property/<?=format_url($requestVisit['type'].'-'.$requestVisit['address'])?>/<?=$requestVisit['data_id'] ?>" target="_blank"><?=$requestVisit['address'].', '.$requestVisit['city'].', '.$requestVisit['state'].' '.$requestVisit['postal_code'] ?></a></td>
						         <td><a target="_blank" href="/dashboard/profile/<?=$requestVisit['member_id']?>"><?=$requestVisit['name'] ?></a></td>
						        <td class="request-hour"><?=$requestVisit['hour'] ?></td>
						    </tr>
						 <?php 
					    }
					 }?>
                  
                  </tbody>
              </table>
            </section>
          </div>
          <div class="col-lg-7">
            <section class="panel">
              <header class="panel-heading">
                  Visits approved for the next 7 days
              </header>
              <table class="table table-striped table-advance table-hover">
                  <thead>
                  <tr>
                  		<th><i class="icon-user"></i> Property</th>
                      <th><i class="icon-user"></i> Client name</th>
                      <th><i class="icon-time"></i> Hour</th>
                      <th><i class="icon-time"></i> Date</th>
                  </tr>
                  </thead>
                  <tbody>
                 <?php 
                 	if(count($_value['allRequestVisitsWeek']) > 0)
                 	{
					    foreach($_value['allRequestVisitsWeek'] as $requestVisit)
					    {?>
						    <tr id="request-<?=$requestVisit['id_visit_request']?>">
						       <td class="hidden-phone"><a href="/property/<?=format_url($requestVisit['type'].'-'.$requestVisit['address'])?>/<?=$requestVisit['data_id'] ?>" target="_blank"><?=$requestVisit['address'].', '.$requestVisit['city'].', '.$requestVisit['state'].' '.$requestVisit['postal_code'] ?></a></td>
						         <td><a target="_blank" href="/dashboard/profile/<?=$requestVisit['member_id']?>"><?=$requestVisit['name'] ?></a></td>
						        <td class="request-hour"><?=$requestVisit['hour'] ?></td>
						         <td class="request-date"><?=date('Y-m-d', strtotime($requestVisit['date'])) ?></td>
						    </tr>
						 <?php 
					    }
					 }?>
                  
                  </tbody>
              </table>
            </section>
          </div>
          <div style="clear:both"></div>
		<div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                  Visits demands
                  <?php
                  if($_value['nbPageMax'] > 1)
					{
						?>
                          <ul class="unstyled inbox-pagination">
                              <li><span><?=(($_value['pageActuel']-1)*$_value['nbParPage'])+1 ?>-<?=(($_value['pageActuel'])*$_value['nbParPage']) ?> of <?=$_value['nbTotalResult'] ?></span></li>
                             <?php 
                             if($_value['pageActuel'] > 1)
						{?>
                              <li>
                                  <a href="/dashboard/admin/visits/<?=($_value['pageActuel']-1)?>" class="np-btn btn-xs"><i class="icon-angle-left  pagination-left"></i></a>
                              </li>
                            <?php 
						}
						if($_value['nbPageMax'] > $_value['pageActuel'])	
						{?>
                              <li>
                                  <a href="/dashboard/admin/visits/<?=($_value['pageActuel']+1)?>" class="np-btn btn-xs"><i class="icon-angle-right pagination-right"></i></a>
                              </li>
                            <?php 
						}?>
                          </ul>
					<?php 
					}?>
              </header>
              <table class="table table-striped table-advance table-hover">
                  <thead>
                  <tr>
                  		<th><i class="icon-user"></i> Property</th>
                      <th><i class="icon-user"></i> Client name</th>
                      <th><i class="icon-envelope-alt"></i> Email </th>
                      <th><i class="icon-envelope-alt"></i> Phone </th>
                      <th><i class="icon-time"></i> Date</th>
                      <th><i class="icon-time"></i> Hour</th>
                      <th><i class=" icon-edit"></i> Status</th>
                      <th></th>
                  </tr>
                  </thead>
                  <tbody>
                 <?php 
                 if(count($_value['allRequestVisit']) > 0)
                 {
				    foreach($_value['allRequestVisit'] as $requestVisit)
				    {?>
					    <tr id="request-<?=$requestVisit['id_visit_request']?>">
					      <td class="hidden-phone"><a href="/property/<?=format_url($requestVisit['type'].'-'.$requestVisit['address'])?>/<?=$requestVisit['data_id'] ?>" target="_blank"><?=$requestVisit['address'].', '.$requestVisit['city'].', '.$requestVisit['state'].' '.$requestVisit['postal_code'] ?></a></td>
					         <td><a target="_blank" href="/dashboard/profile/<?=$requestVisit['member_id']?>"><?=$requestVisit['name'] ?></a></td>
					         <td><?=$requestVisit['email'] ?></td>
					         <td><?=$requestVisit['phone'] ?></td>
					        <td class="request-date"><?=date('Y-m-d', strtotime($requestVisit['date'])) ?></td>
					        <td class="request-hour"><?=$requestVisit['hour'] ?></td>
					        <td class="col_status"><span class="switchStatusVisitRequest label <?=($requestVisit['status'] == 0 ? 'label-info' : ($requestVisit['status'] == 1 ? 'label-success' : ($requestVisit['status'] == 2 ? 'label-warning' : '')))?> label-mini" data-toggle="modal" href="#modalSwitchStatusVisitRequest" ><?=($requestVisit['status'] == 0 ? 'On confirmation' : ($requestVisit['status'] == 1 ? 'Approved' : ($requestVisit['status'] == 2 ? 'Suspended' : '')))?></span></td>
					        <td>
					        	<input type="hidden" class="id_visit_request" value="<?=$requestVisit['id_visit_request'] ?>" />
					            <a href="/property/<?=format_url($requestVisit['type'].'-'.$requestVisit['address'])?>/<?=$requestVisit['data_id'] ?>" target="_blank" class="btn btn-success btn-xs"><i class="icon-eye-open"></i></a>
					            <button class="btn btn-primary btn-xs edit-request" data-toggle="modal" href="#modalVisitRequest"><i class="icon-pencil"></i></button>
					            <button class="btn btn-danger btn-xs deleteVisitRequest"><i class="icon-trash "></i></button>
					            <a id="<?=$requestVisit['email'] ?>" class="btn btn-warning btn-xs send-mail" href="#">
									<i class="icon-envelope"></i>
								</a>
					        </td>
					    </tr>
					 <?php 
				    }
				 }?>
                  
                  </tbody>
              </table>
            </section>
          </div>
		<?php
	}
	
	public function showListMember($_value)
	{

		?>
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        List of all subscribed clients
                        <?php
	                  if($_value['nbPageMax'] > 1)
						{
							?>
	                          <ul class="unstyled inbox-pagination">
	                              <li><span><?=(($_value['pageActuel']-1)*$_value['nbParPage'])+1 ?>-<?=(($_value['pageActuel'])*$_value['nbParPage']) ?> of <?=$_value['nbTotalResult'] ?></span></li>
	                             <?php 
	                             if($_value['pageActuel'] > 1)
							{?>
	                              <li>
	                                  <a href="/dashboard/admin/listMember/<?=($_value['pageActuel']-1)?>" class="np-btn btn-xs"><i class="icon-angle-left  pagination-left"></i></a>
	                              </li>
	                            <?php 
							}
							if($_value['nbPageMax'] > $_value['pageActuel'])	
							{?>
	                              <li>
	                                  <a href="/dashboard/admin/listMember/<?=($_value['pageActuel']+1)?>" class="np-btn btn-xs"><i class="icon-angle-right pagination-right"></i></a>
	                              </li>
	                            <?php 
							}?>
	                          </ul>
						<?php 
						}?>
                    </header>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name </th>
                            <th>Occupation</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
						<?php 
						if(count($_value['allMember'])> 0)
						{
							foreach($_value['allMember'] as $member)
							{
							?>
		                        <tr>
		                          <td><?=$member['id'] ?></td>
		                           <td><?=$member['name']?></td>
		                           <td><?=$member['occupation'] ?></td>
		                           <td><?=$member['company'] ?></td>
		                           <td><?=$member['email'] ?></td>
		                           <td><?=$member['phone'] ?></td>
		                           <td><?=$member['address'] ?></td>
		                           <td><a href="/dashboard/profile/<?=$member['id'] ?>" class="btn btn-success btn-xs"><i class="icon-eye-open"></i></a> 
		                           <? if($member['email'] != '')
		                           {
		                           	?>
		                           		<a href="#" id="<?=$member['email'] ?>" class="btn btn-warning btn-xs send-mail"><i class="icon-envelope"></i></a>
		                           <?php 
		                           }?></td>
		                        </tr>
                        <?php 
							}
						}?>
                     
                        </tbody>
                    </table>
                </section>
            </div>
		<?php 
	}
	
	public function showProfile($_value)
	{
		if(count($_value['member']) > 0)
		{
		?>
		<div class="row">
            <aside class="profile-nav col-lg-3">
                <section class="panel">
                    <div class="user-heading round">
                        <h1><?=($_value['member']['name'] != '' ? $_value['member']['name'] : '') ?> <?=($_value['member']['last_name'] != '' ? $_value['member']['last_name'] : '') ?></h1>
                        <p><?=$_value['member']['email'] ?></p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#"> <i class="icon-user"></i> Profile</a>
                        
                        <? if($_SESSION['user']['id'] == $_value['member']['id'])
                        { ?>
                       	 <li><a href="/dashboard/profile/edit"> <i class="icon-edit"></i> Edit profile</a></li>
                        <?php 
                        }
                        else if($_SESSION['user']['admin'] == 1 && $_value['member']['email'] != '')
                        {?>
                        	<li><a href="#" class="send-mail" id="<?=$_value['member']['email']?>"> <i class="icon-envelope"></i> Contact</a>
                        <?php 
                        }?>
                    </ul>

                </section>
            </aside>
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                        Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                    </div>
                    <div class="panel-body bio-graph-info">
                        <h1>Bio Graph</h1>
                        <div class="row">
                            <div class="bio-row">
                                <p><span>Last Name </span>: <?=$_value['member']['name'] ?></p>
                            </div>
                            <div class="bio-row">
                                <p><span>First Name </span>: <?=$_value['member']['last_name'] ?></p>
                            </div>
                            <div class="bio-row">
                                <p><span>Company </span>: <?=$_value['member']['company'] ?></p>
                            </div>
                            <div class="bio-row">
                                <p><span>Occupation </span>: <?=$_value['member']['occupation'] ?></p>
                            </div>
                            <div class="bio-row">
                                <p><span>Email </span>: <?=$_value['member']['email'] ?></p>
                            </div>
                            <div class="bio-row">
                                <p><span>Mobile </span>: <?=$_value['member']['phone'] ?></p>
                            </div>
                            <div class="bio-row">
                                <p><span>Address </span>: <?=$_value['member']['address'] ?></p>
                            </div>
                            <div class="bio-row">
                                <p><span>Date Register </span>: <?=$_value['member']['date_register'] ?></p>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
		<?
		}
	}
	
	public function editProfile($_value)
	{
		?>
		<div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                               <h1><?=($_value['member']['name'] != '' ? $_value['member']['name'] : '') ?> <?=($_value['member']['last_name'] != '' ? $_value['member']['last_name'] : '') ?></h1>
                       		<p><?=$_value['member']['email'] ?></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li><a href="/dashboard/profile"> <i class="icon-user"></i> Profile</a></li>
                              <li class="active"><a href="#"> <i class="icon-edit"></i> Edit profile</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                              Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1> Profile Info</h1>
                              <form class="form-horizontal" action="/dashboard/profile/edit" method="POST" role="form">
                               
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Last Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="f-name" placeholder=" " name="name" value="<?=$_value['member']['name'] ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">First Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="l-name" placeholder=" " name="last_name" value="<?=$_value['member']['last_name'] ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="email" placeholder=" " name="email" value="<?=$_value['member']['email'] ?>">
                                      </div>
                                      <?php 
                                      if(isset($_value['erreur']['email']))
                                      {
                                     	 ?>
                                     	 <div class="col-lg-2">
                                     	 	<span style="color:red;font-weight:bold;">Invalid Email.</span>
                                     	 </div>
                                    <?php 
                                      }?>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Company</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="c-name" placeholder=" " name="company" value="<?=$_value['member']['company'] ?>">
                                      </div>
                                  </div>
                                 
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Occupation</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="occupation" placeholder=" " name="occupation" value="<?=$_value['member']['occupation'] ?>">
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Mobile</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mobile" placeholder=" " name="phone" value="<?=$_value['member']['phone'] ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Address</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="url" placeholder="" name="address" value="<?=$_value['member']['address'] ?>">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-success" name="save_profile">Save</button>
                                          <button type="button" class="btn btn-default">Cancel</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section>
                          <div class="panel panel-primary">
                              <div class="panel-heading"> Sets New Password</div>
                              <div class="panel-body">
                                  <form class="form-horizontal" role="form" action="/dashboard/profile/edit" method="POST" >
                                  	<?php 
                                  	if($_value['member']['password'] != '')
                                  	{?>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Current Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="c-pwd" placeholder=" " name="current_password">
                                          </div>
                                          <?php 
	                                      if(isset($_value['erreur']['current_password']))
	                                      {
	                                     	 ?>
	                                     	 <div class="col-lg-2">
	                                     	 	<span style="color:red;font-weight:bold;">Wrong current password.</span>
	                                     	 </div>
	                                    <?php 
	                                      }?>
                                      </div>
                                     <?php 
                                  	}?>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">New Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="n-pwd" placeholder=" " name="new_password">
                                          </div>
                                          <?php 
	                                      if(isset($_value['erreur']['new_password']))
	                                      {
	                                     	 ?>
	                                     	 <div class="col-lg-2">
	                                     	 	<span style="color:red;font-weight:bold;">At least 6 characters</span>
	                                     	 </div>
	                                    <?php 
	                                      }?>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Re-type New Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="rt-pwd" placeholder=" " name="new_password_again">
                                          </div>
                                          <?php 
	                                      if(isset($_value['erreur']['new_password_again']))
	                                      {
	                                     	 ?>
	                                     	 <div class="col-lg-2">
	                                     	 	<span style="color:red;font-weight:bold;">The two passwords are not identical</span>
	                                     	 </div>
	                                    <?php 
	                                      }?>
                                      </div>

                                    

                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button type="submit" class="btn btn-info" name="save_password">Save</button>
                                              <button type="button" class="btn btn-default">Cancel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>
		<?php
	}
	
	public function showConversation($_value)
	{
		?>
		 <!--mail inbox start-->
              <div class="mail-box">
                  <aside class="sm-side">
                      <div class="user-head">
                          <a href="javascript:;" class="inbox-avatar">
                              <img src="Assets/dashboard/img/mail-avatar.jpg" alt="">
                          </a>
                          <div class="user-name">
                              <h5><a href="#"><?=$_SESSION['user']['name'] ?></a></h5>
                          </div>
                      </div>
                      <div class="inbox-body">
                          <a class="btn btn-compose" data-toggle="modal" href="#modalComposeMail">
                              Compose
                          </a>
                         
                      </div>
                      <ul class="inbox-nav inbox-divider">
                          <li class="active">
                              <a href="/dashboard/mail"><i class="icon-inbox"></i> Inbox <?php if($_value['nbMessageNonLu'] > 0){?><span class="label label-danger pull-right"><?=$_value['nbMessageNonLu'] ?></span><?php }?></a>

                          </li>

                          <li>
                              <a href="#"><i class=" icon-trash"></i> Trash</a>
                          </li>
                      </ul>

                      <div class="inbox-body text-center">

                          <div class="btn-group">
                              <a href="javascript:;" class="btn mini btn-success">
                                  <i class="icon-phone"></i> 04 00 00 00 00
                              </a>
                          </div>

                      </div>

                  </aside>
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Inbox</h3>
						<?php
						if($_value['nbPageMax'] > 1)
						{
							?>
                          <ul class="unstyled inbox-pagination">
                              <li><span><?=(($_value['pageActuel']-1)*$_value['nbParPage'])+1 ?>-<?=(($_value['pageActuel'])*$_value['nbParPage']) ?> of <?=$_value['nbTotalConversation'] ?></span></li>
                             <?php 
                             if($_value['pageActuel'] > 1)
							{?>
                              <li>
                                  <a href="/dashboard/mail_<?=($_value['pageActuel']-1)?>" class="np-btn"><i class="icon-angle-left  pagination-left"></i></a>
                              </li>
                            <?php 
							}
							if($_value['nbPageMax'] > $_value['pageActuel'])	
							{?>
                              <li>
                                  <a href="/dashboard/mail_<?=($_value['pageActuel']+1)?>" class="np-btn"><i class="icon-angle-right pagination-right"></i></a>
                              </li>
                            <?php 
							}?>
                          </ul>
						<?php 
						}?>
                      </div>
                      <div class="inbox-body">
                         <div class="mail-option">


                         </div>
                          <table class="table table-inbox table-hover">
                            <tbody>
                            <?
                            if(count($_value['allConversation']) > 0)
                            {
                            foreach($_value['allConversation'] as $conversation)
                            { 
                            	
							?>
                              <tr <?=($conversation['lu'] == 0 ? 'class="unread"' : '' )?>>
                                  <td class="inbox-small-cells" style="width:20px;">
                                  		<input type="hidden" name="id_conversation" value="<?=$conversation['id_conversation'] ?>" />
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="view-message"><b><a href="/dashboard/mail/<?=$conversation['id_conversation']?>"><?=$conversation['interlocuteur']['name'].($conversation['interlocuteur']['last_name'] != '' ? ' '.$conversation['interlocuteur']['last_name'] : '') ?></a></b></td>
                                  <td class="view-message"><a href="/dashboard/mail/<?=$conversation['id_conversation']?>"><?=$conversation['titre'] ?></a></td>
                                  <td class="view-message  text-right"><?=$conversation['date'] ?></td>
                              </tr>
                            <?php 
                            }
                            }?>
                            
                          </tbody>
                          </table>
                      </div>
                  </aside>
              </div>
              <!--mail inbox end-->
		<?php
		
	}
	
	public function showMessage($_value)
	{
		?>
		 <!--mail inbox start-->
              <div class="mail-box">
                  <aside class="sm-side">
                      <div class="user-head">
                          <a href="javascript:;" class="inbox-avatar">
                              <img src="Assets/dashboard/img/mail-avatar.jpg" alt="">
                          </a>
                          <div class="user-name">
                              <h5><a href="#"><?=$_SESSION['user']['name'] ?></a></h5>
                          </div>
                      </div>
                      <div class="inbox-body">
                          <a class="btn btn-compose" data-toggle="modal" href="#modalComposeMail">
                              Compose
                          </a>
  
                      </div>
                      <ul class="inbox-nav inbox-divider">
                          <li class="active">
                              <a href="/dashboard/mail"><i class="icon-inbox"></i> Inbox <?php if($_value['nbMessageNonLu'] > 0){?><span class="label label-danger pull-right"><?=$_value['nbMessageNonLu'] ?></span><?php }?></a>

                          </li>
                          <li>
                              <a href="#"><i class=" icon-trash"></i> Trash</a>
                          </li>
                      </ul>

                      <div class="inbox-body text-center">

                          <div class="btn-group">
                              <a href="javascript:;" class="btn mini btn-success">
                                  <i class="icon-phone"></i> 04 00 00 00 00
                              </a>
                          </div>

                      </div>

                  </aside>
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Inbox</h3>

                        

                      </div>
                      <div class="inbox-body">
                        	<h4 style="text-align:center;text-decoration:underline;font-weight:bold;">Subject : <?=$_value['conversation']['titre'] ?></h4>
                        	<?php 
                        	$nbMessage = count($_value['messages']);
                        	$i=1;
                        	if(count($nbMessage) >0)
                        	{
                        	foreach($_value['messages'] as $message)
                        	{
                        		
                        		?>
								<div<?=($i == $nbMessage ? ' id="last_msg"' : '') ?>>
									<div> <!-- head message -->
										<p style="float:right">
											<?=$message['date'] ?>
										</p>
										<p><b>
										<?php 
										if($_value['interlocuteur']['id'] == $message['id_expediteur'])
										{?>
											From <?=$_value['interlocuteur']['name'].($_value['interlocuteur']['last_name'] != '' ? ' '.$_value['interlocuteur']['last_name'] : '') ?> to you.
											
										<?php 
										}
										else 
										{?>
											From you to <?=$_value['interlocuteur']['name'].($_value['interlocuteur']['last_name'] != '' ? ' '.$_value['interlocuteur']['last_name'] : '') ?>
										<?php 
										}?>
										</b></p>
										
									</div>
									<p><?=$message['message'] ?></p>
								</div>
								<hr/> 
							<?php	
								$i++;
							}
                        	}?>
							

                           <form action="/dashboard/mail/<?=$_value['conversation']['id_conversation'] ?>" method="post" id="form_answer">
                           		<textarea name="message" class="form-control" cols="30" rows="10" placeholder="Answer"></textarea>
                           		<br/>
                           		<button type="submit" class="btn btn-send" name="answer">Send</button>
                           </form>
                           
                            

                      </div>
                  </aside>
              </div>
              <!--mail inbox end-->
		<?php
			
	}
	
	public function test()
	{
	?>
	
<!--Mail page -->


<div align="center">
  <h2>Yoann new page starts here</h2>
</div>

<section id="main-content">
          <section class="wrapper">
             
          </section>
</section>


<div align="center">
  <h2>Yoann new page starts here</h2>
</div>
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <aside class="profile-nav col-lg-3">
                <section class="panel">
                    <div class="user-heading round">
                        <h1><?=$_SESSION['user']['name'] ?></h1>
                        <p>jsmith@flatlab.com</p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="profile.html"> <i class="icon-user"></i> Profile</a>
                        <li><a href="profile-edit.html"> <i class="icon-edit"></i> Edit profile</a></li>
                    </ul>

                </section>
            </aside>
            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="bio-graph-heading">
                        Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                    </div>
                    <div class="panel-body bio-graph-info">
                        <h1>Bio Graph</h1>
                        <div class="row">
                            <div class="bio-row">
                                <p><span>First Name </span>: Jonathan</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Last Name </span>: Smith</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Country </span>: Australia</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Birthday</span>: 13 July 1983</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Occupation </span>: UI Designer</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Email </span>: jsmith@flatlab.com</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Mobile </span>: (12) 03 4567890</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Phone </span>: 88 (02) 123456</p>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>

        <!-- page end-->
    </section>
</section>

<div align="center">
  <h2>Yoann new page starts here</h2>
</div>

<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="Assets/dashboard/img/profile-avatar.jpg" alt="">
                              </a>
                              <h1>Jonathan Smith</h1>
                              <p>jsmith@flatlab.com</p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li><a href="profile.html"> <i class="icon-user"></i> Profile</a></li>
                              <li class="active"><a href="profile-edit.html"> <i class="icon-edit"></i> Edit profile</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                              Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1> Profile Info</h1>
                              <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">About Me</label>
                                      <div class="col-lg-10">
                                          <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">First Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="f-name" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Last Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="l-name" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Country</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="c-name" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Birthday</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="b-day" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Occupation</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="occupation" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="email" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Mobile</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mobile" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Website URL</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="url" placeholder="http://www.demowebsite.com ">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-success">Save</button>
                                          <button type="button" class="btn btn-default">Cancel</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section>
                          <div class="panel panel-primary">
                              <div class="panel-heading"> Sets New Password &amp; Avatar</div>
                              <div class="panel-body">
                                  <form class="form-horizontal" role="form">
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Current Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="c-pwd" placeholder=" ">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">New Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="n-pwd" placeholder=" ">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Re-type New Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="rt-pwd" placeholder=" ">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Change Avatar</label>
                                          <div class="col-lg-6">
                                              <input type="file" class="file-pos" id="exampleInputFile">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button type="submit" class="btn btn-info">Save</button>
                                              <button type="button" class="btn btn-default">Cancel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>

              <!-- page end-->
          </section>
</section>

<div align="center">
  <h2>Yoann new admin page starts here</h2>
</div>

<section id="main-content">
    <section class="wrapper">

      <div class="row">

          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                  Visits demands
              </header>
              <table class="table table-striped table-advance table-hover">
                  <thead>
                  <tr>
                      <th><i class="icon-user"></i> client name</th>
                      <th><i class="icon-envelope-alt"></i> email </th>
                      <th><i class="icon-envelope-alt"></i> phone </th>
                      <th><i class="icon-time"></i> date</th>
                      <th><i class=" icon-edit"></i> Status</th>
                      <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>Vcant land</td>
                      <td>Lorem Ipsum dorolo imit</td>
                      <td>06 .....</td>
                      <td>12/24/2014</td>
                      <td><span class="label label-info label-mini">on confirmation</span></td>
                      <td>
                          <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                          <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                          <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                      </td>
                  </tr>
                  <tr>
                      <td>Commercial</td>
                      <td>Lorem Ipsum dorolo</td>
                      <td>06 .....</td>
                      <td>12/24/2014</td>
                      <td><span class="label label-warning label-mini">Suspended</span></td>
                      <td>
                          <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                          <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                          <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                      </td>
                  </tr>
                  <tr>
                      <td>Residential</td>
                      <td>Lorem Ipsum dorolo</td>
                      <td>06 .....</td>
                      <td>12/24/2014</td>
                      <td><span class="label label-success label-mini">Approved</span></td>
                      <td>
                          <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                          <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                          <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                      </td>
                  </tr>
                  </tbody>
              </table>
            </section>
          </div>


      </div>

    </section>
</section>


<div align="center">
  <h2>Yoann new admin page starts here</h2>
</div>

<section id="main-content">
          <section class="wrapper">
              <!--mail inbox start-->
              <div class="mail-box">
                  <aside class="sm-side">
                      <div class="user-head">
                          <a href="javascript:;" class="inbox-avatar">
                              <img src="Assets/dashboard/img/mail-avatar.jpg" alt="">
                          </a>
                          <div class="user-name">
                              <h5><a href="#">Jonathan Smith</a></h5>
                              <span><a href="#">jsmith@gmail.com</a></span>
                          </div>
                          <a href="javascript:;" class="mail-dropdown pull-right">
                              <i class="icon-chevron-down"></i>
                          </a>
                      </div>
                      <div class="inbox-body">
                          <a class="btn btn-compose" data-toggle="modal" href="#myModal">
                              Compose
                          </a>
                          <!-- Modal -->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          <h4 class="modal-title">Compose</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form class="form-horizontal" role="form">
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">To</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" class="form-control" id="inputEmail1" placeholder="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Cc / Bcc</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" class="form-control" id="cc" placeholder="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Subject</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" class="form-control" id="inputPassword1" placeholder="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Message</label>
                                                  <div class="col-lg-10">
                                                      <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="icon-plus icon-white"></i>
                                                        <span>Attachment</span>
                                                        <input type="file" multiple="" name="files[]">
                                                      </span>
                                                      <button type="submit" class="btn btn-send">Send</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                      </div>
                      <ul class="inbox-nav inbox-divider">
                          <li class="active">
                              <a href="#"><i class="icon-inbox"></i> Inbox <span class="label label-danger pull-right">2</span></a>

                          </li>
                          <li>
                              <a href="#"><i class="icon-envelope-alt"></i> Sent Mail</a>
                          </li>
                          <li>
                              <a href="#"><i class=" icon-trash"></i> Trash</a>
                          </li>
                      </ul>

                  </aside>
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Inbox</h3>

                          <ul class="unstyled inbox-pagination">
                              <li><span>1-50 of 234</span></li>
                              <li>
                                  <a href="#" class="np-btn"><i class="icon-angle-left  pagination-left"></i></a>
                              </li>
                              <li>
                                  <a href="#" class="np-btn"><i class="icon-angle-right pagination-right"></i></a>
                              </li>
                          </ul>

                      </div>
                      <div class="inbox-body">
                         <div class="mail-option">


                         </div>
                          <table class="table table-inbox table-hover">
                            <tbody>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="view-message  dont-show">Vector Lab</td>
                                  <td class="view-message ">Lorem ipsum dolor imit set.</td>
                                  <td class="view-message  inbox-small-cells"><i class="icon-paper-clip"></i></td>
                                  <td class="view-message  text-right">9:27 AM</td>
                              </tr>
                              <tr class="unread">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="view-message dont-show">Mosaddek Hossain</td>
                                  <td class="view-message">Hi Bro, How are you?</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">March 15</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="view-message dont-show">Dulal khan</td>
                                  <td class="view-message">Lorem ipsum dolor sit amet</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">June 15</td>
                              </tr>
                              <tr class="">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="view-message dont-show">Facebook</td>
                                  <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                                  <td class="view-message inbox-small-cells"></td>
                                  <td class="view-message text-right">April 01</td>
                              </tr>

                          </tbody>
                          </table>
                      </div>
                  </aside>
              </div>
              <!--mail inbox end-->
          </section>
</section>


<div align="center">
  <h2>Yoann new admin page starts here</h2>
</div>

<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        List of all subscribed clients
                    </header>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name </th>
                            <th>Last Name </th>
                            <th>Country</th>
                            <th>Birthday</th>
                            <th>Occupation</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Phone</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>1</td>
                           <td>Jonathan</td>
                           <td>Smith</td>
                           <td>Australia</td>
                           <td>13 July 1983</td>
                           <td>UI Designer</td>
                           <td>jsmith@flatlab.com</td>
                           <td>(12) 03 4567890</td>
                           <td>88 (02) 123456</td>
                        </tr>
                        <tr>
                          <td>2</td>
                           <td>Jonathan</td>
                           <td>Smith</td>
                           <td>Australia</td>
                           <td>13 July 1983</td>
                           <td>UI Designer</td>
                           <td>jsmith@flatlab.com</td>
                           <td>(12) 03 4567890</td>
                           <td>88 (02) 123456</td>
                        </tr>

                        </tbody>
                    </table>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>



		<?php
	}
}