<?php

/**
 * Usado en base-printfield para armar el nombre de la clase para la validacion.
 */
function build_rules($array){
	$string = "validate[";
	foreach($array as $key =>$val){
		switch($key){
			case 'required':
					$string .= 'required';
				break;
			case 'email':
					$string .= ',custom[email]';
				break;
			case 'url':
					$string .= ',custom[url]';
				break;
			case 'numero':
					$string .= ',custom[integer]';
				break;
			case 'decimal':
					$string .= ',custom[number]';
				break;
			case 'letras':
					$string .= ',custom[onlyLetterSp]';
				break;
			case 'alfanumerico':
					$string .= ',custom[onlyLetterNumber]';
				break;
		}
	}
	$string .= "]";
	return $string;
}

function validate_empty($str){
    if(!empty($str)){
        return false;
    }
    return "El campo %s no puede estar vacio.";
}

function validate_email($str){
    if(preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)){
        return false;
    }
    return "El campo %s no no es un email valido.";
}

?>