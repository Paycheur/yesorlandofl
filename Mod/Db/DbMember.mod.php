<?php

class BddMember extends CConnexion
{
	private $Id = '';
	private $IdFacebook = '';
	private $Name = '';
	private $Email = '';
	private $Password = '';
	private $DateRegister = '';
	private $Company = '';
	private $Occupation = '';
	private $Address = '';
	private $Phone = '';
	private $Admin = '';
	private $LastName='';

	/************** SETTERS *****************/

	function setId($v)
	{
		$this->Id = $v;
	}

	function setIdFacebook($v)
	{
		$this->IdFacebook = $v;
	}

	function setName($v)
	{
		$this->Name = $v;
	}

	function setEmail($v)
	{
		$this->Email = $v;
	}

	function setPassword($v)
	{
		$this->Password = $v;
	}

	function setDateRegister($v)
	{
		$this->DateRegister = $v;
	}

	function setCompany($v)
	{
		$this->Company = $v;
	}

	function setOccupation($v)
	{
		$this->Occupation = $v;
	}

	function setAddress($v)
	{
		$this->Address = $v;
	}

	function setPhone($v)
	{
		$this->Phone = $v;
	}
	
	function setAdmin($v)
	{
		$this->Admin = $v;
	}
	
	function setLastName($v)
	{
		$this->LastName = $v;
	}

	/************** GETTERS *****************/

	function getId()
	{
		return $this->Id;
	}

	function getIdFacebook()
	{
		return $this->IdFacebook;
	}

	function getName()
	{
		return $this->Name;
	}

	function getEmail()
	{
		return $this->Email;
	}

	function getPassword()
	{
		return $this->Password;
	}

	function getDateRegister()
	{
		return $this->DateRegister;
	}

	function getCompany()
	{
		return $this->Company;
	}

	function getOccupation()
	{
		return $this->Occupation;
	}

	function getAddress()
	{
		return $this->Address;
	}

	function getPhone()
	{
		return $this->Phone;
	}
	
	function getAdmin()
	{
		return $this->Admin;
	}
	
	function getLastName()
	{
		return $this->LastName;
	}

	function __construct($valeurs = array())
	{
		parent::__construct(BD_NAME, BD_LOGIN, BD_PASSWORD);
		if (!empty($valeurs)) // Si on a spécifié des valeurs, alors on hydrate l'objet
		 $this->hydrate($valeurs);
	}

	public function hydrate($donnees)
	{
	    foreach ($donnees as $attribut => $valeur);
	    {
	        $methode = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
	        if (is_callable(array($this, $methode)))
	        {
	            $this->$methode($valeur);
	        }
	    }
	}

	public function isNew()
	{
		return empty($this->id);
	}

	public function isValide() //return TRUE ou un tableau error[]
	{

	}

	function prepareChampsRequete()
	{
		$champsRequete['id']		=	($this->Id != '')		? '\''. protegeChaine($this->getId()) .'\'' : 'DEFAULT';
		$champsRequete['id_facebook']		=	($this->IdFacebook != '')		? '\''. protegeChaine($this->getIdFacebook()) .'\'' : 'DEFAULT';
		$champsRequete['name']		=	($this->Name != '')		? '\''. protegeChaine($this->getName()) .'\'' : 'DEFAULT';
		$champsRequete['email']		=	($this->Email != '')		? '\''. protegeChaine($this->getEmail()) .'\'' : 'DEFAULT';
		$champsRequete['password']		=	($this->Password != '')		? '\''. protegeChaine($this->getPassword()) .'\'' : 'DEFAULT';
		$champsRequete['date_register']		=	($this->DateRegister != '')		? '\''. protegeChaine($this->getDateRegister()) .'\'' : 'DEFAULT';
		$champsRequete['company']		=	($this->Company != '')		? '\''. protegeChaine($this->getCompany()) .'\'' : 'DEFAULT';
		$champsRequete['occupation']		=	($this->Occupation != '')		? '\''. protegeChaine($this->getOccupation()) .'\'' : 'DEFAULT';
		$champsRequete['address']		=	($this->Address != '')		? '\''. protegeChaine($this->getAddress()) .'\'' : 'DEFAULT';
		$champsRequete['phone']		=	($this->Phone != '')		? '\''. protegeChaine($this->getPhone()) .'\'' : 'DEFAULT';
		$champsRequete['admin']		=	($this->Admin != '')		? '\''. protegeChaine($this->getAdmin()) .'\'' : 'DEFAULT';
		$champsRequete['last_name']		=	($this->LastName != '')		? '\''. protegeChaine($this->getLastName()) .'\'' : 'DEFAULT';
		return $champsRequete; 	}

	function load($row)
	{
		$this->setId($row['id']);
		$this->setIdFacebook($row['id_facebook']);
		$this->setName($row['name']);
		$this->setEmail($row['email']);
		$this->setPassword($row['password']);
		$this->setDateRegister($row['date_register']);
		$this->setCompany($row['company']);
		$this->setOccupation($row['occupation']);
		$this->setAddress($row['address']);
		$this->setPhone($row['phone']);
		$this->setAdmin($row['admin']);
		$this->setLastName($row['last_name']);
	}
	function select($where = array(), $whereSpe=array(), $orderBy = array(), $limit = null)
	{
		// Clause SELECT
		$req = 'SELECT id,id_facebook,name,email,password,date_register,company,occupation,address,phone, admin, last_name '.
				'FROM member  ';
				
		// Clause WHERE
		$chWhere = '';
		$where = ($where == null) ? array() : $where;
		foreach($where as $k => $v)
		{
			if ($chWhere != '')
				$chWhere .= 'AND ';
			else
				$chWhere .= 'WHERE ';
			$chWhere .= $k .'=\''. protegeChaine($v) .'\' ';
		}
		$req .= $chWhere;
		
		//Clause WHERE #2 : key => colonne, val : array('signe', 'val')
		$chWhereSpe = '';
		$whereSpe = ($whereSpe == null) ? array() : $whereSpe;
		foreach($whereSpe as $i => $where2)
		{
			foreach($where2 as $k => $v)
			{

				if($k == 0)
				{
					if ($chWhere != '' || $chWhereSpe != '')
						$chWhereSpe .= 'AND ';
					else
						$chWhereSpe .= 'WHERE ';
				
					$chWhereSpe .= $v.' ';
				}
				else
				{
					if(count($v) > 1)
						$chWhereSpe .= $v[0].' \''. protegeChaine($v[1]) .'\' '; // ex : actif >= 1
					else
						$chWhereSpe .= $v[0].' '; //ex : actif IS NULL
				}
			}
		}
		$req .= $chWhereSpe;
		
		// Clause ORDER BY
		$chOrderBy = '';
		$orderBy = ($orderBy == null) ? array() : $orderBy;
		foreach($orderBy as $k => $v)
		{
			if ($chOrderBy != '')
				$chOrderBy .= ', ';
			else
				$chOrderBy .= 'ORDER BY ';
			$chOrderBy .= $k .' '. $v;
		}
		$req .= $chOrderBy;
		
		// Clause LIMIT
		if ($limit != null)
		{
			if (count($limit) == 1){
				$chLimit = ' LIMIT '.$limit[0];
			}
			if (count($limit) == 2){
				$chLimit = ' LIMIT '.$limit[0].', '.$limit[1];
			}
			$req .= $chLimit;
		}
		$tabRows =  array();
		$res = $this->getConnexion()->query($req);
		$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
		return $tabRows;
	}

	function selectFunction($function, $where = array(), $whereSpe = array())
	{
		$req = 'SELECT '.$function[0].'('.$function[1].') value FROM member ';
		$chWhere = '';
		foreach($where as $k => $v)
		{
			if ($chWhere != '')
				$chWhere .= 'AND ';
			else
				$chWhere .= 'WHERE ';
			$chWhere .= $k .'=\''. protegeChaine($v) .'\' ';
		}
		$req .= $chWhere;
		
		//Clause WHERE #2 : key => colonne, val : array('signe', 'val')
		$chWhereSpe = '';
		$whereSpe = ($whereSpe == null) ? array() : $whereSpe;
		foreach($whereSpe as $i => $where2)
		{
			foreach($where2 as $k => $v)
			{

				if($k == 0)
				{
					if ($chWhere != '' || $chWhereSpe != '')
						$chWhereSpe .= 'AND ';
					else
						$chWhereSpe .= 'WHERE ';
				
					$chWhereSpe .= $v.' ';
				}
				else
				{
					if(count($v) > 1)
						$chWhereSpe .= $v[0].' \''. protegeChaine($v[1]) .'\' '; // ex : actif >= 1
					else
						$chWhereSpe .= $v[0].' '; //ex : actif IS NULL
				}
			}
		}
		$req .= $chWhereSpe;
		
		$tabRows =  array();
		$res = $this->getConnexion()->query($req);
		$tabRows = $res->fetchAll(PDO::FETCH_ASSOC);
		return $tabRows;
	}

	function update()
	{
		$this->verifChampsPrimaryKey();
		$champsRequete = $this->prepareChampsRequete();
		
		$req = 'UPDATE member  SET ';
		foreach ($champsRequete as $champ => $value){
			$req .= $champ . ' = ' . $value . ', ';
		}
		$req .= 'WHERE id = \'' . $this->getId().'\'';
		$req = str_replace(', WHERE', ' WHERE', $req);
		
		$res = $this->getConnexion()->query($req);
		return $res;
	}
	

	/** 
	 * Supprime la ligne
	 * @return DB résultat de la suppression
	 */
	function delete()
	{
		$req = 'DELETE from member  '; 
		$req .= 'WHERE id = \'' . $this->getId().'\'';
		$res = $this->getConnexion()->query($req);
		return $res;
	}

	function insert($type = 'INSERT')
	{
		$this->verifChampsPrimaryKey();
		$champsRequete = $this->prepareChampsRequete();
		$req = $type.' INTO member (';
		foreach ($champsRequete as $champ => $value){
			$req .= $champ . ', ';
		}
		$req .= ') VALUES (';
		foreach ($champsRequete as $champ => $value){
			$req .= $value.', ';
		}
		
		$req .= ')';
		$req = str_replace(', )', ')', $req);
		$res = $this->getConnexion()->query($req);
		return $res;
	}

	function verifChampsPrimaryKey()
	{
	}

}

?>