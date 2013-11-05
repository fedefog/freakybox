<?
/*****************************************************
*   form.php:                             	     *
*        Normalmente el encargado de insertar nuevo  *
*	   elementos en una tabla, o de editarlos.   *
*****************************************************/

/*setea la variable $tipodepermiso con su valor correspondiente
 * 1_restricted, 2_view. 3_edit, 4_fullaccess*/
include(ABS_PATH."/system/_inc/permissions.php");
if(($tipodepermiso==1)||($tipodepermiso==2)){
	?>
	<script type="text/javascript">
		alert("No tiene autorizacion para ingresar a esta area");
		history.back();
	</script>
	<?
}

//Verifica que esten seteadas las variables necesarias para mostrar el form.
if (isset($_REQUEST[$maintable.'_id'])){
    $id=$_REQUEST[$maintable.'_id'];
}elseif(!isset($id)){
    $id=0;
}

//Usa la funcion get item para obtener el elemnto de la tabla requerido
if($id > 0){
	if(isset($maintable)){
	    $row=getItem($maintable,$maintable.'_id',$id);
	}else{
	    $row=getItem($pathprocess->bf,$pathprocess->bf.'_id',$id);
	}
}

$i=0;
if(isset($list)){
    $_fields=$edita;
}else{
    if(isset($maintable)){
        $_fieldsdefault=getFileds($maintable);
        $_fields=array("titulo"=>"Datos Generales","opciones"=>$_fieldsdefault);
    }else{
        $_fieldsdefault=getFileds($pathprocess->bf);
        $_fields=array("titulo"=>"Datos Generales","opciones"=>$_fieldsdefault);
    }
}

?>
        
<? 
//ABRE editone.
//Se usa para mostrar el form en caso de que solo haya un item en lista.
if($editone == false){?>
<body>

<?//Funciones javascript utilizadas?>

<?include(ABS_PATH."/system/views/header.php")?>
<?include(ABS_PATH."/system/views/menubar.php")?>


<?//Dibujo todos los campos a completar o modificar?>
<div id="maincontent">
        <div class="head-content">
		<?//Titulo de la seccion:?>
		<h1 class="titulos"><?=$module_title?>&nbsp;<?if(isset($_REQUEST['clone']))echo "Clon";?></h1>
        <div style="width:100%" class="clearfix"></div>
        </div>
        <? } // CIERRA editone.?>
        
        <? if(isset($_SESSION['sys_editone'])){ unset($_SESSION['sys_editone']);?>
        <div class="alert success">
            El elemento se guardo con éxito.
        </div>
        <?}?>
        
	<div id="container" class="form">
		<form id="mainform" action="<?=ADMIN_FOLDER?><?=$pathprocess->bf?>/actions" method="post" enctype="multipart/form-data">
                <input type="hidden" name="sys_before" value="<?=$module_action['before']?>"/>
		<input type="hidden" name="sys_after" value="<?=$module_action['after']?>"/>
                <? if($editone){ ?>
                <input type="hidden" name="sys_editone" value="1"/>
                <? } ?>
		<?
		//Recorro todos los campos del conf que llamo a form:
		$x=1;
		foreach($_fields as $_field_item){?>
		<fieldset title="<?=$_field_item["titulo"]?>">
                <?if($_field_item["titulo"]){?>
                    <legend><?=$_field_item["titulo"]?></legend>
                <?}?>
			<?//Coloco el titulo de cada subseccion de la configuracion:
			/*if($_field_item["titulo"]!=''){?>
				
				<div class="clearfix">
				<h2><?=$_field_item["titulo"]?></h2>
				</div>
			<?}*/?>
		<?	
		foreach($_field_item['opciones'] as $_field){
				//Obtengo todos los valores que necesito y los coloco en variables
				if(isset($fields[$_field]['fieldlabel'])){
				    $field_name=$_field;
				    $field_label=$fields[$_field]['fieldlabel'];
				    $field_component=$fields[$_field]['fieldcomponent'];
				    //COMENTADO 12/02 - No se usa.
				    //$extra_field=$fields[$_field][3];
				    $fieldoptions=$fields[$_field];
				    // SI EXISTE LA UNA TABLA ESPECIFICA, LA ROW SE GENERA EN BASE A ESA
				    if((isset($fieldoptions['fieldtable']))&&($fieldoptions['fieldtable'])){
						$row=getItem($fieldoptions['fieldtable'],'fk_'.$maintable.'_id',$id);
				    }else{
						$row=getItem($maintable,$maintable.'_id',$id);
				    }
				}else{
				    $field_name=$_field;
				    $field_label=str_replace($maintable."_","",$_field);
				    $field_component="texto";
				    //$extra_field='';
				    $fieldoptions="";
				}

				//La complejidad de mostrar el tipo de campo por pantalla queda en manos del base-printfield
				?>
                <? if($field_component != 'oculto'){ // Ocultamos el div si es un campo oculto?>
                <div id="div_<?=$field_name?>" class="formfield" <?
				if (($field_component=='ckeditor')||($field_component=='fckeditor')||($field_component=='multiselect'))
					echo "style='width:100%;' " ;
				
				if(isset($fieldoptions['style'])){
					echo "style=\"".$fieldoptions['style']."\"";
				}
				
				?>> 
				<? } ?>
				<?
				if(($field_component!='oculto')&&($field_component!='sistema')&&($field_component!='fijo')){?>
				    <label for="<?=$field_name?>" class="clearfix"><?=($field_label)?$field_label.':':''?>
				    <?
				    if(isset($fields[$_field]['notes'])){?>
						<span class="info-icon tooltip" title="<?=$fields[$_field]['notes'];?>"></span><?
				    }
				    ?>
				    </label>
				    <? printField($field_name,$field_component,$row,$pathprocess->bf,$fieldoptions);
				}else{
				       printField($field_name,$field_component,$row,$pathprocess->bf,$fieldoptions);
				}?>
				<? if($fields[$_field]['options']['hide']){ ?>
					<?
						// Agrega un array vacio asi si no se selecciona nada muestra todo.
						$fields[$_field]['options']['hide'][''] = array();
					?>
					<script type="text/javascript">
						function update_<?=$_field?>(el){
							var json = <?=json_encode($fields[$_field]['options']['hide'])?>;
							$.each(json, function(index, value){
								if(el.val() == index){
									$("div.formfield").each(function(index){
										var div = $(this);
										var hide = false;
										$.each(value, function(index, field){
											if(div.attr('id') == "div_"+field){
												hide = true;
											}
										});
										if(hide == true){
											div.hide();
										}
										else{
											div.show();
											
										}
										show = false;
									});
								}
							});
						}
						$(document).ready(function(){
							update_<?=$_field?>($(this));
							
							$("#<?=$field_name?>").change(function(){
								update_<?=$_field?>($(this));
							});
						});
					</script>
				<? } ?>
                <? if($field_component != 'oculto'){ // Ocultamos el div si es un campo oculto?>
				</div>
                <? } ?>
				<?
                if(isset ($fields[$_field]['dependencia']))
                {?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#<?=$fields[$_field]['dependencia']?>").change (function(){
                                $.ajax({
                                    url: "<?=HTML_PATH?>/system/_ajax/dependencia.php",
                                    data: "maintable=<?=$fields[$_field]['listtable']?>&condition=<?=$fields[$_field]['dependencia']?>:"+$('#<?=$fields[$_field]['dependencia']?> option:selected').val()+"&default=<?=$fields[$_field]['defaultlistoption']?>",
                                    cache: false,
                                    success: function(data){
                                        j=data.split(";;");
                                        var options = '';
                                            for (var i = 0; i < j.length; i++) {
                                                splitj=j[i].split(":");
                                                options += '<option value="' + splitj[0] + '">' + splitj[1] + '</option>';
                                            }
                                            $('#<?=$field_name?>').html(options);/**/
                                    }
                                });
                            });
                        });
                    </script>
                <?}

                $x++;
			}?>
            </fieldset>
                        <?
		}?>
		 
		 <table width="100%" border="0" cellspacing="0" cellpadding="2">
		    <tr>
			<td>&nbsp;</td>
		    </tr>
		    <tr>
			<td align="right" colspan="2">

			<button type="submit" name="save" id="save-post" tabindex="4">Guardar</button>&nbsp;
		<?//si estamos cancelando apuntamos directamente al segundo elemento del array(el [1]) que es el anterior?>
		<?$href=ADMIN_FOLDER.$_SESSION['navigationtree'][1]['bf']."/".$_SESSION['navigationtree'][1]['ac']."?".$_SESSION['navigationtree'][1]['qs']."&navigation=back";
		?>
		<button type="button" name="save" id="save-post" value="" tabindex="4" class="button-cancel" onClick="document.location='<?=$href?>'">Cancelar</button> </td>
		    </tr>
	         </table>
		 <input type="hidden" name="<?=$maintable.'_id'?>" value="<?=$id?>">
		 <?if(isset($_REQUEST['clone'])){?>
		 	<input type="hidden" name="clonar" value="yes">
		 <?}?>
		</form>
	</div>
</div>


<?include(ABS_PATH."/system/views/footer.php")?>