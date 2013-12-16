<?php
header ('Content-Type:text/html; charset=UTF-8');
//define ('ICONE_PAGE', '../Img/bdd.png');
//define ('CSS_PAGE', '../Css/index.css');
define ('JS_PAGE', '/Assets/js/app/dashboard.js');
define ('CONTROLER', 'page_dashboard.php');

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
	case 'home'   : home ();   break;
	case 'switchStatusVisitRequest' : switchStatusVisitRequest(); exit;
	case 'deleteVisitRequest' : deleteVisitRequest(); exit;
	case 'showAllRecentlyViewed' : showAllRecentlyViewed(); break;
	case 'showAllFavoritesProperties' : showAllFavoritesProperties(); break;
	case 'adminVisits' : adminVisits(); break;
	case 'showListMember' : showListMember(); break;
	case 'showProfile' : showProfile(); break;
	case 'editProfile' : editProfile(); break;
	case 'showConversation' : showConversation(); break;
	case 'showMessageConversation' : showMessageConversation(); break;
	case 'listMemberAutocomplete' : listMemberAutocomplete(); exit;
	case 'newConversation' : newConversation(); exit;
	case 'test' : test(); break;
}

/**
 * R�cup�ration de la mise en page
 */
require ('View/inc/main-dashboard.view.php');

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

    
    $dashboard = new MDashboard($_SESSION['user']['admin']);
    $allRequestVisit = $dashboard->getAllRequestVisit(20);
    $tab['allRequestVisit'] = $allRequestVisit;
    
    $favoritesProperties = $dashboard->getFavoritesProperties(4);
    $tab['favoritesProperties'] = $favoritesProperties;
    
    $recentlyViewed = $dashboard->getPropertiesViewed(4);
    $tab['recentlyViewed'] = $recentlyViewed;
    
    $page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'homeDashboard';
    $page['arg'] = $tab;

}

function switchStatusVisitRequest()
{
	$dbVisitRequest = new BddVisitRequest();
	$rows = $dbVisitRequest->select(array('id' => $_POST['id_request']));
	if(count($rows) > 0)
	{
		$dbVisitRequest->load($rows[0]);
		$dbVisitRequest->setStatus($_POST['status']);
		$dbVisitRequest->update();
	}
}


function deleteVisitRequest()
{
	$dbVisitRequest = new BddVisitRequest();
	$dbVisitRequest->setId($_POST['id_request']);
	$dbVisitRequest->delete();
}

function showAllRecentlyViewed()
{
	 global $page;
    $tab = array();
    
	$dashboard = new MDashboard($_SESSION['user']['admin']);
	$recentlyViewed = $dashboard->getPropertiesViewed(20);
    $tab['recentlyViewed'] = $recentlyViewed;
    
    $page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'showAllRencentlyViewed';
    $page['arg'] = $tab;
}

function showAllFavoritesProperties()
{
	global $page;
    $tab = array();
    
	$dashboard = new MDashboard($_SESSION['user']['admin']);

	$favoritesProperties = $dashboard->getFavoritesProperties(100);
    $tab['favoritesProperties'] = $favoritesProperties;
    
    $page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'showAllFavoritesProperties';
    $page['arg'] = $tab;
}

function adminVisits()
{
	global $page;
    $tab = array();
    
  	$dashboard = new MDashboard($_SESSION['user']['admin']);
	
	$nbParPage = 20;
	if(isset($_GET['page']))
		$p = $_GET['page'];
	else
		$p = 1;
	
	$n = ($nbParPage*$p)-$nbParPage;
	$allRequestVisit = $dashboard->getAllRequestVisit($nbParPage, $n);
	$nbTotalResult = $dashboard->getNbRequestVisit();
    $tab['allRequestVisit'] = $allRequestVisit;
    $tab['nbTotalResult'] = $nbTotalResult;
    $tab['nbParPage'] = $nbParPage;
    $tab['nbPageMax'] = ceil($nbTotalResult/$nbParPage);
    $tab['pageActuel'] = $p;
    $page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'adminShowAllVisitsRequest';
    $page['arg'] = $tab;
}

function showListMember()
{
	global $page;
    $tab = array();
    
    $member = new BddMember();
    $nbParPage = 20;
	if(isset($_GET['page']))
		$p = $_GET['page'];
	else
		$p = 1;
	
	$n = ($nbParPage*$p)-$nbParPage;
	
	$rows = $member->select(array(), array(), array('name'=>'ASC'), array($n, $nbParPage));
	$nbResultMax = $member->selectFunction(array('COUNT','1'));
	$nbTotalResult=$nbResultMax[0]['value'];
	
    $tab['allMember'] = $rows;
    $tab['nbTotalResult'] = $nbTotalResult;
    $tab['nbParPage'] = $nbParPage;
    $tab['nbPageMax'] = ceil($nbTotalResult/$nbParPage);
    $tab['pageActuel'] = $p;

    $page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'showListMember';
    $page['arg'] = $tab;
}

function showProfile()
{
	global $page;
    $tab = array();
    
    $member = new BddMember();
	
	if(isset($_GET['member']))
		$idMember=$_GET['member'];
	else
		$idMember=$_SESSION['user']['id'];
	
	
	$rows =$member->select(array('id'=>$idMember));
    
	if(isset($rows[0]))
	{
		$tab['member'] = $rows[0];
	}
	else
	{
		$tab['member'] = array();
	}
    $page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'showProfile';
    $page['arg'] = $tab;
}

function editProfile()
{
	global $page;
    $tab = array();
    
    $member = new BddMember();
    $idMember=$_SESSION['user']['id'];
	
	$rows =$member->select(array('id'=>$idMember));
   
	$tab['erreur'] = array();
	if(isset($rows[0]) && isset($_REQUEST['save_profile']))
    {
    	
    	if(count($rows[0]) > 0)
    	{
	    	$member->load($rows[0]);
	    	$member->setAddress($_REQUEST['address']);
	    	$member->setCompany($_REQUEST['company']);
	    	$Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
			if(preg_match($Syntaxe,$_REQUEST['email']))
			{
	    		$member->setEmail($_REQUEST['email']);
			}
			else
			{
				$tab['erreur']['email'] = true;
			}
	    	$member->setLastName($_REQUEST['last_name']);
	    	$member->setName($_REQUEST['name']);
	    	$member->setOccupation($_REQUEST['occupation']);
	    	$member->setPhone($_REQUEST['phone']);
	    	$member->update();
	    	
	    	$rows =$member->select(array('id'=>$idMember));
    	}
    	
    }
    else if(isset($rows[0]) && isset($_REQUEST['save_password']))
    {
    	if(count($rows[0]) > 0)
    	{
	    	$member->load($rows[0]);
	    	if($member->getPassword() != '') //si le membre a déjà un mot de passe
	    	{
	    		if(isset($_REQUEST['current_password']) && isset($_REQUEST['new_password']) && isset($_REQUEST['new_password_again']))
	    		{
	    			if(md5($_REQUEST['current_password']) == $member->getPassword())
	    			{
	    				if(strlen($_REQUEST['new_password']) > 6)
	    				{
	    					if($_REQUEST['new_password'] == $_REQUEST['new_password_again'])
	    					{
	    						$member->setPassword(md5($_REQUEST['new_password']));
	    						$member->update();
	    					}
	    					else
	    					{
	    						$tab['erreur']['new_password_again']= true;
	    					}
	    				}
	    				else
	    				{
	    					$tab['erreur']['new_password']= true;
	    				}
	    			}
	    			else
	    			{
	    				$tab['erreur']['current_password'] = true;
	    				
	    			}
	    		}
	    		else
	    		{
	    			home();
	    			return;
	    		}
	    	}
	    	else //si le membre n'a pas de mot de passe (facebook)
	    	{
	    		if(isset($_REQUEST['new_password']) && isset($_REQUEST['new_password_again']))
	    		{
    				if(strlen($_REQUEST['new_password']) > 6)
    				{
    					if($_REQUEST['new_password'] == $_REQUEST['new_password_again'])
    					{
    						$member->setPassword(md5($_REQUEST['new_password']));
    						$member->update();
    					}
    					else
    					{
    						$tab['erreur']['new_password_again']= true;
    					}
    				}
    				else
    				{
    					$tab['erreur']['new_password']= true;
    				}
	    			
	    		}
	    		else
	    		{
	    			home();
	    			return;
	    		}
	    	}
    	}
    }

    if(count($tab['erreur']) == 0 && (isset($_REQUEST['save_password']) || isset($_REQUEST['save_profile'])))
    {
    	showProfile();
    	return;
    }
    
	if(isset($rows[0]))
	{
		$tab['member'] = $rows[0];
	}
	else
	{
		$tab['member'] = array();
	}
    $page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'editProfile';
    $page['arg'] = $tab;
}

function showConversation()
{
	global $page;
    $tab = array();

    $message = new MMessage($_SESSION['user']['admin']);
    
	$nbParPage = 20;
	if(isset($_GET['page']))
		$p = $_GET['page'];
	else
		$p = 1;

	$n = ($nbParPage*$p)-$nbParPage;
	$allConversation = $message->getAllConversation($nbParPage, $n);

	foreach($allConversation as $i => $conversation)
	{
		$type = '';
		if($conversation['id_expediteur'] == $_SESSION['user']['id'])
		{
			$type = 'expediteur';
			$idInterlocuteur = $conversation['id_destinataire'];
		}
		else
		{
			$type = 'destinataire';
			$idInterlocuteur = $conversation['id_expediteur'];
		}
			
		$estLu = 1;
		$mp_message = new BddMpMessage();
		$rows = $mp_message->select(array('id_message' => $conversation['id_message']));
		if(count($rows) > 0)
		{
			$mp_message->load($rows[0]);
			if($type == 'expediteur')
				$estLu = $mp_message->getLuExpediteur();
			else
				$estLu = $mp_message->getLuDestinataire();
		}
		$member = new BddMember();
		$rows = $member->select(array('id' => $idInterlocuteur));
		if(count($rows) > 0)
		{
			$objInterlocuteur = $rows[0];
		}
		
		$allConversation[$i]['interlocuteur'] = $objInterlocuteur;
		$allConversation[$i]['lu'] = $estLu;
	}
	$nbTotalConversation = $message->getNbConversation();
    $tab['allConversation'] = $allConversation;
    $tab['nbTotalConversation'] = $nbTotalConversation;
    $tab['nbParPage'] = $nbParPage;
    $tab['nbPageMax'] = ceil($nbTotalConversation/$nbParPage);
    $tab['pageActuel'] = $p;
   
	$page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'showConversation';
    $page['arg'] = $tab;
}

function showMessageConversation()
{
	global $page;
    $tab = array();
    
    $message = new MMessage($_SESSION['user']['admin']);
    
    if($message->canRead($_GET['id_conversation']) == true)
    {
    	
    	
    	$objConversation = new BddMpConversation();
    	$rows = $objConversation->select(array('id_conversation' => $_GET['id_conversation']));
    	if(count($rows) > 0)
    	{
    		$tab['conversation'] = $rows[0];
    	
	    	if($tab['conversation']['id_expediteur'] == $_SESSION['user']['id'])
			{
				$idInterlocuteur = $tab['conversation']['id_destinataire'];
			}
			else
			{
				$idInterlocuteur = $tab['conversation']['id_expediteur'];
			}
    	
	    	if(isset($_POST['answer']) && isset($_POST['message']) && !empty($_POST['message'])) //Si une réponse est envoyé
	    	{
	    		$message = new BddMpMessage();
				$message->setMessage($_POST['message']);
				$message->setDate(date('Y-m-d H:i:s', time()));
				$message->setIdConversation($_GET['id_conversation']);
				$message->setIdDestinataire($idInterlocuteur);
				$message->setIdExpediteur($_SESSION['user']['id']);
				$message->setLuDestinataire(0);
				$message->setLuExpediteur(1);
				$message->insert();
	    	}
    	
	    	$member = new BddMember();
			$rows = $member->select(array('id' => $idInterlocuteur));
			if(count($rows) > 0)
			{
				$tab['interlocuteur'] = $rows[0];
			}
		
	   		$objMessageConversation = new BddMpMessage();
	   		$tab['messages'] = $objMessageConversation->select(array('id_conversation' => $_GET['id_conversation']), array(), array('date' => 'ASC'));

    	}
    	$page['title'] = 'DashBoard';
	    $page['class'] = 'VDashBoard';
	    $page['method'] = 'showMessage';
	    $page['arg'] = $tab;
    }
    else
    {
    	home();
    	exit;
    }
    
    
}

function listMemberAutocomplete()
{
	$dashboard = new MDashboard($_SESSION['user']['admin']);
	$rows = $dashboard->getListMemberAutocomplete($_REQUEST['name_startsWith'], $_REQUEST['maxRows']);

	print json_encode($rows);
}

function newConversation()
{
	$erreur = '';
	if(isset($_POST['message']) && !empty($_POST['message']))
	{
		if(isset($_POST['email']) AND !empty($_POST['email'])) //Si il y a une adresse mail renseigné
		{
			$Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
			if(preg_match($Syntaxe,$_POST['email']))
			{
				$member = new BddMember();
				$rows = $member->select(array('email' => $_POST['email']));
				if(count($rows) > 0) //le membre recherché existe
				{
					$member->load($rows[0]);
					$conversation = new BddMpConversation();
					$idConversation = time().'-'.$member->getId().'-'.$_SESSION['user']['id'];
					$conversation->setIdDestinataire($member->getId());
					$conversation->setIdExpediteur($_SESSION['user']['id']);
					$conversation->setIdConversation($idConversation);
					$conversation->setTitre($_POST['objet']);
					$conversation->insert();
					
		
					$message = new BddMpMessage();
					$message->setMessage($_POST['message']);
					$message->setDate(date('Y-m-d H:i:s', time()));
					$message->setIdConversation($idConversation);
					$message->setIdDestinataire($member->getId());
					$message->setIdExpediteur($_SESSION['user']['id']);
					$message->setLuDestinataire(0);
					$message->setLuExpediteur(1);
					$message->insert();
				}
				else
				{
					$erreur = 'The email address is not registered';
				}
			}
			else
			{
				$erreur = 'Please enter a valid email address';
			}
		}
		else //sinon on envoit aux admin si ce n'est pas lui qui expédie
		{
			$rows = $member->select(array('admin' => 1));
			if(count($rows) > 0) 
			{
				foreach($rows as $row) //on envoit à tous les admin
				{
					$membre->load($row);
					$conversation = new BddMpConversation();
					$idConversation = time().'-'.$member->getId().'-'.$_SESSION['user']['id'];
					$conversation->setIdDestinataire($member->getId());
					$conversation->setIdExpediteur($_SESSION['user']['id']);
					$conversation->setIdConversation($idConversation);
					$conversation->setTitre($_POST['objet']);
					$conversation->insert();
					
		
					$message = new BddMpMessage();
					$message->setMessage($_POST['message']);
					$message->setDate(date('Y-m-d H:i:s', time()));
					$message->setIdConversation($idConversation);
					$message->setIdDestinataire($member->getId());
					$message->setIdExpediteur($_SESSION['user']['id']);
					$message->setLuDestinataire(0);
					$message->setLuExpediteur(1);
					$message->insert();
				}
			}
		}
	}
	else
	{
		$erreur = 'You can\'t send empty message';
	}
	
	echo $erreur;
}

function answerMessage()
{
	
}

function test()
{
	global $page;
    $tab = array();
    $page['title'] = 'DashBoard';
    $page['class'] = 'VDashBoard';
    $page['method'] = 'test';
    $page['arg'] = $tab;
}



//function showAllFavoritesProperties()
//{
//	global $page;
//    $tab = array();
//    
//	$dashboard = new MDashboard($_SESSION['user']['admin']);
//	
//	$nbParPage = 20;
//	if(isset($_GET['page']))
//		$page = $_GET['page'];
//	else
//		$page = 1;
//	
//	$n = ($nbParPage*$page)-$nbParPage;
//	$recentlyViewed = $dashboard->getFavoritesProperties($nbParPage, $n);
//	$nbTotalResult = $dashboard->getNbFavorites();
//    $tab['favoritesProperties'] = $recentlyViewed;
//    $tab['nbTotalResult'] = $nbTotalResult;
//    $tab['nbParPage'] = $nbParPage;
//    $tab['nbPageMax'] = $nbTotalResult/$nbParPage;
//    $tab['nbPageActuel'] = $page;
//    
//    $page['title'] = 'DashBoard';
//    $page['class'] = 'VDashBoard';
//    $page['method'] = 'showAllFavoritesProperties';
//    $page['arg'] = $tab;
//}



?>