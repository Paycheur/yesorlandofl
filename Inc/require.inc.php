<?php
session_start();
//defines
require (__DIR__.'/../Inc/define.inc.php');

//Class diverses
require (__DIR__.'/../Class/CConnexion.class.php');

//Class DB
require (__DIR__.'/../Mod/Db/DbData.mod.php');
require (__DIR__.'/../Mod/Db/DbMember.mod.php');
require (__DIR__.'/../Mod/Db/DbVisit_request.mod.php');
require (__DIR__.'/../Mod/Db/DbMember_search.mod.php');
require (__DIR__.'/../Mod/Db/DbFavorite.mod.php');




//lib
require (__DIR__.'/../Lib/tools.lib.php');
//require (__DIR__.'/../Lib/Facebook/base_facebook.php');
//require (__DIR__.'/../Lib/Facebook/facebook.php');
?>