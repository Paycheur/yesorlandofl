<?php
	require(dirname(__FILE__).'/../Class/CConnexion.class.php');

	$nomBdd = 'Yesorlandofl'; // NOM DE LA BASE A RECUPERER


	$req = 'SELECT table_name FROM tables WHERE table_schema = \''.$nomBdd.'\'';
	$db = new CConnexion('information_schema', 'root', '');
	$connexion = $db->getConnexion();
	$donnees = $connexion->query($req);
	$tabRows = $donnees->fetchAll(PDO::FETCH_ASSOC);
	foreach($tabRows as $table => $value) //on récupère toutes les tables de la base recherchée
	{
		
		$value['table_name']= 'member_search'; //Récupérer une seule table de la base selectionnée. Ne pas oublié d'ajouté le "exit" à la fin
		$table_name = $value['table_name'];

		$fileName= __DIR__.'/../Mod/Db/Db'.ucfirst($table_name).'.mod.php'; // CHEMIN ET NOM DU FICHIER QUI SERA CREE
			
		//Récupération de toutes les colonnes de la table ainsi que leurs infos
		$req3 = 'SELECT * FROM COLUMNS WHERE table_schema =  \''.$nomBdd.'\' AND table_name = \''.$table_name.'\'';
		
		$donnees3 = $connexion->query($req3);
		$tabRows3 = $donnees3->fetchAll(PDO::FETCH_ASSOC);
	
		$infoTable = array();
		foreach($tabRows3 as $tab)
		{
			$infoTable[$tab['COLUMN_NAME']] = array(
				'NULL' => $tab['IS_NULLABLE'],
				'PRI' => $tab['COLUMN_KEY'],
				'DEFAULT' => $tab['COLUMN_DEFAULT'],
				'EXTRA' => $tab['EXTRA']
			);
		}
		
			$string = "<?php\n\n";
				$exp = explode('_', $table_name);
				if(count($exp) > 0)
				{
					$t = '';
					foreach($exp as $i=>$s)
					{
						$t .= ucfirst($s);
					}
				}
				$string .= "class Bdd".$t." extends CConnexion
{";
				$string .= "\n";
				foreach($infoTable as $nom_col => $val)
				{
					$expl = explode('_', $nom_col);
					if(count($expl) > 0)
					{
						$str = '';
						foreach($expl as $i=>$s)
						{
							$str .= ucfirst($s);
						}
					}
					if(isset($str))
					{
						$nom_col = $str;
					}
					else 
					{
						$nom_col = ucfirst($nom_col);
					}
					$string .= "	private $".$nom_col." = '';";
					$string .= "\n";
					
					
				}

				$string .= "\n";
				$string .= '	/************** SETTERS *****************/';
				$string .= "\n";
				foreach($infoTable as $nom_col => $val)
				{
					$expl = explode('_', $nom_col);
					if(count($expl) > 0)
					{
						$str = '';
						foreach($expl as $i=>$s)
						{
							$str .= ucfirst($s);
						}
					}
					if(isset($str))
					{
						$nom_col = $str;
					}
					else 
					{
						$nom_col = ucfirst($nom_col);
					}
					$string .= "\n";
					$string .= '	function set'.$nom_col.'($v)';
					$string .= "\n";
					$string .= '	{';
					$string .= "\n";
					$string .= '		$this->'.$nom_col.' = $v;';
					$string .= "\n";
					$string .= '	}';
					$string .= "\n";
				}
				$string .= "\n";
				$string .= '	/************** GETTERS *****************/';
				$string .= "\n";
				foreach($infoTable as $nom_col => $val)
				{
					$expl = explode('_', $nom_col);
					if(count($expl) > 0)
					{
						$str = '';
						foreach($expl as $i=>$s)
						{
							$str .= ucfirst($s);
						}
					}
					if(isset($str))
					{
						$nom_col = $str;
					}
					else 
					{
						$nom_col = ucfirst($nom_col);
					}
					$string .= "\n";
					$string .= '	function get'.$nom_col.'()';
					$string .= "\n";
					$string .= '	{';
					$string .= "\n";
					$string .= '		return $this->'.$nom_col.';';
					$string .= "\n";
					$string .= '	}';
					$string .= "\n";
				}
				$string .= "\n";
				$string .= '	function __construct($valeurs = array())';
				$string .= "\n";
				$string .= '	{';
				$string .= "\n";
				$string .= '		parent::__construct(BD_NAME, BD_LOGIN, BD_PASSWORD);';
				$string .= "\n";
				$string .= '		if (!empty($valeurs)) // Si on a spécifié des valeurs, alors on hydrate l\'objet';
				$string .= "\n";
       			$string .= '		 $this->hydrate($valeurs);';
				$string .= "\n";
				$string .= '	}';
				$string .= "\n";
				$string .= "\n";
				$string .= '	public function hydrate($donnees)';
				$string .= "\n";
		        $string .= '	{';
		        $string .= "\n";
		        $string .= '	    foreach ($donnees as $attribut => $valeur);';
		        $string .= "\n";
		        $string .= '	    {';
		        $string .= "\n";
		        $string .= "	        \$methode = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', \$attribut)));"; 
		        $string .= "\n";
		        $string .= '	        if (is_callable(array($this, $methode)))';
		        $string .= "\n";
		        $string .= '	        {';
		        $string .= "\n";
		        $string .= '	            $this->$methode($valeur);';
		        $string .= "\n";
		        $string .= '	        }';
		        $string .= "\n";
		        $string .= '	    }';
		        $string .= "\n";
		        $string .= '	}';
		        $string .= "\n";
		        $string .= "\n";
		        
			    $string .= '	public function isNew()';
			    $string .= "\n";
			    $string .= '	{';
			    $string .= "\n";
			    $string .= '		return empty($this->id);';
			    $string .= "\n";
			    $string .= '	}';
			    $string .= "\n";
			    $string .= "\n";
			    $string .= '	public function isValide() //return TRUE ou un tableau error[]';
			    $string .= "\n";
			    $string .= '	{';
			    $string .= "\n";
			    $string .= "\n";					
			    
			    $string .= '	}';
			    $string .= "\n";
			    $string .= "\n";
				
				$string .= "	function prepareChampsRequete()
	{\n";
				foreach($infoTable as $nom_col => $val)
				{
					$nom_col_save = $nom_col;
					$expl = explode('_', $nom_col);
					if(count($expl) > 0)
					{
						$str = '';
						foreach($expl as $i=>$s)
						{
							$str .= ucfirst($s);
						}
					}
					if(isset($str))
					{
						$nom_col = $str;
					}
					else 
					{
						$nom_col = ucfirst($nom_col);
					}
					
					if($infoTable[$nom_col_save]['DEFAULT'] != 'NULL')
						$default = 'DEFAULT';
					else if($infoTable[$nom_col_save]['NULL'] != 'NO')
						$default = 'NULL';
					else
						$default = 'DEFAULT';

					
					$string .= '		$champsRequete[\''.$nom_col_save.'\']		=	($this->'.$nom_col.' != \'\')		? \'\\\'\'. protegeChaine($this->get'.$nom_col.'()) .\'\\\'\' : \''.$default.'\';';
					$string .= "\n";
				}
				$string .= '		return $champsRequete; ';
				$string .= "	}\n";
				$string .= "\n";
				$string .= '	function load($row)';
				$string .= "\n";
				$string .= '	{';
				$string .= "\n";
				foreach($infoTable as $nom_col => $val)
				{
					$nom_col_save = $nom_col;
					$expl = explode('_', $nom_col);
					if(count($expl) > 0)
					{
						$str = '';
						foreach($expl as $i=>$s)
						{
							$str .= ucfirst($s);
						}
					}
					if(isset($str))
					{
						$nom_col = $str;
					}
					else 
					{
						$nom_col = ucfirst($nom_col);
					}
					$string .= '		$this->set'.$nom_col.'($row[\''.$nom_col_save.'\']);';
					$string .= "\n";
				}
			$string .= "\n";
			$string .= '	}';
			$string .= "\n";
			
			$allColonneString = implode(',',array_keys($infoTable));
			$string .= "	function select(\$where = array(), \$whereSpe=array(), \$orderBy = array(), \$limit = null)
	{
		// Clause SELECT
		\$req = 'SELECT $allColonneString '.
				'FROM $table_name  ';
				
		// Clause WHERE
		\$chWhere = '';
		\$where = (\$where == null) ? array() : \$where;
		foreach(\$where as \$k => \$v)
		{
			if (\$chWhere != '')
				\$chWhere .= 'AND ';
			else
				\$chWhere .= 'WHERE ';
			\$chWhere .= \$k .'=\''. protegeChaine(\$v) .'\' ';
		}
		\$req .= \$chWhere;
		
		//Clause WHERE #2 : key => colonne, val : array('signe', 'val')
		\$chWhereSpe = '';
		\$whereSpe = (\$whereSpe == null) ? array() : \$whereSpe;
		foreach(\$whereSpe as \$i => \$where2)
		{
			foreach(\$where2 as \$k => \$v)
			{

				if(\$k == 0)
				{
					if (\$chWhere != '' || \$chWhereSpe != '')
						\$chWhereSpe .= 'AND ';
					else
						\$chWhereSpe .= 'WHERE ';
				
					\$chWhereSpe .= \$v.' ';
				}
				else
				{
					if(count(\$v) > 1)
						\$chWhereSpe .= \$v[0].' \''. protegeChaine(\$v[1]) .'\' '; // ex : actif >= 1
					else
						\$chWhereSpe .= \$v[0].' '; //ex : actif IS NULL
				}
			}
		}
		\$req .= \$chWhereSpe;
		
		// Clause ORDER BY
		\$chOrderBy = '';
		\$orderBy = (\$orderBy == null) ? array() : \$orderBy;
		foreach(\$orderBy as \$k => \$v)
		{
			if (\$chOrderBy != '')
				\$chOrderBy .= ', ';
			else
				\$chOrderBy .= 'ORDER BY ';
			\$chOrderBy .= \$k .' '. \$v;
		}
		\$req .= \$chOrderBy;
		
		// Clause LIMIT
		if (\$limit != null)
		{
			if (count(\$limit) == 1){
				\$chLimit = ' LIMIT '.\$limit[0];
			}
			if (count(\$limit) == 2){
				\$chLimit = ' LIMIT '.\$limit[0].', '.\$limit[1];
			}
			\$req .= \$chLimit;
		}
		\$tabRows =  array();
		\$res = \$this->getConnexion()->query(\$req);
		\$tabRows = \$res->fetchAll(PDO::FETCH_ASSOC);
		return \$tabRows;
	}

	function selectFunction(\$function, \$where = array(), \$whereSpe = array())
	{
		\$req = 'SELECT '.\$function[0].'('.\$function[1].') value FROM $table_name ';
		\$chWhere = '';
		foreach(\$where as \$k => \$v)
		{
			if (\$chWhere != '')
				\$chWhere .= 'AND ';
			else
				\$chWhere .= 'WHERE ';
			\$chWhere .= \$k .'=\''. protegeChaine(\$v) .'\' ';
		}
		\$req .= \$chWhere;
		
		//Clause WHERE #2 : key => colonne, val : array('signe', 'val')
		\$chWhereSpe = '';
		\$whereSpe = (\$whereSpe == null) ? array() : \$whereSpe;
		foreach(\$whereSpe as \$i => \$where2)
		{
			foreach(\$where2 as \$k => \$v)
			{

				if(\$k == 0)
				{
					if (\$chWhere != '' || \$chWhereSpe != '')
						\$chWhereSpe .= 'AND ';
					else
						\$chWhereSpe .= 'WHERE ';
				
					\$chWhereSpe .= \$v.' ';
				}
				else
				{
					if(count(\$v) > 1)
						\$chWhereSpe .= \$v[0].' \''. protegeChaine(\$v[1]) .'\' '; // ex : actif >= 1
					else
						\$chWhereSpe .= \$v[0].' '; //ex : actif IS NULL
				}
			}
		}
		\$req .= \$chWhereSpe;
		
		\$tabRows =  array();
		\$res = \$this->getConnexion()->query(\$req);
		\$tabRows = \$res->fetchAll(PDO::FETCH_ASSOC);
		return \$tabRows[0]['value'];
	}

	function update()
	{
		\$this->verifChampsPrimaryKey();
		\$champsRequete = \$this->prepareChampsRequete();
		
		\$req = 'UPDATE $table_name  SET ';
		foreach (\$champsRequete as \$champ => \$value){
			\$req .= \$champ . ' = ' . \$value . ', ';
		}";
		$isFirst=true;
		foreach($infoTable as $nom=>$info)
		{
			if($info['PRI'] == 'PRI')
			{
				$exp = explode('_', $nom);
				if(count($exp) > 0)
				{
					$t = '';
					foreach($exp as $i=>$s)
					{
						$t .= ucfirst($s);
					}
				}
				if($isFirst == true)
				{
					$string.= "\n		\$req .= 'WHERE $nom = \'' . \$this->get$t().'\'';";
					$isFirst = false;
				}
				else
					$string.= "\n		\$req .= ' AND $nom = \'' . \$this->get$t().'\'';";
			}
		}
		$string .= 	"\n		\$req = str_replace(', WHERE', ' WHERE', \$req);
		
		\$res = \$this->getConnexion()->query(\$req);
		return \$res;
	}
	

	/** 
	 * Supprime la ligne
	 * @return DB résultat de la suppression
	 */
	function delete()
	{
		\$req = 'DELETE from $table_name  '; ";
		$isFirst=true;
		foreach($infoTable as $nom=>$info)
		{
			if($info['PRI'] == 'PRI')
			{
				$exp = explode('_', $nom);
				if(count($exp) > 0)
				{
					$t = '';
					foreach($exp as $i=>$s)
					{
						$t .= ucfirst($s);
					}
				}
				if($isFirst == true)
				{
					$string.= "\n		\$req .= 'WHERE $nom = \'' . \$this->get$t().'\'';";
					$isFirst = false;
				}
				else
					$string.= "\n		\$req .= ' AND $nom = \'' . \$this->get$t().'\'';";
			}
		}
		$string .=
		"\n		\$res = \$this->getConnexion()->query(\$req);
		return \$res;
	}

	function insert(\$type = 'INSERT')
	{
		\$this->verifChampsPrimaryKey();
		\$champsRequete = \$this->prepareChampsRequete();
		\$req = \$type.' INTO $table_name (';
		foreach (\$champsRequete as \$champ => \$value){
			\$req .= \$champ . ', ';
		}
		\$req .= ') VALUES (';
		foreach (\$champsRequete as \$champ => \$value){
			\$req .= \$value.', ';
		}
		
		\$req .= ')';
		\$req = str_replace(', )', ')', \$req);
		\$res = \$this->getConnexion()->query(\$req);
		return \$res;
	}

	function verifChampsPrimaryKey()
	{";
		foreach($infoTable as $nom=>$info)
		{
			if($info['PRI'] == 'PRI' AND $info['EXTRA'] != 'auto_increment')
			{
				$exp = explode('_', $nom);
				if(count($exp) > 0)
				{
					$t = '';
					foreach($exp as $i=>$s)
					{
						$t .= ucfirst($s);
					}
				}
				$string .= "\n		if (\$this->get$t() == '')
			die('Exécution impossible car le champs OBLIGATOIRE `$nom` n\'a pas de valeur!');";
			}
		}
		
	$string .= "\n	}

}

?>";
	
			
		 	file_put_contents($fileName, $string);
		 	echo "\n";
		 	echo 'Fichier Db'.ucfirst($table_name).'.mod.php créé ';
		 	echo "\n";
		 	exit;
	}
?>