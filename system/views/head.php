<?
/*****************************************************
*   head.php:                                        *
*       Aqui se comienza a programar la interfaz    *
*        html de nuestro sitio linkeando con         *
*        .css, definiendo funciones y jquerys        *
*****************************************************/
?>
<!doctype html> 
<html>
<head>
    <title><?=PAGE_TITLE?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<?//Linkeos generales con archivos .css y carga de funciones jquery?>
	<?//HERRAMIENTAS JS?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="<?=HTML_PATH?>/system/lib/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=HTML_PATH?>/system/lib/tinymce/tiny_mce.js"></script>
    
    <script type="text/javascript" src="<?=HTML_PATH?>/system/lib/jqueryfileupload/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="<?=HTML_PATH?>/system/lib/jqueryfileupload/jquery.fileupload.js"></script>
    
    <script type="text/javascript" src="<?=HTML_PATH?>/system/lib/jquery.placeholder.js"></script>
        
    <script type="text/javascript" src="<?=HTML_PATH?>/system/lib/validationengine/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="<?=HTML_PATH?>/system/lib/validationengine/languages/jquery.validationEngine-es.js"></script>        
    
    <script src="<?=HTML_PATH?>/system/functions/gral-functions.js" type="text/javascript"></script>    
    <script src="<?=HTML_PATH?>/system/lib/cropper/js/jquery.Jcrop.min.js"></script>
    <script type="text/javascript" src="<?=HTML_PATH?>/system/lib/timepicker/jquery.timepicker.js"></script>
    <script type="text/javascript" src="<?=HTML_PATH?>/system/lib/colorpicker/js/colorpicker.js"></script>
    
    <script type="text/javascript" src="<?=HTML_PATH?>/system/lib/shadowbox/shadowbox.js"></script>
        
    <?//ESTILOS CSS?>
    <link rel="stylesheet" href="<?=HTML_PATH?>/system/lib/shadowbox/shadowbox.css" type="text/css"/>
    <link rel="stylesheet" href="<?=HTML_PATH?>/system/lib/cropper/css/jquery.Jcrop.css" type="text/css"/>
    <link rel="stylesheet" media="screen" type="text/css" href="<?=HTML_PATH?>/system/lib/colorpicker/css/colorpicker.css" />
    
    <link rel="stylesheet" href="<?=HTML_PATH?>/system/lib/validationengine/validationEngine.css" type="text/css"/>
    
    <link rel="stylesheet" href="<?=HTML_PATH?>/system/_css/jquery-ui.css" type="text/css"/>
    <link href="<?=HTML_PATH?>/system/_css/estilos.css" rel="stylesheet" type="text/css"/>
    
    <?  $extra = ABS_PATH.'/system/_css/extra.css';
        if(file_exists($extra)){ ?>
        	<link href="<?=HTML_PATH?>/system/_css/extra.css" rel="stylesheet" type="text/css" />
        <? } ?>
       
<?//A continuacion 3 script que estaban en tienda feliz que no se si
  // se usarian o no:  ?>
    <script type="text/javascript">
        function fcn_deleteconfirm(delurl){
        var deleteconfirm = confirm('¿Está seguro que desea borrar el elemento seleccionado?');
        if ( !deleteconfirm ){
            /*NOP*/
        }else{
            window.open(delurl,"_self");
        }
    }
    </script>
</head>



