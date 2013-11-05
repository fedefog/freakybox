<?php

/**
 * Retorna si el usuario actual es administrador.
 * @param integer $id
 * @return boolean 
 */
function is_admin($id = null){
	if(!is_null($id)){
		$result = mysql_query("SELECT fk_tipousuario_id FROM usuario WHERE usuario_id = '$id';");
		$row = mysql_fetch_assoc($result);
		if($row['fk_tipousuario_id'] == '1'){
			return true;
		}
		return false;
	}
	
	if($_SESSION['ctrltype'] == '1'){
		return true;
	}
	return false;
}

/**
 * Encripta un string.
 * @param string $string
 * @param string $key
 * @return string 
 */
function encrypt($string, $key){
    if(function_exists('mcrypt_encrypt')){
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5($key)));
    }
    return md5($string);
}

/**
 * Desencripta un string.
 * @param string $string
 * @param string $key
 * @return string 
 */
function decrypt($string, $key){
    if(function_exists('mcrypt_decrypt')){
    	$pass = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5($key));
        return trim($pass);
    }
    return;
}

/**
 * Verifica o genera un token csfr.
 * @param token $string
 * @return mixed 
 */
function csfr($token = null){
	if(is_null($token)){
		$new = md5(time());
		$_SESSION['token'] = $new;
		return $new;
	}
	if($_SESSION['token'] == $token){
		return true;
	}
	return false;
}

/**
 * Verifica o genera un captcha de pregunta.
 * @param answer $string
 * @return mixed 
 */
function captcha($answer = null){
	if(is_null($token)){
		$num1 = substr(mt_rand(),0,2);
		$num2 = substr(mt_rand(),0,1);
		$_SESSION['answer'] = $rand_int1 + $rand_int2;
		return "Cuánto es $num1 + $num2?";
	}
	if($_SESSION['answer'] == $answer){
		return true;
	}
	return false;
}