<?
/*****************************************************
*   server.php:                                      *
*        Defino las constantes que usa el sitio      *
*        Realiza la conexion con la Base de Datos    *
*****************************************************/

/*RUTAS DE LA APLICACION*/
/*Es importante diferenciar lo que se procesa en el servidor local
*de lo que procesa el explorador.
* ABS_PATH es utilizada por el servidor.
* HTML_PATH es utilizada por el explorador.
*/
define("ABS_PATH", dirname(__FILE__));
define("HTML_PATH", "");
define("UPLOAD_PATH",ABS_PATH."/upfiles");
define("HTML_UPLOAD_PATH",HTML_PATH."/upfiles/");
define("ADMIN_FOLDER",HTML_PATH."/admin/");
define("PAGE_TITLE","Administra - Panel de Administracion");
define("SYSTEM_NAME","Administra");

/* DB */
define("DBHOST","localhost");
define("DBNAME","freakybox");
define("DBUSER","root");
define("DBPASS","franlo1904");

/* conexion a la base  */
$GLOBALS['mysql_connection']=mysql_connect(DBHOST,DBUSER,DBPASS);

$selected = mysql_select_db(DBNAME);
if($selected === false){
    die("Error al seleccionar la base de datos designada.");
}
mysql_query("SET NAMES utf8");
?>
