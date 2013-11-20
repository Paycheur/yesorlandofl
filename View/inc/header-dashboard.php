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




<!--[if lt IE 9]>
    <script src="/Assets/js/vendor/respond.min.js"></script>
<![endif]-->
  		<?php if(defined('CSS_PAGE')) : ?>
		    <style type="text/css">@import url('<?=CSS_PAGE?>');</style>
      <?php endif ?>

</head>
<body>


<?php
require_once(dirname(__FILE__).'/../components/form-login.php'); ?>
<?php require_once(dirname(__FILE__).'/../components/form-register.php'); ?>
