<?
/******************************************************
*   list.php:                                         *
*        Este view se va a encargar de listar la      *
*           categoria seleccionada (en base a su conf)*
******************************************************/

/*setea la variable $tipodepermiso con su valor correspondiente
 * 1_restricted, 2_view. 3_edit, 4_fullaccess*/
include(ABS_PATH . "/system/_inc/permissions.php");
if ($tipodepermiso == 1) {
?>
    	<script type="text/javascript">
                alert("No tiene autorizacion para ingresar a esta area");
                history.back();
    	</script>
    <?
}

//Cuando implementemos el uso de sys:
//$listlink=ADMIN_FOLDER."".$pathprocess->sys."/".$pathprocess->bf;
//mientras:
$listlink=ADMIN_FOLDER."".$pathprocess->bf;

//Si maintable esta seteado es porque tengo distintos conf
//para una misma tabla y necesito especificar la misma.
if(isset($maintable)){
    $mt=$maintable;
}else{
    $mt=$pathprocess->bf;
}


//esto no se que hace
$vs="";
if (isset($_REQUEST['join'])){
    $vs['join']['table']=$_REQUEST['join'];
    //$vs['join']['hijo'] = $pathprocess->bf;
    $_SESSION['ultimojoin'][$pathprocess->bf]=$_REQUEST['join'];
}
if (isset($_REQUEST['parameters'])){
    $vs['parameters']=$_REQUEST['parameters'];
    $_SESSION['ultimabusqueda'][$pathprocess->bf]=$_REQUEST['parameters'];
}


//Preparo los datos a mostrar
if(isset($orden)){
    if((isset($_GET['column']))&&($_GET['column']!="")){
        if(isset($_REQUEST['join'])){
            $vs['orden']="ORDER BY ".$maintable.".".$_GET['column']." ".$_GET['order'];
        }else{
            $vs['orden']="ORDER BY ".$_GET['column']." ".$_GET['order'];
        }

    }else{
        if(isset($_REQUEST['join'])){
            $vs['orden']=str_replace($maintable."_",$maintable.".".$maintable."_",$orden);
        }else{
            $vs['orden']=$orden;
        }
    }
}



//Si en el conf esta seteado $list
//los cargo en $_fields, sino cargo los datos de la base
if(isset($list)){
    $_fields=$list;
}else{
    $qs_fields=mysql_query("SHOW COLUMNS FROM ".$mt);
    while ($row_fields = mysql_fetch_assoc($qs_fields)) {
        if($row_fields['Field']!=$mt."_id"){
            $_fields[]=$row_fields['Field'];
        }
    }
}
?>

<body>
	<?//Agrego el header.php con el logo, fecha, etc.
	include(ABS_PATH."/system/views/header.php");
	//Agrego menubar.php que es el top men? de administra
	include(ABS_PATH."/system/views/menubar.php");

	//Levanta los parametros que vienen con list
	if((isset($_REQUEST['parameters']))&&($_REQUEST['parameters']!=null)){
	    $arr_parameter=explode('&',$_REQUEST['parameters']);
	    foreach($arr_parameter as $KEY=>$parameter){
	        if(stristr($parameter, 'fk_') == TRUE){
	            $arr_val=explode(':',$parameter);
	            $table=explode('_',$arr_val[0]);
	            if($applang=='es'){$field_father='nombre';}else{$field_father='name';}
	            $qs=mysql_query("SELECT * FROM ".$table[1]." WHERE ".$table[1]."_id='".$arr_val[1]."'");
	            $father=mysql_fetch_array($qs);
	            $_SESSION['father']=$father[$table[1]."_".$field_father];
	        }
	    }
	}else{
		$_SESSION['father']="";
	}
	$_SESSION['vs']=$vs; //guardo en session los filtros y el orden para que lo levanten los accions
	$vstemporal=$vs;
	unset($_SESSION['order']);
	if((isset($_GET['order']))&&($_GET['order']!="")){
		$_SESSION['order']=$_GET['order'];
	}


$half = array("imagen");
	//LISTADO de informaci?n:?>
<div id="maincontent">
    <div class="head-content">
	<?//Agrego el t?tulo de la secci?n?>
	<h1 class="titulos"><?=$module_title?>&nbsp;
        <?if(($_SESSION['father']!=null)&&($father!=null))
        {
            echo "Padre de ".$_SESSION['father'];
        }
        elseif($padre_de!='')
        {
            echo "Padre de ".$padre_de;
        }

        if(($pathprocess->bf=="usuarioregistrado")||($pathprocess->bf=="consulta"))
        {
        	if($pathprocess->bf=="usuarioregistrado")
        		$temptable="usuarioregistrado";
        	else
        		$temptable="consulta";
        	$where=explode("WHERE",$queryForDb);
        	if(count($where)>1)
            	$total_query=mysql_query("SELECT count(".$temptable."_id) FROM ".$temptable." WHERE ".$where[1]);
            else
            	$total_query=mysql_query("SELECT count(".$temptable."_id) FROM ".$temptable);
            $total=mysql_result($total_query, 0, 0);
            echo "(Total: $total)";
        }?></h1>

	<div class="clearfix" style="width:100%"></div>
	<div id="subbotonera" >
	<?//Agrego el boton de Volver
	foreach($_SESSION['navigationtree'] as $KEY=>$branch){
	    if($branch['bf']!=$pathprocess->bf){
	        ?><div id="cancelar" class="button"><a href="<?=ADMIN_FOLDER.$mt?>/list?<?=$_SESSION['navigationtree'][$KEY]['qs']?>&navigation=back">Volver</a></div><?
	        break;
	    }
	}

	//Agrego el boton Agregar
	if ((isset($actions))&&($actions['additem']==1)&&(($tipodepermiso==3)||($tipodepermiso==4))){?>
	    <div id="agregar" class="button" >
	        <a href="<?=$listlink?>/new">Agregar</a>
	    </div>
	<?}
    
    //Agrego el boton Guardar Cambios
    if ((isset($actions['multidelete']))&&($actions['multidelete']==1)&&($tipodepermiso==4)){?>
	    <div id="multidelete" class="button" style="margin-left: 20px;">
	        <a href="javascript: confirm_delete()">Borrar</a>
	    </div>
	<?}

	//Agrego el boton Guardar Cambios
	if ((isset($actions))&&($actions['set_in_list']==1)&&(($tipodepermiso==3)||($tipodepermiso==4))){
    $show_guardar = false;
    foreach($_fields as $field){
    	if($field['set_in_list']){
	        $show_guardar = true;
        }
    }
    if($show_guardar){
    ?>
	    <div id="setinlist" class="button" >
	        <a href="javascript: Set_in_list()">Guardar</a>
	    </div>
	<?}}
    
    //si esta seteado exportar agrego el boton
	if ((isset($actions['import']))&&($actions['import']==1)){?>
            <div id="agregar" class="button" >
	        <a href="<?=$listlink?>/import">Importar</a>
	    </div>
	<? }
        
        //si esta seteado exportar agrego el boton
	if ((isset($actions['export']))&&($actions['export']==1)){?>
            <div id="agregar" class="button" >
	        <a href="<?=$listlink?>/export">Exportar</a>
	    </div>
	<? }
    
    //Agrego el boton Guardar Cambios
    if ((isset($filtercomp)) && (count($filtercomp) > 0)) {?>
	    <div  class="button" >
	        <a href="javascript: void(0)" id="filter-colapse">Filtrar</a>
	    </div>
	<? }
    /*
    if ((isset($actions['papelera']))&&($actions['papelera']==1)&&($tipodepermiso==4)){?>
	    <div id="multidelete" class="button" style="margin-left: 20px;">
	        <a href="<?=$listlink?>/papelera">Papelera</a>
	    </div>
	<?}*/
        
        ?>
        </div>
    </div>
                <?


        //*************************FLITROS**********************************
        include (ABS_PATH."/system/_inc/filtersforlist.php");
        //******************************************************************

        if($sqlfiltro!=""){
            if($vstemporal['parameters']!=''){
                $vstemporal['parameters'].=";";
            }
            $vstemporal['parameters'].=$sqlfiltro;
        }

        $limit = 50;
               
        $page = 0;
        if($_GET['page'] > 1){
            $page = intval($_GET['page']) - 1;
        }
        if($_GET['pagina'] > 1){
            $page = intval($_GET['pagina']) - 1;
        }
        
        $offset = $limit * $page;
        
        $filters_sql = "";
        if(!empty($vstemporal['parameters'])){
            $array = explode(";", $vstemporal['parameters']);
            $vals = array();
            foreach($array as $val){
                $vals[] = str_replace(array(':'), array('='), $val);
            }
            $filters_sql = "WHERE ".implode(' AND ', $vals);
        }
        
        $count = $database->query("SELECT COUNT(*) AS records FROM $maintable $filters_sql")->get();
        $total_rows = $count->row_array[0]['records'];
		
        $args = array();
        foreach($_GET as $key => $val){
            if(!empty($val)){
                if($key != 's'){
                    $args[$key] = "$key=$val";
                }
            }
        }
                
        $pagination = new Pagination();
        $pagination->url = ADMIN_FOLDER.$pathprocess->bf."/list";
        $pagination->page_limit = $limit;
        $pagination->links = 5;
        $pagination->include_dots = 1;
		if(isset($_REQUEST['page'])){
			$pagination->current_page = $input->get('page');	
		}else{
			$pagination->current_page = $input->get('pagina');
		}
        
        $pagination->total_items = $total_rows; 
        $pagination->query_string = implode('&', $args); // viene de _inc/filtersforlist.php
        
        $orden = str_replace('ORDER BY', '', $orden);
        
        if(isset($join) && !empty($join)){
            foreach($join as $ajoin){
                $database->join($ajoin['table'], $ajoin['bridge']);
            }
        }        
        
        $database->parameters($vstemporal['parameters']);
        if($_GET['column']){
            $database->order_by($_GET['column'], $_GET['order']);
        }
        else{
            $database->order_by($orden);
        }
        
        $query = $database->get($maintable, $offset, $limit);
        
        $records = $query->row_array;
        
		$editone = false;
        if($total_rows == 1 && $actions['additem'] == 0){
            $id = $records[0][$maintable."_id"];
            $editone = true;
            include_once(ABS_PATH . "/system/views/" . $module_action['edit']);
            die();
        }
        
        /* old
        $queryForDb=getQueryForDb4($mt,$vstemporal);
        $db = new Database();
        $db->SetQuery($queryForDb,50);
        $db->Pager2();
        $mqs=$db->ExecuteQuery();
         * */
        
        
        ?>

	<div id="container" class="<?=(count($filtercomp)>0)?'hasfilter':''?>">
            <div class="ajaxcontainer">
		<?=$pagination->create_links()?>
            <form action="<?=ADMIN_FOLDER?><?=$pathprocess->bf?>/set_in_list" method="post" name="set_in_list" enctype="multipart/form-data">
	    <table border="0" cellspacing="0" cellpadding="4" align="center" id="listtable">
                <thead>
	        <tr>
	            <?php
	            if ($actions['id'] != 0){
	                ?>
	                <?//Defino el orden para mostrar los datos?>
	                <th class="tablesorter-header 
                            <?
                            if($_GET['column'] == $maintable."_id"){
                                if($_GET['order'] == 'asc'){
                                    echo 'tablesorter-headerSortDown';
                                }
                                else{
                                    echo 'tablesorter-headerSortUp';
                                }
                            }
                            ?>" align="left" width="30">
                            
                            <?
                            $args["column"] = "column=".$maintable."_id";
                            if(!$_GET['order']){
                                $args["order"] =  "order=asc";
                            }
                            else{
                                if($_GET['column'] == $maintable."_id"){
                                    if($_GET['order'] == 'asc'){
                                        $args["order"] =  "order=desc";
                                    }
                                    else{
                                        $args["order"] =  "order=asc";
                                    }
                                }
                                else{
                                    $args["order"] =  "order=asc";
                                }
                            }
                            $get_string = implode('&', $args);
                            ?>
                            
                            <a href="?<?=$get_string?>">ID</a>
	                </th>
	            <? }

	            //Prepara el orden de las columnas (orderby) y les pone t�tulo
                
	            foreach($_fields as $_field){?>
	                <th class=" <?
                            ?>" align="left" <?=in_array($fields[$_field]['fieldcomponent'], $half)?'width="50"':'';?>>
                        <? if(isset($fields)){?>
                            <?
                            $args["column"] = "column=$_field";
                            if(!$_GET['order']){
                                $args["order"] =  "order=asc";
                            }
                            else{
                                if($_GET['column'] == $_field){
                                    if($_GET['order'] == 'asc'){
                                        $args["order"] =  "order=desc";
                                    }
                                    else{
                                        $args["order"] =  "order=asc";
                                    }
                                }
                                else{
                                    $args["order"] =  "order=asc";
                                }
                            }
                            $get_string = implode('&', $args);
                            ?>
                            
                            <a href="?<?=$get_string?>"><?=$fields[$_field]['fieldlabel']?></a>
			<? }else{ ?>
                            <?=str_replace("mail_","",$_field)?>
		        <? } ?>
	            	</th>
	             <?}

	            if (isset($listfilters)) {
	                foreach ($listfilters as $key=>$campo) {?>
	                     <th class="tablesorter-header"><a href="#"><?=$campo[1];?></a></th>
	              <?}
	            }
	            if ($pathprocess->bf !="mail") {
                        if ((isset($actions['view']))&&($actions['view']==1)&&(($tipodepermiso==3)||($tipodepermiso==4))){?>
	                	<th class="control sorter-false" width="50">Ver</th>
	                <?}
	            	if ((isset($actions['edit']))&&($actions['edit']==1)&&(($tipodepermiso==3)||($tipodepermiso==4))){
	            		if ($mt=="consulta")
                        {?>
                            <th class="control" width="50">Responder</th>
                        <?}else{?>
	            			<th class="control sorter-false" width="50"><??></th>
	            		<?}?>
	            	<?}
	            	//Si estoy en el listado de consultas de TOPPER
	            	/*if ($mt=="consulta")
                        {?>
                            <th width="50">FAQ</th><?
                        }*/
                    if ((isset($actions['clone']))&&($actions['clone']==1)&&(($tipodepermiso==3)||($tipodepermiso==4))){?>
                        <th class="control sorter-false" width="50">Clonar</th>
                    <?}
	                if ((isset($actions['delete']))&&($actions['delete']==1)&&($tipodepermiso==4)){?>
	                	<th class="control sorter-false" width="50"><??></th>
	                <?}
                    if ((isset($actions['multidelete']))&&($actions['multidelete']==1)&&($tipodepermiso==4)){?>
	                	<th class="control sorter-false" width="50">
                        	<input id="del-chk" type="checkbox" name="delete[]" value="<?=$mr[$maintable."_id"]?>"/>
                        </th>
	                <?}

	            }
	            if (isset($popup)){
	                for($i=0;$i<count($popup);$i++){ ?>
	                    <th align="center">Ver <?=$popup[$i]?></th>
	                <?}
	            }?>
	        </tr>
                </thead>
                <tbody class="sortable">
		        <? if(count($records)>0){
                    //enlisto todos los datos especificados en el conf
                    foreach($records as $mr){
		        		$seteable=false;?>
			        	<tr id="item_<?=$mr[$maintable."_id"]?>">
	                        <? if ($actions['id'] != 0){ ?>
					        <td align="left">
	                        	<?=intval($mr[$maintable."_id"])?>
	                            <input type="hidden" name="list_ids[]" value="<?=$mr[$maintable."_id"]?>"/>
	                        </td>
                        <?}
				        foreach($_fields as $_field){?>
				            <td align="left">
				            	<?php
				            	if($_field == "config_val"){
				            		printField($_field,$mr[$maintable."_tipo"],$mr,$pathprocess,$fields[$_field]);
				                }
								else{
									echo $mr[$_field];
								}
				            	?>
				            </td>
				    	<?}
				        if (isset($listfilters)){
				            foreach ($listfilters as $key=>$campo){
				                if($campo[0]){
                                                    $linklf=ADMIN_FOLDER.$key."?parameters=".$campo[0].":".$mr[$maintable."_id"];
                                                }
                                                else{
                                                    $linklf=ADMIN_FOLDER.$key;
                                                }
				                if ($campo[1]!='label'){?>
				                	<td align="center"><a href="<?=$linklf?>"><?=$campo[2]?></a></td>
				                <?}else{?>
				                	<td align="center"><a href="<?=$linklf?>"><img src="<?=HTML_PATH?>/system/_img/actions/iconoLupa.png" alt="" width="18" height="18" border="0"></a></td>
				                <?}

				             }
				        }
                                        if ((isset($actions['view']))&&($actions['view']==1)&&(($tipodepermiso==3)||($tipodepermiso==4))){
				            ?><td align="center"><a class="view-icon" href="<?=$listlink?>/view?<?=$maintable?>_id=<?=$mr[$maintable."_id"]?>"></a></td><?
				        }
				        if ((isset($actions['edit']))&&($actions['edit']==1)&&(($tipodepermiso==3)||($tipodepermiso==4))){
				            ?><td align="center"><a class="edit-icon" title="Editar" href="<?=$listlink?>/edit?<?=$maintable?>_id=<?=$mr[$maintable."_id"]?>"></a></td><?
				        }
                        if ((isset($actions['clone']))&&($actions['clone']==1)&&(($tipodepermiso==3)||($tipodepermiso==4)))
                        {?>
                            <td align="center"><a class="del-icon" title="Borrar" href="javascript:clone_confirm('<?=$listlink?>/clone?<?=$maintable?>_id=<?=$mr[$maintable."_id"]?>&clone=Y')"></a></td><?
                        }
				        if ((isset($actions['delete']))&&($actions['delete']==1)&&($tipodepermiso==4)){
				            ?><td align="center">
                            <? if(isset($actions["papelera"]) && ($actions["papelera"] == 1)){ ?>
                            <a class="del-icon" title="Borrar" href="javascript:fcn_deleteconfirm('<?=$listlink?>/actions?id=<?=$mr[$maintable."_id"]?>&accion=papelera');"></a>
                            <? } else { ?>
                            <a class="del-icon" title="Borrar" href="javascript:fcn_deleteconfirm('<?=$listlink?>/actions?iddel=<?=$mr[$maintable."_id"]?>&accion=d');"></a>
                            <? } ?>
                            </td><?
				        }
						if ((isset($actions['multidelete']))&&($actions['multidelete']==1)&&($tipodepermiso==4)){
				            ?>
                            <td align="center">
                            <input class="del-chk" type="checkbox" name="delete[]" value="<?=$mr[$maintable."_id"]?>"/> <!-- Accion en set_in_list -->
                            </td><?
				        }


			        ?></tr>
			    <?}
                        }?>
		    
                </tbody>
		</table>
                </form>
		<?=$pagination->create_links()?>
        </div>
    </div>
</div>

<?include(ABS_PATH."/system/views/footer.php")?>

<script type="text/javascript">
function Set_in_list(){
	document.set_in_list.submit();
}
function confirm_delete(){
	var result =confirm("¿Está seguro que desea borrar los elementos seleccionados?");
	if (result==true){
	  document.set_in_list.submit();
	}	
}
</script>