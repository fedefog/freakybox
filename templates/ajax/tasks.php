<div class="col-md-6 module">
    <div class="row">
        <div class="title">
            Tareas de <strong class="whotasks"><?php echo $pn; ?></strong>
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
                    <li role="presentation"><a class="switchtasks" role="menuitem" tabindex="-1" href="/ajax/tasks/me<?php echo (!empty($project_id))?'/'.$project_id:''; ?>">Mis Tareas</a></li>
					<li class="divider"></li>
                    <li role="presentation"><a class="switchtasks" role="menuitem" tabindex="-1" href="/ajax/tasks/completed<?php echo (!empty($project_id))?'/'.$project_id:''; ?>">Ver completadas</a></li>										
                  </ul>
            </div><!-- / filter -->
        </div><!-- / title -->
    </div><!-- / row -->
	
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click', '.switchtasks', function(e){
				e.preventDefault();
				var el = $(this);
				$.ajax({
					url: el.attr('href'),
					method: 'post',
					success: function(html){
						var resp = $(html);
						var tasks = resp.find('#tasks').html();
						var username = resp.find('.whotasks').html();
						$('#tasks').html(tasks);
						$('.whotasks').html(username);
					}
				});
			});
		});
	</script>
    
     <div class="row">
     
     	<div id="tasks" class="<?php echo $cp; ?>">
     		<?php $fake_id = 1; ?>
			<?php foreach($tasks as $task){ ?>
        	<div class="task <?php echo ($task['tarea_completada'])?'completed':'';?>">
                <div class="task-number"><?php echo $fake_id; ?></div>
                <div class="task-state"><input type="checkbox" id="ch_<?php echo $task['tarea_id']; ?>" class="complete-task" value="<?php echo $task['tarea_id']; ?>" <?php echo ($task['tarea_completada'])?'checked="checked"':'';?>><label for="ch_<?php echo $task['tarea_id']; ?>"></label></div>
                <div class="task-title"><?php echo $task['tarea_nombre']; ?></div>
                <div class="view-task"><a class="view-task-btn showtask" href="/ajax/task/<?php echo $task['tarea_id']; ?>" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" data-id="<?php echo $task['tarea_id']; ?>" title="Remove Task"></a></div>
                <div class="task-due-date"><?php echo date('d M', strtotime($task['tarea_fin'])); ?></div>
                <div class="task-project"><span class="label label-default"><a class="color-1 edit-project" <?php echo ($task['proyecto_color'])?'style="background:#'.$task['proyecto_color'].';"':''?> href="/ajax/project/<?php echo $task['proyecto_id']; ?>" tabindex="-1"><?php echo $task['proyecto_nombre']; ?></a></span></div>
            </div><!-- / task -->
            <?php $fake_id++; ?>
			<?php } ?>
            
			<?php /*
            <div class="task has-subtask">
            
                <div class="task-number">1</div>
                <div class="task-state"><input type="checkbox" value=""></div>
                <div class="task-title"><span>Task title</span><a href="#" class="view-subtask" title="View Subtask"></a></div>
                <div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
                <div class="task-due-date">Jul 13</div>
                <div class="task-project"><span class="label label-default"><a class="color-2" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Project Name</a></span></div>
                
                <div class="subtask-wrapper">
                
                    <div class="subtask">
						<div class="task-state"><input type="checkbox" value=""></div>
						<div class="task-title">SubTask title</div>
						<div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
						<div class="task-due-date">Jul 13</div>
                    </div><!-- / sub task -->
                    
                    <div class="subtask">
						<div class="task-state"><input type="checkbox" value=""></div>
						<div class="task-title">SubTask title</div>
						<div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
						<div class="task-due-date">Jul 13</div>
                    </div><!-- / sub task -->
            	</div><!-- / subtask wrapper -->
            </div><!-- / task -->
			<*/?>
                    
        </div><!-- / tasks -->
        
          <div class="add-new-task-btn">
          	<a class="add-new-task" data-toggle="modal" href="#modal-create-task" role="menuitem" tabindex="-1">NUEVA TAREA</a>
          </div><!-- / add new task btn -->  
        
    </div><!-- / row -->    

</div><!-- / col 6 -->

<script type="text/javascript">
	$(document).ready(function(){
		$('body').on('click', '.complete-task', function(e){
			var el = $(this);
			
			var action = 'incomplete';
			if($(this).is(':checked')){
				action = 'complete'
			}
			
			$.ajax({
				url: '/ajax/'+action+'/'+el.val(),
				method: 'post',
				success: function(html){
					if(action == 'complete'){
						el.closest('.task').addClass('completed');
					}
					else{
						el.closest('.task').removeClass('completed');
					}
					var html = $('<li><a href="" class="btn btn-primary">Undo</a></li>').fadeIn('slow').delay(5000).fadeOut('slow');
					$(".notify").append(html);
				}
			});
		});
	
		$('body').on('click', '.showtask', function(e){
			e.preventDefault();
			var el = $(this);
			$.ajax({
				url: el.attr('href'),
				method: 'post',
				success: function(html){
					$('#modal-task div.modal-content').html(html);
					$('#modal-task').modal('show')
				}
			});
		});
		
		$('body').on('click', '.remove-task-btn', function(e){
			e.preventDefault();
			var el = $(this);
			var id = $(this).data('id');
			var tarea = {
				tarea_id: id
			};
			var ask = confirm("¿Está seguro de que desea eliminar esta tarea?");
			if (ask == true){
				Frontend.deleteTask(tarea);
				el.closest('.task').hide('slow');
			}			
		});
	});
</script>

<div class="modal fade full" id="modal-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->