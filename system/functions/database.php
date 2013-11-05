<?

/* * ***************************************************
 *   base-functions.php:                              *
 *        Define las funciones básicas del admin.     *		
 * *************************************************** */

/**
 * Ejecuta una query y retorna el array de datos.
 * 
 * @param string $sql
 * @param int $cache
 * @return array 
 */
function getResult($sql, $cache = 0) {
	$data = array();
	
	$file = abs_path('/cache/'.sha1($sql).'.json');
	
	// Si el archivo existe lo levantamos
	if (file_exists($file) && (filemtime($file) > (time() - 60 * $cache)) && ($cache > 0)) {
		$json = file_get_contents($file);
	   	$data = json_decode($json, true);
	} 
	// Sino generamos la consulta y guardamos el archivo
	else {
		$result = mysql_query($sql);
	   	if (mysql_num_rows($result) > 0) {
	       	while ($row = mysql_fetch_assoc($result)) {
	        	$data[] = $row;
	       	}
	   	}
	   	// Si el cache esta activo lo guardamos
		if($cache > 0){
	   		$json = json_encode($data);
			file_put_contents($file, $json, LOCK_EX);
	   	}
	}
    return $data;
}

/**
 * Ejecuta una query y retorna la primer fila.
 * 
 * @param string $sql
 * @param int $cache
 * @return array 
 */
function getRow($sql, $cache = 0){
	$data = getResult($sql, $cache);
	return $data[0];
}

/**
 * Genera un where a partir de un array.
 * @param array $items
 * @param string $prefix
 * @return string 
 */
function getWhere($items, $prefix = "WHERE") {
    $sql = "";
    if (count($items) > 0) {
        $sql = $prefix . " " . implode(' AND ', $items);
    }
    return trim($sql);
}

/**
 * Retorna un row.
 * 
 * @param string $table
 * @param string $field
 * @param string $value
 * @return array 
 */
function getItem($table, $field, $value) {
    $sql = "SELECT * FROM $table WHERE $field = '$value'";
    $db = new Database();
    $db->SetQuery($sql);
    $qs = $db->ExecuteQuery($sql);

    return mysql_fetch_array($qs);
}

/**
 * Lista todas las columnas de una tabla.
 * 
 * @param string $table
 * @return array 
 */
function getFileds($table) {
    $qs_fields = mysql_query("SHOW COLUMNS FROM " . $table);
    while ($row_fields = mysql_fetch_assoc($qs_fields)) {
        if ($row_fields['Field'] != $folder . "_id") {
            $_fields[] = $row_fields['Field'];
        }
    }
    return $_fields;
}

//getList
function getList($tbl, $opt) {
    $db = new Database();
    if (isset($opt['join'])) {
        $params = explode("-", $opt['join']['table']);
        $id = $params[1];
        $hijo = $tbl;
        $str = str_replace($hijo, "", $params[0]);
        $padre = str_replace("rel_", "", $str);
        $addsql = "INNER JOIN " . $params[0] . " ON $hijo." . $hijo . "_id=" . $params[0] . "." . $hijo . "_id";
    }

    $sql = "SELECT * FROM $tbl $addsql";

    if (isset($opt['join']))
        $sql.=" WHERE " . $params[0] . "." . $padre . "_id=$id";

    if (isset($opt['parameters'])) {
        $params = explode(";", $opt['parameters']);
        for ($i = 0; $i <= count($params) - 1; $i++) {
            $params[$i] = str_replace(":", "=", $params[$i]);
            if ($i != 0) {
                $sql.=" AND " . $params[$i];
            } else {
                if (strstr($sql, "WHERE"))
                    $sql.= ' AND ' . $params[$i];
                else
                    $sql.= ' WHERE ' . $params[$i];
            }
        }
    }
	if($_GET['DEBUG']){
		echo '<div style="background:#FFFFC0; padding:10px; clear:both;">'.$sql.'</div>';
	}
    if (isset($opt['orden'])) {
        $sql.=" " . $opt['orden'];
    }
    if (isset($opt['maxpp'])) {
        $db->SetQuery($sql, $opt['maxpp']);
    } else {
        $db->SetQuery($sql);
    }
	
    $db->Pager2();
    return $db->ExecuteQuery();
}

function getQueryForDb4($tbl, $opt) {
    if (isset($opt['join'])) {
        $params = explode("-", $opt['join']['table']);
        $id = $params[1];
        $hijo = $tbl;
        $str = str_replace($hijo, "", $params[0]);
        $padre = str_replace("rel_", "", $str);
        $addsql = "INNER JOIN " . $params[0] . " ON $hijo." . $hijo . "_id=" . $params[0] . "." . $hijo . "_id";
    }

    $sql = "SELECT * FROM $tbl $addsql";

    if (isset($opt['join']))
        $sql.=" WHERE " . $params[0] . "." . $padre . "_id=$id";

    if (isset($opt['parameters'])) {
        $params = explode(";", $opt['parameters']);
        for ($i = 0; $i <= count($params) - 1; $i++) {
            $params[$i] = str_replace(":", "=", $params[$i]);
            if ($i != 0) {
                $sql.=" AND " . $params[$i];
            } else {
                if (strstr($sql, "WHERE"))
                    $sql.= ' AND ' . $params[$i];
                else
                    $sql.= ' WHERE ' . $params[$i];
            }
        }
    }
    if (isset($opt['orden'])) {
        $sql.=" " . $opt['orden'];
    }
    return $sql;
}

/*
  consigue la cantidad total de registros de una tabla con un juego de paraemtros
  los parametros deber tener el siguiente formato:

  nombre1:val1;nombre2val2;etc */

function getQty($table, $params) {

    $addsql = "";

    if ($params != '') {

        $arr = explode(";", $params);

        for ($ii = 0; $ii < count($arr); $ii++) {

            $arr2 = explode(":", $arr[$ii]);

            if ($addsql == '') {

                $addsql.="where " . $arr2[0] . "='" . $arr2[1] . "'";
            } else {

                $addsql.=" and " . $arr2[0] . "='" . $arr2[1] . "'";
            }
        }
    }

    $sql = "select count(*) as total from $table $addsql";

    //echo $sql;

    $qs = mysql_query($sql);

    if (mysql_num_rows($qs) > 0) {

        $row = mysql_fetch_array($qs);

        return $row[0];
    } else {

        $empt = "0";

        return $empt;
    }
}

?>