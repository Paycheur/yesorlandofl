<?php
class CConnexion
{
	private $connexion;
	
	public function __construct($dbName, $login, $password)
    {
        $this->connexion = new PDO('mysql:host=localhost;dbname='.$dbName, $login, $password);
    }
    
    public function getConnexion()
    {
    	return $this->connexion;
    }
}
?>
