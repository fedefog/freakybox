<div class="teams-updates">
	<?php foreach($updates as $update){ ?>
	<div class="task-update">
		
		<div class="task-update-header">
			
			<div class="task-update-title left">
				<?php echo $update['tarea_nombre']; ?>
			</div><!-- / task update title -->
			
			<a class="view-task-btn right" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1"></a>
			
			<div class="project-name-update right">
				<span class="label label-default" <?php echo ($update['proyecto_color'])?'style="background:#'.$update['proyecto_color'].';"':''?>><a class="edit-project" href="/ajax/project/<?php echo $update['proyecto_id']; ?>" role="menuitem" tabindex="-1"><?php echo $update['proyecto_nombre']; ?></a></span>
			</div><!-- / project name update -->
			
		</div><!-- task update header -->
		
		<div class="update-notification">
		
			<div class="user left">
				<img src="<?php echo gravatar($update['usuario_email'], 23); ?>" alt="<?php echo $update['usuario_nombrecompleto']; ?>">
			</div><!-- / user -->
			
			<div class="update-body right">
			
				<div class="name">
					<?php echo $update['usuario_nombrecompleto']; ?> <!-- <span class="task-completed-message">completed this task.</span> -->
				</div><!-- / name -->
				
				<div class="update-content">
					<p><?php echo $update['actualizacion_contenido']; ?></p>
				</div><!-- / update content -->
				
				<div class="date-update"><?php echo date('l \a\t H:i a', strtotime($update['actualizacion_fecha'])); ?>&middot;</div><!-- / date update -->
				<div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
				<div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
				
			</div><!-- / update body -->
			
		</div><!-- / update notification -->
		
	</div><!-- / task update -->    
	<div class="clear"></div>
	<?php } ?>
	
</div><!-- / teams updates -->