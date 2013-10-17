<?php

header ('Content-Type:text/html; charset=UTF-8');
//define ('ICONE_PAGE', '../Img/bdd.png');
//define ('CSS_PAGE', '../Css/index.css');
define ('JS_PAGE', '/Assets/js/app/login.js');
define ('CONTROLER', 'page_login.php');

require ('Inc/require.inc.php');

$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';

if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']))
	header('Location:dashboard.php');

//Variables
$page['error']='';
$page['confirmation']='';

// Contr�leur
switch ($EX)
{
  case 'home'   : home ();   break;
  case 'doLoginWithFacebook' : doLoginWithFacebook(); break;
  case 'doRegister' : doRegister(); exit;
  case 'doLogin' : doLogin(); exit;
  case 'logout'   : logout ();   break;
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
    
    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
    
    $page['title'] = 'Login';
    $page['class'] = 'VLogin';
    $page['method'] = 'homeLogin';
    $page['arg'] = $tab;
    
}

function doLoginWithFacebook()
{
	$facebook = new Facebook(array(
	    'appId'  => '619730978046867',
	    'secret' => 'aeaf097c3f422e59c7e21686f2a6fa3c',
		'cookie' => false
	));
		
		$user = $facebook->getUser();
		
  	 	if ($user) {
            try {
            
                $data['user_profile'] = $facebook->api('/me');
			    $fql = "select uid,name,email from user where uid=$user";
			    $param = array(
			        'method' => 'fql.query',
			        'query' => $fql,
			        'callback' => ''
			    );
			    $fb = $facebook->api($param);
			    $fb = $fb[0];   // $fb contient les info utilisateurs
			    $name = $fb['name'];
       			$email = $fb['email'];
                
       			$login = new MLogin();
                $tabMember = $login->connecteWithFacebook($user, $name, $email);
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }
        else
        {
        	header('Location:'.$facebook->getLoginUrl(array('req_perms' => 'email', 'locale' => 'fr_FR')));
        }
       
        if(isset($tabMember) && $tabMember !== false) //le membre s'est connecté
	    {
	    	$_SESSION['user']['id'] = $tabMember->getId();
	    	$_SESSION['user']['name'] = $tabMember->getName();
	    	
	    	if(isset($_SESSION['referer']))
	    	{
	    		$referer = $_SESSION['referer'];
	    		unset($_SESSION['referer']);
	    		header('Location:'.$referer);
	    	}
	    	else
	    		header('Location:/dashboard');
	       
	    }
	    else
	    {
	    	$page['error']='Erreur de connexion.';
	    	home();
	    }
	    
}

function doRegister()
{
	$error = array();
	$statut = 'KO';
	if(isset($_POST['email']) && !empty($_POST['email']) && strlen($_POST['email']) > 1 && strlen($_POST['email']) <= 100)
	{
		$Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
		if(preg_match($Syntaxe,$_POST['email']))
		{
			if(isset($_POST['name']) && !empty($_POST['name']) && strlen($_POST['name']) > 1 && strlen($_POST['name']) <= 100)
			{
				if(isset($_POST['mdp']) && !empty($_POST['mdp']) && strlen($_POST['mdp']) > 1 && strlen($_POST['mdp']) <= 50)
				{
					$email = $_POST['email'];
					$password = $_POST['mdp'];
					$name = $_POST['name'];
					
					$login = new MLogin();
	    			$error = $login->register($name, $email, $password);
	    			if(isset($error['ok']) && $error['ok'] == true)
	    			{
	    				$statut = 'OK';
	    				$rep = $login->login($email, $password);
	    			}
				}
				else
				{
					$error['registerPassword'] = 'Error';
				}
			}
			else
			{
				$error['registerName'] = 'Error';
			}
		}
		else
		{
			$error['registerEmail'] = 'Wrong email';
		}
	}		
	else
	{
		$error['registerEmail'] = 'Wrong email';
	}
    
    print json_encode(array('error_form' =>$error, 'statut' => $statut));
   
}

function doLogin()
{
	$statut = 'KO';
	if(isset($_POST['email']) && isset($_POST['mdp']))
	{
		$login = new MLogin();
		$rep = $login->login($_POST['email'], $_POST['mdp']);
		if($rep == true)
			$statut = 'OK';
	}
	
	print json_encode(array('statut' => $statut));
}

function logout()
{
	unset($_SESSION['user']);
	header('Location:/');
}

?>