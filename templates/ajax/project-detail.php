<?php $proyecto = $projects[0]; ?>


                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Editar Proyecto</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" role="form">
                          <div class="form-group">
                            <label for="project-name" class="col-lg-3 control-label">Nombre Proyecto</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="project-name" name="nombre" placeholder="Nombre del Proyecto" value="<?php echo $proyecto['proyecto_nombre']; ?>">
                            </div>
                          </div>
						  <div class="form-group">
                            <label for="subtask" class="col-lg-3 control-label">Equipo</label>
                            <div class="col-lg-9">
                            <select name="team" class="form-control">
								<option><?php echo (count($teams) == 0)?'Proyecto Personal':'';?></option>
								<?php foreach($teams as $team){ ?>
									<option value="<?php echo $team['team_id']; ?>" <?php echo ($team['team_id'] == $proyecto['fk_team_id'])?'selected="selected"':'';?>><?php echo $team['team_nombre']; ?></option>
								<? } ?>
                            </select>
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>
						  <div class="form-group date">
                            <label for="start-date" class="col-lg-3 control-label">Inicio</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="inicio" value="<?php echo date('d/m/Y', strtotime($proyecto['proyecto_inicio']));?>" data-date-format="mm/dd/yy" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                            <label for="due-date" class="col-lg-3 control-label due-date">Fin</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="fin" value="<?php echo date('d/m/Y', strtotime($proyecto['proyecto_fin']));?>" data-date-format="mm/dd/yy" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>		
                          <div class="form-group color-project">
                            <label for="project-color" class="col-lg-3 control-label">Color</label>
                            <div class="col-lg-9">
								<input id="create-project-color" type="hidden" name="color" value="<?php echo $proyecto['proyecto_color']; ?>"/>
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
                                  <textarea id="project-description" class="form-control" name="descripcion" placeholder="Descripcion" rows="3"><?php echo $proyecto['proyecto_descripcion']; ?></textarea>
                                </div>
                            </div>
							<div class="form-group">
								<label for="team-privacy" class="col-lg-3 control-label">Privado</label>
								<div class="col-lg-9">
								  <div class="radio">
									<label>
									<input type="radio" id="project-private" name="private" value="0" <?php echo ($proyecto['proyecto_privado'] == 1)?'checked="checked"':''; ?>>
									Public
									</label>
									</div>
									<div class="radio">
									<label>
									<input type="radio" id="project-private" name="private" value="1" <?php echo ($proyecto['proyecto_privado'] == 0)?'checked="checked"':''; ?>>
									Private
									</label>
								  </div>
								</div>
							  </div>
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-default add-submit">Actualizar Proyecto</button>
                            </div>
                          </div>
                    </form>
					<script type="text/javascript">
							$(document).ready(function(){
								$(document).on("click", ".add-project", function () {
									 var teamId = $(this).data('team');
									 $("div#modal-project select[name=team]").val(teamId);
								});

								$("div#modal-project button.add-submit").click(function(e){
									e.preventDefault();
									var proyecto = {
										proyecto_id: <?php echo $proyecto['proyecto_id']; ?>,
										nombre: $("div#modal-project input[name=nombre]").val(),
										team_id: $("div#modal-project select[name=team]").val(),
										inicio: $("div#modal-project input[name=inicio]").val(),
										fin: $("div#modal-project input[name=fin]").val(),
										color: $("div#modal-project input[name=color]").val(),
										privado: $("div#modal-project input[name=private]:checked").val(),
										descripcion: $("div#modal-project textarea[name=descripcion]").val()
									};
									Frontend.updateProject(proyecto);
									$('input#project-name').val('');
									$('div#modal-project').modal('hide');
									location.reload();
								});

								$("div#modal-project button.close").click(function(e){
									$("div#modal-project input[name=nombre]").val('');
									$("div#modal-project select[name=team]").val(0);
									$("div#modal-project input[name=inicio]").val('');
									$("div#modal-project input[name=fin]").val('');
									$("div#modal-project input[name=color]").val('');
									$("div#modal-project :radio[name=private]").prop('checked', false);
									$("div#modal-project textarea[name=descripcion]").val('');
								});
							});
						</script>
                    </div>
