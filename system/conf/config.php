<?php

/* TABLAS */
$maintable = "config";

/* GRUPO */
$module_group = "Sistema";

/* TITULO DE SECCION */
$module_title = "Configuración";

/* QUE COSAS VA A LISTAR */
$list = array("config_nombre", "config_val");

/* * ***************************************************
 * Todos los campos a editar:					     *
 * 	Primer array son titulos agrupadores de campos   *
 * 	----->segundo son los campos                     *
 * 	---------->tercero las especificaciones          *
 * *************************************************** */
$fields = array(
	"config_nombre" => array(
        "fieldlabel" => "Nombre", 
        "fieldcomponent" => "texto", 
        "validation" => array("required" => "required")
    ),
    "config_modulo" => array(
        "fieldlabel" => "Modulo", 
        "fieldcomponent" => "texto"
    ),
    "config_key" => array(
        "fieldlabel" => "Key", 
        "fieldcomponent" => "texto", 
        "validation" => array("required" => "required")
    ),
    "config_val" => array(
        "fieldlabel" => "Valor", 
        "fieldcomponent" => "textarea"
    ),
    "config_tipo" => array(
        "fieldlabel" => "Tipo", 
        "fieldcomponent" => "radio",
        "options" => array("texto" => "Texto", "textarea" => "Textarea", "boolean" => "Booleano", "calendario" => "Calendario")
    )
);
/* Existen otros tipos (oculto, fijo, etc), para conocer todos ver base-printfield */


/* LOS CAMPOS QUE EDITA */
$edita = array(
	array(
        "titulo" => "", //Divido el editor en subsecciones
        "opciones" => array(
            "config_nombre",
		    "config_modulo",
		    "config_key",
		    "config_val",
		    "config_tipo"
        )
    )
);

//$listfilters = array());

/* ORDEN POR DEFAULT */
$orden = "ORDER BY config_modulo, config_nombre";

/* QUE VIEW LEVANATAN LAS ACCIONES */
$module_action = array(
    "edit" => 'configform.php',
    "new" => 'configform.php',
    "list" => 'configlist.php',
    "actions" => 'actions.php',
    "set_in_list" => 'set_in_list.php'
);

/* QUE ACCIONES ESTAN HABILITADAS */
$actions = array(
    "id" => 0,
    "edit" => 0,
    "additem" => 0,
    "delete" => 0,
    "multidelete" => 0,
    "export" => 0,
    "set_in_list" => 1
);
?>