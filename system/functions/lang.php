<?php
/**
 * Retorna el string en el idioma seleccionado.
 * @param array $array
 * @param string $key
 * @return string 
 */
function lang($array, $key){
    $lang = $_SESSION['lang'];
	$rawstring = trim($array[$key.$lang]);
	$string =  strip_tags($rawstring);
	//Si el lenguaje seleccionado no contiene nada retornar el por default.
	if(empty($string)){
		return trim($array[$key]);
	}
    return $rawstring;
}
?>
