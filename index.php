<?php
include_once("system.php");

$uri = new Uri();

$template = $uri->template();

$output = new Output();

$data['uri'] = $uri;

// SESSION A LA FUERZA
// @TODO
$usuario_id = '1';

/*
* Composicion de la url: dominio.com/team_id/proyecto_id/ticket_id
*/
$response = null;
if($uri->segment(1) == 'ajax'){
	if($uri->segment(2) == 'sidebar'){
		$teams = getResult("
			SELECT team_id, team_nombre, team_private
			FROM team
			JOIN rel_teamusuario ON rel_teamusuario.fk_team_id = team.team_id
			WHERE rel_teamusuario.fk_usuario_id = '$usuario_id' 
			ORDER BY team.team_nombre ASC
		");
		$users = getResult("
			SELECT usuario_id, usuario_nombre, usuario_apellido, fk_team_id
			FROM usuario
			JOIN rel_teamusuario ON rel_teamusuario.fk_usuario_id = usuario.usuario_id
			WHERE rel_teamusuario.fk_usuario_id = '$usuario_id'
			ORDER BY usuario.usuario_nombre ASC
		");
		$proyects = getResult("
			SELECT proyecto_id, proyecto_nombre, proyecto_privado
			FROM proyecto
			JOIN rel_proyectousuario ON rel_proyectousuario.fk_proyecto_id = proyecto.proyecto_id
			WHERE rel_proyectousuario.fk_usuario_id = '$usuario_id'
			ORDER BY proyecto.proyecto_nombre ASC
		");
		$data['teams'] = $teams;
		$data['usuarios'] = $users;
		$data['proyectos'] = $proyects;
	}
}

$output->load($template, $data, false);
$output->display();
?>