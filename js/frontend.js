var Core = (function() {
    var _host;
	var _socket;
	
	// Keep the team id of the current user.
	var _team;
	
	var _date = new Date();
	
    function Core(){};	
			
	Core.prototype.init = function(url, id) {
		_host = url;
		_socket = io.connect(_host);
		
		_socket.emit('register', id);
		
		_socket.on('createTeam', createTeam);
		_socket.on('createProject', createProject);
		_socket.on('deleteProject', deleteProject);
		_socket.on('createTask', createTask);
		_socket.on('updateTask', updateTask);
		_socket.on('commentTask', commentTask);
		_socket.on('deleteTask', deleteTask);
    };
	
    Core.prototype.doAction = function(event, data) {
        _socket.emit(event, data);
    };
	
	Core.prototype.createTeam = function(data) {
		var uid = _date.getTime();
		
		data.uid = uid;
	
		createTeam(data);
        _socket.emit('createTeam', data);
    };
	
	Core.prototype.createProject = function(data) {
		//createProject(data);
        _socket.emit('createProject', data);
    };
	
	Core.prototype.updateProject = function(data) {
		//@TODO: Actualizar en algun lado.
		//updateTask(data);
        _socket.emit('updateProject', data);
    };
    
    Core.prototype.deleteProject = function(data) {
		//@TODO: Actualizar en algun lado.
		//updateTask(data);
        _socket.emit('deleteProject', data);
    };
	
	Core.prototype.createTask = function(data) {
		//@TODO: Actualizar en algun lado.
		//createTask(data);
        _socket.emit('createTask', data);
    };
	
	Core.prototype.updateTask = function(data) {
		//@TODO: Actualizar en algun lado.
		//updateTask(data);
        _socket.emit('updateTask', data);
    };
	
	Core.prototype.commentTask = function(data) {
		//@TODO: Actualizar en algun lado.
		//commentTask(data);
        _socket.emit('commentTask', data);
    };
	
	Core.prototype.deleteTask = function(data) {
		//@TODO: Actualizar en algun lado.
		//commentTask(data);
        _socket.emit('deleteTask', data);
    };
	
	var createTeam = function(data) {
		var html = '<div id="team-'+data.uid+'" class="team-wrapper">';
		html = html + '<div class="team-name"><a title="Team Name" href="#">'+data.nombre+'</a></div>';
		html = html + '<div class="team-content">';	
		html = html + '<div class="team-people">';
		for (var key in data.members) {
			var user = data.members[key];
			html = html + '<a class="" href="">';
			html = html + '<img title="'+user.nombre+'" alt="User" src="http://www.gravatar.com/avatar/'+user.avatar+'?d=identicon&amp;s=22">';
			html = html + '</a>';
		}
		html = html + '</div><!-- / team people -->';
		html = html + '<span class="clearfix"></span>';
		html = html + '<a role="menuitem" href="#projectModal" data-team="'+data.id+'" data-toggle="modal" class="add-project">PROJECT</a>';
		html = html + '<ul class="projects-team" id="team-'+data.id+'">';
		html = html + '</ul><!-- / projects team -->';
		html = html + '</div><!-- / team-content -->';
		html = html +'</div><!-- / team-wrapper -->';
		
        $('div.workspace-wrapper').append(html);
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
		
		var percent = '';
		percent = percent + '<a href="/' + data.team_id + '/' + data.proyecto_id + '" tabindex="-1">';
		percent = percent + '	<div class="project-state color-1" style="background:#' + data.proyecto_color + ';">';
		percent = percent + '		<span class="name left">' + data.proyecto_nombre + '</span>';
		percent = percent + '		<span class="percentage right">100</span>';
		percent = percent + '		<div class="progress">';
		percent = percent + '			<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">';
		percent = percent + '				<span class="sr-only"><?php echo $terminado; ?>100% Complete</span>';
		percent = percent + '			</div><!-- / progress bar -->';
		percent = percent + '		</div><!-- / progress -->';
		percent = percent + '	</div><!-- / project State -->';
		percent = percent + '</a>';
		
		$('.other-projects-states').append(percent);
    };
	
	var updateProject = function(data){
		console.log("Updated Project:");
		console.log(data);
	}
	
	var deleteProject = function(data){
		$('.project-'+data.proyecto_id).remove();
		console.log("Deleted Project:");
		console.log(data);
	}
	
	var createTask = function(data){
		console.log("Create Task:");
		console.log(data);
		
		var count = $("#tasks .task").length + 1;
		
		var html = '<div class="task">';
		html = html + '<div class="task-number">' + count + '</div>';
        html = html + '<div class="task-state"><input type="checkbox" class="complete-task" value="' + data.tarea_id + '"></div>';
        html = html + '<div class="task-title">' + data.tarea_nombre + '</div>';
        html = html + '<div class="view-task"><a class="view-task-btn showtask" href="/ajax/task/' + data.tarea_id + '" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" data-id="' + data.tarea_id + '" title="Remove Task"></a></div>';
        html = html + '<div class="task-due-date">' + data.tarea_fin_str + '</div>';
        html = html + '<div class="task-project"><span class="label label-default"><a class="color-1" style="background:#'+data.proyecto_color+';" data-toggle="modal" href="#" role="menuitem" tabindex="-1">'+data.proyecto_nombre+'</a></span></div>';
        html = html + '</div>';
		
		$('div.list-tasks-generic').append(html);
		$('div.list-tasks-pr'+data.fk_proyecto_id).append(html);
	}
	
	var updateTask = function(data){
		console.log("Updated Task:");
		console.log(data);
	}
	
	var commentTask = function(data){
		console.log("Commented Task:");
		console.log(data);
	}
	
	var deleteTask = function(data){
		console.log("Delete Task:");
		console.log(data);
	}
	
    return Core;
})();