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
			SELECT team_id, team_nombre, team_privado
			FROM team
			JOIN rel_teamusuario ON rel_teamusuario.fk_team_id = team.team_id
			WHERE rel_teamusuario.fk_usuario_id = '$usuario_id' 
			OR team.fk_usuario_id = '$usuario_id'
			GROUP BY team.team_id
			ORDER BY team.team_nombre ASC
		");
		$users = getResult("
			SELECT usuario_id, usuario_nombre, usuario_apellido, usuario_email, fk_team_id
			FROM usuario
			JOIN rel_teamusuario ON rel_teamusuario.fk_usuario_id = usuario.usuario_id
			WHERE rel_teamusuario.fk_team_id IN (SELECT fk_team_id FROM rel_teamusuario WHERE rel_teamusuario.fk_usuario_id = '$usuario_id')
			ORDER BY usuario.usuario_nombre ASC
		");
		$proyects = getResult("
			SELECT proyecto_id, proyecto_nombre, proyecto_privado, fk_team_id
			FROM proyecto
			JOIN rel_proyectousuario ON rel_proyectousuario.fk_proyecto_id = proyecto.proyecto_id
			WHERE rel_proyectousuario.fk_usuario_id = '$usuario_id'
			GROUP BY proyecto.proyecto_id
			ORDER BY proyecto.proyecto_nombre ASC
		");
		$sidebar = array();
		foreach($teams as $team){
			foreach($users as $user){
				if($team['team_id'] == $user['fk_team_id']){
					$team['usuarios'][] = $user;
				}
			}
			foreach($proyects as $proyect){
				if($team['team_id'] == $proyect['fk_team_id']){
					$team['proyectos'][] = $proyect;
				}
			}
			$sidebar[] = $team;
		}
		$data['sidebar'] = $sidebar;
	}
	if($uri->segment(2) == 'getMembers'){
		$users = getResult("
			SELECT usuario_id, usuario_nombre, usuario_apellido, usuario_email
			FROM usuario
			JOIN rel_usuariousuario ON rel_usuariousuario.fk_contacto_id = usuario.usuario_id
			WHERE rel_usuariousuario.fk_usuario_id = '$usuario_id'
			ORDER BY usuario.usuario_nombre ASC
		");
		$result = array();
		foreach($users as $user){
			$result[] = array(
				'id' => $user['usuario_id'],
				'nombre' => $user['usuario_nombre'].' '.$user['usuario_apellido'],
				'avatar' => md5(strtolower( $user['usuario_email']))
			);
		}
		die(json_encode($result));
	}
}

$output->load($template, $data, false);
$output->display();
?>