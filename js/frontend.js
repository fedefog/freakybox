var Core = (function() {
    var _host;
	var _socket;
	
	// Keep the team id of the current user.
	var _team;
	
    function Core(){};	
			
	Core.prototype.init = function(url) {
		_host = url;
		_socket = io.connect(_host);
		
		_socket.on('createProject', createProject);
    };
	
    Core.prototype.doAction = function(event, data) {
        _socket.emit(event, data);
    };
	
	Core.prototype.createProject = function(data) {
		createProject(data);
        _socket.emit('createProject', data);
    };
	
	var createProject = function(data) {
        $('ul.projects').append($('<li>'), data.name);
    };
	
    return Core;
})();