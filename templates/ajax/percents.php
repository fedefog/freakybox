<?php if(count($projects) > 0){ ?>
<?php for($i = 0; $i < 5; $i++){ ?>
	<?php if($projects[$i]){ ?>
		<?php $project = $projects[$i]; ?>
		<?php $terminado = round(100 - (($project['tasks_open'] / $project['tasks']) * 100));?>
		<a href="/dashboard/<?php echo $project['proyecto_id']; ?>" tabindex="-1">
			<div class="project-state color-1 <?php echo ($i == 4)?'last':'';?>" <?php echo ($project['proyecto_color'])?'style="background:#'.$project['proyecto_color'].';"':''?>>
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
<?php } ?>
<?php if(count($projects)>5){ ?>
	<div class="other-projects-states">
	<?php for($i = 5; $i < count($projects); $i++){ ?>
	<?php $project = $projects[$i]; ?>
	<?php $terminado = round(100 - (($project['tasks_open'] / $project['tasks']) * 100));?>
	<a href="/dashboard/<?php echo $project['proyecto_id']; ?>" tabindex="-1">
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
<?php } ?>