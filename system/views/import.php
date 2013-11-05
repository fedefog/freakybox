<?
/* * ***************************************************
 *   form.php:                             	     *
 *        Normalmente el encargado de insertar nuevo  *
 * 	   elementos en una tabla, o de editarlos.   *
 * *************************************************** */

/* setea la variable $tipodepermiso con su valor correspondiente
 * 1_restricted, 2_view. 3_edit, 4_fullaccess */
include(ABS_PATH . "/system/_inc/permissions.php");
if (($tipodepermiso == 1) || ($tipodepermiso == 2)) {
    ?>
    <script type="text/javascript">
        alert("No tiene autorizacion para ingresar a esta area");
        history.back();
    </script>
    <?
}

//Verifica que esten seteadas las variables necesarias para mostrar el form.
if (isset($_REQUEST[$maintable . '_id'])) {
    $id = $_REQUEST[$maintable . '_id'];
} elseif (!isset($id)) {
    $id = 0;
}

//Usa la funcion get item para obtener el elemnto de la tabla requerido
if (isset($maintable)) {
    $row = getItem($maintable, $maintable . '_id', $id);
} else {
    $row = getItem($pathprocess->bf, $pathprocess->bf . '_id', $id);
}

?>
    <body>

        <? include(ABS_PATH . "/system/views/header.php") ?>
        <? include(ABS_PATH . "/system/views/menubar.php") ?>

        <div id="maincontent">
            <div class="head-content">
                <h1 class="titulos">Importar</h1>
                <div class="clearfix" style="width:100%"></div>
            </div>

        <div id="container" class="form">
            <form id="mainform" action="<?= ADMIN_FOLDER ?><?= $pathprocess->bf ?>/actions" method="post" enctype="multipart/form-data">
                <input type="hidden" name="sys_import" value="1"/>
                <table id="listtable">
                    <thead>
                        <tr>
                            <th class="control sorter-false" colspan="<?=count($importa);?>">Campos de Impotación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <? for($i=1; $i<=count($importa); $i++){ ?>
                                <td>Columna <?=$i?></td>
                            <? } ?>
                        </tr>
                        <tr>
                            <? foreach($importa as $field){ ?>
                                <td>
                                	<strong><?=$fields[$field]['fieldlabel']?></strong>
                                	<?
										switch($fields[$field]['fieldcomponent']){
											case 'tags':
											case 'multiselect':
													if(!empty($fields[$field]['options']['importslicer'])){
														echo "<br>Separador: ".$fields[$field]['options']['importslicer'];
													}
												break;
											case 'calendario':
													echo "<br>Formato: dia/mes/año";
												break;
											
											case 'radio':
													$radios = array();
													foreach($fields[$field]['options'] as $key => $val){
														$radios[] = $key.":".$val;
													}
													echo "<br>Opciones: ".implode(', ', $radios);
												break;
											case 'boolean':
													echo "<br>Opciones: 1:Si, 0:No";
												break;
										}
									?>
                                </td>
                            <? } ?>
                        </tr>
                    </tbody>
                </table>
                
                <fieldset title="Archivo">
                    <h2 style="border:0;">Archivo XLS</h2>
                    <div class="formfield texto"> 	
                        <label class="clearfix" for="especial_alianza">Tiene Cabecera?:</label>
                        <div class="checkcontainer">
                        	<input type="radio" value="1" name="saltea"><span>Si</span>
                        </div>
                        <div class="checkcontainer">
                        	<input type="radio" value="0" name="saltea" checked="checked"><span>No</span>
                        </div>
                    </div>
                    <div class="formfield texto"> 				    
                        <label class="clearfix" for="csv">Archivo:</label>
                        <input type="file" id="csv" name="csv"> 
                    </div>
                </fieldset>

                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">

                            <button type="submit" name="save" id="save-post" tabindex="4">Importar</button>&nbsp;
                            <? //si estamos cancelando apuntamos directamente al segundo elemento del array(el [1]) que es el anterior ?>
                            <? $href = ADMIN_FOLDER . $_SESSION['navigationtree'][1]['bf'] . "/" . $_SESSION['navigationtree'][1]['ac'] . "?" . $_SESSION['navigationtree'][1]['qs'] . "&navigation=back";
                            ?>
                            <button type="button" name="save" id="save-post" value="" tabindex="4" class="button-cancel" onclick="document.location='<?= $href ?>'">Cancelar</button> </td>
                    </tr>
                </table>
                <input type="hidden" name="<?= $maintable . '_id' ?>" value="<?= $id ?>">
            </form>
        </div>
    </div>


<? include(ABS_PATH . "/system/views/footer.php") ?>