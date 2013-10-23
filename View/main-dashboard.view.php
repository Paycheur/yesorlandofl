<?php
//Cette page permet d'etre appellé dans toutes les pages non static à qui on a besoin de passer des paramètres (les pages **.view.php)

$vpage->$page['method']($page['arg']);

?>