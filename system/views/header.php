<?
/*****************************************************
*   header.php:                                      *
*        Muestra el logo, la fecha, la posibilidad   *
*           de des-loggearse e informacion del user  *
*****************************************************/
?>
<?/*
<div id="header">
	<div id="contents">
        <!--Coloca el Logo del back office-->
		<div id="logo"><a href="<?=ADMIN_FOLDER?>" title="Volver al menu" alt="Logo"><img src="<?=HTML_PATH?>/system/_img/logos/logo.jpg" alt="Volver al menu" border="0"></a></div>
        <!--Coloca el boton LogOut-->
        <div id="logout" style="width:65px;"><a href="?logout=1">LOGOUT</a></div>

        <!--Coloca la fecha, y el nombre de usuario-->
        <div id="userinfo"> <?=date("d.m.y")?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<strong><?=$_SESSION['usr_name']?></strong> <a href="?changepass=1" style="text-decoration: none">(change password)</a></div>
	</div>
</div>
*/
$user = $usuarios->current();
?>
<div id="header">
	<div>
        <? 
        $logo = ABS_PATH.'/system/_img/logo.png';
        if(file_exists($logo)){ ?>
        <img src="<?=HTML_PATH?>/system/_img/logo.png" class="logointerno" />
        <? } ?>
	    <img src="<?=HTML_PATH?>/system/_css/images/login-flecha.png" class="flecha" />
	    <span style="margin-left: 10px;">
	        <b><?=SYSTEM_NAME?>
	        <i>Logueado como:</i></b> 
	        <?=$user['usuario_nombre']?>
	    </span>
	    <a href="?logout=1">Logout</a>
    </div>
</div>
<div id="contenedor">