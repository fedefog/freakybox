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
        }?> - Papelera</h1>

	<div class="clearfix" style="width:100%"></div>
	<div id="subbotonera" >
	<?//Agrego el boton de Volver?>
    <div id="cancelar" class="button" style="margin-left:20px;"><a href="<?=ADMIN_FOLDER.$mt?>/list?<?=$_SESSION['navigationtree'][$KEY]['qs']?>&navigation=back">Volver</a></div>
	<?
    
	//Agrego el boton Guardar Cambios
    if ($tipodepermiso==4){?>
	    <div id="multidelete" class="button" style="margin-left: 20px;">
	        <a href="javascript: confirm_restore()">Restaurar</a>
	    </div>
	<?}
    
    //Agrego el boton Guardar Cambios
    if ((isset($actions['multidelete']))&&($actions['multidelete']==1)&&($tipodepermiso==4)){?>
	    <div id="multidelete" class="button" style="margin-left: 20px;">
	        <a href="javascript: confirm_delete()">Borrar</a>
	    </div>
	<?}
        
        ?>
    </div>
    </div>
                <?


        //*************************FLITROS**********************************
        include (ABS_PATH."/system/_inc/filtersforlist.php");
        //******************************************************************

		$sqlfiltro=$mt."_papelera = '1'";
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
			$vstemporal['parameters'] = $vstemporal['parameters'].";".$mt."_papelera:1";
		}
		else{
			$vstemporal['parameters'] = $mt."_papelera:1";
		}
        if(!empty($vstemporal['parameters'])){
            $array = explode(";", $vstemporal['parameters']);
            $vals = array();
            foreach($array as $val){
                $vals[] = str_replace(array(':'), array('='), $val);
            }
            $filters_sql = "WHERE ".implode(' AND ', $vals);
        }
        
        $count = $database->query("SELECT COUNT(*) AS records FROM $maintable $filters_sql")->get();
        
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
        
        $pagination->total_items = $count->row_array[0]['records']; 
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
        
        if($count->row_array[0]['records'] == 1 && $actions['additem'] == 0){
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
            <input class="formaction" type="hidden" name="force_delete" value="1"/>
	    <table border="0" cellspacing="0" cellpadding="4" align="center" id="listtable">
                <thead>
	        <tr>
	            <?$order=split(":",$_GET['order']);
	            if($order[1]=="DESC"){$src="go-down.png";}else{$src="go-up.png";}

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
	            <?}

	            //Prepara el orden de las columnas (orderby) y les pone t�tulo
	            foreach($_fields as $_field){?>
	                <th class="tablesorter-header <?
                        if($_GET['column'] == $_field){
                            if($_GET['order'] == 'asc'){
                                echo 'tablesorter-headerSortDown';
                            }
                            else{
                                echo 'tablesorter-headerSortUp';
                            }
                        }
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
			<?}else{?>
                            <?=str_replace("mail_","",$_field)?>
		        <?}?>
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
		        <?
                        if(count($records)>0){
                            //enlisto todos los datos especificados en el conf
                            foreach($records as $mr){
		        	$seteable=false;?>
			        <tr id="item_<?=$mr[$maintable."_id"]?>">
                                        <? if ($actions['id'] != 0){ ?>
				        <td align="left">
                                            <?=stripslashes($mr[$maintable."_id"])?>
                                            <?if($seteable){?>
                                            <input type="hidden" name="list_ids[]" value="<?=$mr[$maintable."_id"]?>"/>
                                            <?}?>
                                        </td>
                                        <?}
				        foreach($_fields as $_field){?>

				            <td align="left"><?
				            if($fields[$_field]['listfields']){
				                $doscampos=explode(";;",$fields[$_field]['listfields']);
				            }else{
				                $doscampos=array($_field);
				            }

				            foreach($doscampos as $campos){
				                if(substr($campos,0,3)=='fk_'){
				                    $table=str_replace("fk_","",$campos);
				                    $table=str_replace("_id","",$table);
				                    $qsfk=getItem($table,$table.'_id',$mr[$campos]);
				                    if(isset($fields[$_field]['linkeable']))
				                    	echo "<a href='".ADMIN_FOLDER."/".$table."/edit?opportunity_id=".$qsfk[$table."_id"]."'>".stripslashes($qsfk[$table."_nombre"])."</a>";
				                    else
				                    	echo stripslashes($qsfk[$table."_nombre"]);
				                }elseif($fields[$_field]['fieldcomponent']=="multiselect"){
				                	$rel=explode('-',$campos);
				                	$sql = 'SELECT fk_'.$rel[1].'_id from rel_'.$rel[0].$rel[1].' where fk_'.$rel[0].'_id = '.$mr[$rel[0].'_id'];
				                	$resultado = mysql_query($sql);
				                	$listasel="";
					                while ($recordset = mysql_fetch_array($resultado)){
					                	if($listasel!="")
					                		$listasel.=", ";
						                $sql2 = 'SELECT '.$rel[1].'_nombre from '.$rel[1].' where '.$rel[1].'_id = '.$recordset['fk_'.$rel[1].'_id'];
						                $resultado2 = mysql_query($sql2);
						                $nombresel = mysql_fetch_array($resultado2);
						                $listasel.=$nombresel[$rel[1].'_nombre'];
						            }
						            echo $listasel;
                                                }
                                                elseif($fields[$_field]['fieldcomponent']=="imagen"){
				                	if(($mr[$_field]!='')&&(file_exists(ABS_PATH."/upfiles/x50y50/".$mr[$_field]))){?>
                                                            <a href="<?=uploaded_path($mr[$_field]);?>" rel="shadowbox"><img src="<?=uploaded_path($mr[$_field], 'x50y50');?>" border="0" width="50" height="50" /></a>
                                                        <?}
				                }
                                                elseif($fields[$_field]['fieldcomponent']=="boolint"){
                                                    echo ($mr[$_field] == 1) ? 'Si' : 'No';
                                                }
                                                elseif($fields[$_field]['fieldcomponent']=="boolean"){
                                                    echo ($mr[$_field] == 1) ? 'Si' : 'No';
                                                }
                                                elseif($fields[$_field]['fieldcomponent']=="radio"){
                                                    if ($fields[$_field]['set_in_list']=='Y' || $fields[$_field]['set_in_list']==1){
                                                        printField($_field,$fields[$_field]['fieldcomponent'],$mr,$pathprocess,$fields[$_field]);
				                    	$seteable=true;
                                                    }
                                                    else{
                                                        echo $fields[$_field]['options'][$mr[$_field]];
                                                    }
                                                }
                                                elseif($fields[$_field]['fieldcomponent']=="calendario"){
                                                    echo date('d/m/Y', strtotime($mr[$_field]));
				                }else{
				                    if(isset($fields[$_field]['listformat'])){
				                        switch($fields[$_field]['listformat']){
				                            case "dd/mm/yyyy":
				                                $sp1=explode(" ",$mr[$campos]);
				                                $sp2=explode("-",$sp1[0]);
				                                echo $sp2[2]."/".$sp2[1]."/".$sp2[0];
				                            break;
				                            default:
				                                echo stripslashes($mr[$campos]);
				                            break;
				                        }
				                    }elseif ($fields[$_field]['set_in_list']=='Y' || $fields[$_field]['set_in_list']==1){
				                    	$tipo=$fields[$_field]['fieldcomponent'];
				                    	printField($_field,$tipo,$mr,$pathprocess,$fields[$_field]);
				                    	$seteable=true;
				                    }else
				                        echo '<span item="'.$mr[$maintable."_id"].'" field="'.$campos.'" class="editable">'.stripslashes($mr[$campos]).'</span>';
				                }
				                echo "&nbsp;";
				            }
							?></td>
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
				        
				        if ((isset($actions['delete']))&&($actions['delete']==1)&&($tipodepermiso==4)){
				            ?><td align="center"><a class="del-icon" title="Borrar" href="javascript:fcn_deleteconfirm('<?=$listlink?>/actions?iddel=<?=$mr[$maintable."_id"]?>&accion=d');"></a></td><?
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
function confirm_restore(){
	var result =confirm("¿Está seguro que desea restaurar los elementos seleccionados?");
	if (result==true){
	  $('.formaction').attr('name', 'force_restore');
	  document.set_in_list.submit();
	}	
}
function confirm_delete(){
	var result =confirm("¿Está seguro que desea borrar los elementos seleccionados?");
	if (result==true){
		$('.formaction').attr('name', 'force_delete');
	  document.set_in_list.submit();
	}	
}
</script>