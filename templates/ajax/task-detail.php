<?php $task = $tasks[0]; ?>
<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo $task['tarea_nombre'];?></h4>
            </div>
			<div class="modal-body">
				<div class="teams-updates"> 
    <div class="task-update">
        <div class="task-update-header">
            <div class="task-update-title left"><?php echo $task['tarea_nombre'];?></div><!-- / task update title -->
        </div><!-- task update header -->
        
        <div class="update-notification">
            <div class="user left">
                <img src="<?php echo gravatar($task['usuario_email'], 23); ?>" alt="<?php echo $task['usuario_nombrecompleto']; ?>">
            </div><!-- / user -->
            
            <div class="update-body right">
				<!--
                <div class="name">
                    Federico <span class="task-completed-message">completed this task.</span>
                </div> --><!-- / name -->
                
                <div class="update-content">
                    <p><?php echo $task['usuario_nombrecompleto']; ?></p>
                </div><!-- / update content -->
                
                <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                
            </div><!-- / update body -->
            
        </div><!-- / update notification -->
                
    </div><!-- / task update -->
        
	<div class="clear"></div>

</div><!-- / teams updates -->
<div class="reply-notification">
                                	
                            <form>
                                <textarea class="form-control reply-message" placeholder="Mensaje de respuesta" rows="1"></textarea>
                                <input class="btn btn-default enviar-mensaje" type="submit" value="Enviar">
                            </form>
                            
                        </div>
				<div class="clear"></div>
                     
			</div><!-- / modal body -->
