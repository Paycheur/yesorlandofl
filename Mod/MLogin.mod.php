<?php
class MLogin
{

	private $dbMember;
	
    public function __construct($valeurs = array())
    {
    	$this->dbMember = new BddMember();
    }
    
    public function connecteWithFacebook($uid, $name, $email)
    {
    	$rows = $this->dbMember->select(array('id_facebook' => $uid));
    	if(count($rows) > 0)
    	{
    		$this->dbMember->load($rows[0]);
    		return $this->dbMember;
    	}
    	else
    	{
    		$rep = $this->register($name, $email, '', $uid);
    		if(isset($rep['ok']) && $rep['ok'] == true)
    		{
    			$rows = $this->dbMember->select(array('id_facebook' => $uid));
    			if(count($rows) > 0)
		    	{
		    		$this->dbMember->load($rows[0]);
		    		return $this->dbMember;
		    	}
		    	else
		    	{
		    		return false;
		    	}
    		}
    	}
    }
    
    public function register($name, $email, $password='', $facebook_id='')
    {
    	$rep = array();
    	
    	$rows = $this->dbMember->select(array('email' => $email));
    	if(count($rows) > 0)
    	{
    		$rep['registerEmail'] = 'This email address is already registered, try to connect.';
    	}
    	else
    	{
    		$this->dbMember->setName($name);
    		$this->dbMember->setEmail($email);
    		if($password != '')
    			$this->dbMember->setPassword(md5($password));
    		else 	
    			$this->dbMember->setPassword($password);
    		$this->dbMember->setIdFacebook($facebook_id);
    		$this->dbMember->setDateRegister(date('Y-m-d H:i:s', time()));
    		$this->dbMember->insert();
    		
    		$rep['ok'] = true;
    	}
    	
    	return $rep;
    }
    
    public function login($email, $password)
    {
    	$rep = false;
    	
    	$rows = $this->dbMember->select(array('email' => $email, 'password' => md5($password)));
    	if(count($rows) > 0)
    	{
    		$this->dbMember->load($rows[0]);
    		$_SESSION['user']['id'] = $this->dbMember->getId();
	    	$_SESSION['user']['name'] = $this->dbMember->getName().($this->dbMember->getLastName() != '' ? ' '.$this->dbMember->getLastName() : '');
	    	$_SESSION['user']['admin'] = $this->dbMember->getAdmin();
	    	$rep = true;
    	}
    	else
    	{
    		$rep = false;
    	}
    	
    	return $rep;
    }
    
}