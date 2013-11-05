<div class="modulo" style="border:0px; width:800px;">
	<style>
	.botoninicio {
		float: left;
		height: 90px;
		margin-bottom: 20px;
		margin-right: 10px;
		text-align: center;
		width: 120px;
	}
	</style>
    <div class="container" style="border:0px;">

        <? foreach ($sections as $seccion_nombre => $seccion) { ?>
            <h3 style="clear:both; width:780px;margin:20px 0px;font-size:20px;"><?= $seccion_nombre ?></h3>
            <? foreach ($seccion['sections'] as $seccion_nombre => $seccion_info) { ?>
                <div class="botoninicio"><a href="<?= ADMIN_FOLDER ?><?
							echo $seccion_info['conf'];
		
		                    if ($seccion_info['link'] != '') {
		                        echo $seccion_info['link'];
		                    } else {
		                        echo "?ch=1";
		                    }
                ?>"><?
                                    if ($seccion_info['icon'] != '') {
                    ?><img src="/system/_img/iconos/<?= $seccion_info['icon'] ?>" border="0" /><br/><?
            }
                ?><?= trim($seccion_info['name']) ?></a></div><?
            }?>
            <div class="clearfix" style="width: 100%; height:1px;"></div>
            <?
        }
        ?>	

    </div>
</div>