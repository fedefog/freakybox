<?php $task = $tasks[0]; ?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title"><?php echo $task['tarea_nombre'];?></h4>
</div>
<div id="editask" class="modal-body">
                    
                    	<div class="col-md-6">
                          <form class="form-horizontal" role="form">
                          <div class="form-group">
                            <label for="task-name" class="col-lg-3 control-label">Tarea</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="task-name" name="nombre" placeholder="Nombre de la tarea" value="<?php echo $task['tarea_nombre'];?>">
                            </div>
                          </div>
						  <div class="form-group">
                            <label for="project-name" class="col-lg-3 control-label">Proyecto</label>
                            <div class="col-lg-9">
								<select name="proyecto" class="form-control">
									<option></option>
									<?php foreach($projects as $project){ ?>
										<option value="<?php echo $project['proyecto_id']; ?>" <?php echo ($task['proyecto_id'] == $project['proyecto_id'])?'selected="selected"':''?>><?php echo $project['proyecto_nombre']; ?></option>
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
						  <script type="text/javascript">
							$(document).ready(function(){	
								
								var project_id = <?php echo $task['proyecto_id']; ?>;
								
								$("div#editask select[name=proyecto]").change(function(){
									project_id = $(this).val();
									$.getJSON("/ajax/getMembers", {project: project_id},function(data){
										var options = '<option></option>';
										$.each( data, function(key, item) {
											var selected = '';
											if(item.id == '<?php echo $task['fk_responsable_id']; ?>'){
												selected = 'selected="selected"';
											}
											options += '<option value="'+item.id+'" '+selected+'>'+item.nombre+'</option>'
										});
										$("div#editask select[name=responsable]").html(options);
									});
								});
								$.getJSON("/ajax/getMembers", {project: project_id},function(data){
										var options = '<option></option>';
										$.each( data, function(key, item) {
											var selected = '';
											if(item.id == '<?php echo $task['fk_responsable_id']; ?>'){
												selected = 'selected="selected"';
											}
											options += '<option value="'+item.id+'" '+selected+'>'+item.nombre+'</option>'
										});
										$("div#editask select[name=responsable]").html(options);
									});
									
								$("input.members").each(function() {
									var el = $(this);
									el.autocomplete({
										source: function(request, response) {
											$.getJSON("/ajax/getMembers", {project: project_id},response);
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
								
								$('.update-task').click(function(e){
									//e.preventDefault();
									
									var members = [];
									$("div#editask span.tag").each(function(index, value){
										var member = {
											id: $(this).data("id"),
											nombre: $(this).data("nombre"),
											avatar: $(this).data("avatar"),
											email: $(this).data("email")
										};
										members.push(member);
									});
									
									var tarea = {
										usuario_id: <?php echo ($_SESSION['uid'])?$_SESSION['uid']:0; ?>,
										tarea_id: <?php echo $task['tarea_id']; ?>,
										nombre: $("div#editask input[name=nombre]").val(),
										proyecto_id: $("div#editask select[name=proyecto]").val(),
										responsable_id: $("div#editask select[name=responsable]").val(),
										inicio: $("div#editask input[name=inicio]").val(),
										fin: $("div#editask input[name=fin]").val(),
										followers: members,
										fk_tarea_id: $("div#editask select[name=maintask]").val()
									};
									
									Frontend.updateTask(tarea);
									
									$('.reply-message').val('');
								});
								
								$('.enviar-mensaje').click(function(e){
									//e.preventDefault();
									var comentario = $('.reply-message').val();
									var comment = {
										team_id: 0,
										proyecto_id: <?php echo $task['proyecto_id']; ?>,
										tarea_id: <?php echo $task['tarea_id']; ?>,
										usuario_id: <?php echo ($_SESSION['uid'])?$_SESSION['uid']:0; ?>,
										comentario: comentario
									};
									
									Frontend.commentTask(comment);
									
									$('.reply-message').val('');
								});
								
							});						  
						  </script>
						  <div class="form-group date">
                            <label for="start-date" class="col-lg-3 control-label">Inicio</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="inicio" value="<?php echo date('d/m/Y',strtotime($task['tarea_inicio'])); ?>" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                            <label for="due-date" class="col-lg-3 control-label due-date">Fin</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="fin" value="<?php echo date('d/m/Y',strtotime($task['tarea_fin'])); ?>" id="dp1">
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
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-default add-submit update-task">Actualizar</button>
                            </div>
                          </div>
                    </form>
                        
                     </div><!-- / col 6 -->   
                     
                     <div class="col-md-6 teams-update-wrapper">
                     	
                        <?php 
						$updates = $tasks['stream'];
						include_once('stream.php'); 
						?>
                        <div class="clear"></div>
                        <div class="reply-notification">
                                	
                            <form>
                                <textarea class="form-control reply-message" placeholder="Mensaje de respuesta" rows="1"></textarea>
                                <input class="btn btn-default enviar-mensaje" type="submit" value="Enviar">
                            </form>
                            
                        </div><!-- / reply notification -->
                        
                     </div><!-- / col 6 -->
                     
                     <div class="clear"></div>
                     
</div>