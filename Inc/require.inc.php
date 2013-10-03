<?php
session_start();
//defines
require ('Inc/define.inc.php');

//Class diverses
require ('Class/CConnexion.class.php');

//Class DB
require ('Mod/Db/DbData.mod.php');
require ('Mod/Db/DbMember.mod.php');
require ('Mod/Db/DbVisit_request.mod.php');
require ('Mod/Db/DbMember_search.mod.php');
require ('Mod/Db/DbFavorite.mod.php');




//lib
require ('Lib/tools.lib.php');
/*require ('Lib/Facebook/base_facebook.php');
require ('Lib/Facebook/facebook.php');*/
?>