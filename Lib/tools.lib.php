<?php


function __autoload ($class)
{
  switch ($class[0])
  {
  	case 'V': require_once ('View/'.$class.'.view.php'); break;
  	case 'M' : require_once ('Mod/'.$class.'.mod.php');   break;
  }

  return;

}

function protegeChaine($ch)
{
    $ch = str_replace('\\','\\\\',$ch);
    $ch = str_replace("'","\'",$ch);
    return $ch;
}

function br2nl($text) //Enleve les <br /> du au nl2br()
{
	return  str_replace("<br />", "", $text);
}

 function SupprAccents($toClean) {

	$normalizeChars = array(
    'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
    'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
    'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
);

    foreach($normalizeChars as $accent => $suppr){
    	$toClean = str_replace($accent, $suppr, $toClean);
    }

    return $toClean;
}

function supprAccentUTF8($chaine)
{
	$chaine = str_replace("Ã¤", "À", $chaine);
	$chaine = str_replace("Ã‰","É", $chaine);
	$chaine = str_replace("Ã©", "é", $chaine);
	$chaine = str_replace("Ã¨", "è", $chaine);
	$chaine = str_replace("Ã", "à", $chaine);
	$chaine = str_replace("Ã¤", "ä", $chaine);
	$chaine = str_replace("Ã«", "ë", $chaine);
	$chaine = str_replace("Ã¯", "ï", $chaine);
	$chaine = str_replace("Ã¢", "â", $chaine);
	$chaine = str_replace("Ãª", "ê", $chaine);
	$chaine = str_replace("a´", "ô", $chaine);
	$chaine = str_replace("Ã´", "ô", $chaine);

	return $chaine;
 }

function format_url($chaine)
{
    $chaine = SupprAccents(supprAccentUTF8(html_entity_decode($chaine)));
    $chaine = str_replace('œ', 'oe', $chaine);
    $chaine = strtolower($chaine);
    $chaine = str_replace('#', '-', $chaine);
    $chaine = str_replace('(', '-', $chaine);
    $chaine = str_replace(')', '-', $chaine);
    $chaine = str_replace('&', '-', $chaine);
    $chaine = str_replace(' ', '-', $chaine);
    $chaine = str_replace(',', '-', $chaine);
    $chaine = str_replace('--', '-', $chaine);
    $chaine = str_replace('_', '-', $chaine);
    $chaine = str_replace('/', '-', $chaine);
    $chaine = str_replace(':', '-', $chaine);
    $chaine = str_replace('--', '-', $chaine);
    $chaine = str_replace('"', '-', $chaine);
    $chaine = str_replace("'", '-', $chaine);
    $chaine = str_replace("’", '-', $chaine);
    $chaine = str_replace('--', '-', $chaine);
    $chaine = str_replace('²', '', $chaine);
    $chaine = str_replace('?', '', $chaine);
    $chaine = str_replace('!', '', $chaine);
    // Si le dernier caractère est un - on le supprimer
    if(endswith($chaine, '-')) $chaine = substr($chaine, 0, strlen($chaine)-1);

    return $chaine;
}

 function startswith($hay, $needle) {
  return substr($hay, 0, strlen($needle)) === $needle;
}

function endswith($hay, $needle) {
  return substr($hay, -strlen($needle)) === $needle;
}

//view check value
function test_value($csv, $input ) {
    if ( isset( $csv[$input] ) &&  $csv[$input]['val'] != '' )  {

        echo '<li><b>'.$csv[$input]["lib"].': </b>'
        .$csv[$input]["val"].'</li>' ;
    }
}

?>