<?php
session_start();
//defines
require (dirname(__FILE__).'/../Inc/define.inc.php');

//Class diverses
require (dirname(__FILE__).'/../Class/CConnexion.class.php');

//Class DB
require (dirname(__FILE__).'/../Mod/Db/DbData.mod.php');
require (dirname(__FILE__).'/../Mod/Db/DbMember.mod.php');
require (dirname(__FILE__).'/../Mod/Db/DbVisit_request.mod.php');
require (dirname(__FILE__).'/../Mod/Db/DbMember_search.mod.php');
require (dirname(__FILE__).'/../Mod/Db/DbFavorite.mod.php');
require (dirname(__FILE__).'/../Mod/Db/DbMp_conversation.mod.php');
require (dirname(__FILE__).'/../Mod/Db/DbMp_message.mod.php');



//lib
require (dirname(__FILE__).'/../Lib/tools.lib.php');
require (dirname(__FILE__).'/../Lib/Facebook/base_facebook.php');
require (dirname(__FILE__).'/../Lib/Facebook/facebook.php');
?>