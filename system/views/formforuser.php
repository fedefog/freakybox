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
}else{
    $id=0;
}

//Usa la funcion get item para obtener el elemnto de la tabla requerido
if(isset($maintable)){
    $row=getItem($maintable,$maintable.'_id',$id);
}else{
    $row=getItem($pathprocess->bf,$pathprocess->bf.'_id',$id);
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
<body>

<?//Funciones javascript utilizadas?>

<?include(ABS_PATH."/system/views/header.php")?>
<?include(ABS_PATH."/system/views/menubar.php")?>


<?//Dibujo todos los campos a completar o modificar?>
<div id="maincontent">
	<?//Titulo de la seccion:?>
	<div class="head-content">
	<h1 class="titulos"><?=$module_title?>&nbsp;<?if(isset($_REQUEST['clone']))echo "Clon";//if(isset($_SESSION['father'])){echo $cfg_fatherfor.$_SESSION['father'];}?></h1>
    <div style="width:100%" class="clearfix"></div>
        </div>
	<div id="container" class="form">
		<form action="<?=ADMIN_FOLDER?><?=$pathprocess->bf?>/actions" method="post" name="form1" id="mainform" enctype="multipart/form-data">

		<?
		//Recorro todos los campos del conf que llamo a form:
		$x=1;
		foreach($_fields as $_field_item){?>
                    <fieldset title="<?=$_field_item["titulo"]?>">
                        <? if($_field_item["titulo"]){ ?>
                            <legend><?=$_field_item["titulo"]?></legend>
                        <? } ?>
			<?//Coloco el titulo de cada subseccion de la configuracion:
			if($_field_item["titulo"]!=''){?>
                          <h2><?=$_field_item["titulo"]?></h2>
			<?}?>
		<?	foreach($_field_item['opciones'] as $_field){
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
				    if($fields[$_field]['restricted']!=''){
					    ?>
					    <script type="text/javascript">
						fields[varindex] = new Array(4);
						fields[varindex][0]='<?=$field_name?>';
						fields[varindex][1]='<?=$field_component?>';
						fields[varindex][2]='<?=$fields[$_field][0]?>';
						fields[varindex][3]='<?=$fields[$_field][2]?>';
						varindex++;
					    </script>
				    <?}
				}else{
				    $field_name=$_field;
				    $field_label=str_replace($maintable."_","",$_field);
				    $field_component="texto";
				    //$extra_field='';
				    $fieldoptions="";
				}
				if(substr($_field,0,3)=='fk_'){
					$field_component="lista";
				}

				//La complejidad de mostrar el tipo de campo por pantalla queda en manos del base-printfield
				?><div class="formfield <?=$field_component?>" <?
				if (($field_component=='ckeditor')||($field_component=='fckeditor')||($field_component=='multiselect'))
					echo "" ;
				?>> <?
				if(($field_component!='oculto')&&($field_component!='sistema')&&($field_component!='fijo')){?>
				    <label for="<?=$field_name?>" class="clearfix"><?=$field_label?>:<?
				    if(isset($fields[$_field]['notes'])){?>
						<span class="info-icon tooltip" title="<?=$fields[$_field]['notes'];?>"></span><?
				    }?>
				    </label>
				    <? printField($field_name,$field_component,$row,$pathprocess->bf,$fieldoptions);
				}else{
				       printField($field_name,$field_component,$row,$pathprocess->bf,$fieldoptions);
				}?>

				</div>
				<?$x++;
			}
                        ?>
                        </fieldset><?
		}
                

		/*****************************************************
		 * MANEJO DE RESTRICCIONES PARA USUARIOS DE SISTEMA
		 *****************************************************/	?>
                            <fieldset title="Permisos por secci&oacute;n">
                    <legend>Permisos por secci&oacute;n</legend>                
		<?
		$sqlpermisos=mysql_query("SELECT * FROM tipopermiso");
		while ($rowpermisos=mysql_fetch_array($sqlpermisos)) {
			$permisos[]=$rowpermisos;
		}

		$sqlcategorias=mysql_query("SELECT * FROM menucategoria ORDER BY menucategoria_orden;");
		$xfordiv=0;
		while($rowcategorias=mysql_fetch_array($sqlcategorias)){?>
		<div id="divforcategoria_<?=$xfordiv?>">
                    <h2><?=$rowcategorias['menucategoria_nombre']?></h2>
			
			<?$sqlsecciones=mysql_query("SELECT * FROM menuadmin WHERE fk_menucategoria_id='".$rowcategorias['menucategoria_id']."'");
			if(mysql_num_rows($sqlsecciones)>0){?>
				<div class="clearfix" style="width: 100%;">
                                    <label>Marcar todas como:</label>
					<select id="selectforcategoria_<?=$xfordiv?>" onChange="setradiovalues('<?=$xfordiv?>')">
							<option value="0">No marcar</option>
						<?foreach($permisos as $permiso){?>
							<option value="<?=$permiso['tipopermiso_id']?>"><?=$permiso['tipopermiso_nombre']?></option>
						<?}?>
					</select>
				</div>
			<?}
			while ($rowsecciones=mysql_fetch_array($sqlsecciones)) {?>
				<div class="formfield">
					<label for="<?=$rowsecciones['menuadmin_nombre']?>" class="clearfix"><?=$rowsecciones['menuadmin_nombre']?>:</label>
					<?
					 foreach($permisos as $permiso){
					 	$tienepermiso=mysql_query("SELECT * FROM rel_usuariomenuadmin WHERE fk_usuario_id=".$id." AND fk_menuadmin_id=".$rowsecciones['menuadmin_id']);
						if(mysql_num_rows($tienepermiso)>0){
							$permisodeseccion=mysql_fetch_array($tienepermiso);
			               $chkd=($permisodeseccion['fk_tipopermiso_id']==$permiso['tipopermiso_id'])?"checked":"";
						}
			               ?>
			               <input type="radio" value="<?=$permiso['tipopermiso_id']?>" name="<?=$rowsecciones['menuadmin_id']?>_permiso" <?=$chkd?>><span class="label"><?=$permiso['tipopermiso_nombre']?></span><br/>
			               <?
			            };?>
	            </div>
	        <?}?>
	    </div>

		<?$xfordiv++;
		}?>
                    </fieldset>
        <script type="text/javascript">
	        function setradiovalues(categoria){
				$('#divforcategoria_'+categoria+' input:radio')/*input:radio*/.each(function(){
					var valforset= $("#selectforcategoria_"+categoria).val();
					if($(this).val()==valforset){
						$(this).attr("checked","true");
					}

				}
				);
	        }
        </script>
        <?
        /*******************************************************
		 * FIN MANEJO DE RESTRICCIONES PARA USUARIOS DE SISTEMA
		 *******************************************************/?>


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