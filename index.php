<?php
include_once("system.php");

$uri = new Uri();

$template = $uri->template();

$output = new Output();

$data['uri'] = $uri;

// SESSION A LA FUERZA
// @TODO
$_SESSION['uid'] = 1;
$usuario_id = intval($_SESSION['uid']);

$team_id = $uri->segment(1);
$project_id = intval($uri->segment(2));
$task_id = $uri->segment(3);

if($usuario_id > 0){
	$data['usuario'] = getRow("SELECT *, CONCAT_WS(' ', usuario_nombre, usuario_apellido) AS usuario_nombrecompleto FROM usuario WHERE usuario_id = $usuario_id");
	
	$teams = getResult("
		SELECT team_id, team_nombre, team_privado
		FROM team
		JOIN rel_teamusuario ON rel_teamusuario.fk_team_id = team.team_id
		WHERE rel_teamusuario.fk_usuario_id = '$usuario_id' 
		OR team.fk_usuario_id = '$usuario_id'
		GROUP BY team.team_id
		ORDER BY team.team_nombre ASC
	");

	$data['teams'] = $teams;
	
	$projects = getResult("
		SELECT proyecto_id, proyecto_nombre, proyecto_color, proyecto_privado, rel_teamusuario.fk_team_id, (SELECT COUNT(tarea_id) FROM tarea WHERE tarea.fk_proyecto_id = proyecto.proyecto_id AND tarea_activo = '1') AS tasks_open, (SELECT COUNT(tarea_id) FROM tarea WHERE tarea.fk_proyecto_id = proyecto.proyecto_id) AS tasks
		FROM proyecto
		JOIN rel_proyectoteam ON rel_proyectoteam.fk_proyecto_id = proyecto.proyecto_id
		JOIN rel_teamusuario ON rel_teamusuario.fk_team_id = rel_proyectoteam.fk_team_id
		WHERE rel_teamusuario.fk_usuario_id = '$usuario_id'
		GROUP BY proyecto.proyecto_id
		ORDER BY proyecto.proyecto_nombre ASC
	");
	
	$data['projects'] = $projects;
	
	if($project_id){
		$tasks = getResult("
			SELECT tarea_id, tarea_nombre, tarea_due, tarea_completada, proyecto_id, proyecto_nombre, proyecto_color
			FROM tarea 
			JOIN proyecto ON proyecto.proyecto_id = tarea.fk_proyecto_id 
			LEFT JOIN rel_tareausuario ON rel_tareausuario.fk_tarea_id = tarea.tarea_id 
			WHERE tarea.fk_tarea_id = 0 
			AND fk_proyecto_id = '$project_id' 
			GROUP BY tarea.tarea_id 
			ORDER BY tarea_completada DESC, tarea_due ASC
		");
	}
	else{
		$tasks = getResult("
			SELECT tarea_id, tarea_nombre, tarea_due, tarea_completada, proyecto_id, proyecto_nombre, proyecto_color 
			FROM tarea 
			JOIN proyecto ON proyecto.proyecto_id = tarea.fk_proyecto_id 
			LEFT JOIN rel_tareausuario ON rel_tareausuario.fk_tarea_id = tarea.tarea_id 
			WHERE tarea.fk_tarea_id = 0 
			GROUP BY tarea.tarea_id 
			ORDER BY tarea_completada DESC, tarea_due ASC
		");
	}

	$data['tasks'] = $tasks;
}

/*
* Composicion de la url: dominio.com/team_id/proyecto_id/ticket_id
*/
$response = null;
if($uri->segment(1) == 'ajax'){
	if($uri->segment(2) == 'register'){
		if($_POST){
			if(empty($_POST['email']) || empty($_POST['password'])){
				$response = array("error" => 1, "msg" => "El email y la contraseña son requeridos.");
				die(json_encode($response));
			}
			
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$response = array("error" => 1, "msg" => "El email no es una direccion valida.");
				die(json_encode($response));
			}
				
			$usuario_email = mysql_real_escape_string(strtolower($_POST['email']));
			$exists = getRow("SELECT usuario_id FROM usuario WHERE LOWER(usuario_email) = '$usuario_email'");
			
			if($exists){
				if(empty($exists['usuario_pass'])){
					if($_POST['password'] == $_POST['passconf']){
						$encoded = encrypt($_POST['password'], $config->get('encode_key'));
						mysql_query("UPDATE usuario SET usuario_pass = '$encoded' WHERE LOWER(usuario_email) = '$usuario_email'");
						//@TODO: Sistema de validacion por mail
						$_SESSION['uid'] = $exists['usuario_id'];
						$response = array("error" => 0);
					}
					else{
						$response = array("error" => 1, "msg" => "La contraseña y la confirmación no concuerdan.");
					}
				}
				else{
					$response = array("error" => 1, "msg" => "La cuenta ya se encuentra registrada.");
				}
			}
			else{
				if($_POST['password'] == $_POST['passconf']){
					$encoded = encrypt($_POST['password'], $config->get('encode_key'));
					mysql_query("INSERT INTO usuario SET usuario_email = '$usuario_email', usuario_pass = '$encoded'");
					
					$uid = mysql_insert_id();
					if($uid > 0){
						//@TODO: Sistema de validacion por mail
						$_SESSION['uid'] = $uid;
						$response = array("error" => 0);
					}
					else{
						$response = array("error" => 1, "msg" => "La cuenta ya se encuentra registrada.");
					}
				}
				else{
					$response = array("error" => 1, "msg" => "La contraseña y la confirmación no concuerdan.");
				}
			}
		}
		die(json_encode($response));
	}
	if($uri->segment(2) == 'login'){
		if($_POST){
			if(empty($_POST['email']) || empty($_POST['password'])){
				$response = array("error" => 1, "msg" => "El email y la contraseña son requeridos.");
				die(json_encode($response));
			}
			
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$response = array("error" => 1, "msg" => "El email no es una direccion valida.");
				die(json_encode($response));
			}
				
			$usuario_email = mysql_real_escape_string(strtolower($_POST['email']));
			$exists = getRow("SELECT usuario_id, usuario_pass FROM usuario WHERE LOWER(usuario_email) = '$usuario_email'");
			
			if($exists){
				if(!empty($exists['usuario_pass'])){
					$encoded = encrypt($_POST['password'], $config->get('encode_key'));
				
					if($exists['usuario_pass'] == $encoded){
						$_SESSION['uid'] = $exists['usuario_id'];
						$response = array("error" => 0);
					}
					else{
						$response = array("error" => 1, "msg" => "La contraseña no concuerda.");
					}
				}
				else{
					$response = array("error" => 1, "msg" => "El usuario no existe.");
				}
			}
			else{
				$response = array("error" => 1, "msg" => "La cuenta no existe.");
			}
		}
		die(json_encode($response));
	}
	if($uri->segment(2) == 'sidebar'){
		$users = getResult("
			SELECT usuario_id, usuario_nombre, usuario_apellido, usuario_email, fk_team_id
			FROM usuario
			JOIN rel_teamusuario ON rel_teamusuario.fk_usuario_id = usuario.usuario_id
			WHERE rel_teamusuario.fk_team_id IN (SELECT fk_team_id FROM rel_teamusuario WHERE rel_teamusuario.fk_usuario_id = '$usuario_id')
			ORDER BY usuario.usuario_nombre ASC
		");
		$sidebar = array();
		// SE LISTA EN EL INDEX GENERAL
		foreach($teams as $team){
			foreach($users as $user){
				if($team['team_id'] == $user['fk_team_id']){
					$team['usuarios'][] = $user;
				}
			}
			foreach($projects as $project){
				if($team['team_id'] == $project['fk_team_id']){
					$team['proyectos'][] = $project;
				}
			}
			$sidebar[] = $team;
		}
		$data['sidebar'] = $sidebar;
	}
	if($uri->segment(2) == 'projects'){
		if($uri->segment(3) == 'summary'){
			// SE USA LA CONSULTA DE MAIN
			$template = abs_path('templates/ajax/percents.php');
		}
	}
	if($uri->segment(2) == 'getMembers'){
		if($_GET['project']){
			$users = getResult("
				SELECT usuario_id, usuario_nombre, usuario_apellido, usuario_email
				FROM usuario
				JOIN rel_teamusuario ON rel_teamusuario.fk_usuario_id = usuario.usuario_id
				JOIN rel_proyectoteam ON rel_proyectoteam.fk_team_id = rel_teamusuario.fk_team_id
				WHERE rel_proyectoteam.fk_proyecto_id = '".intval($_GET['project'])."'
				ORDER BY usuario.usuario_nombre ASC
			");
		}
		else{
			$users = getResult("
				SELECT usuario_id, usuario_nombre, usuario_apellido, usuario_email
				FROM usuario
				JOIN rel_usuariousuario ON rel_usuariousuario.fk_contacto_id = usuario.usuario_id
				WHERE rel_usuariousuario.fk_usuario_id = '$usuario_id'
				ORDER BY usuario.usuario_nombre ASC
			");
		}
		$result = array();
		foreach($users as $user){
			$result[] = array(
				'id' => $user['usuario_id'],
				'nombre' => $user['usuario_nombre'].' '.$user['usuario_apellido'],
				'avatar' => md5(strtolower($user['usuario_email']))
			);
		}
		die(json_encode($result));
	}
	if($uri->segment(2) == 'getTasks'){
		$project_id = intval($_GET['project']);
		$tareas = getResult("
			SELECT tarea_id, tarea_nombre
			FROM tarea
			WHERE fk_proyecto_id = '$project_id' AND fk_tarea_id = '0'
			ORDER BY tarea_creado ASC
		");

		$result = array();
		foreach($tareas as $tarea){
			$result[] = array(
				'id' => $tarea['tarea_id'],
				'nombre' => $tarea['tarea_nombre']
			);
		}
		die(json_encode($result));
	}
	if($uri->segment(2) == 'tasks'){
		$where = "WHERE tarea.fk_tarea_id = 0 ";
		if($uri->segment(3) == 'me'){
			$where .= "AND tarea.fk_responsable_id = '$usuario_id' AND tarea.tarea_completada = '0'";
		}
		if($uri->segment(3) == 'completed'){
			$where .= "AND tarea.tarea_completada = '1'";
		}
		$tasks = getResult("
			SELECT tarea_id, tarea_nombre, tarea_due, tarea_completada, proyecto_id, proyecto_nombre, proyecto_color 
			FROM tarea 
			JOIN proyecto ON proyecto.proyecto_id = tarea.fk_proyecto_id 
			$where
			GROUP BY tarea.tarea_id 
			ORDER BY tarea_completada, tarea_due ASC
		");
		
		$data['tasks'] = $tasks;
		$template = abs_path('templates/ajax/tasks.php');
	}
	if($uri->segment(2) == 'task'){
		$task_id = $uri->segment(3);
		
		$tasks = getResult("
			SELECT tarea_id, tarea_nombre, tarea_due, tarea_completada, proyecto_id, proyecto_nombre, proyecto_color, CONCAT_WS(' ', usuario_nombre, usuario_apellido) AS usuario_nombrecompleto, CONCAT_WS(' ', follower.usuario_nombre, follower.usuario_apellido) as follower_nombrecompleto, follower.usuario_email as follower_email
			FROM tarea 
			JOIN proyecto ON proyecto.proyecto_id = tarea.fk_proyecto_id 
			LEFT JOIN rel_tareausuario ON rel_tareausuario.fk_tarea_id = tarea.tarea_id
			LEFT JOIN usuario AS follower ON follower.usuario_id = rel_tareausuario.fk_usuario_id
			WHERE tarea.tarea_id = '$task_id' 
			ORDER BY tarea_completada, tarea_due ASC
		");
		$data['tasks'] = $tasks;
		$template = abs_path('templates/ajax/task-detail.php');
	}
}

if($uri->segment(1) == '' && $usuario_id == 0){
	$template = abs_path('templates/index.php');
}

if(is_numeric($uri->segment(1))){
	$template = abs_path('templates/dashboard.php');
}

$output->load($template, $data, false);
$output->display();
?>