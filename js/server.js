var io = require('socket.io').listen(5000);

var mysql  = require('mysql');

var connection = mysql.createConnection({
	host: 'localhost',
	user: 'root',
	password: 'franlo1904',
	database: 'freakybox'
});

connection.connect();

var clients = {};

io.sockets.on('connection', function (socket) {
		
	socket.on('connect', function(data){
		clients[data.nickname] = socket.id;
	});
	
	socket.on('createTeam', function(data){
		//@TODO: Cambiar el 1 por el fk de usuario creador.
		var usuario_id = 1;
		
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
		if(data.privado == 0){
			socket.broadcast.emit('createProject', data);
		}
		
		var ini = data.inicio.split('/');
		var fin = data.fin.split('/');
		
		var proyecto = {
			fk_team_id: data.team_id,
			proyecto_nombre: data.nombre,
			proyecto_inicio: ini[2]+'-'+ini[1]+'-'+ini[0],
			proyecto_fin: fin[2]+'-'+fin[1]+'-'+fin[0],
			proyecto_privado: data.privado,
			proyecto_descripcion: data.descripcion
		};
				
		connection.query('INSERT INTO proyecto SET ?', proyecto, function(err, result) {
			if (err) throw err;
			
			var id = result.insertId;
			
			var rel_proyectoteam = {
				fk_proyecto_id: id,
				fk_team_id: data.team_id
			};
			
			connection.query('INSERT INTO rel_proyectoteam SET ?', rel_proyectoteam, function(err, result) {
				if (err) throw err;
			});
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