<?php
class MMessage
{

	private $dbConversation;
	private $dbMessage;

	private $isAdmin = 0;
	
    public function __construct($admin)
    {
    	$this->dbConversation = new BddMpConversation();
    	$this->dbMessage = new BddMpMessage();
    	$this->admin = $admin;
    }
    
    public function getAllConversation($limit, $n=0)
    {
    	$sql = 'SELECT mpc.id_conversation, mpc.id_expediteur, mpc.id_destinataire, titre, mpm.date, mpm.id_message '.
    			'FROM mp_conversation as mpc, mp_message as mpm '.
    			'WHERE mpc.id_conversation = mpm.id_conversation AND (mpc.id_expediteur = \''.$_SESSION['user']['id'].'\' OR mpc.id_destinataire = \''.$_SESSION['user']['id'].'\') GROUP BY mpc.id_conversation ORDER BY mpm.date DESC '.
    			' LIMIT '.$n.', '.$limit.' ';

    	$tabRows =  array();
		$res = $this->dbConversation->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
        return $tabRows;
        
    }
    
    public function getNbConversation()
    {
    	$sql = 'SELECT COUNT(1) as nb '.
    			'FROM mp_conversation as mpc, mp_message as mpm '.
    			'WHERE mpc.id_conversation = mpm.id_conversation AND (id_expediteur = \''.$_SESSION['user']['id'].'\' OR id_destinataire = \''.$_SESSION['user']['id'].'\') GROUP BY mpc.id_conversation ORDER BY mpm.date DESC ';
    	
    	$tabRows =  array();
		$res = $this->dbConversation->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
		if(isset($tabRows[0]['nb']))
      	  return $tabRows[0]['nb'];
      	else 
      		return 0;
    }
    
   	public function canRead($id_conversation)
   	{
   		$sql = 'SELECT * FROM mp_conversation WHERE id_conversation = \''.$id_conversation.'\' AND (id_expediteur = \''.$_SESSION['user']['id'].'\' OR id_destinataire = \''.$_SESSION['user']['id'].'\')';

    	$tabRows =  array();
		$res = $this->dbConversation->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
		if(count($tabRows) > 0)
        	return true;
        else
        	return false;
   	}
    
    
}