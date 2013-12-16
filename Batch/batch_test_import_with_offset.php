<?php
//ini_set("memory_limit" , "8048M");

include(dirname(__FILE__).'/../Class/phrets.php');
include(dirname(__FILE__).'/../Inc/require.inc.php');



//echo "\n **** RESIDENTIAL 1 ****";
//
//recupFichier5();
//recupFichier6();
//
//
//recupDonneesResidential();

//echo "\n **** VACANT_LAND ****";
//recupFichier1();
//recupFichier2();
//recupFichier3();
//recupFichier31();
//
//recupDonneesVacantLand();

echo "\n **** RENTAL ****";
recupFichier91();

recupDonneesRental();



//recupFichier7();
//recupFichier8();
//recupFichier9();
//recupFichier10();
//
//echo "\n **** RESIDENTIAL 2 ****";
//recupDonneesResidential2();

//echo "\n **** RENTAL ****";	
//recupDonneesRental();

//echo "\n **** VACANT LAND ****";	
//recupDonneesVacantLand();

//echo "\n **** COMMERCIAL ****";	
//recupDonneesCommercial();

	
//recupDonneesResidential();






function recupFichier1()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("5");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '1950-01-01';
//
	$dateEnd = '2013-01-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_1.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier2()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("5");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-01-01';
//
	$dateEnd = '2013-06-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_2.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier3()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("5");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-06-01';
//
	$dateEnd = '2013-10-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_3.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier31()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("5");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-10-01';
//
	$dateEnd = '2013-12-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_31.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier4()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("4");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-08-01';
//
	$dateEnd = '2013-10-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_4.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier5()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("4");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-10-01';
//
	$dateEnd = '2013-10-15';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_5_1.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier6()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("4");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-10-15';
//
	$dateEnd = '2013-11-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_5_2.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier7()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("3");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '1950-01-01';
//
	$dateEnd = '2013-01-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_1.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier8()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("3");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-01-01';
//
	$dateEnd = '2013-06-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_2.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier9()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("3");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-06-01';
//
	$dateEnd = '2013-10-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_3.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier91()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("3");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-10-01';
//
	$dateEnd = '2013-12-01';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_31.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupFichier10()
{
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
	
	// use http://retsmd.com to help determine the SystemName of the DateTime field which
	// designates when a record was last modified
	$rets_modtimestamp_field = "112";
	$rets_status_field = "178";
	$active = 'ACT';
	// use http://retsmd.com to help determine the names of the classes you want to pull.
	// these might be something like RE_1, RES, RESI, 1, etc.
	$property_classes = array("4");
	
	// DateTime which is used to determine how far back to retrieve records.
	// using a really old date so we can get everything
	$dateBegin = '2013-12-09';
//
	$dateEnd = '2013-12-12';
//	
	$between = $dateBegin.'-'.$dateEnd;
	
	// start rets connection
	$rets = new phRETS;
	
	// only enable this if you know the server supports the optional RETS feature called 'Offset'
	$rets->SetParam("offset_support", false);
	
	echo "+ Connecting to {$rets_login_url} as {$rets_username}<br>\n";
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	if ($connect) {
	        echo "  + Connected<br>\n";
	}
	else {
	        echo "  + Not connected:<br>\n";
	        print_r($rets->Error());
	        exit;
	}
	
	
	foreach ($property_classes as $class) {
	$nbOk = 0;
	        echo "+ Property:{$class}<br>\n";
	
	        if($class == "1")
	        	$name = 'commercial';
	        else if($class=="3")
	        	$name = 'rental';
	        else if($class=="4")
	        	$name = 'residential';
	        else if($class=="5")
	        	$name = 'vacant_land';
	        $file_name = strtolower("data/property_all_active_".$name."_10.csv");
	        $fh = fopen(dirname(__FILE__).'/'.$file_name, "w+");
	

	        

	                $query = "({$rets_modtimestamp_field}={$between}),({$rets_status_field}={$active})";
					$first = true;
	                // run RETS search
	                $search = $rets->SearchQuery("Property", $class, $query, array("Select" => "sysid"));
	                if ($rets->NumRows($search) > 0) {
	
	
	                        // process results
	                        while ($record = $rets->FetchRow($search)) {
	                        	
	                        	$fields_order = array();
	                        	
	                        	$sysid = $record['sysid'];
	                        	$query2 = "(sysid={$sysid})";
	
						                // run RETS search
						        $search2 = $rets->SearchQuery("Property", $class, $query2, array());
	                        	 $fields_order = $rets->SearchGetFields($search2);
				      		  	if($first == true)
				                {
				                	fputcsv($fh, $fields_order);
				                	$first = false;
				                }
				
				                // process results
				                while ($record = $rets->FetchRow($search2)) {
				                        $this_record = array();
				                        foreach ($fields_order as $fo) {
				                                $this_record[] = "||".$record[$fo]."||";
				                        }
				                        fputcsv($fh, $this_record);
				                        $nbOk++;
				                }
				                
				                $rets->FreeResult($search2);

	                        }
	
	
	                }
	
	           
					 echo "    + Total found: {$rets->TotalRecordsFound($search)}<br> Total OK : {$nbOk} \n";
	                $rets->FreeResult($search);
	
	        //fclose($fh);
	
	        echo "  - done<br>\n";
	
	}
	
	echo "+ Disconnecting<br>\n";
	$rets->Disconnect();
}

function recupDonneesRental()
{
	$nbMaj = 0;
	$phrets = new phRETS;
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
    $phrets->Connect($rets_login_url, $rets_username, $rets_password);
    
	$all_fichier = array('property_all_active_rental_31');
	
	$donnees_retour = array();
	foreach($all_fichier as $fichier)
	{
		$tab_donnees_fichier=array();
		if (file_exists(dirname(__FILE__).'/data/'.$fichier.'.csv') != FALSE) 
		{
			
		    $handle  = file_get_contents(dirname(__FILE__).'/data/'.$fichier.'.csv') or exit;
		    echo $fichier;
		    $continue=true;
		    $offset=0;
		    while($continue==true)
		    {
			    $handle_row = array_slice(explode("\n", $handle), $offset, 1000, true);
			    if(count($handle_row) == 0)
			    	$continue = false;
			    
			    echo ' - '.count($handle_row);
			    $offset = $offset+1000;
			    $first = true;
			    $array_key = array();
			    $array_donnees = array();
			    foreach ($handle_row as $key => $val) 
			    {
			    	if($val == '') continue;
			    	$row_array = array();
			    	if($first == true)
			       		$row_array = explode(',', str_replace('"', '', $val));
			       	else
			       		$row_array = explode('||,', str_replace('"', '', $val));
	
			       
		       		if($first == true)
		        	{
				        foreach ($row_array as $key2 => $val2) 
				        {
				        	
				        	$array_key[$val2] = $key2;
				        }
				       
		        	}
	
			        if($first == false)
			        {	
			        		
			        	$value_id = '';
			        	$value_city = '';
	
			        	$value_type = 'rental';
			        		
			        	$value_style = '';
			        	$value_bed = '';
			        	$value_bathroom = '';
			        	$value_price = '';
			        	$value_sqft ='';
			        	$value_address = '';
			        	$value_img = '';
			        	$value_state = '';
			        	$value_postalCode = '';
			        	$value_sale_or_lease = '';
						$value_status = '';
	
					    
				   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
			     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
				   		$value_style = trim( str_replace('||', '', $row_array[$array_key[934]])); //property style
				   		$value_bed = trim( str_replace('||', '', $row_array[$array_key[32]])); //beds
				   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address
				   		$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[2364]]))); //rent price
				   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
				   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
				   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
				   		$value_bathroom = trim( str_replace('||', '', $row_array[$array_key[2294]])); //full bath
				   		$value_sale_or_lease = 'lease';
				   		$value_status = trim( str_replace('||', '', $row_array[$array_key[178]])) ;//status
						   	
					    
					    if($value_status == 'Sold' || $value_status == '' || $value_price == 0)
					    	$actif = 0;
					    else
					    	$actif=1;
					    
					    $recup_img = true;
					    $dbData = new BddData();
					    $rows = $dbData->select(array('id' => $value_id, 'type' => $value_type));
					    if(count($rows) > 0)
					    {
					    	$dbData->load($rows[0]);
					    	if($dbData->getImg() != null && $dbData->getImg() != '')
					    	{
					    		$recup_img = false;
					    		$value_img = $dbData->getImg();
					    	}
					    }
	
					    if($recup_img == true)
					    {
				        	$photos = $phrets->GetObject("Property", "Photo", $value_id, "*", 1);
				        	if(count($photos) > 0)
				        	{
								foreach ($photos as $photo) {
									if(!isset($photo['Location'])) continue;
									
									$value_img .= $photo['Location'].'|';
								        
								}
				        	}
							if($value_img != '')
							{
								$value_img .= '#end';
								$value_img = str_replace('|#end', '', $value_img);
							}
					    }
	
					    $data['property_description'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2819]])), 'lib' => 'Property Description');
						$data['property_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1349]])), 'lib' => 'Property Style');
						$data['architectural_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1716]])), 'lib' => 'Architectural Style');
						$data['beds'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[32]])), 'lib' => 'Beds');
						$data['full_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2294]])), 'lib' => 'Full Baths');
						$data['half_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2296]])), 'lib' => 'Half Baths');
						$data['sq_ft_heated'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2346]])), 'lib' => 'Sq Ft Heated');
						$data['lot_size'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2362]])), 'lib' => 'Lot Size');
						$data['lp_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2763]])), 'lib' => 'LP/SqFt');
						$data['year_built'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[55]])), 'lib' => 'Year Built');
						$data['garage_carport'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2805]])), 'lib' => 'Garage/Carport');
						$data['annual_rent'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3211]])), 'lib' => 'Annual Rent');
						$data['seasonal_rent'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3213]])), 'lib' => 'Seasonal Rent');
						$data['off_season_rent'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3214]])), 'lib' => 'Off Season Rent');
						$data['weekly_rent'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3215]])), 'lib' => 'Weekly Rent');
						$data['application_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[927]])), 'lib' => 'Application Fee');
						$data['max_pet_weight'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1055]])), 'lib' => 'Max Pet Weight');
						$data['minimum_days_leased'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1117]])), 'lib' => 'Minimum Days Leased');
						$data['pet_deposit'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1213]])), 'lib' => 'Pet Deposit');
						$data['pet_fee_non_refundable'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1215]])), 'lib' => 'Pet Fee (Non-Refundable)');
						$data['security_deposit'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1231]])), 'lib' => 'Security Deposit');
						$data['long_term_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1248]])), 'lib' => 'Long Term Y/N');
						$data['association_approval_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3219]])), 'lib' => 'Association Approval Fee');
						$data['additional_applicant_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3220]])), 'lib' => 'Additional Applicant Fee');
						$data['furnishings'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3224]])), 'lib' => 'Furnishings');
						$data['weeks_available_2013'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3228]])), 'lib' => 'Weeks Available 2013');
						$data['master_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1466]])), 'lib' => 'Master Bedroom (Approx.)');
						$data['2nd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1495]])), 'lib' => '2nd Bedroom (Approx.)');
						$data['3rd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1514]])), 'lib' => '3rd Bedroom (Approx.)');
						$data['4th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1518]])), 'lib' => '4th Bedroom (Approx.)');
						$data['5th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1522]])), 'lib' => '5th Bedroom (Approx.)');
						$data['master_bath_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1724]])), 'lib' => 'Master Bath Features');
						$data['kitchen_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1727]])), 'lib' => 'Kitchen Features');
						$data['kitchen_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1426]])), 'lib' => 'Kitchen (Approx.)');
						$data['great_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3021]])), 'lib' => 'Great Room (Approx.)');
						$data['family_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1405]])), 'lib' => 'Family Room (Approx.)');
						$data['living_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1415]])), 'lib' => 'Living Room (Approx.)');
						$data['dinette_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1384]])), 'lib' => 'Dinette (Approx.)');
						$data['bonus_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1354]])), 'lib' => 'Bonus Room (Approx.)');
						$data['studio_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2945]])), 'lib' => 'Studio Dimensions');
						$data['study_den_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3077]])), 'lib' => 'Study/Den Dimensions');
						$data['balcony_porch_lanai_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2789]])), 'lib' => 'Balcony/Porch/Lanai (Approx)');
						$data['interior_layout'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1725]])), 'lib' => 'Interior Layout');
						$data['interior_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1726]])), 'lib' => 'Interior Features');
						$data['architectural_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1716]])), 'lib' => 'Architectural Style');
						$data['floor_covering'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1729]])), 'lib' => 'Floor Covering');
						$data['roof'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1735]])), 'lib' => 'Roof');
						$data['foundation'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1739]])), 'lib' => 'Foundation');
						$data['exterior_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1734]])), 'lib' => 'Exterior Features');
						$data['lot_size_acres'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2624]])), 'lib' => 'Lot Size [Acres]');
						$data['lot_size_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2622]])), 'lib' => 'Lot Size [SqFt]');
						$data['lot_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2322]])), 'lib' => 'Lot Dimensions');
						$data['total_acreage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2328]])), 'lib' => 'Total Acreage');
						$data['garage_carport'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2805]])), 'lib' => 'Garage/Carport');
						$data['garage_features	character'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1736]])), 'lib' => 'Garage Features	Character');
						$data['air_conditioning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1732]])), 'lib' => 'Air Conditioning');
						$data['heating_and_fuel'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1731]])), 'lib' => 'Heating and Fuel');
						$data['fireplace_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2801]])), 'lib' => 'Fireplace Y/N');
						$data['fireplace_description'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1723]])), 'lib' => 'Fireplace Description');
						$data['utilities'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1720]])), 'lib' => 'Utilities');
						$data['appliances_included'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1728]])), 'lib' => 'Appliances Included');
						$data['pool'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3186]])), 'lib' => 'Pool');
						$data['pool_type'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1737]])), 'lib' => 'Pool Type');
						$data['pool_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3233]])), 'lib' => 'Pool Dimensions');
						$data['water_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2350]])), 'lib' => 'Water Name');
						$data['water_view_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3064]])), 'lib' => 'Water View Y/N');
						$data['water_frontage_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3065]])), 'lib' => 'Water Frontage Y/N');
						$data['water_frontage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3067]])), 'lib' => 'Water Frontage');
						$data['water_access'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3068]])), 'lib' => 'Water Access');
						$data['waterfront_feet'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3022]])), 'lib' => 'Waterfront Feet');
						$data['elementary_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1397]])), 'lib' => 'Elementary School');
						$data['middle_or_junior_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1425]])), 'lib' => 'Middle or Junior School');
						$data['high_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1420]])), 'lib' => 'High School');
						$data['community_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1743]])), 'lib' => 'Community Features');
						$data['flood_zone_code'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3148]])), 'lib' => 'Flood Zone Code');
						$data['location'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1718]])), 'lib' => 'Location');
						$data['pets_allowed_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3075]])), 'lib' => 'Pets Allowed Y/N');
						$data['green_certifications'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3015]])), 'lib' => 'Green Certifications');
						
				
						$dbData = new BddData();
						$dbData->setId($value_id);
						$dbData->setType($value_type);
						$dbData->setCity($value_city);
						$dbData->setStyle($value_style);
						$dbData->setBed($value_bed);
						$dbData->setBathroom($value_bathroom);
						$dbData->setPrice($value_price);
						$dbData->setSqft($value_sqft);
						$dbData->setAddress($value_address);
						$dbData->setImg($value_img);
						$dbData->setState($value_state);
						$dbData->setPostalCode($value_postalCode);
						$dbData->setSaleOrLease($value_sale_or_lease);
						$dbData->setStatus($value_status);
						$dbData->setActif($actif);
						$dbData->setJsonData(json_encode($data));
						$dbData->insert('REPLACE');
					    
						$nbMaj++;
						
			        }
			        else
			        {
			        	 $first = false;
			        }
			    }
		    }
	    }
	    
	    echo "\n    + Total maj: {$nbMaj} \n";

	}


}


function recupDonneesCommercial()
{
	$nbMaj = 0;
	$phrets = new phRETS;
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
    $phrets->Connect($rets_login_url, $rets_username, $rets_password);
    
	$all_fichier = array('property_all_active_commercial');
	
	$donnees_retour = array();
	foreach($all_fichier as $fichier)
	{
		$tab_donnees_fichier=array();
		if (file_exists(dirname(__FILE__).'/data/'.$fichier.'.csv') != FALSE) 
		{
			
		    $handle  = file_get_contents(dirname(__FILE__).'/data/'.$fichier.'.csv') or exit;
		    echo $fichier;
		    $continue=true;
		    $offset=0;
		    while($continue==true)
		    {
			    $handle_row = array_slice(explode("\n", $handle), $offset, 1000, true);
			    if(count($handle_row) == 0)
			    	$continue = false;
			    	
			    echo ' - '.count($handle_row);
			    $offset = $offset+1000;
			    $first = true;
			    $array_key = array();
			    $array_donnees = array();
			    foreach ($handle_row as $key => $val) 
			    {
			    	if($val == '') continue;
			    	$row_array = array();
			    	if($first == true)
			       		$row_array = explode(',', str_replace('"', '', $val));
			       	else
			       		$row_array = explode('||,', str_replace('"', '', $val));
	
			       
		       		if($first == true)
		        	{
				        foreach ($row_array as $key2 => $val2) 
				        {
				        	
				        	$array_key[$val2] = $key2;
				        }
				       
		        	}
	
			        if($first == false)
			        {	
			        		
			        	$value_id = '';
			        	$value_city = '';
			        	
			        	$value_type='commercial';
	
			        		
			        	$value_style = '';
			        	$value_bed = '';
			        	$value_bathroom = '';
			        	$value_price = '';
			        	$value_sqft ='';
			        	$value_address = '';
			        	$value_img = '';
			        	$value_state = '';
			        	$value_postalCode = '';
			        	$value_sale_or_lease = '';
						$value_status = '';
	
			     		$value_id = trim( str_replace('||', '', $row_array[0])); //id
			     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
				   		$value_style = trim( str_replace('||', '', $row_array[$array_key[77]])); //property style
				   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address391
				   		$lease_rate = trim( str_replace('||', '', $row_array[$array_key[2308]]));
				   		if($lease_rate != '')
				   		{
				   			$value_sqft = trim( str_replace('||', '', $row_array[$array_key[79]])) ;//lotsize sqft
				   			if($lease_rate > 50)
				   			{
				   				$value_price = $lease_rate;
				   			}
				   			else
				   			{
				   				$value_price = ($lease_rate*$value_sqft)/12; //lease rate
				   			}
				   			$value_sale_or_lease = 'lease';
				   			
				   		}
				   		else
				   		{
				   			$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[176]]))); //list price
				   			$value_sqft = trim( str_replace('||', '', $row_array[$array_key[80]])) ;//lotsize sqft
				   			$value_sale_or_lease = 'sale';
				   		}
				   		
				   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
				   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
				   		$value_status = trim( str_replace('||', '', $row_array[$array_key[178]])) ;//status
				     	
					    if($value_status == 'Sold' || $value_status == '' || $value_price == 0)
					    	$actif = 0;
					    else
					    	$actif=1;
					    
					    $recup_img = true;
					    $dbData = new BddData();
					    $rows = $dbData->select(array('id' => $value_id, 'type' => $value_type));
					    if(count($rows) > 0)
					    {
					    	$dbData->load($rows[0]);
					    	if($dbData->getImg() != null && $dbData->getImg() != '')
					    	{
					    		$recup_img = false;
					    		$value_img = $dbData->getImg();
					    	}
					    }
	
					    if($recup_img == true)
					    {
				        	$photos = $phrets->GetObject("Property", "Photo", $value_id, "*", 1);
				        	if(count($photos) > 0)
				        	{
								foreach ($photos as $photo) {
									if(!isset($photo['Location'])) continue;
									
									$value_img .= $photo['Location'].'|';
								        
								}
				        	}
							if($value_img != '')
							{
								$value_img .= '#end';
								$value_img = str_replace('|#end', '', $value_img);
							}
					    }
	
						$data['lease_rate'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2308]])), 'lib' => 'Lease Rate');
						$data['property_use'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[86]])), 'lib' => 'Property Use');
						$data['property_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[77]])), 'lib' => 'Property Style');
						$data['sq_ft_gross'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[80]])), 'lib' => 'Sq.Ft. Gross');
						$data['lp_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2763]])), 'lib' => 'LP/SqFt');
						$data['lease_price_per_sf'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2999]])), 'lib' => 'Lease Price per SF');
						$data['net_leasable_sq_ft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[79]])), 'lib' => 'Net Leasable Sq.Ft.');
						$data['total_num_bldg'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[443]])), 'lib' => 'Total Num Bldg');
						$data['floors_number'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[432]])), 'lib' => 'Floors #');
						$data['class_of_space'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2952]])), 'lib' => 'Class of Space');
						$data['lot_size_acres'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2624]])), 'lib' => 'Lot Size [Acres]');
						$data['public_remarks_new'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3187]])), 'lib' => 'Public Remarks New');
						$data['complex_community_name_nccb'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2316]])), 'lib' => 'Complex/Community Name/NCCB');
						$data['zoning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2320]])), 'lib' => 'Zoning');
						$data['taxes'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[104]])), 'lib' => 'Taxes');
						$data['net_operating_income'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[283]])), 'lib' => 'Net Operating Income');
						$data['cam_per_sq_ft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3002]])), 'lib' => 'CAM Per Sq Ft');
						$data['number_of_add_parcels'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2632]])), 'lib' => '# of Add Parcels');
						$data['water_view'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3011]])), 'lib' => 'Water View');
						$data['waterfront_feet'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3022]])), 'lib' => 'Waterfront Feet');
						$data['number_of_hotel_motel_rms'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2644]])), 'lib' => '# of Hotel/Motel Rms');
						$data['number_of_restrooms'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2648]])), 'lib' => '# of Restrooms');
						$data['number_of_offices'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2650]])), 'lib' => '# of Offices');
						$data['warehouse_space_heated'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3118]])), 'lib' => 'Warehouse Space(Heated)');
						$data['warehouse_space_total'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3119]])), 'lib' => 'Warehouse Space(Total)');
						$data['number_of_bays_dock_high'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3120]])), 'lib' => '# of Bays(Dock High)');
						$data['number_of_bays_grade_level'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3121]])), 'lib' => '# of Bays(Grade Level)');
						$data['number_of_restrooms'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2648]])), 'lib' => '# of Restrooms');
						$data['freezer_space_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2654]])), 'lib' => 'Freezer Space Y/N');
						$data['air_conditioning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[487]])), 'lib' => 'Air Conditioning');
						$data['utilities'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[475]])), 'lib' => 'Utilities');
						$data['new_construction'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3084]])), 'lib' => 'New Construction');
						$data['construction_status'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3085]])), 'lib' => 'Construction Status');
						$data['projected_completion_date'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3086]])), 'lib' => 'Projected Completion Date');
						$data['green_site_improvements'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3195]])), 'lib' => 'Green Site Improvements');
						$data['green_water_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3196]])), 'lib' => 'Green Water Features');
						$data['green_energy_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3197]])), 'lib' => 'Green Energy Features');
						$data['financing_terms'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3162]])), 'lib' => 'Financing Terms');
						$data['condo_fees'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3254]])), 'lib' => 'Condo Fees');
						$data['condo_fees_term'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3255]])), 'lib' => 'Condo Fees Term');
        			
				
						$dbData = new BddData();
						$dbData->setId($value_id);
						$dbData->setType($value_type);
						$dbData->setCity($value_city);
						$dbData->setStyle($value_style);
						$dbData->setBed($value_bed);
						$dbData->setBathroom($value_bathroom);
						$dbData->setPrice($value_price);
						$dbData->setSqft($value_sqft);
						$dbData->setAddress($value_address);
						$dbData->setImg($value_img);
						$dbData->setState($value_state);
						$dbData->setPostalCode($value_postalCode);
						$dbData->setSaleOrLease($value_sale_or_lease);
						$dbData->setStatus($value_status);
						$dbData->setActif($actif);
						$dbData->setJsonData(json_encode($data));
						$dbData->insert('REPLACE');
					    
						 $nbMaj++;
			        }
			        else
			        {
			        	 $first = false;
			        }
			    }
		    }
	    }

	}
	echo "\n    + Total maj: {$nbMaj} \n";
}


function recupDonneesResidential()
{
	$nbMaj=0;
	$phrets = new phRETS;
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
    $phrets->Connect($rets_login_url, $rets_username, $rets_password);
    
	$all_fichier = array('property_all_active_residential_5_1', 'property_all_active_residential_5_2');
	$donnees_retour = array();
	foreach($all_fichier as $fichier)
	{
		
		$tab_donnees_fichier=array();
		if (file_exists(dirname(__FILE__).'/data/'.$fichier.'.csv') != FALSE) 
		{
			
		    $handle  = file_get_contents(dirname(__FILE__).'/data/'.$fichier.'.csv') or exit;
		    echo $fichier;
		    $continue=true;
		    $offset=0;
		    while($continue==true)
		    {
			    $handle_row = array_slice(explode("\n", $handle), $offset, 1000, true);
			    if(count($handle_row) == 0)
			    	$continue = false;
			    
			    echo ' - '.count($handle_row);
			    $offset = $offset+1000;
			    $first = true;
			    $array_key = array();
			    $array_donnees = array();
			    foreach ($handle_row as $key => $val) 
			    {
			    	if($val == '') continue;
			    	$row_array = array();
			    	if($first == true)
			       		$row_array = explode(',', str_replace('"', '', $val));
			       	else
			       		$row_array = explode('||,', str_replace('"', '', $val));
	
			       
		       		if($first == true)
		        	{
				        foreach ($row_array as $key2 => $val2) 
				        {
				        	
				        	$array_key[$val2] = $key2;
				        }
				       
		        	}
	
			        if($first == false)
			        {	
			        	$value_id = '';
			        	$value_city = '';
	
			        	$value_type = 'residential';
	
			        		
			        	$value_style = '';
			        	$value_bed = '';
			        	$value_bathroom = '';
			        	$value_price = '';
			        	$value_sqft ='';
			        	$value_address = '';
			        	$value_img = '';
			        	$value_state = '';
			        	$value_postalCode = '';
			        	$value_sale_or_lease = '';
						$value_status = '';
	
					    
				   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
			     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
				   		$value_style = trim( str_replace('||', '', $row_array[$array_key[1349]])); //property style
				   		$value_bed = trim( str_replace('||', '', $row_array[$array_key[32]])); //beds
				   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address
				   		$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[176]]))); //list price
				   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2346]])); //lotsize sqft
				   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
				   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
				   		$value_bathroom = trim( str_replace('||', '', $row_array[$array_key[2294]])); //full bath
				   		$value_sale_or_lease = 'sale';
				   		$value_status = trim( str_replace('||', '', $row_array[$array_key[178]])) ;//status
						   	
					    
					   if($value_status == 'Sold' || $value_status == '' || $value_price == 0)
					    	$actif = 0;
					    else
					    	$actif=1;
					    $recup_img = true;
					    $dbData = new BddData();
	
					    $rows = $dbData->select(array('id' => $value_id, 'type' => $value_type));
					    if(count($rows) > 0)
					    {
					    	$dbData->load($rows[0]);
	
					    	if($dbData->getImg() != null && $dbData->getImg() != '')
					    	{
					    		$recup_img = false;
					    		$value_img = $dbData->getImg();
					    	}
					    }
	
					    if($recup_img == true)
					    {
				        	$photos = $phrets->GetObject("Property", "Photo", $value_id, "*", 1);
				        	if(count($photos) > 0)
				        	{
								foreach ($photos as $photo) {
									if(!isset($photo['Location'])) continue;
									
									$value_img .= $photo['Location'].'|';
								        
								}
				        	}
							if($value_img != '')
							{
								$value_img .= '#end';
								$value_img = str_replace('|#end', '', $value_img);
							}
					    }
	
					   $data['special_sale_provision'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3062]])), 'lib' => 'Special Sale Provision');
						$data['list_price'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[176]])), 'lib' => 'List Price');
						$data['property_description'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2819]])), 'lib' => 'Property Description');
						$data['property_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1349]])), 'lib' => 'Property Style');
						$data['architectural_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1716]])), 'lib' => 'Architectural Style');
						$data['full_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2294]])), 'lib' => 'Full Baths');
						$data['half_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2296]])), 'lib' => 'Half Baths');
						$data['sq_ft_heated'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2346]])), 'lib' => 'Sq Ft Heated');
						$data['lot_size'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2362]])), 'lib' => 'Lot Size');
						$data['lp_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2763]])), 'lib' => 'LP/SqFt');
						$data['year_built'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[55]])), 'lib' => 'Year Built');
						$data['garage_carport'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2805]])), 'lib' => 'Garage/Carport');
						$data['beds'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[32]])), 'lib' => 'Beds');
						$data['master_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1466]])), 'lib' => 'Master Bedroom (Approx.)');
						$data['2nd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1495]])), 'lib' => '2nd Bedroom (Approx.)');
						$data['3rd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1514]])), 'lib' => '3rd Bedroom (Approx.)');
						$data['4th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1518]])), 'lib' => '4th Bedroom (Approx.)');
						$data['5th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1522]])), 'lib' => '5th Bedroom (Approx.)');
						$data['full_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2294]])), 'lib' => 'Full Baths');
						$data['half_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2296]])), 'lib' => 'Half Baths');
						$data['master_bath_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1724]])), 'lib' => 'Master Bath Features');
						$data['kitchen_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1727]])), 'lib' => 'Kitchen Features');
						$data['kitchen_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1426]])), 'lib' => 'Kitchen (Approx.)');
						$data['great_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3021]])), 'lib' => 'Great Room (Approx.)');
						$data['family_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1405]])), 'lib' => 'Family Room (Approx.)');
						$data['living_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1415]])), 'lib' => 'Living Room (Approx.)');
						$data['dinette_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1384]])), 'lib' => 'Dinette (Approx.)');
						$data['bonus_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1354]])), 'lib' => 'Bonus Room (Approx.)');
						$data['studio_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2945]])), 'lib' => 'Studio Dimensions');
						$data['study_den_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3077]])), 'lib' => 'Study/Den Dimensions');
						$data['balcony_porch_lanai_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2789]])), 'lib' => 'Balcony/Porch/Lanai (Approx)');
						$data['interior_layout'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1725]])), 'lib' => 'Interior Layout');
						$data['interior_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1726]])), 'lib' => 'Interior Features');
						$data['architectural_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1716]])), 'lib' => 'Architectural Style');
						$data['floor_covering'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1729]])), 'lib' => 'Floor Covering');
						$data['roof'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1735]])), 'lib' => 'Roof');
						$data['foundation'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1739]])), 'lib' => 'Foundation');
						$data['exterior_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1734]])), 'lib' => 'Exterior Features');
						$data['lot_size_acres'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2624]])), 'lib' => 'Lot Size [Acres]');
						$data['lot_size_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2622]])), 'lib' => 'Lot Size [SqFt]');
						$data['lot_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2322]])), 'lib' => 'Lot Dimensions');
						$data['total_acreage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2328]])), 'lib' => 'Total Acreage');
						$data['garage_carport'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2805]])), 'lib' => 'Garage/Carport');
						$data['garage_features	character'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1736]])), 'lib' => 'Garage Features	Character');
						$data['air_conditioning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1732]])), 'lib' => 'Air Conditioning');
						$data['heating_and_fuel'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1731]])), 'lib' => 'Heating and Fuel');
						$data['fireplace_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2801]])), 'lib' => 'Fireplace Y/N');
						$data['fireplace_description'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1723]])), 'lib' => 'Fireplace Description');
						$data['utilities'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1720]])), 'lib' => 'Utilities');
						$data['appliances_included'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1728]])), 'lib' => 'Appliances Included');
						$data['pool'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3186]])), 'lib' => 'Pool');
						$data['pool_type'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1737]])), 'lib' => 'Pool Type');
						$data['pool_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3233]])), 'lib' => 'Pool Dimensions');
						$data['water_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2350]])), 'lib' => 'Water Name');
						$data['water_view_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3064]])), 'lib' => 'Water View Y/N');
						$data['water_frontage_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3065]])), 'lib' => 'Water Frontage Y/N');
						$data['water_frontage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3067]])), 'lib' => 'Water Frontage');
						$data['water_access'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3068]])), 'lib' => 'Water Access');
						$data['waterfront_feet'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3022]])), 'lib' => 'Waterfront Feet');
						$data['taxes'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1375]])), 'lib' => 'Taxes');
						$data['hoa_comm_assn'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3074]])), 'lib' => 'HOA/Comm Assn');
						//$data['hoa_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1833]])), 'lib' => 'HOA Fee');
						$data['hoa_payment_schedule'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2901]])), 'lib' => 'HOA Payment Schedule');
						$data['condo_maintenance_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3189]])), 'lib' => 'Condo Maintenance Fee');
						$data['condo_maint_fee_schedule'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3190]])), 'lib' => 'Condo Maint. Fee Schedule');
						$data['cdd_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2795]])), 'lib' => 'CDD Y/N');
						$data['annual_cdd_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2793]])), 'lib' => 'Annual CDD Fee');
						$data['elementary_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1397]])), 'lib' => 'Elementary School');
						$data['middle_or_junior_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1425]])), 'lib' => 'Middle or Junior School');
						$data['high_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1420]])), 'lib' => 'High School');
						$data['community_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1743]])), 'lib' => 'Community Features');
						$data['flood_zone_code'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3148]])), 'lib' => 'Flood Zone Code');
						$data['location'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1718]])), 'lib' => 'Location');
						$data['pets_allowed_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3075]])), 'lib' => 'Pets Allowed Y/N');
						$data['green_certifications'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3015]])), 'lib' => 'Green Certifications');
						$data['office_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2368]])), 'lib' => 'Office Name');
				
						$dbData = new BddData();
						$dbData->setId($value_id);
						$dbData->setType($value_type);
						$dbData->setCity($value_city);
						$dbData->setStyle($value_style);
						$dbData->setBed($value_bed);
						$dbData->setBathroom($value_bathroom);
						$dbData->setPrice($value_price);
						$dbData->setSqft($value_sqft);
						$dbData->setAddress($value_address);
						$dbData->setImg($value_img);
						$dbData->setState($value_state);
						$dbData->setPostalCode($value_postalCode);
						$dbData->setSaleOrLease($value_sale_or_lease);
						$dbData->setStatus($value_status);
						$dbData->setActif($actif);
						$dbData->setJsonData(json_encode($data));
						$dbData->insert('REPLACE');
						
						$nbMaj++;
	
			        }
			        else
			        {
			        	 $first = false;
			        }
			    }
		    }
	    }

	}
	
	echo "\n    + Total maj: {$nbMaj} \n";
}

function recupDonneesResidential2()
{
	$nbMaj=0;
	$phrets = new phRETS;
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
    $phrets->Connect($rets_login_url, $rets_username, $rets_password);
    
	$all_fichier = array('property_all_active_residential_7', 'property_all_active_residential_8', 'property_all_active_residential_9', 'property_all_active_residential_10');
	$donnees_retour = array();
	foreach($all_fichier as $fichier)
	{
		
		$tab_donnees_fichier=array();
		if (file_exists(dirname(__FILE__).'/data/'.$fichier.'.csv') != FALSE) 
		{
			
		    $handle  = file_get_contents(dirname(__FILE__).'/data/'.$fichier.'.csv') or exit;
		    echo $fichier;
		    $continue=true;
		    $offset=0;
		    while($continue==true)
		    {
			    $handle_row = array_slice(explode("\n", $handle), $offset, 1000, true);
			    if(count($handle_row) == 0)
			    	$continue = false;
			    
			    echo ' - '.count($handle_row);
			    $offset = $offset+1000;
			    $first = true;
			    $array_key = array();
			    $array_donnees = array();
			    foreach ($handle_row as $key => $val) 
			    {
			    	if($val == '') continue;
			    	$row_array = array();
			    	if($first == true)
			       		$row_array = explode(',', str_replace('"', '', $val));
			       	else
			       		$row_array = explode('||,', str_replace('"', '', $val));
	
			       
		       		if($first == true)
		        	{
				        foreach ($row_array as $key2 => $val2) 
				        {
				        	
				        	$array_key[$val2] = $key2;
				        }
				       
		        	}
	
			        if($first == false)
			        {	
			        	$value_id = '';
			        	$value_city = '';
	
			        	$value_type = 'residential';
	
			        		
			        	$value_style = '';
			        	$value_bed = '';
			        	$value_bathroom = '';
			        	$value_price = '';
			        	$value_sqft ='';
			        	$value_address = '';
			        	$value_img = '';
			        	$value_state = '';
			        	$value_postalCode = '';
			        	$value_sale_or_lease = '';
						$value_status = '';
	
					    
				   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
			     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
				   		$value_style = trim( str_replace('||', '', $row_array[$array_key[1349]])); //property style
				   		$value_bed = trim( str_replace('||', '', $row_array[$array_key[32]])); //beds
				   		$value_address = trim( str_replace('||', '', $row_array[$array_key[49]])); //address
				   		$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[176]]))); //list price
				   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2346]])); //lotsize sqft
				   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
				   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
				   		$value_bathroom = trim( str_replace('||', '', $row_array[$array_key[2294]])); //full bath
				   		$value_sale_or_lease = 'sale';
				   		$value_status = trim( str_replace('||', '', $row_array[$array_key[178]])) ;//status
						   	
					    
					   if($value_status == 'Sold' || $value_status == '' || $value_price == 0)
					    	$actif = 0;
					    else
					    	$actif=1;
					    $recup_img = true;
					    $dbData = new BddData();
	
					    $rows = $dbData->select(array('id' => $value_id, 'type' => $value_type));
					    if(count($rows) > 0)
					    {
					    	$dbData->load($rows[0]);
	
					    	if($dbData->getImg() != null && $dbData->getImg() != '')
					    	{
					    		$recup_img = false;
					    		$value_img = $dbData->getImg();
					    	}
					    }
	
					    if($recup_img == true)
					    {
				        	$photos = $phrets->GetObject("Property", "Photo", $value_id, "*", 1);
				        	if(count($photos) > 0)
				        	{
								foreach ($photos as $photo) {
									if(!isset($photo['Location'])) continue;
									
									$value_img .= $photo['Location'].'|';
								        
								}
				        	}
							if($value_img != '')
							{
								$value_img .= '#end';
								$value_img = str_replace('|#end', '', $value_img);
							}
					    }
	
					   $data['special_sale_provision'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3062]])), 'lib' => 'Special Sale Provision');
						$data['list_price'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[176]])), 'lib' => 'List Price');
						$data['property_description'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2819]])), 'lib' => 'Property Description');
						$data['property_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1349]])), 'lib' => 'Property Style');
						$data['architectural_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1716]])), 'lib' => 'Architectural Style');
						$data['full_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2294]])), 'lib' => 'Full Baths');
						$data['half_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2296]])), 'lib' => 'Half Baths');
						$data['sq_ft_heated'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2346]])), 'lib' => 'Sq Ft Heated');
						$data['lot_size'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2362]])), 'lib' => 'Lot Size');
						$data['lp_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2763]])), 'lib' => 'LP/SqFt');
						$data['year_built'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[55]])), 'lib' => 'Year Built');
						$data['garage_carport'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2805]])), 'lib' => 'Garage/Carport');
						$data['beds'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[32]])), 'lib' => 'Beds');
						$data['master_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1466]])), 'lib' => 'Master Bedroom (Approx.)');
						$data['2nd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1495]])), 'lib' => '2nd Bedroom (Approx.)');
						$data['3rd_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1514]])), 'lib' => '3rd Bedroom (Approx.)');
						$data['4th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1518]])), 'lib' => '4th Bedroom (Approx.)');
						$data['5th_bedroom_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1522]])), 'lib' => '5th Bedroom (Approx.)');
						$data['full_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2294]])), 'lib' => 'Full Baths');
						$data['half_baths'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2296]])), 'lib' => 'Half Baths');
						$data['master_bath_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1724]])), 'lib' => 'Master Bath Features');
						$data['kitchen_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1727]])), 'lib' => 'Kitchen Features');
						$data['kitchen_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1426]])), 'lib' => 'Kitchen (Approx.)');
						$data['great_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3021]])), 'lib' => 'Great Room (Approx.)');
						$data['family_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1405]])), 'lib' => 'Family Room (Approx.)');
						$data['living_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1415]])), 'lib' => 'Living Room (Approx.)');
						$data['dinette_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1384]])), 'lib' => 'Dinette (Approx.)');
						$data['bonus_room_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1354]])), 'lib' => 'Bonus Room (Approx.)');
						$data['studio_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2945]])), 'lib' => 'Studio Dimensions');
						$data['study_den_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3077]])), 'lib' => 'Study/Den Dimensions');
						$data['balcony_porch_lanai_approx'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2789]])), 'lib' => 'Balcony/Porch/Lanai (Approx)');
						$data['interior_layout'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1725]])), 'lib' => 'Interior Layout');
						$data['interior_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1726]])), 'lib' => 'Interior Features');
						$data['architectural_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1716]])), 'lib' => 'Architectural Style');
						$data['floor_covering'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1729]])), 'lib' => 'Floor Covering');
						$data['roof'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1735]])), 'lib' => 'Roof');
						$data['foundation'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1739]])), 'lib' => 'Foundation');
						$data['exterior_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1734]])), 'lib' => 'Exterior Features');
						$data['lot_size_acres'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2624]])), 'lib' => 'Lot Size [Acres]');
						$data['lot_size_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2622]])), 'lib' => 'Lot Size [SqFt]');
						$data['lot_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2322]])), 'lib' => 'Lot Dimensions');
						$data['total_acreage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2328]])), 'lib' => 'Total Acreage');
						$data['garage_carport'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2805]])), 'lib' => 'Garage/Carport');
						$data['garage_features	character'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1736]])), 'lib' => 'Garage Features	Character');
						$data['air_conditioning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1732]])), 'lib' => 'Air Conditioning');
						$data['heating_and_fuel'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1731]])), 'lib' => 'Heating and Fuel');
						$data['fireplace_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2801]])), 'lib' => 'Fireplace Y/N');
						$data['fireplace_description'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1723]])), 'lib' => 'Fireplace Description');
						$data['utilities'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1720]])), 'lib' => 'Utilities');
						$data['appliances_included'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1728]])), 'lib' => 'Appliances Included');
						$data['pool'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3186]])), 'lib' => 'Pool');
						$data['pool_type'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1737]])), 'lib' => 'Pool Type');
						$data['pool_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3233]])), 'lib' => 'Pool Dimensions');
						$data['water_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2350]])), 'lib' => 'Water Name');
						$data['water_view_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3064]])), 'lib' => 'Water View Y/N');
						$data['water_frontage_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3065]])), 'lib' => 'Water Frontage Y/N');
						$data['water_frontage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3067]])), 'lib' => 'Water Frontage');
						$data['water_access'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3068]])), 'lib' => 'Water Access');
						$data['waterfront_feet'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3022]])), 'lib' => 'Waterfront Feet');
						$data['taxes'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1375]])), 'lib' => 'Taxes');
						$data['hoa_comm_assn'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3074]])), 'lib' => 'HOA/Comm Assn');
						//$data['hoa_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1833]])), 'lib' => 'HOA Fee');
						$data['hoa_payment_schedule'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2901]])), 'lib' => 'HOA Payment Schedule');
						$data['condo_maintenance_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3189]])), 'lib' => 'Condo Maintenance Fee');
						$data['condo_maint_fee_schedule'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3190]])), 'lib' => 'Condo Maint. Fee Schedule');
						$data['cdd_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2795]])), 'lib' => 'CDD Y/N');
						$data['annual_cdd_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2793]])), 'lib' => 'Annual CDD Fee');
						$data['elementary_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1397]])), 'lib' => 'Elementary School');
						$data['middle_or_junior_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1425]])), 'lib' => 'Middle or Junior School');
						$data['high_school'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1420]])), 'lib' => 'High School');
						$data['community_features'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1743]])), 'lib' => 'Community Features');
						$data['flood_zone_code'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3148]])), 'lib' => 'Flood Zone Code');
						$data['location'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1718]])), 'lib' => 'Location');
						$data['pets_allowed_y_n'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3075]])), 'lib' => 'Pets Allowed Y/N');
						$data['green_certifications'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3015]])), 'lib' => 'Green Certifications');
						$data['office_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2368]])), 'lib' => 'Office Name');
				
						$dbData = new BddData();
						$dbData->setId($value_id);
						$dbData->setType($value_type);
						$dbData->setCity($value_city);
						$dbData->setStyle($value_style);
						$dbData->setBed($value_bed);
						$dbData->setBathroom($value_bathroom);
						$dbData->setPrice($value_price);
						$dbData->setSqft($value_sqft);
						$dbData->setAddress($value_address);
						$dbData->setImg($value_img);
						$dbData->setState($value_state);
						$dbData->setPostalCode($value_postalCode);
						$dbData->setSaleOrLease($value_sale_or_lease);
						$dbData->setStatus($value_status);
						$dbData->setActif($actif);
						$dbData->setJsonData(json_encode($data));
						$dbData->insert('REPLACE');
						
						$nbMaj++;
	
			        }
			        else
			        {
			        	 $first = false;
			        }
			    }
		    }
	    }

	}
	
	echo "\n    + Total maj: {$nbMaj} \n";
}


function recupDonneesVacantLand()
{
	$nbMaj=0;
	$phrets = new phRETS;
	$rets_login_url = "http://mfr.rets.interealty.com/Login.asmx/Login";
	$rets_username = "RETS689";
	$rets_password = "2e7Retru";
    $phrets->Connect($rets_login_url, $rets_username, $rets_password);
    
	$all_fichier = array('property_all_active_vacant_land_3','property_all_active_vacant_land_31');
	
	$donnees_retour = array();
	foreach($all_fichier as $fichier)
	{
		$tab_donnees_fichier=array();
		if (file_exists(dirname(__FILE__).'/data/'.$fichier.'.csv') != FALSE) 
		{
			
		    $handle  = file_get_contents(dirname(__FILE__).'/data/'.$fichier.'.csv') or exit;
		    echo $fichier;
		    $continue=true;
		    $offset=0;
		    while($continue==true)
		    {
			    $handle_row = array_slice(explode("\n", $handle), $offset, 1000, true);
			    if(count($handle_row) == 0)
			    	$continue = false;
			    
			    echo ' - '.count($handle_row);
			    $offset = $offset+1000;
			    $first = true;
			    $array_key = array();
			    $array_donnees = array();
			    foreach ($handle_row as $key => $val) 
			    {
			    	if($val == '') continue;
			    	$row_array = array();
			    	if($first == true)
			       		$row_array = explode(',', str_replace('"', '', $val));
			       	else
			       		$row_array = explode('||,', str_replace('"', '', $val));
	
			       
		       		if($first == true)
		        	{
				        foreach ($row_array as $key2 => $val2) 
				        {
				        	
				        	$array_key[$val2] = $key2;
				        }
				       
		        	}
	
			        if($first == false)
			        {	
			        		
			        	$value_id = '';
			        	$value_city = '';
	
			        	$value_type = 'vacant_land';
			        		
			        	$value_style = '';
			        	$value_bed = '';
			        	$value_bathroom = '';
			        	$value_price = '';
			        	$value_sqft ='';
			        	$value_address = '';
			        	$value_img = '';
			        	$value_state = '';
			        	$value_postalCode = '';
			        	$value_sale_or_lease = '';
						$value_status = '';
	
	
				   		$value_id = trim( str_replace('||', '', $row_array[0])); //id
			     		$value_city = trim( str_replace('||', '', $row_array[$array_key[2302]])); //city
				   		$value_style = trim( str_replace('||', '', $row_array[$array_key[1764]])); //property style
				   		$value_address = trim( str_replace('||', '', $row_array[$array_key[165]])).' '.trim( str_replace('||', '', $row_array[$array_key[421]])).' '.trim( str_replace('||', '', $row_array[$array_key[2306]])); //number, street
				   		$value_sqft = trim( str_replace('||', '', $row_array[$array_key[2622]])); //lotsize sqft
				   		$value_state = trim( str_replace('||', '', $row_array[$array_key[2304]])); //state
				   		$value_postalCode = trim( str_replace('||', '', $row_array[$array_key[46]])) ;//postal code (zipcode)
				   		$lease_rate = trim( str_replace('||', '', $row_array[$array_key[2308]]));
				   		if($lease_rate!= '')
				   		{
				   			$value_price = $lease_rate; //lease rate
				   			$value_sale_or_lease = 'lease';
				   		}
				   		else
				   		{
				   			$value_price = str_replace(',', '', trim( str_replace('||', '', $row_array[$array_key[176]]))); //list price
				   			$value_sale_or_lease = 'sale';
				   		}
				   		$value_status = trim( str_replace('||', '', $row_array[$array_key[178]])) ;//status
						   		
					    if($value_status == 'Sold' || $value_status == '' || $value_price == 0)
					    	$actif = 0;
					    else
					    	$actif=1;
					    
					    $recup_img = true;
					    $dbData = new BddData();
					    $rows = $dbData->select(array('id' => $value_id, 'type' => $value_type));
					    if(count($rows) > 0)
					    {
					    	$dbData->load($rows[0]);
					    	if($dbData->getImg() != null && $dbData->getImg() != '')
					    	{
					    		$recup_img = false;
					    		$value_img = $dbData->getImg();
					    	}
					    }
	
					    if($recup_img == true)
					    {
				        	$photos = $phrets->GetObject("Property", "Photo", $value_id, "*", 1);
				        	if(count($photos) > 0)
				        	{
								foreach ($photos as $photo) {
									if(!isset($photo['Location'])) continue;
									
									$value_img .= $photo['Location'].'|';
								        
								}
				        	}
							if($value_img != '')
							{
								$value_img .= '#end';
								$value_img = str_replace('|#end', '', $value_img);
							}
					    }
	
						$data['property_style'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1764]])), 'lib' => 'Property Style');
						$data['list_price'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[176]])), 'lib' => 'List Price');
						$data['lease_rate'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2308]])), 'lib' => 'Lease Rate');
						$data['public_remarks_new'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3187]])), 'lib' => 'Public Remarks New');
						$data['zoning'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2320]])), 'lib' => 'Zoning');
						$data['lot_size_sqft'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2622]])), 'lib' => 'Lot Size [SqFt]');
						$data['lot_size_acres'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2624]])), 'lib' => 'Lot Size [Acres]');
						$data['lot_dimensions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2322]])), 'lib' => 'Lot Dimensions');
						$data['total_acreage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2328]])), 'lib' => 'Total Acreage');
						$data['site_improvements'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2678]])), 'lib' => 'Site Improvements');
						$data['fences'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2134]])), 'lib' => 'Fences');
						$data['taxes'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1790]])), 'lib' => 'Taxes');
						$data['hoa_comm_assn'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3074]])), 'lib' => 'HOA/Comm Assn');
						$data['hoa_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[1833]])), 'lib' => 'HOA Fee');
						$data['hoa_payment_schedule'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2901]])), 'lib' => 'HOA Payment Schedule');
						$data['annual_cdd_fee'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2793]])), 'lib' => 'Annual CDD Fee');
						$data['financing_available'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2124]])), 'lib' => 'Financing Available');
						$data['water_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2350]])), 'lib' => 'Water Name');
						$data['water_frontage'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3067]])), 'lib' => 'Water Frontage');
						$data['water_access'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3068]])), 'lib' => 'Water Access');
						$data['waterfront_feet'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[3022]])), 'lib' => 'Waterfront Feet');
						$data['driving_directions'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2300]])), 'lib' => 'Driving Directions');
						$data['office_name'] = array('val' => trim( str_replace('||', '', $row_array[$array_key[2368]])), 'lib' => 'Office Name');
				
						$dbData = new BddData();
						$dbData->setId($value_id);
						$dbData->setType($value_type);
						$dbData->setCity($value_city);
						$dbData->setStyle($value_style);
						$dbData->setBed($value_bed);
						$dbData->setBathroom($value_bathroom);
						$dbData->setPrice($value_price);
						$dbData->setSqft($value_sqft);
						$dbData->setAddress($value_address);
						$dbData->setImg($value_img);
						$dbData->setState($value_state);
						$dbData->setPostalCode($value_postalCode);
						$dbData->setSaleOrLease($value_sale_or_lease);
						$dbData->setStatus($value_status);
						$dbData->setActif($actif);
						$dbData->setJsonData(json_encode($data));
						$dbData->insert('REPLACE');
					    
						$nbMaj++;
			        }
			        else
			        {
			        	 $first = false;
			        }
			    }
		    }
	    }

	}
	
	echo "\n    + Total maj: {$nbMaj} \n";
}

?>