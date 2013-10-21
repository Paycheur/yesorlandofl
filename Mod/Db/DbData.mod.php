<?php

class BddData extends CConnexion
{
	private $Id = '';
	private $Type = '';
	private $Style = '';
	private $City = '';
	private $Address = '';
	private $Bed = '';
	private $Bathroom = '';
	private $Sqft = '';
	private $Price = '';
	private $Img = '';
	private $PostalCode = '';
	private $State = '';
	private $Actif = '';
	private $FlagActif = '';
	private $SaleOrLease = '';
	private $Status;

	/************** SETTERS *****************/

	function setId($v)
	{
		$this->Id = $v;
	}

	function setType($v)
	{
		$this->Type = $v;
	}

	function setStyle($v)
	{
		$this->Style = $v;
	}

	function setCity($v)
	{
		$this->City = $v;
	}

	function setAddress($v)
	{
		$this->Address = $v;
	}

	function setBed($v)
	{
		$this->Bed = $v;
	}

	function setBathroom($v)
	{
		$this->Bathroom = $v;
	}

	function setSqft($v)
	{
		$this->Sqft = $v;
	}

	function setPrice($v)
	{
		$this->Price = $v;
	}

	function setImg($v)
	{
		$this->Img = $v;
	}

	function setPostalCode($v)
	{
		$this->PostalCode = $v;
	}

	function setState($v)
	{
		$this->State = $v;
	}

	function setActif($v)
	{
		$this->Actif = $v;
	}

	function setFlagActif($v)
	{
		$this->FlagActif = $v;
	}
	
	function setSaleOrLease($v)
	{
		$this->SaleOrLease = $v;
	}
	
	function setStatus($v)
	{
		$this->Status = $v;
	}

	/************** GETTERS *****************/

	function getId()
	{
		return $this->Id;
	}

	function getType()
	{
		return $this->Type;
	}

	function getStyle()
	{
		return $this->Style;
	}

	function getCity()
	{
		return $this->City;
	}

	function getAddress()
	{
		return $this->Address;
	}

	function getBed()
	{
		return $this->Bed;
	}

	function getBathroom()
	{
		return $this->Bathroom;
	}

	function getSqft()
	{
		return $this->Sqft;
	}

	function getPrice()
	{
		return $this->Price;
	}

	function getImg()
	{
		return $this->Img;
	}

	function getPostalCode()
	{
		return $this->PostalCode;
	}

	function getState()
	{
		return $this->State;
	}

	function getActif()
	{
		return $this->Actif;
	}

	function getFlagActif()
	{
		return $this->FlagActif;
	}
	
	function getSaleOrLease()
	{
		return $this->SaleOrLease;
	}
	
	function getStatus()
	{
		return $this->Status;
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
		$champsRequete['type']		=	($this->Type != '')		? '\''. protegeChaine($this->getType()) .'\'' : 'DEFAULT';
		$champsRequete['style']		=	($this->Style != '')		? '\''. protegeChaine($this->getStyle()) .'\'' : 'DEFAULT';
		$champsRequete['city']		=	($this->City != '')		? '\''. protegeChaine($this->getCity()) .'\'' : 'DEFAULT';
		$champsRequete['address']		=	($this->Address != '')		? '\''. protegeChaine($this->getAddress()) .'\'' : 'DEFAULT';
		$champsRequete['bed']		=	($this->Bed != '')		? '\''. protegeChaine($this->getBed()) .'\'' : 'DEFAULT';
		$champsRequete['bathroom']		=	($this->Bathroom != '')		? '\''. protegeChaine($this->getBathroom()) .'\'' : 'DEFAULT';
		$champsRequete['sqft']		=	($this->Sqft != '')		? '\''. protegeChaine($this->getSqft()) .'\'' : 'DEFAULT';
		$champsRequete['price']		=	($this->Price != '')		? '\''. protegeChaine($this->getPrice()) .'\'' : 'DEFAULT';
		$champsRequete['sale_or_lease']		=	($this->SaleOrLease != '')		? '\''. protegeChaine($this->getSaleOrLease()) .'\'' : 'DEFAULT';
		$champsRequete['img']		=	($this->Img != '')		? '\''. protegeChaine($this->getImg()) .'\'' : 'DEFAULT';
		$champsRequete['postal_code']		=	($this->PostalCode != '')		? '\''. protegeChaine($this->getPostalCode()) .'\'' : 'DEFAULT';
		$champsRequete['state']		=	($this->State != '')		? '\''. protegeChaine($this->getState()) .'\'' : 'DEFAULT';
		$champsRequete['actif']		=	($this->Actif != '')		? '\''. protegeChaine($this->getActif()) .'\'' : 'DEFAULT';
		$champsRequete['flag_actif']		=	($this->FlagActif != '')		? '\''. protegeChaine($this->getFlagActif()) .'\'' : 'DEFAULT';
		$champsRequete['status']		=	($this->Status != '')		? '\''. protegeChaine($this->getStatus()) .'\'' : 'DEFAULT';
		return $champsRequete; 	}

	function load($row)
	{
		$this->setId($row['id']);
		$this->setType($row['type']);
		$this->setStyle($row['style']);
		$this->setCity($row['city']);
		$this->setAddress($row['address']);
		$this->setBed($row['bed']);
		$this->setBathroom($row['bathroom']);
		$this->setSqft($row['sqft']);
		$this->setPrice($row['price']);
		$this->setImg($row['img']);
		$this->setPostalCode($row['postal_code']);
		$this->setState($row['state']);
		$this->setActif($row['actif']);
		$this->setFlagActif($row['flag_actif']);
		$this->setSaleOrLease($row['sale_or_lease']);
		$this->setStatus($row['status']);
	}
	function select($where = array(), $whereSpe=array(), $orderBy = array(), $limit = null)
	{
		// Clause SELECT
		$req = 'SELECT id,type,style,city,address,bed,bathroom,sqft,price,img,postal_code,state,actif,flag_actif, sale_or_lease, status '.
				'FROM data  ';
				
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
		$req = 'SELECT '.$function[0].'('.$function[1].') value FROM data ';
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
		return $tabRows[0]['value'];
	}

	function update()
	{
		$this->verifChampsPrimaryKey();
		$champsRequete = $this->prepareChampsRequete();
		
		$req = 'UPDATE data  SET ';
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
		$req = 'DELETE from data  '; 
		$req .= 'WHERE id = \'' . $this->getId().'\'';
		$res = $this->getConnexion()->query($req);
		return $res;
	}

	function insert($type = 'INSERT')
	{
		$this->verifChampsPrimaryKey();
		$champsRequete = $this->prepareChampsRequete();
		$req = $type.' INTO data (';
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
		if ($this->getId() == '')
			die('Exécution impossible car le champs OBLIGATOIRE `id` n\'a pas de valeur!');
	}

}

?>