<?php
global $page;
if(isset($page['class']))
	$vpage = new $page['class'];


 $burl ='/';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en-US" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en-US" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en-US" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-US" class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="http://mondedesign.net">
 <title><?=$page['title']?></title>

<!-- Web font -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<!-- Main CSS -->
<!-- Bootstrap core CSS -->
<link href="/Assets/dashboard/css/bootstrap.min.css" rel="stylesheet">
<link href="/Assets/dashboard/css/bootstrap-reset.css" rel="stylesheet">
<!--external css-->
<link href="/Assets/dashboard/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="/Assets/dashboard/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" href="/Assets/dashboard/css/owl.carousel.css" type="text/css">
<!-- Custom styles for this template -->
<link href="/Assets/dashboard/css/style.css" rel="stylesheet">
<link href="/Assets/dashboard/css/style-responsive.css" rel="stylesheet" />

<link href="/Assets/dashboard/css/style.css" rel="stylesheet">

<!-- jquery ui -->
<link href="/Assets/js/jquery-ui-1.8.23/css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />


<!--[if lt IE 9]>
    <script src="/Assets/js/vendor/respond.min.js"></script>
<![endif]-->
  		<?php if(defined('CSS_PAGE')) : ?>
		    <style type="text/css">@import url('<?=CSS_PAGE?>');</style>
      <?php endif ?>

</head>
<body>


<?php
require_once(dirname(__FILE__).'/../components/dashboard/switchStatusVisitRequest.php');
require_once(dirname(__FILE__).'/../components/dashboard/compose_mail.php');
require_once(dirname(__FILE__).'/../components/form-login.php');
require_once(dirname(__FILE__).'/../components/form-register.php'); 
require_once(dirname(__FILE__).'/../components/dashboard/form-visit-request.php'); 

$message = new MMessage($_SESSION['user']['admin']);
$nbMessageNonLu = $message->getNbMessageNonLu();

$visits = new BddVisitRequest();
$resultVisitRequest = $visits->selectFunction(array('COUNT', '1'), array('status' => 0));
if(isset($resultVisitRequest[0]['value']))
	$nbVisitRequest =  $resultVisitRequest[0]['value'];
else
	$nbVisitRequest = 0;
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
                      <span class="username"><?=$_SESSION['user']['name'] ?></span>
                      <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu extended logout">
                      <div class="log-arrow-up"></div>
                      <li><a href="/home"><i class=" icon-suitcase"></i>the website</a></li>
                      <li><a href="/dashboard/profile"><i class="icon-cog"></i> profile</a></li>
                      <li><a href="/dashboard/mail"><i class="icon-bell-alt"></i> message</a></li>
                      <li><a href="/logout"><i class="icon-key"></i> Log Out</a></li>
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
            <li <?=($_SERVER['REQUEST_URI'] == '/dashboard' ? 'class="active"' : '') ?>>
                <a class="" href="/dashboard">
                    <i class="icon-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li <?=(strpos($_SERVER['REQUEST_URI'], '/dashboard/mail') !== false ? 'class="active"' : '') ?>>
                <a class="" href="/dashboard/mail">
                    <i class="icon-envelope"></i>
                    <span>Mail </span>
                    <?php 
                    if($nbMessageNonLu > 0)
                    {?>
                    	<span class="label label-danger pull-right mail-info"><?=$nbMessageNonLu ?></span>
                    <?php 
                    }?>
                </a>
            </li>
            <li <?=(strpos($_SERVER['REQUEST_URI'], '/dashboard/profile') !== false ? 'class="active"' : '') ?>>
                <a class="" href="/dashboard/profile">
                    <i class="icon-user"></i>
                    <span>Profile </span>
                </a>
            </li>
			<?php 
			if(isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1)
			{?>
            <li <?=(strpos($_SERVER['REQUEST_URI'], '/dashboard/admin/visits') !== false ? 'class="active"' : '') ?>>
                <a class="" href="/dashboard/admin/visits">
                    <i class="icon-bell-alt"></i>
                    <span>Visits </span>
                    <?php 
                    if($nbVisitRequest > 0)
                    {?>
                    	<span class="label label-danger pull-right mail-info"><?=$nbVisitRequest ?></span>
                    <?php 
                    }?>
                </a>
            </li>

            <li <?=(strpos($_SERVER['REQUEST_URI'], '/dashboard/admin/listMember') !== false ? 'class="active"' : '') ?>>
                <a class="" href="/dashboard/admin/listMember">
                    <i class="icon-list"></i>
                    <span>Clients Listing </span>
                </a>
            </li>
            <?php 
			}?>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">

    	<div class="row">
