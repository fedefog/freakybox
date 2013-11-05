<?
/* * ***************************************************
 *   menubar.php:                                     *
 *        Muestra las secciones del administrador y   *
 *           permite ingresar a las mismas            *
 * *************************************************** */
?>

<? //Enmaquetado del Men�?>
<div id="menubar">
    <ul >
        <li>
            <a href="<?= ADMIN_FOLDER ?>"><img src="<?= HTML_PATH ?>/system/_css/images/home.png"/><span>Inicio</span></a>
        </li>

        <? /*
         * El c�digo que sigue recorre el array del main y lo va
         *   separando por partes para mostrar cada una en el men�
         */ ?>                
        <? foreach ($sections as $seccion_nombre => $seccion) { ?>
        <? 
		$secccion_activa = array();
		foreach($seccion['sections'] as $subseccion){
			$secccion_activa[] = $subseccion['conf'];
		}
		?>
			<li <?=(in_array($pathprocess->bf, $secccion_activa))?'class="activa"':''?>>
                <a class="group" href="#">
					<? if(($seccion['icon'])&&(file_exists(ABS_PATH."/system/_css/images/".$seccion['icon']))){ ?>
                    <img src="<?= HTML_PATH ?>/system/_css/images/<?=$seccion['icon']?>"/>
                    <? } ?>
                    <span><?= $seccion_nombre ?></span>
				</a>
				<ul <?=(in_array($pathprocess->bf, $secccion_activa))?'style="display:block;"':''?>>    
				<? foreach ($seccion['sections'] as $seccion_nombre => $seccion_info) { ?>
					<li <?=($seccion_info['conf'] == $pathprocess->bf)?'class="activa"':''?>>                            
						<a href="<?= ADMIN_FOLDER ?><?
							echo $seccion_info['conf'];
		
		                    if ($seccion_info['link'] != '') {
		                        echo $seccion_info['link'];
		                    } else {
		                        echo "?ch=1";
		                    }
                            ?>"><?=trim($seccion_info['name'])?>
                        </a>
                    </li> 
        		<? } ?>
                </ul>
			</li>
		<? } ?>	    
    </ul>
</div> 
    
<script type="text/javascript">
    $(document).ready(function($) {
        $('#menubar ul li a.group').click(function(){
            $('#menubar ul li ul').slideUp();
            $(this).next().slideDown();
            return false;
        });
    });
</script>