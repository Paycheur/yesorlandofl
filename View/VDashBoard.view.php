<?php
class VDashBoard
{

	public function __construct() {return;}

	public function __destruct() {return;}


	public function homeDashboard($_value)
	{
		?>
<section id="container" class="">
<!--header start-->
<header class="header white-bg">
      <div class="sidebar-toggle-box">
          <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
      </div>
      <!--logo start-->
      <a href="go to front page" class="logo">
		<img src="/Assets/dashboard/img/logo.png" alt="the portfolio group">
      </a>
      <!--logo end-->
      <div class="top-nav ">
          <!--search & user info start-->
          <ul class="nav pull-right top-menu">

              <!-- user login dropdown start-->
              <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                      <img alt="" src="Assets/dashboard/img/avatar1_small.jpg">
                      <span class="username">Jhon Doue</span>
                      <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu extended logout">
                      <div class="log-arrow-up"></div>
                      <li><a href="#"><i class=" icon-suitcase"></i>the website</a></li>
                      <li><a href="#"><i class="icon-cog"></i> profile</a></li>
                      <li><a href="#"><i class="icon-bell-alt"></i> message</a></li>
                      <li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
                  </ul>
              </li>
              <!-- user login dropdown end -->
          </ul>
          <!--search & user info end-->
      </div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="active">
                <a class="" href="index.html">
                    <i class="icon-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="" href="inbox.html">
                    <i class="icon-envelope"></i>
                    <span>Mail </span>
                    <span class="label label-danger pull-right mail-info">2</span>
                </a>
            </li>
            <li>
                <a class="" href="profile.html">
                    <i class="icon-user"></i>
                    <span>profile </span>
                    <span class="label label-danger pull-right mail-info">2</span>
                </a>
            </li>

            <li>
                <a class="" href="profile.html">
                    <i class="icon-bell-alt"></i>
                    <span><small>admin</small> Visits </span>
                    <span class="label label-danger pull-right mail-info">2</span>
                </a>
            </li>

            <li>
                <a class="" href="profile.html">
                    <i class="icon-envelope"></i>
                    <span><small>admin</small> Mail </span>
                    <span class="label label-danger pull-right mail-info">2</span>
                </a>
            </li>

            <li>
                <a class="" href="profile.html">
                    <i class="icon-list"></i>
                    <span><small>admin</small> Clients Listing </span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">

    	<div class="row">
		      <div class="col-lg-4">
		          <!--widget start-->
		          <aside class="profile-nav alt green-border">
		              <section class="panel">
		                  <div class="user-heading alt green-bg">
		                      <a href="#">
		                          <img alt="" src="Assets/dashboard/img/profile-avatar.jpg">
		                      </a>
		                      <h1>Hello Jonathan Smith</h1>
		                  </div>

		                  <ul class="nav nav-pills nav-stacked">
		                      <li><a href="javascript:;"> <i class="icon-bell-alt"></i> Visits <span class="label label-warning pull-right r-activity">03</span></a></li>
		                      <li><a href="javascript:;"> <i class="icon-envelope-alt"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
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
		                          <article class="media">
		                              <a class="pull-left thumb p-thumb">
		                                  <img src="Assets/dashboard/img/product1.jpg">
		                              </a>
		                              <div class="media-body">
		                                  <a class=" p-head" href="#">Property address</a>
		                                  <p>beds, sqft, prix ...</p>
		                              </div>
		                          </article>
		                          <hr>
		                          <article class="media">
		                              <a class="pull-left thumb p-thumb">
		                                  <img src="Assets/dashboard/img/product2.png">
		                              </a>
		                              <div class="media-body">
		                                  <a class=" p-head" href="#">Property address</a>
		                                  <p>beds, sqft, prix ...</p>
		                              </div>
		                          </article>
		                          <hr>
		                          <article class="media">
		                              <a class="pull-left thumb p-thumb">
		                                  <img src="Assets/dashboard/img/product3.png">
		                              </a>
		                              <div class="media-body">
		                                  <a class=" p-head" href="#">Property address</a>
		                                  <p>beds, sqft, prix ...</p>
		                              </div>
		                          </article>
		                          <br>
		                          <button type="button" class="btn btn-success"><i class="icon-eye-open"></i> View more </button>
		                      </div>

		                      <div class="tab-pane " id="recent">
		                          <article class="media">
		                              <a class="pull-left thumb p-thumb">
		                                  <img src="Assets/dashboard/img/product1.jpg">
		                              </a>
		                              <div class="media-body">
		                                  <a class=" p-head" href="#">Property address</a>
		                                  <p>beds, sqft, prix ...</p>
		                              </div>
		                          </article>
		                          <hr>
		                          <article class="media">
		                              <a class="pull-left thumb p-thumb">
		                                  <img src="Assets/dashboard/img/product2.png">
		                              </a>
		                              <div class="media-body">
		                                  <a class=" p-head" href="#">Property address</a>
		                                  <p>beds, sqft, prix ...</p>
		                              </div>
		                          </article>
		                          <hr>
		                          <article class="media">
		                              <a class="pull-left thumb p-thumb">
		                                  <img src="Assets/dashboard/img/product3.png">
		                              </a>
		                              <div class="media-body">
		                                  <a class=" p-head" href="#">Property address</a>
		                                  <p>beds, sqft, prix ...</p>
		                              </div>
		                          </article>
		                          <br>
		                          <button type="button" class="btn btn-success"><i class="icon-eye-open"></i> View more </button>
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
						        <th class="hidden-phone"><i class="icon-road"></i> address </th>
						        <th><i class="icon-time"></i> date</th>
						        <th><i class=" icon-edit"></i> Status</th>
						        <th></th>
						    </tr>
						    </thead>
						    <tbody>
						    <tr>
						        <td>Vcant land</td>
						        <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
						        <td>12/24/2014</td>
						        <td><span class="label label-info label-mini">on confirmation</span></td>
						        <td>
						            <a href="un lien ver le font pour voir le bien" class="btn btn-success btn-xs"><i class="icon-eye-open"></i></a>
						            <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
						            <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
						        </td>
						    </tr>
						    <tr>
						        <td>Commercial</td>
						        <td class="hidden-phone">Lorem Ipsum dorolo</td>
						        <td>12/24/2014</td>
						        <td><span class="label label-warning label-mini">Suspended</span></td>
						        <td>
						            <button class="btn btn-success btn-xs"><i class="icon-eye-open"></i></button>
						            <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
						            <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
						        </td>
						    </tr>
						    <tr>
						        <td>Residential</td>
						        <td class="hidden-phone">Lorem Ipsum dorolo</td>
						        <td>12/24/2014</td>
						        <td><span class="label label-success label-mini">Approved</span></td>
						        <td>
						            <button class="btn btn-success btn-xs"><i class="icon-eye-open"></i></button>
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
<!--main content end-->
</section>


<!--Mail page -->


<div align="center">
  <h2>Yoann new page starts here</h2>
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