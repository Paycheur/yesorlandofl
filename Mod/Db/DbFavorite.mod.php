<?php

class BddFavorite extends CConnexion
{
	private $IdProperty = '';
	private $IdMember = '';

	/************** SETTERS *****************/

	function setIdProperty($v)
	{
		$this->IdProperty = $v;
	}

	function setIdMember($v)
	{
		$this->IdMember = $v;
	}

	/************** GETTERS *****************/

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
		$champsRequete['id_property']		=	($this->IdProperty != '')		? '\''. protegeChaine($this->getIdProperty()) .'\'' : 'DEFAULT';
		$champsRequete['id_member']		=	($this->IdMember != '')		? '\''. protegeChaine($this->getIdMember()) .'\'' : 'DEFAULT';
		return $champsRequete; 	}

	function load($row)
	{
		$this->setIdProperty($row['id_property']);
		$this->setIdMember($row['id_member']);

	}
	function select($where = array(), $whereSpe=array(), $orderBy = array(), $limit = null)
	{
		// Clause SELECT
		$req = 'SELECT id_property,id_member '.
				'FROM favorite  ';
				
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
		$req = 'SELECT '.$function[0].'('.$function[1].') value FROM favorite ';
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
		
		$req = 'UPDATE favorite  SET ';
		foreach ($champsRequete as $champ => $value){
			$req .= $champ . ' = ' . $value . ', ';
		}
		$req .= 'WHERE id_property = \'' . $this->getIdProperty().'\'';
		$req .= ' AND id_member = \'' . $this->getIdMember().'\'';
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
		$req = 'DELETE from favorite  '; 
		$req .= 'WHERE id_property = \'' . $this->getIdProperty().'\'';
		$req .= ' AND id_member = \'' . $this->getIdMember().'\'';
		$res = $this->getConnexion()->query($req);
		return $res;
	}

	function insert($type = 'INSERT')
	{
		$this->verifChampsPrimaryKey();
		$champsRequete = $this->prepareChampsRequete();
		$req = $type.' INTO favorite (';
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
		if ($this->getIdProperty() == '')
			die('Exécution impossible car le champs OBLIGATOIRE `id_property` n\'a pas de valeur!');
		if ($this->getIdMember() == '')
			die('Exécution impossible car le champs OBLIGATOIRE `id_member` n\'a pas de valeur!');
	}

}

?>