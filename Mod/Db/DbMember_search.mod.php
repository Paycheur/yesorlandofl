<?php

class BddMemberSearch extends CConnexion
{
	private $IdMember = '';
	private $City = '';
	private $Style = '';
	private $Bed = '';
	private $Bathroom = '';
	private $Price = '';
	private $NbResults = '';
	private $Date = '';

	/************** SETTERS *****************/

	function setIdMember($v)
	{
		$this->IdMember = $v;
	}

	function setCity($v)
	{
		$this->City = $v;
	}

	function setStyle($v)
	{
		$this->Style = $v;
	}

	function setBed($v)
	{
		$this->Bed = $v;
	}

	function setBathroom($v)
	{
		$this->Bathroom = $v;
	}

	function setPrice($v)
	{
		$this->Price = $v;
	}

	function setNbResults($v)
	{
		$this->NbResults = $v;
	}

	function setDate($v)
	{
		$this->Date = $v;
	}

	/************** GETTERS *****************/

	function getIdMember()
	{
		return $this->IdMember;
	}

	function getCity()
	{
		return $this->City;
	}

	function getStyle()
	{
		return $this->Style;
	}

	function getBed()
	{
		return $this->Bed;
	}

	function getBathroom()
	{
		return $this->Bathroom;
	}

	function getPrice()
	{
		return $this->Price;
	}

	function getNbResults()
	{
		return $this->NbResults;
	}

	function getDate()
	{
		return $this->Date;
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
		$champsRequete['id_member']		=	($this->IdMember != '')		? '\''. protegeChaine($this->getIdMember()) .'\'' : 'DEFAULT';
		$champsRequete['city']		=	($this->City != '')		? '\''. protegeChaine($this->getCity()) .'\'' : 'DEFAULT';
		$champsRequete['style']		=	($this->Style != '')		? '\''. protegeChaine($this->getStyle()) .'\'' : 'DEFAULT';
		$champsRequete['bed']		=	($this->Bed != '')		? '\''. protegeChaine($this->getBed()) .'\'' : 'DEFAULT';
		$champsRequete['bathroom']		=	($this->Bathroom != '')		? '\''. protegeChaine($this->getBathroom()) .'\'' : 'DEFAULT';
		$champsRequete['price']		=	($this->Price != '')		? '\''. protegeChaine($this->getPrice()) .'\'' : 'DEFAULT';
		$champsRequete['nb_results']		=	($this->NbResults != '')		? '\''. protegeChaine($this->getNbResults()) .'\'' : 'DEFAULT';
		$champsRequete['date']		=	($this->Date != '')		? '\''. protegeChaine($this->getDate()) .'\'' : 'DEFAULT';
		return $champsRequete; 	}

	function load($row)
	{
		$this->setIdMember($row['id_member']);
		$this->setCity($row['city']);
		$this->setStyle($row['style']);
		$this->setBed($row['bed']);
		$this->setBathroom($row['bathroom']);
		$this->setPrice($row['price']);
		$this->setNbResults($row['nb_results']);
		$this->setDate($row['date']);

	}
	function select($where = array(), $whereSpe=array(), $orderBy = array(), $limit = null)
	{
		// Clause SELECT
		$req = 'SELECT id_member,city,style,bed,bathroom,price,nb_results,date '.
				'FROM member_search  ';
				
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
		$req = 'SELECT '.$function[0].'('.$function[1].') value FROM member_search ';
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
		
		$req = 'UPDATE member_search  SET ';
		foreach ($champsRequete as $champ => $value){
			$req .= $champ . ' = ' . $value . ', ';
		}
		$req .= 'WHERE id_member = \'' . $this->getIdMember().'\'';
		$req .= ' AND city = \'' . $this->getCity().'\'';
		$req .= ' AND style = \'' . $this->getStyle().'\'';
		$req .= ' AND bed = \'' . $this->getBed().'\'';
		$req .= ' AND bathroom = \'' . $this->getBathroom().'\'';
		$req .= ' AND price = \'' . $this->getPrice().'\'';
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
		$req = 'DELETE from member_search  '; 
		$req .= 'WHERE id_member = \'' . $this->getIdMember().'\'';
		$req .= ' AND city = \'' . $this->getCity().'\'';
		$req .= ' AND style = \'' . $this->getStyle().'\'';
		$req .= ' AND bed = \'' . $this->getBed().'\'';
		$req .= ' AND bathroom = \'' . $this->getBathroom().'\'';
		$req .= ' AND price = \'' . $this->getPrice().'\'';
		$res = $this->getConnexion()->query($req);
		return $res;
	}

	function insert($type = 'INSERT')
	{
		$this->verifChampsPrimaryKey();
		$champsRequete = $this->prepareChampsRequete();
		$req = $type.' INTO member_search (';
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
		if ($this->getIdMember() == '')
			die('Exécution impossible car le champs OBLIGATOIRE `id_member` n\'a pas de valeur!');
	}

}

?>