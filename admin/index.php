<?

/* * ***************************************************
 *   index.php:                                       *
 *        Aqui comienza la ejecucion nuestro sitio    *
 * *************************************************** */

//Incluyo sistem (encargado de las inclusiones basicas)
include("../system.php");

$database = new Database(DBHOST, DBUSER, DBPASS, DBNAME);

//Creo un objeto de la clase pathprocess y pareseo mi URL
$pathprocess = new pathprocess();
$pathprocess->myurl();

$usuarios = new usuarios($config);

$input = new Input();

//Sistema de control de loggeo
// Tiene que realizarse antes que se incluya el main.php sino tira error de permisos por $_SESSION['ctrlid'] usado en main.php
$querystring = array();
if ($pathprocess->qs != '') {
    $aux = explode("&", $pathprocess->qs);
    foreach ($aux as $value) {
        $aux2 = explode("=", $value);
        $querystring[$aux2[0]] = $aux2[1];
    }
}
if (isset($querystring['logout'])) {
    session_destroy();
    header("Location: " . ADMIN_FOLDER);
    exit();
} elseif (isset($_REQUEST['changepassword_pass_old'])) {           //Creo el objeto de tipo usuario
    $usuarios->changepassword($_REQUEST);
} elseif (empty($_SESSION['ctrlid'])) {
    if (isset($_POST['login_user']) && isset($_POST['login_pass'])) {
        $usuarios->login($_POST['login_user'], $_POST['login_pass']);    //Requiero su loggin
    }
}

//Inclusion de las configuraciones main:
if (isset($_SESSION['ctrlid'])) {
    include(ABS_PATH . "/system/conf/main.php");
}

//Si la accion es exportar a excel se genera el header correspondiente
if ($pathprocess->ac == 'export') {
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=" . $pathprocess->bf . "-" . date('Ymd') . ".xls");
    header("Pragma: no-cache");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Expires: 0");
    echo pack("CCC", 0xef, 0xbb, 0xbf);
}

if ($pathprocess->ac == 'ajax') {
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
}

//Asigno el nombre de seccion
if (isset($sections[$pathprocess->bf])) {
    $section_name = $sections[$pathprocess->bf]['titulo'];
} else {
    $section_name = $pathprocess->bf;
}

//Si la acción no es exportaci�n procedemos a mostrar el head.php

$actions = array('install', 'buildtables', 'export', 'ajax', 'regen');

if (!in_array($pathprocess->ac, $actions)) {
    include(ABS_PATH . "/system/views/head.php");
}

if (isset($querystring['changepass'])) {
    include(ABS_PATH . "/system/views/changeuserpass.php");
    exit();
}
//Controlo si hay alguien logueado, si no hay muestro el loggin
if (!isset($_SESSION['ctrlid'])) {
    if ($pathprocess->ac == 'install') {
        if (file_exists(ABS_PATH . "/system/views/" . $pathprocess->ac . ".php")) {
            include_once(ABS_PATH . "/system/views/" . $pathprocess->ac . ".php");
        }
		redirect('/admin/');
    }
    include(ABS_PATH . "/system/views/login.php");
    exit();
}

//Se desetea la memoria de b�squeda
if (isset($_GET['ch'])) {
    unset($_SESSION['ultimabusqueda']);
}


//Controlo el Arbol de navegacion (este se implementa en un array que simula una "pila"
//	donde se va a ir guardando la ruta seguida por el usuario en administra)
//Controlo el Arbol de navegacion (este se implementa en un array que simula una "pila" 
//	donde se va a ir guardando la ruta seguida por el usuario en administra)
if(isset($_SESSION['ctrlid'])){
    if($_SESSION['navigationtree']==null){
	$_SESSION['navigationtree']=array();
    }
    //Se guarda la información útil 	
    $base=array("url"=>$_SERVER['REQUEST_URI'],"bf"=>$pathprocess->bf,"ac"=>$pathprocess->ac,"qs"=>$pathprocess->qs,"request"=>/*$_REQUEST*/'');
    //Si vengo del volver del list, desapilo el ultimo lugar visitado 	
    if((isset($_REQUEST['navigation']))&&($_REQUEST['navigation']=="back")){
                $array_aux=$_SESSION['navigationtree'];
                $_SESSION['navigationtree']=array();
                for($i=1;$i<(count($array_aux));$i++){
                    $_SESSION['navigationtree'][]=$array_aux[$i];
                }
    }else{
	//Si no me fijo si el elemento esta enlistado y lo saco (si viene de un cancel)
	$aux=str_replace("/list?navigation=back","",$base['url']);	
        foreach($_SESSION['navigationtree'] as $KEY=>$step){

            if($aux==$step['url']){
                $array_aux=$_SESSION['navigationtree'];
                $_SESSION['navigationtree']=array();
                for($i=1;$i<(count($array_aux));$i++){
                    $_SESSION['navigationtree'][$KEY]=$array_aux[$i];
                }
                break;
            }
        }
	//array_unshift: coloca el elemento requerido al principio del array
	if($base!=$_SESSION['navigationtree'][0]){
        	array_unshift($_SESSION['navigationtree'],$base);    
	}
    }
	/*?><pre><?var_dump($_SESSION['navigationtree']) ?></pre><?*/
}


//Si existe el archivo de configuracion del mismo nombre del baseFolder lo incluyo
if (file_exists(ABS_PATH . "/system/conf/" . $pathprocess->bf . ".php")) {
    include_once(ABS_PATH . "/system/conf/" . $pathprocess->bf . ".php");
} 
else {
    $module_title = ucwords($pathprocess->bf);
}


if($pathprocess->ac=='buildtables'){
	if (file_exists(ABS_PATH . "/system/views/" . $pathprocess->ac . ".php")) {
		include_once(ABS_PATH . "/system/views/" . $pathprocess->ac . ".php");
    }
    redirect('/admin/' . $pathprocess -> bf);
}

// Regenera las thumbnails cargadas en el conf.
if($pathprocess->ac=='regen'){
    foreach($fields as $key => $val){
        if($val["fieldcomponent"] == 'imagen'){
            
            $secondary = $val["options"]["secondary"];
            if($secondary){
                $regen_qr = mysql_query("SELECT ".$secondary."_imagen AS imagen FROM $secondary") or die(mysql_error());
            }
            else{
                $regen_qr = mysql_query("SELECT $key AS imagen FROM $maintable") or die(mysql_error());
            }
            
            while($row = mysql_fetch_assoc($regen_qr)){
                $src_file = UPLOAD_PATH.'/'.$row['imagen'];
                $new_file = UPLOAD_PATH.'/'.$row['imagen'];
				@create_resized_copies($src_file, $new_file, $val["crop"]);
            }
        }
    }
    
    redirect('/admin/'.$pathprocess->bf);
}

//Si esta seteada module_action para la ac incluyo su view, sino uso la del ac
if (isset($module_action[$pathprocess->ac])) {
    include(ABS_PATH . "/system/views/" . $module_action[$pathprocess->ac]);
} 
else {
    include(ABS_PATH . "/system/views/" . $pathprocess->ac . ".php");
}


?>
