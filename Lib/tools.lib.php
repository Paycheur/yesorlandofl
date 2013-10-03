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

?>