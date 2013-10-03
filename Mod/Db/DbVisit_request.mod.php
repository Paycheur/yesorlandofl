<?php

class BddVisitRequest extends CConnexion
{
	private $Id = '';
	private $Date = '';
	private $Hour = '';
	private $Email = '';
	private $Name = '';
	private $IdProperty = '';
	private $idMember = '';

	/************** SETTERS *****************/

	function setId($v)
	{
		$this->Id = $v;
	}

	function setDate($v)
	{
		$this->Date = $v;
	}

	function setHour($v)
	{
		$this->Hour = $v;
	}

	function setEmail($v)
	{
		$this->Email = $v;
	}

	function setName($v)
	{
		$this->Name = $v;
	}

	function setIdProperty($v)
	{
		$this->IdProperty = $v;
	}
	
	function setIdMember($v)
	{
		$this->IdMember = $v;
	}

	/************** GETTERS *****************/

	function getId()
	{
		return $this->Id;
	}

	function getDate()
	{
		return $this->Date;
	}

	function getHour()
	{
		return $this->Hour;
	}

	function getEmail()
	{
		return $this->Email;
	}

	function getName()
	{
		return $this->Name;
	}

	function getIdProperty()
	{
		return $this->IdProperty;
	}
	
	function getIdMember()
	{
		return $this->IdMember;
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
		$champsRequete['date']		=	($this->Date != '')		? '\''. protegeChaine($this->getDate()) .'\'' : 'DEFAULT';
		$champsRequete['hour']		=	($this->Hour != '')		? '\''. protegeChaine($this->getHour()) .'\'' : 'DEFAULT';
		$champsRequete['email']		=	($this->Email != '')		? '\''. protegeChaine($this->getEmail()) .'\'' : 'DEFAULT';
		$champsRequete['name']		=	($this->Name != '')		? '\''. protegeChaine($this->getName()) .'\'' : 'DEFAULT';
		$champsRequete['id_property']		=	($this->IdProperty != '')		? '\''. protegeChaine($this->getIdProperty()) .'\'' : 'DEFAULT';
		$champsRequete['id_member']		=	($this->IdMember != '')		? '\''. protegeChaine($this->getIdMember()) .'\'' : 'DEFAULT';
		return $champsRequete; 	}

	function load($row)
	{
		$this->setId($row['id']);
		$this->setDate($row['date']);
		$this->setHour($row['hour']);
		$this->setEmail($row['email']);
		$this->setName($row['name']);
		$this->setIdProperty($row['id_property']);
		$this->setIdMember($row['id_member']);

	}
	function select($where = array(), $whereSpe=array(), $orderBy = array(), $limit = null)
	{
		// Clause SELECT
		$req = 'SELECT id,date,hour,email,name,id_property,id_member '.
				'FROM visit_request  ';
				
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
		$req = 'SELECT '.$function[0].'('.$function[1].') value FROM visit_request ';
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
		
		$req = 'UPDATE visit_request  SET ';
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
		$req = 'DELETE from visit_request  '; 
		$req .= 'WHERE id = \'' . $this->getId().'\'';
		$res = $this->getConnexion()->query($req);
		return $res;
	}

	function insert($type = 'INSERT')
	{
		$this->verifChampsPrimaryKey();
		$champsRequete = $this->prepareChampsRequete();
		$req = $type.' INTO visit_request (';
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