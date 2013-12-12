<?php foreach($i = 0; $i < 5; $i++){ ?>
<?php $project = $projects[$i];
<?php $terminado = round(100 - (($project['tasks_open'] / $project['tasks']) * 100));?>
<a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
	<div class="project-state color-1">
		<span class="name left"><?php echo $project['proyecto_nombre']; ?></span>
		<span class="percentage right"><?php echo $terminado; ?></span>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $terminado; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $terminado; ?>%;">
				<span class="sr-only"><?php echo $terminado; ?>% Complete</span>
			</div><!-- / progress bar -->
		</div><!-- / progress -->
	</div><!-- / project State -->
</a>
<?php } ?>
<?php if(count($projects)>5){ ?>
	<div class="other-projects-states">
	<?php foreach($i = 5; $i < count($projects); $i++){ ?>
	<?php $project = $projects[$i];
	<?php $terminado = round(100 - (($project['tasks_open'] / $project['tasks']) * 100));?>
	<a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
		<div class="project-state color-1">
			<span class="name left"><?php echo $project['proyecto_nombre']; ?></span>
			<span class="percentage right"><?php echo $terminado; ?></span>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $terminado; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $terminado; ?>%;">
					<span class="sr-only"><?php echo $terminado; ?>% Complete</span>
				</div><!-- / progress bar -->
			</div><!-- / progress -->
		</div><!-- / project State -->
	</a>
	<?php } ?>
	</div>
<?php } ?>