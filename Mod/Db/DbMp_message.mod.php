<?php

class BddMpMessage extends CConnexion
{
	private $IdMessage = '';
	private $IdConversation = '';
	private $IdExpediteur = '';
	private $IdDestinataire = '';
	private $Date = '';
	private $Message = '';
	private $LuExpediteur = '';
	private $LuDestinataire = '';

	/************** SETTERS *****************/

	function setIdMessage($v)
	{
		$this->IdMessage = $v;
	}

	function setIdConversation($v)
	{
		$this->IdConversation = $v;
	}

	function setIdExpediteur($v)
	{
		$this->IdExpediteur = $v;
	}

	function setIdDestinataire($v)
	{
		$this->IdDestinataire = $v;
	}

	function setDate($v)
	{
		$this->Date = $v;
	}

	function setMessage($v)
	{
		$this->Message = $v;
	}

	function setLuExpediteur($v)
	{
		$this->LuExpediteur = $v;
	}

	function setLuDestinataire($v)
	{
		$this->LuDestinataire = $v;
	}

	/************** GETTERS *****************/

	function getIdMessage()
	{
		return $this->IdMessage;
	}

	function getIdConversation()
	{
		return $this->IdConversation;
	}

	function getIdExpediteur()
	{
		return $this->IdExpediteur;
	}

	function getIdDestinataire()
	{
		return $this->IdDestinataire;
	}

	function getDate()
	{
		return $this->Date;
	}

	function getMessage()
	{
		return $this->Message;
	}

	function getLuExpediteur()
	{
		return $this->LuExpediteur;
	}

	function getLuDestinataire()
	{
		return $this->LuDestinataire;
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
		$champsRequete['id_message']		=	($this->IdMessage != '')		? '\''. protegeChaine($this->getIdMessage()) .'\'' : 'DEFAULT';
		$champsRequete['id_conversation']		=	($this->IdConversation != '')		? '\''. protegeChaine($this->getIdConversation()) .'\'' : 'DEFAULT';
		$champsRequete['id_expediteur']		=	($this->IdExpediteur != '')		? '\''. protegeChaine($this->getIdExpediteur()) .'\'' : 'DEFAULT';
		$champsRequete['id_destinataire']		=	($this->IdDestinataire != '')		? '\''. protegeChaine($this->getIdDestinataire()) .'\'' : 'DEFAULT';
		$champsRequete['date']		=	($this->Date != '')		? '\''. protegeChaine($this->getDate()) .'\'' : 'DEFAULT';
		$champsRequete['message']		=	($this->Message != '')		? '\''. protegeChaine($this->getMessage()) .'\'' : 'DEFAULT';
		$champsRequete['lu_expediteur']		=	($this->LuExpediteur != '')		? '\''. protegeChaine($this->getLuExpediteur()) .'\'' : 'DEFAULT';
		$champsRequete['lu_destinataire']		=	($this->LuDestinataire != '')		? '\''. protegeChaine($this->getLuDestinataire()) .'\'' : 'DEFAULT';
		return $champsRequete; 	}

	function load($row)
	{
		$this->setIdMessage($row['id_message']);
		$this->setIdConversation($row['id_conversation']);
		$this->setIdExpediteur($row['id_expediteur']);
		$this->setIdDestinataire($row['id_destinataire']);
		$this->setDate($row['date']);
		$this->setMessage($row['message']);
		$this->setLuExpediteur($row['lu_expediteur']);
		$this->setLuDestinataire($row['lu_destinataire']);

	}
	function select($where = array(), $whereSpe=array(), $orderBy = array(), $limit = null)
	{
		// Clause SELECT
		$req = 'SELECT id_message,id_conversation,id_expediteur,id_destinataire,date,message,lu_expediteur,lu_destinataire '.
				'FROM mp_message  ';
				
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
		$req = 'SELECT '.$function[0].'('.$function[1].') value FROM mp_message ';
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
		
		$req = 'UPDATE mp_message  SET ';
		foreach ($champsRequete as $champ => $value){
			$req .= $champ . ' = ' . $value . ', ';
		}
		$req .= 'WHERE id_message = \'' . $this->getIdMessage().'\'';
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
		$req = 'DELETE from mp_message  '; 
		$req .= 'WHERE id_message = \'' . $this->getIdMessage().'\'';
		$res = $this->getConnexion()->query($req);
		return $res;
	}

	function insert($type = 'INSERT')
	{
		$this->verifChampsPrimaryKey();
		$champsRequete = $this->prepareChampsRequete();
		$req = $type.' INTO mp_message (';
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