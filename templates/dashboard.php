<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="//assets/ico/favicon.png">

    <title>Freakybox</title>

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
	<link href="/css/colorpicker.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900,300italic,400italic,900italic' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="/js/colorpicker.js"></script>
	<script type="text/javascript" src="/js/freakybox.js"></script>
	
	<script src="http://190.16.165.20:5000/socket.io/socket.io.js"></script>
	<script type="text/javascript" src="/js/frontend.js"></script>
	<script>
		var Frontend = new Core();
		Frontend.init('190.16.165.20:5000', <?php echo ($_SESSION['uid'])?$_SESSION['uid']:0; ?>);
	</script>
		
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
      <script src="/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body> 
  
  	<div id="wrap">    

        <div class="container">
        
            <div id="header" class="row">
                
                <div class="col-md-2 main-logo">
                    
                   <h1><a href="#" title="Freakybox"><img src="/images/freaky-logo.png" alt="Freakybox Logo" title="Freakybox"></a></h1>
                    
                </div><!-- / col 2 -->
                
                <div class="col-md-10 main-bar">
                
                    <div class="buttons left">
                
                        <div class="dropdown add-new">
                          <a data-toggle="dropdown" class="btn" href="#">Add New<span></span></a>
                          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                         	 <span class="caret"></span>
                            <li role="presentation"><a data-toggle="modal" href="#modal-create-team" role="menuitem" tabindex="-1">Crear Equipo</a></li>
                            <li class="divider"></li>
                            <li role="presentation"><a data-toggle="modal" href="#modal-create-project" role="menuitem" tabindex="-1">Crear Proyecto</a></li>
                            <li class="divider"></li>
                            <li role="presentation"><a data-toggle="modal" href="#modal-create-task" role="menuitem" tabindex="-1">Crear Tarea</a></li>
                          </ul>
                        </div><!-- / dropdown -->
                        
                        <a href="#" class="btn team-builder" title="Team Builder">Team Builder</a>
                    
                    </div><!-- / buttons -->
                    
                    <div class="nav right">
                        
                        <div class="user-profile dropdown">
                            <img src="<?php echo gravatar($usuario['usuario_email'], 33); ?>" alt="<?php _e($usuario['usuario_nombrecompleto']); ?>" title="<?php _e($usuario['usuario_nombrecompleto']); ?>">
                            <a data-toggle="dropdown" class="btn" href="#"><?php _e($usuario['usuario_nombrecompleto']); ?></a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                              	<span class="caret"></span>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
                                <li class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Profile</a></li>
                                <li class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Logout</a></li>
                              </ul>
                        </div><!-- / user profile -->
                        
                         <div class="notifications dropdown">
                            <a data-toggle="dropdown" class="notification-btn" href="#"></a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                              	<span class="caret"></span>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#">
                                    	<img src="/images/fed.jpg" alt="Fede">
                                        <div class="notification excerpt"><div class="name">Federico:</div>the lightweight, feature-rich and easy to use..</div>
                                        <div class="date-update">Monday at 12:22 pm</div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#">
                                    	<img src="/images/fed.jpg" alt="Fede">
                                        <div class="notification excerpt"><div class="name">Federico:</div>the lightweight, feature-rich and easy to use..</div>
                                        <div class="date-update">Monday at 12:22 pm</div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#">
                                    	<img src="/images/fed.jpg" alt="Fede">
                                        <div class="notification excerpt"><div class="name">Federico:</div>the lightweight, feature-rich and easy to use..</div>
                                        <div class="date-update">Monday at 12:22 pm</div>
                                    </a>
                                </li>
                                <li class="view-all-messages" role="presentation"><a href="" title="">Ver todos los mensajes</a></li>
                              </ul>
                        </div><!-- / notifications -->
                        
                        <div class="upgrade-plan right">
                            <button type="button" class="btn">Upgrade Plan</button>
                        </div><!-- / calendar -->
                        
                        <div class="calendar right">
                            <a href="#" title="Calendar"></a>
                        </div><!-- / calendar -->
                    
                    </div><!-- right buttons -->
                    
                </div><!-- / col 10 -->
                
            </div><!-- / row -->
        
            <div class="row">
            
                <div class="col-md-2 sidebar">
                    
                    <div class="row">
                    
                        <div class="search-form">
                            
                            <form role="form">
                                <input type="text" class="form-control" id="search-imput" placeholder="BUSCAR TAREAS">
                            </form>
                            
                        </div><!-- / search form -->
                        
                    </div><!-- / row -->
                    
                    <div class="row company-wrapper">
                    
                        <div class="company">
                          <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Company Name</a>
                        </div><!-- / company -->
                    
                    </div><!-- / row -->
                    <script type="">
							$(document).ready(function(){
								$.ajax({
									url: '/ajax/sidebar',
									dataType: 'html',
									success: function(data){
										$('.workspace-wrapper').html(data);
									}									
								});
							});
						</script>
                    <div class="row workspace-wrapper">
                        
                        
                    </div><!-- / row -->
                    
                </div><!-- col 2 -->
                
                <div class="col-md-10 app-content">
                
                    <div class="row">
                    
                        <div class="module states projects-summary">
                        
                            <div class="title">
                                <strong>Featured</strong> Projects States
                                <a class="right all-projects-states" href="#" title="All Projects States">All Projects States</a>
                            </div><!-- / title -->
							
                        
                        </div><!-- / module -->
						
						<script type="">
							$(document).ready(function(){
								$.ajax({
									url: '/ajax/projects/summary',
									dataType: 'html',
									success: function(data){
										$('.projects-summary').append(data);
									}									
								});
							});
						</script>
                        
                    </div><!-- / row -->
                    
                    <div class="row">
                    
                        <?php include_once('ajax/tasks.php'); ?>
                        
                        <div class="col-md-6 module">
                        
                            <div class="row">
                        
                                <div class="title">
                                    <strong>Latest</strong> Teams Updates
                                    <div class="options dropdown">
                                        <a data-toggle="dropdown" class="btn" href="#"></a>
                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Imprimir</a></li>
											<li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Enviar por Email</a></li>
                                          </ul>
                                    </div><!-- / options -->
									<div class="filter dropdown">
                                        <a data-toggle="dropdown" class="btn" href="#"></a>
                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver todo</a></li>
											<li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver mis updates</a></li>
											<li class="divider"></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver las tareas que me gustan</a></li>
											<li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver las tareas que sigo</a></li>	
                                          </ul>
                                    </div><!-- / filter -->
                                </div><!-- / title -->
                                
                            </div><!-- / row -->
                            
                            <div class="row">
                            
                                <?php include_once('ajax/stream.php'); ?>
                            
                            </div><!-- / row -->    
                        
                        </div><!-- / col 6 --> 
                        
                    </div><!-- / row -->
                
                </div><!-- col 10 -->
                
            </div><!-- / row -->      
            
            <div id="footer" class="row"> 
                
                <div class="shortcodes left">
                
                    <span><strong>SOME MAGIC</strong> SHORTCODES</span>  
                    <ul>
                        <li><strong>Tab+Q</strong> Quick Add</li>
                        <li><strong>Tab+bksp</strong>  Delete Task</li>
                        <li><strong>Tab+DownArrow</strong> Move Down</li>
                        <li><strong>Tab+Enter</strong> Mark Complete</li>
                        <li><a href="" title="More Shortcodes">+More</a></li>
                    </ul>
                    
                </div><!-- / shortcodes -->
                
                <div class="nav-footer right">
                    <ul>      
                        <li><a href="" title="ABOUT">ABOUT</a></li>
                        <li><a href="" title="BLOG">BLOG</a></li>
                        <li><a href="" title="TERMS">TERMS</a></li>
                        <li><a href="" title="PRIVACY">PRIVACY</a></li>
                        <li><a href="" title="HELP">HELP</a></li>
                        <li><a href="" title="CONTACT">CONTACT</a></li>
                    </ul>
                </div><!-- / nav footer -->
            
            </div><!-- / row footer -->  
            
              <div class="modal fade" id="modal-create-team" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Create Team</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" role="form">
                          <div class="form-group">
                            <label for="team-name" class="col-lg-3 control-label">Team Name</label>
                            <div class="col-lg-9">
                              <input type="text" name="team" class="form-control" id="team-name" placeholder="Team Name">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="team-name" class="col-lg-3 control-label">Team Members</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control tagsearch" id="user-name" placeholder="User or E-mail">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>
							<style>

								.ui-menu .ui-menu-item a {
								  font-size: 12px;
								}
								.ui-autocomplete {
								  position: absolute;
								  top: 0;
								  left: 0;
								  z-index: 1510 !important;
								  float: left;
								  display: none;
								  min-width: 160px;
								  width: 160px;
								  padding: 4px 0;
								  margin: 2px 0 0 0;
								  list-style: none;
								  background-color: #ffffff;
								  border-color: #ccc;
								  border-color: rgba(0, 0, 0, 0.2);
								  border-style: solid;
								  border-width: 1px;
								  -webkit-border-radius: 2px;
								  -moz-border-radius: 2px;
								  border-radius: 2px;
								  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
								  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
								  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
								  -webkit-background-clip: padding-box;
								  -moz-background-clip: padding;
								  background-clip: padding-box;
								  *border-right-width: 2px;
								  *border-bottom-width: 2px;
								}
							</style>
							<script type="text/javascript">
								$(document).ready(function(){
									$(".tagsearch").each(function() {
										var el = $(this);
										el.autocomplete({
											source: "/ajax/getMembers",
											minLength: 3,
											select: function(event, ui) {
												var tag = '<span class="tag" data-id="'+ui.item.id+'" data-nombre="'+ui.item.nombre+'" data-avatar="'+ui.item.avatar+'"><img src="http://www.gravatar.com/avatar/'+ui.item.avatar+'?d=identicon&s=22" title="'+ui.item.nombre+'" alt="'+ui.item.nombre+'" /><a href="#" class="removetag" title="Quitar">x</a></span>';
												el.val("");
												el.next().append(tag);
												return false;
											},
											messages: {
												noResults: '',
												results: function() {}
											},
											create: function () {
												$(this).data('ui-autocomplete')._renderItem = function (ul, item) {
													return $('<li>')
														.data( "item.autocomplete", item )
														.append( '<a><img src="http://www.gravatar.com/avatar/'+item.avatar+'?d=identicon&s=22" title="'+item.nombre+'" alt="'+item.nombre+'" />' + item.nombre + '</a>' )
														.appendTo(ul);
												};
											}
										});
									});
									$(".tagsearch").keypress(function (e){
										if (e.which == 13) {
											e.preventDefault();
											var tag = '<span class="tag" data-id="0" data-nombre="" data-email="'+$(this).val()+'"><img src="http://www.gravatar.com/avatar/000?d=identicon&s=22" title="'+$(this).val()+'" alt="'+$(this).val()+'" /><a href="#" class="removetag" title="Quitar">x</a></span>';
											$(this).next().append(tag);
											$(this).val("");
											return false;
										}
									});
									$(document).on('click', '.removetag', function(){
										$(this).parent().remove();
										return false;
									});

									$("div#modal-create-team button.btn-submit").click(function(e){
										e.preventDefault();
										var members = [];
										$("div#modal-create-team span.tag").each(function(index, value){
											var member = {
												id: $(this).data("id"),
												nombre: $(this).data("nombre"),
												avatar: $(this).data("avatar"),
												email: $(this).data("email")
											};
											members.push(member);
										});
										
										var team = {
											nombre: $("div#modal-create-team input[name=team]").val(),
											privado: $("div#modal-create-team input[name=private]:checked").val(),
											members: members
										};

										Frontend.createTeam(team);
										
										$("div#modal-create-team input[name=team]").val('');
										$("div#modal-create-team div.tagholder").html('');
										$('div#modal-create-team').modal('hide');
									});		
								});
							</script>
                          <div class="form-group">
                          	<label for="team-privacy" class="col-lg-3 control-label">Team Privacy</label>
                            <div class="col-lg-9">
                              <div class="radio">
                              	<label>
                                <input type="radio" name="private" id="optionsRadios1" value="0" checked>
                                Public
                                </label>
                                </div>
                                <div class="radio">
                                <label>
                                <input type="radio" name="private" id="optionsRadios2" value="1">
                                Private
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-default btn-submit">Create New Team</button>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
			  
			  <div class="modal fade" id="modal-create-project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Crear Proyecto</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" role="form">
                          <div class="form-group">
                            <label for="project-name" class="col-lg-3 control-label">Nombre Proyecto</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="project-name" name="nombre" placeholder="Nombre del Proyecto">
                            </div>
                          </div>
						  <div class="form-group">
                            <label for="subtask" class="col-lg-3 control-label">Equipo</label>
                            <div class="col-lg-9">
                            <select name="team" class="form-control">
								<option><?php echo (count($teams) == 0)?'Proyecto Personal':'';?></option>
								<?php foreach($teams as $team){ ?>
									<option value="<?php echo $team['team_id']; ?>"><?php echo $team['team_nombre']; ?></option>
								<? } ?>
                            </select>
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>
						  <div class="form-group date">
                            <label for="start-date" class="col-lg-3 control-label">Inicio</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="inicio" value="02-16-2012" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                            <label for="due-date" class="col-lg-3 control-label due-date">Fin</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="fin" value="02-16-2012" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>		
                          <div class="form-group color-project">
                            <label for="project-color" class="col-lg-3 control-label">Color</label>
                            <div class="col-lg-9">
								<span style="background-color:#fec755; border: 1px solid;" data-hex="fec755" data-field="create-project-color" class="itemcolor"></span>
								<span style="background-color:#cf2441; border: 1px solid;" data-hex="cf2441" data-field="create-project-color" class="itemcolor"></span>
								<span style="background-color:#27aae1; border: 1px solid;" data-hex="27aae1" data-field="create-project-color" class="itemcolor"></span>
								<span style="background-color:#30495c; border: 1px solid;" data-hex="30495c" data-field="create-project-color" class="itemcolor"></span>
								<span style="background-color:#8bcf30; border: 1px solid;" data-hex="8bcf30" data-field="create-project-color" class="itemcolor"></span>
								<span style="background-color:#ffffff; border: 1px solid;" data-hex="ffffff" data-field="create-project-color" class="colorpick"></span>
								<input id="create-project-color" type="hidden" name="color" value=""/>
                            </div>
							<script>
								$(document).ready(function(){
									$('.colorpick').click(function(){
										var el = $(this);
										el.ColorPicker({
											color: '#0000ff',
											onChange: function (hsb, hex, rgb) {
												el.css('background', '#' + hex);
												$("#"+el.data('field')).val(hex);
											}
										});
									});
									$('.itemcolor').click(function(){
										var hex = $(this).data('hex');
										$('#create-project-color').val(hex);
									});
								});
							</script>
                          </div>
							<div class="form-group">
                                <label for="project-description" class="col-lg-3 control-label">Descripcion</label>
                                <div class="col-lg-9">
                                  <textarea id="project-description" class="form-control" name="descripcion" placeholder="Descripcion" rows="3"></textarea>
                                </div>
                            </div>
							<div class="form-group">
								<label for="team-privacy" class="col-lg-3 control-label">Privado</label>
								<div class="col-lg-9">
								  <div class="radio">
									<label>
									<input type="radio" id="project-private" name="private" value="0" checked>
									Public
									</label>
									</div>
									<div class="radio">
									<label>
									<input type="radio" id="project-private" name="private" value="1">
									Private
									</label>
								  </div>
								</div>
							  </div>
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-default add-submit">Crear nuevo Proyecto</button>
                            </div>
                          </div>
                    </form>
					<script type="text/javascript">
							$(document).ready(function(){
								$(document).on("click", ".add-project", function () {
									 var teamId = $(this).data('team');
									 $("div#modal-create-project select[name=team]").val(teamId);
								});

								$("div#modal-create-project button.add-submit").click(function(e){
									e.preventDefault();
									var proyecto = {
										
										nombre: $("div#modal-create-project input[name=nombre]").val(),
										team_id: $("div#modal-create-project select[name=team]").val(),
										inicio: $("div#modal-create-project input[name=inicio]").val(),
										fin: $("div#modal-create-project input[name=fin]").val(),
										color: $("div#modal-create-project input[name=color]").val(),
										privado: $("div#modal-create-project input[name=private]:checked").val(),
										descripcion: $("div#modal-create-project textarea[name=descripcion]").val()
									};
									Frontend.createProject(proyecto);
									$('input#project-name').val('');
									$('div#modal-create-project').modal('hide');
								});

								$("div#modal-create-project button.close").click(function(e){
									$("div#modal-create-project input[name=nombre]").val('');
									$("div#modal-create-project select[name=team]").val(0);
									$("div#modal-create-project input[name=inicio]").val('');
									$("div#modal-create-project input[name=fin]").val('');
									$("div#modal-create-project input[name=color]").val('');
									$("div#modal-create-project :radio[name=private]").prop('checked', false);
									$("div#modal-create-project textarea[name=descripcion]").val('');
								});
							});
						</script>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
			  
			  <div class="modal fade" id="modal-create-task" tabindex="-1" role="dialog" aria-labelledby="modal-create-teamLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Crear Tarea</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" role="form">
                          <div class="form-group">
                            <label for="task-name" class="col-lg-3 control-label">Tarea</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="task-name" name="nombre" placeholder="Nombre de la tarea">
                            </div>
                          </div>
						  <div class="form-group">
                            <label for="project-name" class="col-lg-3 control-label">Proyecto</label>
                            <div class="col-lg-9">
								<select name="proyecto" class="form-control">
									<option></option>
									<?php foreach($projects as $project){ ?>
										<option value="<?php echo $project['proyecto_id']; ?>"><?php echo $project['proyecto_nombre']; ?></option>
									<?php } ?>
								</select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="user-name" class="col-lg-3 control-label">Responsable</label>
                            <div class="col-lg-9">
								<select name="responsable" class="form-control">
								</select>
                            </div>
                          </div>
						  <div class="form-group date">
                            <label for="start-date" class="col-lg-3 control-label">Inicio</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="inicio" value="02-16-2012" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                            <label for="due-date" class="col-lg-3 control-label due-date">Fin</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="fin" value="02-16-2012" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>		
                          <div class="form-group">
                            <label for="tags" class="col-lg-3 control-label">Tags</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control tagsearch" id="tags" placeholder="Tags">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>		
                          <div class="form-group">
                            <label for="followers" class="col-lg-3 control-label">Seguidores</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control members" id="followers" placeholder="Seguidores">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>		
                          <div class="form-group">
                            <label for="exampleInputFile" class="col-lg-3">Adjuntar Archivo</label>
                            <div class="col-lg-9">
                            <input type="file" id="exampleInputFile">
                            </div>
                          </div>	  
                          <div class="form-group">
                            <label for="subtask" class="col-lg-3 control-label">Subtarea de</label>
                            <div class="col-lg-9">
								<select name="maintask" class="form-control subtasks">
								</select>
                            </div>
                          </div>		
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-default add-submit">Crear nueva tarea</button>
                            </div>
                          </div>
                    </form>
					<script type="text/javascript">
						$(document).ready(function(){						
							$(document).on("click", ".add-task", function () {
								var teamId = $(this).data('team');
								$("div#modal-create-task select[name=team]").val(teamId);
							});
							
							$("input.members").each(function() {
								var el = $(this);
								el.autocomplete({
									source: function(request, response) {
										$.getJSON("/ajax/getMembers", {project: $('div#modal-create-task select[name=proyecto]').val()},response);
									},
									minLength: 3,
									select: function(event, ui) {
										var tag = '<span class="tag" data-id="'+ui.item.id+'" data-nombre="'+ui.item.nombre+'" data-avatar="'+ui.item.avatar+'"><img src="http://www.gravatar.com/avatar/'+ui.item.avatar+'?d=identicon&s=22" title="'+ui.item.nombre+'" alt="'+ui.item.nombre+'" /><a href="#" class="removetag" title="Quitar">x</a></span>';
										el.val("");
										el.next().append(tag);
										return false;
									},
									messages: {
										noResults: '',
										results: function() {}
									},
									create: function () {
										$(this).data('ui-autocomplete')._renderItem = function (ul, item) {
											return $('<li>')
											.data( "item.autocomplete", item )
											.append( '<a><img src="http://www.gravatar.com/avatar/'+item.avatar+'?d=identicon&s=22" title="'+item.nombre+'" alt="'+item.nombre+'" />' + item.nombre + '</a>' )
											.appendTo(ul);
										};
									}
								});
							});
							
							$("div#modal-create-task select[name=proyecto]").change(function(){
								$.getJSON("/ajax/getMembers", {project: $(this).val()},function(data){
									var options = '<option></option>';
									$.each( data, function(key, item) {
										options += '<option value="'+item.id+'">'+item.nombre+'</option>'
									});
									$("div#modal-create-task select[name=responsable]").html(options);
								});
								
								$.getJSON("/ajax/getTasks", {project: $(this).val()},function(data){
									var options = '<option></option>';
									$.each( data, function(key, item) {
										options += '<option value="'+item.id+'">'+item.nombre+'</option>'
									});
									$("div#modal-create-task .subtasks").html(options);
								});
							});

							$("div#modal-create-task button.add-submit").click(function(e){
								e.preventDefault();
								
								var members = [];
								$("div#modal-create-team span.tag").each(function(index, value){
									var member = {
										id: $(this).data("id"),
										nombre: $(this).data("nombre"),
										avatar: $(this).data("avatar"),
										email: $(this).data("email")
									};
									members.push(member);
								});
								
								var tarea = {
									nombre: $("div#modal-create-task input[name=nombre]").val(),
									proyecto_id: $("div#modal-create-task select[name=proyecto]").val(),
									responsable_id: $("div#modal-create-task select[name=responsable]").val(),
									inicio: $("div#modal-create-task input[name=inicio]").val(),
									fin: $("div#modal-create-task input[name=fin]").val(),
									followers: members,
									tarea_id: $("div#modal-create-task select[name=maintask]").val()
								};
								
								Frontend.createTask(tarea);
								
								$("div#modal-create-task input[name=nombre]").val('');
								$("div#modal-create-task select[name=proyecto]").val(0);
								$("div#modal-create-task select[name=responsable]").val(0);
								$("div#modal-create-task input[name=inicio]").val('');
								$("div#modal-create-task input[name=fin]").val('');
								$("div#modal-create-task div.tagholder").html('');
								$("div#modal-create-task select[name=maintask]").val(0);
								
								$('div#modal-create-task').modal('hide');
							});

							$("div#modal-create-task button.close").click(function(e){
								$("div#modal-create-task input[name=nombre]").val('');
								$("div#modal-create-task select[name=proyecto]").val(0);
								$("div#modal-create-task select[name=responsable]").val(0);
								$("div#modal-create-task input[name=inicio]").val('');
								$("div#modal-create-task input[name=fin]").val('');
								$("div#modal-create-task div.tagholder").html('');
								$("div#modal-create-task select[name=subtasks]").val(0);
							});
						});
						</script>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
    
        </div> <!-- /container -->
        
     </div><!-- / wrap --> 
	<ul class="notify">
	</ul>
  </body>
</html>