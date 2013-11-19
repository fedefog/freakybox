var Core = (function() {
    var _host;
	var _socket;
	
    function Core(){};	
		
	Core.prototype.init = function(url) {
		_host = url;
		_socket = io.connect(_host);
		
		_socket.on('chat', function(data) {
			$('div#messages').append($('<p>'), data);
		});
		
		_socket.on('createProject', updateProjects);
    };
	
    Core.prototype.doAction = function(event, data) {
        _socket.emit(event, data);
    };
	
	Core.prototype.createProject = function(data) {
        _socket.emit('createProject', data);
    };
	
	var updateProjects = function() {
        // Private code here
    };
		
    return Core;
})();