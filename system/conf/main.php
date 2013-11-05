<?php

/* * ******************************************************
 *   main.php:                                           *
 *    Define lo que se va a mostrar y como en el home.   *
 * ****************************************************** */

$html_title = PAGE_TITLE;


/* * ******************************************************
 *    Formato de sections                                * 
 * 	Agrupador array()                               * 
 * 	--> boton                                       *  
 * 	------> opciones:                               *
 * 	---------->  base folder (accion principal)     * 
 * 	---------->  icono                              *   
 * ****************************************************** */

$sqlcategorias = mysql_query("SELECT * FROM menucategoria ORDER BY menucategoria_orden;");
$sections = array();

//$sqluserlogged = mysql_query("SELECT * FROM usuario WHERE usuario_id=" . $_SESSION['ctrlid']);
//$userlogged = mysql_fetch_array($sqluserlogged);
$userhierarchy = $_SESSION['ctrltype']; //1:root, 2:user

$categorias = array();
while ($row = mysql_fetch_assoc($sqlcategorias)) {
    $categorias[] = $row;
}

foreach ($categorias as $rowcategorias) {
    $sqlsecciones = mysql_query("SELECT * FROM menuadmin WHERE fk_menucategoria_id = '" . $rowcategorias['menucategoria_id'] . "' ORDER BY menuadmin_orden;");
    $categoria = array();

    while ($rowsecciones = mysql_fetch_array($sqlsecciones)) {
        /* obtengo la restriccion de la seccion para el user loggeado */
        $tienepermisosql = mysql_query("SELECT * FROM rel_usuariomenuadmin WHERE fk_usuario_id=" . $_SESSION['ctrlid'] . " AND fk_menuadmin_id=" . $rowsecciones['menuadmin_id']);
        if (mysql_num_rows($tienepermisosql) > 0) {
            $tienepermiso = mysql_fetch_array($tienepermisosql);
            $permisoenseccion = $tienepermiso["fk_tipopermiso_id"];
        } else {
            if ($userhierarchy != 1) {//es un usuario sin permisos seteados
                $permisoenseccion = 1; //restricted
            } else {
                $permisoenseccion = 4; //es root => full access
            }
        }
        if ($userhierarchy == 1) {
            $permisoenseccion = 4;
        }

        if ($permisoenseccion != 1) {
            $seccion = array("name" => $rowsecciones['menuadmin_nombre'],
                /* "icon" => $rowsecciones['menuadmin_icono'], */
                "link" => $rowsecciones['menuadmin_link'],
                "conf" => $rowsecciones['menuadmin_conf'],
                "permissions" => $permisoenseccion
            );
            $categoria['icon'] = $rowcategorias['menucategoria_icono'];
            $categoria['sections'][$rowsecciones['menuadmin_nombre']] = $seccion;
        }
    }

    /* si la categoria esta vacia no la agrego */
    if (count($categoria) > 0) {
        $sections[$rowcategorias['menucategoria_nombre']] = $categoria;
    }
}

/* acciones por default */
$module_action = array(
    "edit" => 'form.php',
    "new" => 'form.php',
    "list" => 'list.php',
    "actions" => 'actions.php'
);


/* lenguaje de la aplicacion. ser� espa�ol por default */
$applang = "es";
?>
