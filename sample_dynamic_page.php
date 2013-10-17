<?php

header ('Content-Type:text/html; charset=UTF-8');
//define ('ICONE_PAGE', '../Img/bdd.png');
//define ('CSS_PAGE', '../Css/index.css');
//define ('JS_PAGE', '');
define ('CONTROLER', 'sample_dynamic_page.php'); //nom du fichier php

require ('Inc/require.inc.php');

$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';

//Variables
$page['error']='';
$page['confirmation']='';

// Contr�leur
switch ($EX)
{
  case 'home'   : home ();   break;
}

/**
 * R�cup�ration de la mise en page
 */
require ('View/inc/main.view.php');

/********* Fonctions de contr�le *********/

/**
 * Affiche le formulaire et le tableau
 * 
 * @return none
 */


function home()
{
    global $page;

    $tab = array();
    
    
    $page['title'] = 'Sample Dynamic Page'; //nom de la page
    $page['class'] = 'VSample'; //nom de la class : VSample.view.php
    $page['method'] = 'home'; //nom de la fonction dans la class VSample : function home(){};
    $page['arg'] = $tab; //les paramètres qui seront passés à la vue
    
}

?>