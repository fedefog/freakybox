<?php foreach($sidebar as $team){ ?>
<div class="team-wrapper">
	<div class="team-name">
		<a href="/<?php echo $team['team_id']; ?>" title="Team Name"><?php echo $team['team_nombre']; ?></a>
	</div><!-- / Team Name -->
	
	<div class="team-content">
		<div class="team-people">
			<?php foreach($team['usuarios'] as $usuario){ ?>
			<?php $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $usuario['usuario_email'] ) ) ) . "?d=identicon&s=22"; ?>
			<a href="" class="">
				<img src="<?php echo $grav_url; ?>" alt="User" title="<?php echo (!empty($usuario['usuario_nombre']) || !empty($usuario['usuario_apellido']))?$usuario['usuario_nombre'].' '.$usuario['usuario_apellido']:$usuario['usuario_email']; ?>">
			</a>
			<?php } ?>
		</div><!-- / team people -->
		<span class="clearfix"></span>

		<a class="add-project" data-toggle="modal" data-team="1" href="#projectModal" role="menuitem" tabindex="-1">
			PROJECT
		</a>
		<ul id="team-<?php echo $team['team_id']; ?>" class="projects-team">
		<?php foreach($team['proyectos'] as $proyecto){ ?>
			<li>
				<a href="" title=""><?php echo $proyecto['proyecto_nombre']; ?></a>
				<div class="dropdown project-options">
					<a data-toggle="dropdown" class="options-arrow" href="#"></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li role="presentation"><a href="">Archive Project</a></li>
							<li class="divider"></li>
							<li role="presentation"><a href="">Delete Project</a></li>
						</ul>
				</div><!-- / dropdown -->
			</li>
		<?php } ?>
		</ul><!-- / projects team -->
	</div><!-- / team content -->        
</div><!-- / team wrapper -->
<?php } ?>