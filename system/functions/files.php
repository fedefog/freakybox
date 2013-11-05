<?php

/**
 * Devulve el path abs del archivo indicado. Si no se indica archivo devuelve solo el path.
 *
 * @param string $file
 * @return string
 */
function abs_path($file = null){
	$path =  rtrim(ABS_PATH, '/').'/';
	if (!is_null($file)) {
		$path = $path . trim($file, '/');
	}
	return $path;
}

/**
 * Sube un archivo al directorio especificado.
 *
 * @param string $name
 * @param string $destination
 * @param boolean $encode_name
 * @return mixed
 */
function upload($name, $destination = null, $encode_name = false) {
	$temp = $_FILES[$name]["tmp_name"];
	$name = $_FILES[$name]["name"];
	$ext = strtolower(end(explode('.', $name)));

	if ($encode_name === true) {
		$name = time() . '.' . $ext;
	}

	if (is_null($destination)) {
		$destination = ABS_PATH . '/upfiles/' . $name;
	}
	else{
		$destination = $destination . $name;
	}

	$moved = move_uploaded_file($temp, $destination);

	if ($moved) {
		$data = array('name' => $name, 'size' => filesize($destination), 'ext' => $ext);
		return $data;
	}
	return false;
}

/**
 * Retorna la ubicacion web del archivo dentro de la carpeta upfiles.
 *
 * @param string $file
 * @param string $size
 * @return string
 */
function upload_path($file, $size = null) {
	$upload_path = HTML_UPLOAD_PATH;
	
	$path = rtrim($upload_path, '/') . '/' . trim($file, '/');
	if (!is_null($size)) {
		$path = rtrim($upload_path, '/') . '/' . trim($size, '/') . '/' . trim($file, '/');
	}
	
	return $path;
}

/**
 * Retorna si el archivo existe o no dentro de la carpeta upfiles.
 *
 * @param string $file
 * @param string $subdir
 * @return string
 */
function upload_exists($file, $subdir = null) {
	$path = ABS_PATH . '/upfiles/' . trim($file, '/');
	if (!is_null($subdir)) {
		$subdir = trim($subdir, '/');
		$path = ABS_PATH . '/upfiles/' . trim($subdir, '/') . '/' . trim($file, '/');
	}
	if(strlen($file) == 0){
		return false;
	}
	return file_exists($path);
}

/**
 * Fuerza la descarga del archivo indicado. Se puede setear el nombre de destino.
 *
 * @param string $file
 * @param string $name
 */
function download($file, $name = null){
	$path = ABS_PATH . '/' . trim($file, '/');
	if (is_null($name)) {
		$name = basename($file);
	}
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$name);
	header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path));
	readfile($path);
	exit;
}

/**
 * Retorna las dimensiones de la imagen.
 * @param string $file
 * @param string $subdir
 * @return array
 */
function dimensions($file, $subdir = null){
	$path = ABS_PATH . '/upfiles/' . trim($file, '/');
	if (!is_null($subdir)) {
		$subdir = trim($subdir, '/');
		$path = ABS_PATH . '/upfiles/' . trim($subdir, '/') . '/' . trim($file, '/');
	}
	list($width, $height, $type, $attr) = getimagesize($path);
	return array("w" => $width, "h" => $height);
}

/**
 * Retorna el peso del archivo formateado.
 *
 * @param integer $bytes
 * @return string
 */
function format_bytes($bytes) {
	if (!empty($bytes)) {
		$s = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
		$e = floor(log($bytes) / log(1024));
		$output = sprintf('%.2f ' . $s[$e], ($bytes / pow(1024, floor($e))));
		return $output;
	}
}
?>