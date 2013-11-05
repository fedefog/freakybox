<?
/*****************************************************
*   system.php:                                      *
*        Es el encargado de las inclusiones basicas  *
*****************************************************/
setlocale(LC_ALL, 'es_ES');

mb_http_output("UTF-8");
mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=UTF-8');

ini_set("display_errors",0);

session_start();

if(isset($_GET['DEBUG'])){
    ini_set("display_errors",1);
    error_reporting(E_ALL);
}

include("server.php"); //server define constantes y conecta a la DB

function __autoload($class) {
    $class = strtolower($class);
    if(file_exists(ABS_PATH."/system/classes/".$class.".php")){
        include_once(ABS_PATH."/system/classes/".$class.".php");
    }
}

foreach(glob(ABS_PATH."/system/functions/*.php") as $file)  {  
    include_once($file);
}

$config = new Config();
$config->merge(array("encode_key" => "a85AeW7tozx96HgQid8w69zKYT3W1dp6"));

global $pager;

global $uri;
$uri = new pathprocess();

if(isset($_GET['logout']) && $_GET['logout'] == 1){
    unset($_SESSION['cliente_id']);
}
        
if(!empty($_GET['lang'])){
    $lang = strtolower($_GET['lang']);
    switch ($lang) {
        case 'es':
            $_SESSION['lang'] = 'es';
            break;
        case 'en':
            $_SESSION['lang'] = 'en';
            break;
        default:
            $_SESSION['lang'] = 'es';
            break;
    }
}

define("SYSTEM",true);

?>
