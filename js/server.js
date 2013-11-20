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
		
	socket.on('connect', function(data) {
		clients[data.nickname] = socket.id;
	});
		
	socket.on('createProject', function (data) {
		if(data.privado == 0){
			socket.broadcast.emit('createProject', data);
		}
		
		var proyecto = {
			fk_team_id: data.team_id,
			proyecto_nombre: data.nombre,
			proyecto_privado: data.privado
		};
				
		connection.query('INSERT INTO proyecto SET ?', proyecto, function(err, result) {
			if (err) throw err;
		});
    });
});
console.log('Server running');