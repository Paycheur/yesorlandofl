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
<link href="/Assets/css/style.css" rel="stylesheet">


<!--[if lt IE 9]>
    <script src="/Assets/js/vendor/respond.min.js"></script>
<![endif]-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>window.jQuery || document.write('<script src="/Assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
<script src="/Assets/js/min/bootstrap.min.js"></script>
<!-- <script src="/Assets/js/min/typeahead.min.js"></script>
-->
<script src="/Assets/js/min/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/Assets/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/Assets/js/jquery.eislideshow.js"></script>
<script type="text/javascript" src="/Assets/js/jquery.easing.1.3.js"></script>
<!-- price range -->
<script type="text/javascript" src="/Assets/js/bootstrap-slider.js"></script>
<script src="/Assets/js/main.js"></script>
<script src="/Assets/js/app/login.js"></script>

<script src="/Assets/js/vendor/modernizr-2.6.2.min.js"></script>

  		<?php if(defined('CSS_PAGE'))
  		{?>
		<style type="text/css">@import url('<?=CSS_PAGE?>');</style>
		<?php
  		}
  		if(defined('JS_PAGE'))
  		{
  			if(is_array(JS_PAGE))
  			{
  				foreach(JS_PAGE as $js)
  				{
  				?>
  					<script type="text/javascript" src="<?=$js?>"></script>
  				<?php
  				}
  			}
  			else
  			{?>
   				<script type="text/javascript" src="<?=JS_PAGE?>"></script>
   		<?php
  			}
  		}?>
</head>

<body>
<?php 
require_once(dirname(__FILE__).'/../components/form-login.php'); ?>
<?php require_once(dirname(__FILE__).'/../components/form-register.php'); ?>

<nav class="navbar navbar-inverse navbar-fixed-top "><!--  -->
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <hgroup class="margin-zero navbar-brand">
        <h2 class="margin-zero lh-80 "><a class="white serif bold size-16" rel="tab"  href="#">THE <span class="italic">PORTFOLIO</span> GROUP</a></h2>
        <h6 class="margin-zero lh-80">
          <a class="color-sec  sans  size-14" rel="tab"  href="<?php echo $burl ?>">International real Estate Experts </a>
        </h6>
      </hgroup>
    </div><!-- navhead -->

    <div class="nav-collapse collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav fr-lg">
        <li><a rel="tab" href="<?php echo $burl ?>" title="home"><i class="icon-home"></i></a></li>
        <li><a rel="tab" href="<?php echo $burl ?>vision">Vision</a></li>
        <li class="dropdown">
          <a href="<?php echo $burl ?>" class="dropdown-toggle" data-toggle="dropdown">Property search <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a rel="tab" href="<?php echo $burl ?>residential.php">residential</a></li>
            <li><a rel="tab" href="<?php echo $burl ?>commercial.php">commercial</a></li>
            <li><a rel="tab" href="<?php echo $burl.$l_central_fl ?>">central florida</a></li>
          </ul>
        </li>
        <li><a rel="tab" href="<?php echo $burl ?>brand.php">Sell/Lease</a></li>
        <li><a rel="tab" href="<?php echo $burl ?>relocation">Relocation</a></li>
        <li><a rel="tab" href="<?php echo $burl ?>blog.php">Blog</a></li>

        <li><a rel="tab" href="<?php echo $burl ?>careers">Careers</a></li>
        <li><a rel="tab" href="<?php echo $burl ?>contact">Contact</a></li>

        <li class="dropdown">
          <a href="<?php echo $burl ?>" class="dropdown-toggle" data-toggle="dropdown">My Portfolio <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $burl ?>residential.php">Sing in / up</a></li>
            <li><a href="<?php echo $burl ?>commercial.php">Mange portfolio</a></li>
            <li><a href="<?php echo $burl.$l_central_fl ?>">enquirer more info</a></li>
          </ul>
        </li>
        <?php 
        if(isset($_SESSION['user']['id']))
        {?>
        	<li class="dropdown">
        		<a href="<?php echo $burl ?>" class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['user']['name'] ?> <b class="caret"></b></a>
        		<ul class="dropdown-menu">
            		<li><a href="/logout">Logout</a></li>
            	</ul>
        	</li>
        <?php 
        }?>
      </ul>
    </div>
  </div>
</nav>




<div id="container">