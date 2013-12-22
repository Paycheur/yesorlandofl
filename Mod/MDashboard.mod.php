<?php
class MDashboard
{

	private $dbMember;
	private $dbVisitRequest;

	private $isAdmin = 0;
	
    public function __construct($admin)
    {
    	$this->dbMember = new BddMember();
    	$this->dbVisitRequest = new BddVisitRequest();
    	$this->admin = $admin;
    }
    
    public function getAllRequestVisit($limit, $n=0)
    {
    	$sql = 'SELECT type, data.address, city, postal_code, state, vr.date, vr.hour, vr.status, data.style, data.id as data_id, vr.id as id_visit_request, member.name, member.email, member.phone, member.id as member_id '.
    			'FROM visit_request as vr, data, member '.
    			'WHERE vr.id_property = data.id AND member.id=vr.id_member ';
    	if($this->isAdmin == 0)
    	{
    		$sql .= ' AND vr.id_member = \''.$_SESSION['user']['id'].'\' ';
    	}
    	$sql.= ' ORDER BY vr.date_insert DESC LIMIT '.$n.', '.$limit.' ';
    	$tabRows =  array();
		$res = $this->dbMember->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
        return $tabRows;
        
    }
    
	public function getAllRequestVisitPerDate($dateBegin, $dateEnd ='')
    {


    	$sql = 'SELECT type, data.address, city, postal_code, state, vr.date, vr.hour, vr.status, data.style, data.id as data_id, vr.id as id_visit_request, member.name, member.email, member.phone, member.id as member_id '.
    			'FROM visit_request as vr, data, member '.
    			'WHERE vr.id_property = data.id AND member.id=vr.id_member AND vr.status = 1 ';
    	if($dateEnd == '')
    	{
    		$sql .= ' AND date = \''.$dateBegin.'\' ';
    	}
    	else 
    	{
    		$sql .= ' AND date >= \''.$dateBegin.'\' AND date <= \''.$dateEnd.'\' ';
    	}
    	if($this->isAdmin == 0)
    	{
    		$sql .= ' AND vr.id_member = \''.$_SESSION['user']['id'].'\' ';
    	}
    	$sql.= ' ORDER BY vr.date DESC ';
    	$tabRows =  array();
		$res = $this->dbMember->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
        return $tabRows;
        
    }
    
    public function getNbRequestVisit()
    {
    	$sql = 'SELECT COUNT(*) as nb '.
    			'FROM visit_request as vr, data, member '.
    			'WHERE vr.id_property = data.id AND member.id=vr.id_member ';
    	
    	$tabRows =  array();
		$res = $this->dbMember->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
        return $tabRows[0]['nb'];
    }
    
    public function getFavoritesProperties($limit, $n=0)
    {
    	$sql = 'SELECT type, address, city, postal_code, state, sqft, price, bed, bathroom, data.id, img '.
    			'FROM favorite, data '.
    			'WHERE favorite.id_property = data.id '.
    			' AND actif=1 AND favorite.id_member = \''.$_SESSION['user']['id'].'\' '.
    			' ORDER BY price DESC LIMIT '.$n.', '.$limit.' ';
    	
    	$tabRows =  array();
		$res = $this->dbMember->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
        return $tabRows;
    }
    
	 public function getNbFavorites()
    {
    	$sql = 'SELECT COUNT(1) as nb '.
    			'FROM favorite, data '.
    			'WHERE favorite.id_property = data.id '.
    			' AND actif=1 AND favorite.id_member = \''.$_SESSION['user']['id'].'\' ';
    	
    	$tabRows =  array();
		$res = $this->dbMember->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
        return $tabRows;
    }
    
	public function getPropertiesViewed($limit)
    {
    	$sql = 'SELECT type, address, city, postal_code, state, sqft, price, bed, bathroom, data.id, img '.
    			'FROM properties_viewed, data '.
    			'WHERE properties_viewed.id_property = data.id '.
    			' AND actif=1 AND properties_viewed.id_member = \''.$_SESSION['user']['id'].'\' '.
    			' ORDER BY date DESC LIMIT '.$limit.' ';
    	
    	$tabRows =  array();
		$res = $this->dbMember->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
        return $tabRows;
    }
    
    public function getListMemberAutocomplete($search, $limit)
    {
    	$sql = "SELECT name, last_name, email, id FROM member WHERE name LIKE '%".protegeChaine($search)."%' OR last_name LIKE '%".protegeChaine($search)."%' OR email LIKE '%".protegeChaine($search)."%' LIMIT ".$limit;
    	$tabRows =  array();
		$res = $this->dbMember->getConnexion()->query($sql); //on récupère une connexion
		if($res !== false)
			$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
			
		return $tabRows;
		
    }
    
}