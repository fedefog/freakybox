<?php foreach($sidebar as $team){ ?>
<div class="team-wrapper">
	<div class="team-name">
		<a href="/dashboard/<?php echo $team['team_id']; ?>" title="Team Name"><?php echo $team['team_nombre']; ?></a>
	</div><!-- / Team Name -->
	
	<div class="team-content">
		<div class="team-people">
			<?php foreach($team['usuarios'] as $usuario_temp){ ?>
			<a href="/ajax/tasks/from/<?php echo $usuario_temp['usuario_id']; ?>" class="switchtasks">
				<img src="<?php echo gravatar($usuario_temp['usuario_email'], 22); ?>" alt="User" title="<?php echo (!empty($usuario_temp['usuario_nombre']) || !empty($usuario_temp['usuario_apellido']))?$usuario_temp['usuario_nombre'].' '.$usuario_temp['usuario_apellido']:$usuario_temp['usuario_email']; ?>">
			</a>
			<?php } ?>
		</div><!-- / team people -->
		<span class="clearfix"></span>

		<a class="add-project" data-toggle="modal" data-team="1" href="#modal-create-project" role="menuitem" tabindex="-1">
			PROYECTO
		</a>
		<ul id="team-<?php echo $team['team_id']; ?>" class="projects-team">
		<?php foreach($team['proyectos'] as $proyecto){ ?>
			<li class="project project-<?php echo $proyecto['proyecto_id']; ?>">
				<a href="/dashboard/<?php echo $team['team_id']; ?>/<?php echo $proyecto['proyecto_id']; ?>" title=""><?php echo $proyecto['proyecto_nombre']; ?></a>
				<div class="dropdown project-options">
					<a data-toggle="dropdown" class="options-arrow" href="#"></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li role="presentation"><a href="">Archive Project</a></li>
							<li class="divider"></li>
							<li role="presentation"><a class="delproject" href="" data-project="<?php echo $proyecto['proyecto_id']; ?>">Delete Project</a></li>
						</ul>
				</div><!-- / dropdown -->
			</li>
		<?php } ?>
		</ul><!-- / projects team -->
	</div><!-- / team content -->        
</div><!-- / team wrapper -->
<?php } ?>