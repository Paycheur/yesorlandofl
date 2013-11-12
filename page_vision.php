<?php

header ('Content-Type:text/html; charset=UTF-8');
//define ('ICONE_PAGE', '../Img/bdd.png');
//define ('CSS_PAGE', '../Css/index.css');

define ('JS_PAGE', '');
define ('CONTROLER', 'page_vision.php');

require ('Inc/require.inc.php');

//$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';
//
//
//
////Variables
//$page['error']='';
//$page['confirmation']='';
//
//// Contr�leur
//switch ($EX)
//{
//  case 'home'   : home ($_SESSION['user']['id']);   break;
//
//
//}


//Header
require ('View/inc/header.php');


//Page static
require ('View/static/vision.php');


//Footer
require ('View/inc/footer.php');



?>