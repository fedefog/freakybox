<?php

$rels = array();
$columns = array();
$indexs = array();

foreach ($fields as $key => $val) {
	switch($val["fieldcomponent"]) {
		case 'texto' :
		case 'slug' :
		case 'url' :
		case 'email' :
		case 'password' :
		case 'oculto' :
			$columns[] = "$key VARCHAR(255) NOT NULL";
			break;
		case 'calendario' :
			$columns[] = "$key DATE NOT NULL";
			break;
		case 'hora' :
			$columns[] = "$key CHAR(5) NOT NULL";
			break;
		case 'orden' :
		case 'numero' :
		case 'lista' :
		case 'listanumerica' :
			$columns[] = "$key INT NOT NULL DEFAULT '0'";
			$indexs[] = "INDEX ($key)";
			break;
		case 'tags' :
		case 'multiselect' :
			$rel = explode("-", $key);
			$sql = "CREATE TABLE IF NOT EXISTS rel_" . $rel[0] . $rel[1] . " (fk_" . $rel[0] . "_id INT NOT NULL, fk_" . $rel[1] . "_id INT NOT NULL, INDEX (fk_" . $rel[0] . "_id), INDEX (fk_" . $rel[1] . "_id));";
			mysql_query($sql) or die(mysql_error() . "<br/>$sql");
			break;
		case 'decimal' :
			$columns[] = "$key DECIMAL(7,2) NOT NULL DEFAULT '0'";
			break;
		case 'mapa' :
			$columns[] = $key . "lat DECIMAL(10,7) NOT NULL DEFAULT '0'";
			$columns[] = $key . "lon DECIMAL(10,7) NOT NULL DEFAULT '0'";
			break;
		case 'boolean' :
			$columns[] = "$key BOOLEAN NOT NULL DEFAULT '0'";
			break;
		case 'radio' :
			$columns[] = "$key CHAR(1) NOT NULL";
			break;
		case 'colorpicker' :
			$columns[] = "$key VARCHAR(6) NOT NULL";
			break;
		case 'textarea' :
		case 'tinymce' :
		case 'tabla' :
		case 'carrito' :
			$columns[] = "$key TEXT NOT NULL";
			break;
		case 'imagen' :
		case 'archivo' :
			if (!empty($val["options"]["secondary"])) {
				$sql = "CREATE TABLE IF NOT EXISTS " . $val["options"]["secondary"] . " (" . $val["options"]["secondary"] . "_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, fk_" . $maintable . "_id INT NOT NULL, " . $val["options"]["secondary"] . "_nombre VARCHAR(255), " . $val["options"]["secondary"] . "_orden INT NOT NULL, " . $val["options"]["secondary"] . "_" . $val["fieldcomponent"] . " VARCHAR(128) NOT NULL);";
				mysql_query($sql) or die(mysql_error() . "<br/>$sql");
			} else {
				$columns[] = "$key VARCHAR(128) NOT NULL";
			}
			break;
		default :
			break;
	}
}

$index_sql = "";
if(count($indexs) > 0){
	$index_sql = ', '.implode(', ', $indexs);
}

$sql = "CREATE TABLE IF NOT EXISTS $maintable (" . $maintable . "_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, " . implode(',', $columns) . $index_sql . ");";

mysql_query($sql) or die(mysql_error());

$conf_file = $pathprocess->bf;

$fk_menucategoria_id = 0;

$cat_qr = mysql_query("SELECT menucategoria_id FROM menucategoria WHERE menucategoria_nombre = '$module_group'");
if(mysql_num_rows($cat_qr) > 0){
	$cat = mysql_fetch_array($cat_qr);
	$fk_menucategoria_id = $cat[0];
}
else{
	mysql_query("
	    INSERT IGNORE INTO menucategoria 
	    (menucategoria_nombre, menucategoria_orden) 
	        VALUES
	    ('$module_group', 0);
	") or die(mysql_error());
	$fk_menucategoria_id = mysql_insert_id();
}

mysql_query("
    INSERT IGNORE INTO menuadmin 
    (menuadmin_nombre, fk_menucategoria_id, menuadmin_conf, menuadmin_orden) 
        VALUES
    ('$module_title', $fk_menucategoria_id, '$conf_file', 0);
") or die(mysql_error());

?>