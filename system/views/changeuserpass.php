<?
/*****************************************************
*   login.php:                                       *
*        Es el encargado del logueo de los usuarios. *
*        Aca se configura como se ver� la pantalla   *
*	 	de login.			     *	
*****************************************************/
?>
<body>

    <div id="login" style="margin-top:50px;">
	    <img src="<?=HTML_PATH?>/system/_img/logos/logo.jpg" alt="Teseo - Volver al menu" border="0"><br>
	    <h1 class="welcome"><?=$cfg_changepasswelcome?></h1>
	    <?
	    if ((isset($_SESSION['ctrlfailpass']))&&($_SESSION['ctrlfailpass']==1)){?>
	    	<p class="rednote"><?=$cfg_chagepasserror?></p><?
	    }
	    $userq=mysql_query("SELECT * FROM usuario WHERE usuario_id=".$_SESSION['ctrlid']);
	    $userr=mysql_fetch_array($userq)
	    ?>
	    <form action="" method="post" name="loginform" id="loginform">
		    <label for="changepassword_user" title="Email"><?=$userr['usuario_mail']?></label><br>
		    <br>
		    <label for="changepassword_pass_old" title="password">Old Password</label><br>
		    <input type="password" name="changepassword_pass_old" class="inputlogin">
		    <br><br>
		     <label for="changepassword_pass_new" title="password">New Password</label><br>
		    <input type="password" name="changepassword_pass_new" class="inputlogin">
		    <br><br>
		    <input name="button1" type="button" class="button1" id="button2" value="<?=$cfg_cancel?>" onclick="javascript:history.back()" />
		    <input name="button2" type="submit" class="button1" id="button2" value="<?=$cfg_changepass?>" />
	    </form>
    </div>

</body>
</html>

