<?
/*****************************************************
*   login.php:                                       *
*        Es el encargado del logueo de los usuarios. *
*        Aca se configura como se ver� la pantalla   *
*	 	de login.			     *
*****************************************************/
?>
<body class="bodylogin">
<div id="head-login">
	
        <? 
        $logo = ABS_PATH.'/system/_img/logo.png';
        if(file_exists($logo)){ ?>
        <img src="<?=HTML_PATH?>/system/_img/logo.png" />
        <? } ?>
        
</div>
    <div class="rombo"></div>
<div id="body-login"> 

        <div id="login" class="container">
        <h1>Bienvenido al panel de administración</h1>
        <? if((isset($_SESSION['ctrlfail']))&&($_SESSION['ctrlfail']==1)){?>
            <p class="error alert">Usuario o contraseña incorrecta</p>
        <? }?>
        <form action="" method="post" name="loginform" id="loginform">
	        <label for="login_user" title="Email">Email:</label>
	        <input type="text" name="login_user" class="login_user" placeholder="Email" />

	        <label for="login_pass" title="password">Password:</label>
	        <input type="password" name="login_pass" class="login_pass" placeholder="Password" />

	        <button type="submit" id="submit" >Ingresar</button>
        </form>
        </div>
<script>
if ($.browser.webkit) {
    $('input[name="login_pass"]').attr('autocomplete', 'off');
}
</script>
	
</div>
</body>
</html>

