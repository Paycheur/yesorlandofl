<?php

header ('Content-Type:text/html; charset=UTF-8');
//define ('ICONE_PAGE', '../Img/bdd.png');
//define ('CSS_PAGE', '../Css/index.css');
define ('JS_PAGE', '/Assets/Js/dashboard.req.js');
define ('CONTROLER', 'dashboard.php');

require ('Inc/require.inc.php');

$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';



//Variables
$page['error']='';
$page['confirmation']='';
if(!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id']))
	header('Location:login.php');
	
// Contr�leur
switch ($EX)
{
  case 'home'   : home ($_SESSION['user']['id']);   break;
  case 'logout'   : logout ();   break;

}

/**
 * R�cup�ration de la mise en page
 */
require ('View/main.view.php');

/********* Fonctions de contr�le *********/

/**
 * Affiche le formulaire et le tableau
 * 
 * @return none
 */


function home($idUser)
{
    global $page;

    
    $tab = array();
    
    $member = new BddMember();
    $rows = $member->select(array('id' => $idUser));
    if(count($rows) > 0)
    {
    	$member->load($rows[0]);
    	$tab['member'] = $member;
    }
    else
    {
    	header('Location:login.php');
    }
    
    $page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'homeDashboard';
    $page['arg'] = $tab;
    
}

function logout()
{
	unset($_SESSION['user']);
	header('Location:login.php');
}


?>