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
		console.log(data);
		var html = '<li>';
		html = html + '<a href="" title="">'+data.nombre+'</a>';
		html = html + '<div class="dropdown project-options">';
		html = html + '<a data-toggle="dropdown" class="options-arrow" href="#"></a>';
		html = html + '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
		html = html + '<li role="presentation"><a href="">Archive Project</a></li>';
		html = html + '<li class="divider"></li>';
		html = html + '<li role="presentation"><a href="">Delete Project</a></li>';
		html = html + '</ul>';
		html = html + '</div><!-- / dropdown -->';
		html = html +'</li>';
		
        $('ul#team-'+data.team_id).append(html);
    };
	
    return Core;
})();