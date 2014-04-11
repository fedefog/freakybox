var io = require('socket.io').listen(5000);

var mysql  = require('mysql');

var connection = mysql.createConnection({
	host: 'localhost',
	user: 'root',
	password: 'franlo1904',
	database: 'freakybox'
});

connection.connect();

function Client(socket) {
	this.id = null;
	this.name = null;
	this.socket = socket;
}

var clients = {};

var usuario_id = 0;

var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

io.sockets.on('connection', function (socket) {
		
	socket.on('connect', function(data){
		
	});
	
	socket.on('register', function(data){
		var client = new Client(socket);
		client.id = data;
		clients[data] = client;
		usuario_id = data;
	});
	
	socket.on('createTeam', function(data){	
		
		var team = {
			fk_usuario_id: usuario_id,
			team_nombre: data.nombre,
			team_privado: data.privado
		};
				
		connection.query('INSERT INTO team SET ?', team, function(err, result) {
			if (err) throw err;
			
			var team_id = result.insertId;			
			
			linkTeamUser(team_id, usuario_id)
			
			for (var key in data.members) {
				var user = data.members[key];
				
				var follower_id = user.id;
				
				if(follower_id == 0){
					connection.query('SELECT usuario_id FROM usuario WHERE LOWER(usuario_email) = ?', user.email, function(err, results, fields) {
						if (err) throw err;
						// Si el email existe lo vinculamos directamente
						var numRows = results.length;
						if(numRows > 0){
							for (var i in results) {
								var user = results[i];
								linkTeamUser(team_id, user.usuario_id);
							}
						}
						else{
							var usuario = {
								usuario_email: user.email
							};
							connection.query('INSERT INTO usuario SET ?', usuario, function(err, result) {
								if (err) throw err;
								linkTeamUser(team_id, result.insertId);
								linkUserUser(usuario_id, result.insertId);
							});
						}
					});				
				}
				else{
					linkTeamUser(team_id, follower_id);
				}			
			}
			
			data.id = team_id;
			socket.broadcast.emit('createTeam', data);
		});
	});
		
	socket.on('createProject', function(data){
		
		
		var ini = data.inicio.split('/');
		var fin = data.fin.split('/');
		
		var proyecto = {
			proyecto_id: 0,
			fk_team_id: data.team_id,
			proyecto_nombre: data.nombre,
			proyecto_inicio: ini[2]+'-'+ini[1]+'-'+ini[0],
			proyecto_fin: fin[2]+'-'+fin[1]+'-'+fin[0],
			proyecto_color: data.color,
			proyecto_privado: data.privado,
			proyecto_descripcion: data.descripcion
		};
				
		connection.query('INSERT INTO proyecto SET ?', proyecto, function(err, result) {
			if (err) throw err;
			
			var id = result.insertId;
			proyecto.proyecto_id = id;
			
			var rel_proyectoteam = {
				fk_proyecto_id: id,
				fk_team_id: data.team_id
			};
			
			connection.query('INSERT INTO rel_proyectoteam SET ?', rel_proyectoteam, function(err, result) {
				if (err) throw err;
			});
			
			socket.emit('createProject', proyecto);
			if(data.privado == 0){
				socket.broadcast.emit('createProject', proyecto);
			}
		});
    });
	
	socket.on('updateProject', function(data){					
		var ini = data.inicio.split('/');
		var fin = data.fin.split('/');
		
		var proyecto = {
			fk_team_id: data.team_id,
			proyecto_nombre: data.nombre,
			proyecto_inicio: ini[2]+'-'+ini[1]+'-'+ini[0],
			proyecto_fin: fin[2]+'-'+fin[1]+'-'+fin[0],
			proyecto_color: data.color,
			proyecto_privado: data.privado,
			proyecto_descripcion: data.descripcion
		};

		connection.query('UPDATE proyecto SET ? WHERE proyecto_id = ?', [proyecto, data.proyecto_id], function(err, result) {
			if (err) throw err;
								
			socket.emit('updateProject', data);
			socket.broadcast.emit('updateProject', data);
		});
    });
	
	socket.on('createTask', function(data){					
		var ini = data.inicio.split('/');
		var fin = data.fin.split('/');
		
		var tarea = {
			tarea_id: 0,
			fk_proyecto_id: data.proyecto_id,
			fk_tarea_id: data.tarea_id,
			fk_usuario_id: usuario_id,
			fk_responsable_id : data.responsable_id,
			tarea_nombre: data.nombre,
			tarea_inicio: ini[2]+'-'+ini[1]+'-'+ini[0],
			tarea_fin: fin[2]+'-'+fin[1]+'-'+fin[0]
		};
		
		connection.query('INSERT INTO tarea SET ?', tarea, function(err, result) {
			if (err) throw err;
			
			var id = result.insertId;
			tarea.tarea_id = id;
			
			for (var key in data.followers) {
				var user = data.followers[key];
				var follower_id = user.id;
				
				var rel_tareausuario = {
					fk_tarea_id: id,
					fk_usuario_id: follower_id
				};
				
				connection.query('INSERT INTO rel_tareausuario SET ?', rel_tareausuario, function(err, result) {
					if (err) throw err;
				});
			}
			
			//console.log(tarea);
			
			connection.query('SELECT proyecto_nombre, proyecto_color FROM proyecto WHERE proyecto_id = ?', data.proyecto_id, function(err, results, fields) {
				if (err) throw err;
				// Si el email existe lo vinculamos directamente
				var numRows = results.length;
				if(numRows > 0){
					var proyecto = results[0];
					
					var actualizacion = {
						fk_team_id: data.team_id,
						fk_proyecto_id: data.proyecto_id,
						fk_tarea_id : data.tarea_id,
						fk_usuario_id: usuario_id,
						actualizacion_contenido: 'Created this task'
					};
					
					socket.emit('commentTask', actualizacion);
					socket.broadcast.emit('commentTask', actualizacion);
					
					var tobroad = {
						tarea_id: tarea.tarea_id,
						fk_proyecto_id: data.proyecto_id,
						proyecto_nombre: proyecto.proyecto_nombre,
						proyecto_color: proyecto.proyecto_color,
						fk_tarea_id: data.tarea_id,
						fk_usuario_id: usuario_id,
						fk_responsable_id : data.responsable_id,
						tarea_nombre: data.nombre,
						tarea_inicio: ini[2]+'-'+ini[1]+'-'+ini[0],
						tarea_fin: fin[2]+'-'+fin[1]+'-'+fin[0],
						tarea_fin_str: fin[0] + ' ' + months[Number(fin[1] - 1)]
					};
				
					socket.emit('createTask', tobroad);
					socket.broadcast.emit('createTask', tobroad);
					
				}
			});
		});
    });
	
	socket.on('updateTask', function(data){					
		var ini = data.inicio.split('/');
		var fin = data.fin.split('/');
		
		var tarea = {
			fk_proyecto_id: data.proyecto_id,
			fk_tarea_id: data.fk_tarea_id,
			fk_responsable_id : data.responsable_id,
			tarea_nombre: data.nombre,
			tarea_inicio: ini[2]+'-'+ini[1]+'-'+ini[0],
			tarea_fin: fin[2]+'-'+fin[1]+'-'+fin[0]
		};

		connection.query('UPDATE tarea SET ? WHERE tarea_id = ?', [tarea, data.tarea_id], function(err, result) {
			if (err) throw err;
			
			var actualizacion = {
				fk_proyecto_id: data.proyecto_id,
				fk_tarea_id : data.tarea_id,
				fk_usuario_id: data.usuario_id,
				actualizacion_contenido: 'Updated task information'
			};
			
			connection.query('INSERT INTO actualizacion SET ?', actualizacion, function(err, result) {
				if (err) throw err;
						
				socket.emit('commentTask', data);
				socket.broadcast.emit('commentTask', data);
			});
					
			//socket.emit('updateTask', data);
			socket.broadcast.emit('updateTask', data);
		});
    });
	
	socket.on('commentTask', function(data){					
		
		var actualizacion = {
			fk_team_id: data.team_id,
			fk_proyecto_id: data.proyecto_id,
			fk_tarea_id : data.tarea_id,
			fk_usuario_id: usuario_id,
			actualizacion_contenido: data.comentario
		};
		
		connection.query('INSERT INTO actualizacion SET ?', actualizacion, function(err, result) {
			if (err) throw err;
					
			socket.emit('commentTask', data);
			socket.broadcast.emit('commentTask', data);
		});
    });
	
	socket.on('deleteTask', function(data){					
				
		connection.query('DELETE FROM tarea WHERE tarea_id = ?', data.tarea_id, function(err, result) {
			if (err) throw err;
					
			socket.emit('deleteTask', data);
			socket.broadcast.emit('deleteTask', data);
		});
    });
});

/*
* Vincular el Team con el Usuario.
*
* Se uso este metodo porque las llamadas son asyncronas a la db y asi se reutiliza codigo.
*/
var linkTeamUser = function(team_id, usuario_id) {
	var rel_teamusuario = {
		fk_team_id: team_id,
		fk_usuario_id: usuario_id
	};
				
	connection.query('INSERT INTO rel_teamusuario SET ?', rel_teamusuario, function(err, result) {
		if (err) throw err;
	});
}

/*
* Vincular el Usuario con Usuario.
*
* Se utiliza mas que nada cuando invitas por primera vez al usuario.
*/
var linkUserUser = function(usuario_id, contacto_id) {
	var rel_usuariousuario = {
		fk_usuario_id: usuario_id,
		fk_contacto_id: contacto_id
	};
				
	connection.query('INSERT INTO rel_usuariousuario SET ?', rel_usuariousuario, function(err, result) {
		if (err) throw err;
	});
}
console.log('Server running');