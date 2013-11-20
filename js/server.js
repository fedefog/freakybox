var io = require('socket.io').listen(5000);

var clients = {};

io.sockets.on('connection', function (socket) {
		
	socket.on('connect', function(data) {
		clients[data.nickname] = socket.id;
	});
		
	socket.on('createProject', function (data) {
		socket.broadcast.emit('createProject', data);
    });
});
console.log('Server running');