<?php

mysql_query("
    CREATE TABLE IF NOT EXISTS config (
        config_id INT(11) NOT NULL AUTO_INCREMENT,
        config_nombre varchar(255) NOT NULL,
        config_modulo varchar(255) NOT NULL,
        config_key varchar(32) NOT NULL,
        config_tipo varchar(32) NOT NULL,
        config_val TEXT NOT NULL,
        PRIMARY KEY (config_id),
        KEY config_key (config_key)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");

mysql_query("
    CREATE TABLE IF NOT EXISTS usuario (
        usuario_id INT(11) NOT NULL AUTO_INCREMENT,
        usuario_nombre varchar(128) NOT NULL,
        usuario_apellido varchar(32) NOT NULL,
        usuario_mail varchar(128) NOT NULL,
        usuario_pass varchar(128) NOT NULL,
        fk_tipousuario_id int(11) NOT NULL DEFAULT '2',
        PRIMARY KEY (usuario_id)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");

mysql_query("
    INSERT INTO usuario 
    (usuario_id, usuario_nombre, usuario_apellido, usuario_mail, usuario_pass, fk_tipousuario_id) 
        VALUES
    (1, 'Admin', 'Admin', 'info@claveglobal.com', 'B5SCZUGNbdGeyqEfMoR/MLQTny9/ciQ2v32xXRHBoAo=', 1);
");

mysql_query("
    CREATE TABLE IF NOT EXISTS tipousuario (
        tipousuario_id int(11) NOT NULL,
        tipousuario_nombre varchar(64) NOT NULL,
        PRIMARY KEY (tipousuario_id)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");

mysql_query("
    INSERT INTO tipousuario 
    (tipousuario_id, tipousuario_nombre) 
        VALUES
    (1,	'Administrador'),
    (2,	'Usuario');
");

mysql_query("
    CREATE TABLE IF NOT EXISTS rel_usuariomenuadmin (
        fk_usuario_id int(11) NOT NULL,
        fk_menuadmin_id int(11) NOT NULL,
        fk_tipopermiso_id int(11) NOT NULL,
        UNIQUE KEY fk_usuario_id (fk_usuario_id,fk_menuadmin_id)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");

mysql_query("
    CREATE TABLE IF NOT EXISTS tipopermiso (
        tipopermiso_id int(10) NOT NULL AUTO_INCREMENT,
        tipopermiso_nombre varchar(25) NOT NULL,
        PRIMARY KEY (tipopermiso_id)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");

mysql_query("
    INSERT INTO tipopermiso 
    (tipopermiso_id, tipopermiso_nombre) 
        VALUES
    (1,	'Restringido'),
    (2,	'Ver'),
    (3,	'Editar'),
    (4,	'Total');
");

mysql_query("
    CREATE TABLE IF NOT EXISTS menucategoria (
        menucategoria_id int(11) NOT NULL AUTO_INCREMENT,
        menucategoria_nombre varchar(64) NOT NULL,
        menucategoria_icono varchar(64) NOT NULL,
        menucategoria_orden int(11) NOT NULL,
        PRIMARY KEY (menucategoria_id)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");

mysql_query("
    INSERT INTO menucategoria 
    (menucategoria_id, menucategoria_nombre, menucategoria_icono, menucategoria_orden) 
        VALUES
    (1, 'Sistema', 'gear.png', 0);
");

mysql_query("
    CREATE TABLE IF NOT EXISTS menuadmin (
        menuadmin_id int(11) NOT NULL AUTO_INCREMENT,
        menuadmin_nombre varchar(64) NOT NULL,
        menuadmin_link varchar(255) NOT NULL,
        fk_menucategoria_id int(11) NOT NULL,
        menuadmin_conf varchar(64) NOT NULL,
		menuadmin_icono varchar(64) NOT NULL,
        menuadmin_orden int(11) NOT NULL,
        CONSTRAINT nameconf UNIQUE (menuadmin_nombre,menuadmin_orden),
        PRIMARY KEY (menuadmin_id)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");

mysql_query("
    INSERT INTO menuadmin 
    (menuadmin_id, menuadmin_nombre, menuadmin_link, fk_menucategoria_id, menuadmin_conf, menuadmin_orden) 
        VALUES
    (1, 'Configuración', '', 1, 'config', 0),
	(2, 'Usuarios', '', 1, 'usuario', 1);
");

mysql_query("
    CREATE TABLE IF NOT EXISTS modulo (
        modulo_id int(11) NOT NULL AUTO_INCREMENT,
        modulo_nombre varchar(255) NOT NULL,
        modulo_archivo varchar(255) NOT NULL,
        modulo_activo tinyint(1) NOT NULL,
        modulo_position varchar(8) NOT NULL DEFAULT 'left',
        modulo_orden int(11) NOT NULL,
        PRIMARY KEY (modulo_id),
        KEY modulo_orden (modulo_orden)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");

?>