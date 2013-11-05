<?
/*****************************************************
*   actions.php:                                     *
*	Gestiona todas las acciones que requieren    *
*		ser reflejadas en la base de datos.  *
*****************************************************/

if(isset($_POST[$maintable."_id"])){ //Si se envi� el ID, la acci�n es EDITAR
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

    //POSICION DEL ARRAY PARA LA CONSULTA DE LA TABLA PADRE
    $arrayquery[$maintable]="";
    //POSICIONES DEL ARRAY PARA LAS CONSULTAS DE LAS TABLAS HIJAS
    if(isset($secondarytable)){
	    foreach($secondarytable as $table){
		$arrayquery[$table]="";
	    }
    }

            foreach($_POST as $key => $val){
		//si existe el campo en el form
		    if(isset($fields[$key]['fieldcomponent'])) {
			    if(isset($_REQUEST[$key])){
                                $value=$_REQUEST[$key];
			    }
                            
                            if($fields[$key]['calluserfunc']){
                                $function = $fields[$key]['calluserfunc']['function'];
                                $condition = $fields[$key]['calluserfunc']['condition'];
                                if($fields[$key]['calluserfunc']['args']){
                                    $args = $fields[$key]['calluserfunc']['args'];
                                }
                                else{
                                    $args = array();
                                }
                                $args['data'] = array('id' => $_REQUEST[$maintable.'_id']);
                                
                                if(function_exists($function)){
                                    if($condition){
                                        $condition = eval($condition);
                                        if($condition){
                                            call_user_func_array($function, $args);
                                        }
                                    }
                                }
                            }
                            
                            if(($_REQUEST[$key] != $old[$key]) && ($old != false) && isset($fields[$key]['onchange'])){
                                $change_qr = $fields[$key]['onchange'];
                                foreach($old as $key => $val){
                                    $change_qr = str_replace("{".$key."}", $val, $change_qr);
                                }
                                mysql_query($change_qr) or die(mysql_error());
                            }
                            
                            $skip = false;
                            
                            if(($old != false) && ($fields[$key]['insertonly'] == true)){
                                unset($fields[$key]['fieldcomponent']);
                                $skip = true;
                            }
                            
			    //si esta seteada la configuracion para levantar los tipos de campos
			    if (isset($fields[$key]['fieldcomponent'])){
				    switch($fields[$key]['fieldcomponent']){
					case 'fecha':
					    $mainquery=sprintf($key."='%s-%s-%s'",
					                mysql_real_escape_string($_REQUEST[$key."_anio"]),
					                mysql_real_escape_string($_REQUEST[$key."_mes"]),
					                mysql_real_escape_string($_REQUEST[$key."_dia"])
					            );
					break;

					case 'calendario':
					    $fechaCalendario=explode('/',$_REQUEST[$key]);
					    $mainquery=sprintf($key."='%s-%s-%s'",
					                mysql_real_escape_string($fechaCalendario[2]),
					                mysql_real_escape_string($fechaCalendario[1]),
					                mysql_real_escape_string($fechaCalendario[0])
					            );
					break;

					case 'horas':
					     $mainquery=sprintf($key."='%s:%s'",
					    		mysql_real_escape_string($_REQUEST[$key."_hora"]),
							mysql_real_escape_string($_REQUEST[$key."_min"])
					    	    );
				        break;
                                    
                                        case 'password':
                                            if(strlen($_REQUEST[$key]) > 0){
                                            	$encode_key = $config->get('encode_key');
                                                $pass = encrypt($_REQUEST[$key], $encode_key);
                                                $mainquery = $key."='$pass'";
                                            }
				        break;

                    case 'multiselect':
					case 'tags':
				            //se divide en dos los valores, cada uno representa una tabla
							$relationtable = explode("-",$key);
				            //creo una variable llamada secondaryquery que va a trabajar de manera independiente con respecto a mainquery
				            if(!isset($secondaryquery)){
				                $secondaryquery=array();
				            }
				            /*por default, la primer query va a ser de borrado de registros de la tabla relacional con respecto a un c�digo
				            como el c�digo no se conoce, se agrega un &&& que luego sera reemplazado
				            */
							if($fields[$key]['options']['invert']){
								$secondaryquery[] = 'DELETE FROM rel_'.$relationtable[0].$relationtable[1].' where fk_'.$relationtable[1].'_id = &&&;';
							}
							else{
								$secondaryquery[] = 'DELETE FROM rel_'.$relationtable[0].$relationtable[1].' where fk_'.$relationtable[0].'_id = &&&;';
							}
							
				            if (isset($_POST[$key])){
				                //si hay checkboxes checkeados, entro a recorrer sus c�digos
				                foreach($_POST[$key] as $index => $valor){
				                	
									if($index == "0"){
										foreach($_POST[$key]['0'] as $valor){
											mysql_query("INSERT INTO ".$relationtable[1]." SET ".$relationtable[1]."_nombre = '$valor'");
											$valor = mysql_insert_id();
											$secondaryquery[] = 'INSERT INTO rel_'.$relationtable[0].$relationtable[1].' SET fk_'.$relationtable[0].'_id = &&& , fk_'.$relationtable[1].'_id ='.$valor.";";
										}
									}
                                    else{
				                       //se le agrega por cada indice del array, una query de inserci�n, nuevamente se agrega un &&& en el c�digo
										if($fields[$key]['options']['invert']){
											$secondaryquery[] = 'INSERT INTO rel_'.$relationtable[0].$relationtable[1].' SET fk_'.$relationtable[1].'_id = &&& , fk_'.$relationtable[0].'_id ='.$valor.";";
									   	}
									   else{
									   		$secondaryquery[] = 'INSERT INTO rel_'.$relationtable[0].$relationtable[1].' SET fk_'.$relationtable[0].'_id = &&& , fk_'.$relationtable[1].'_id ='.$valor.";";
									   }
                                    }
				                }
				            }
				        break;
					case 'listamultiple':
						$sec=explode("_",$key);
						$sec_table=$sec[1];
						$listado=$_REQUEST[$key];
						$liststring="";
						if(is_array($listado)){
							foreach($listado as $item){
								$str_sql="SELECT * FROM ".$sec_table." WHERE ".$sec_table."_id='".$item."'";
								$query=mysql_query($str_sql);
								$rowtemp=mysql_fetch_array($query);
								if($liststring!="")
									$liststring.="-";

								if(isset($rowtemp[$sec_table."_nombre"]))
									$liststring.=$rowtemp[$sec_table."_nombre"];
								else
									$liststring.=$rowtemp[$sec_table."_name"];

							}
							$mainquery=$key."='".$liststring."'";
						}
					break;

				        case "settexto":
					break;

				        case "bases":
				            $value=implode(",",$value);
				            $mainquery=sprintf($key."='%s'", mysql_real_escape_string($value));
				        break;

				        case "file":
                                            $field = explode('_', $key);
                                            if($field[0]=='fk'){
                                                $i = 0;
                                                foreach($_REQUEST[$key] as $value){
                                                    if(!empty($value)){
                                                        $subinserts[$i]['primary'] = "fk_".$maintable."_id";
                                                        $subinserts[$i]['secondary'] = $fields[$key]['secondary'];
                                                        $subinserts[$i]['sql'] = "INSERT INTO ".$fields[$key]['secondary']." (fk_".$maintable."_id, ".$fields[$key]['secondary']."_archivo) VALUES ('{inserted_id}', '$value')";
                                                        $i++;
                                                    }
                                                }
                                            }
                                            else{
                                                $value=$_REQUEST[$key][count($_REQUEST[$key])-1];
                                                $mainquery=sprintf($key."='%s'", html_entity_decode($value));
                                            }

				        break;

				        case "imagen":
                                            $field = explode('_', $key);
                                            if($field[0]=='fk'){
                                                $i = 0;
                                                if(count($_REQUEST[$key])>0){
                                                    $secundaria = $fields[$key]['options']['secondary'];
                                                    if(!empty($secundaria)){
                                                        $maintable_id = intval($_POST[$maintable."_id"]);
                                                        $prev_qr = mysql_query("SELECT * FROM $secundaria WHERE fk_".$maintable."_id = '$maintable_id'");
                                                        $previous = array();
                                                        while($row = mysql_fetch_assoc($prev_qr)){
                                                            $previous[] = $row[$secundaria.'_imagen'];
                                                        }
                                                    }
                                                    
                                                    $added = array();
                                                    foreach($_REQUEST[$key] as $value){
                                                        if(!empty($value)){
                                                            $added[] = $value;
                                                        }
                                                    }
                                                    
                                                    $delete = array_diff($previous, $added);
                                                    foreach($delete as $value){
                                                        mysql_query("DELETE FROM $secundaria WHERE ".$secundaria."_imagen = '$value'");
                                                    }
                                                    
                                                    foreach($_REQUEST[$key] as $index => $value){
                                                        $nombre = $_REQUEST[$key.'_nombre'][$index];
                                                        $orden = $_REQUEST[$key.'_orden'][$index];
                                                            
                                                        if(!in_array($value, $previous)){
                                                            $subinserts[$i]['primary'] = "fk_".$maintable."_id";
                                                            $subinserts[$i]['secondary'] = $fields[$key]['options']['secondary'];
                                                            $subinserts[$i]['sql'] = "INSERT INTO ".$fields[$key]['options']['secondary']." (fk_".$maintable."_id, ".$fields[$key]['options']['secondary']."_nombre, ".$fields[$key]['options']['secondary']."_orden, ".$fields[$key]['options']['secondary']."_imagen) VALUES ('{inserted_id}', '$nombre', '$orden','$value')";
                                                            $i++;
                                                        }
                                                        else{
                                                            mysql_query("UPDATE ".$fields[$key]['options']['secondary']." SET 
                                                                ".$fields[$key]['options']['secondary']."_nombre = '$nombre',
                                                                ".$fields[$key]['options']['secondary']."_orden = '$orden' 
                                                                WHERE ".$fields[$key]['options']['secondary']."_imagen = '$value' 
                                                            ");
                                                        }
                                                    }
                                                }
                                            }
                                            else{
                                                $value=$_REQUEST[$key][count($_REQUEST[$key])-1];
                                                $mainquery=sprintf($key."='%s'", html_entity_decode($value));
                                            }
				        break;
                                        
                                        case 'tinymce':
                                            $mainquery=sprintf($key."='%s'", html_entity_decode(mysql_real_escape_string($value)));
                                            break;
										case 'mapa':
                                            $mainquery=sprintf($key."lat = '%s',".$key."lon = '%s'",
												mysql_real_escape_string($_REQUEST[$key."lat"]),
												mysql_real_escape_string($_REQUEST[$key."lon"])
											);
                                            break;

					default:
                                            $mainquery=sprintf($key."='%s'", html_entity_decode($value));
					break;

				    }
			    }
                            else{
                                if(isset($_REQUEST[$key]) && $skip == false){
                                    $mainquery=sprintf($key."='%s'", html_entity_decode($value));
				}
			    }
		    }
                    unset($value);
                    
            //SEGUN DE QUE TABLA SEA EL CAMPO LO INSERTA EN UNA QUERY O OTRA
            if((isset($mainquery))&&($mainquery!='')){
                if(isset($fields[$key]['fieldtable'])){
                    if($arrayquery[$fields[$key]['fieldtable']]!='') $arrayquery[$fields[$key]['fieldtable']].=", ";
                    $arrayquery[$fields[$key]['fieldtable']].=$mainquery;
                }else{
                    if($arrayquery[$maintable]!='') $arrayquery[$maintable].=", ";
                    $arrayquery[$maintable].=$mainquery;
                }
            }
            unset($mainquery);
        }
    
    //Aplica clonar para topper
    if(($_POST[$maintable."_id"]=='0')||((isset($_REQUEST['clonar']))&&($_REQUEST['clonar']=="yes"))){
	    //echo "INSERT INTO ".$maintable." SET ".$arrayquery[$maintable];
        $arrayquery[$maintable]="INSERT INTO ".$maintable." SET ".$arrayquery[$maintable];
	    $action="new";
    }else{
	    $arrayquery[$maintable]="UPDATE ".$maintable." SET ".$arrayquery[$maintable]." WHERE ".$maintable."_id=".$_POST[$maintable."_id"];
	    $action="edit";
	    $id=$_POST[$maintable."_id"];
    }
    //armar redireccion
    //var_dump($arrayquery);
    if(mysql_query($arrayquery[$maintable])){
	    if(($_POST[$maintable."_id"]=='0')||((isset($_REQUEST['clonar']))&&($_REQUEST['clonar']=="yes"))){
            $id=mysql_insert_id();
        }
        foreach($arrayquery as $querytable => $querysql){
            if($querytable!=$maintable){
                mysql_query("DELETE FROM $querytable WHERE fk_".$maintable."_id=$id");
                mysql_query("INSERT INTO $querytable SET fk_".$maintable."_id=$id, $querysql");
            }
        }
        //solo se realiza si existe el multicheck
        if(isset($secondaryquery)){
            for ($j=0;$j<=count($secondaryquery)-1;$j++){
                //recorro los registros y ejecuto las querys, se reemplaza el &&& por el c�digo
                //echo $secondaryquery[$j];
                $secondaryquery[$j] = str_replace("&&&",$id,$secondaryquery[$j]);
                mysql_query($secondaryquery[$j]);
            }
        }
	    /*PROCESO DE ARCHIVOS*/
	    foreach($_FILES as $key=>$value){
		    //key es el nombre del campo
		    //value trae tmp_name - name - type - error - size
		    if (isset($fields[$key]['fieldcomponent'])){
			    $ext=explode(".",$value['name']);
			    $newname=$key."_".$id."_".time().".".$ext[count($ext)-1];
                switch($fields[$key]['fieldcomponent']){
				    case 'imagen':
	                    if ((isset($fields[$key]['crop']))&&($fields[$key]['crop']!="")){
	                        $ban = create_resized_copies($value['tmp_name'],UPLOAD_PATH."/".$newname,$fields[$key]['crop']."|o|x900|x100y100");
	                    }else{
	                        $ban = create_resized_copies($value['tmp_name'],UPLOAD_PATH."/".$newname,"o|x900|x100y100");
	                    }
	                    if ($ban){
	                        mysql_query("UPDATE ".$maintable." SET ".$key."='".$newname."' where ".$maintable."_id=$id");
	                    }
                    break;
                    case 'file':
                    	if((isset($fields[$key]['originalname']))&&(strtoupper($fields[$key]['originalname'])=='Y')){
                    		//parche 7-5-2010 no cambiar nombre a files
			        		$newname=$value['name'];
                    	}
	                    $ban = move_uploaded_file($value['tmp_name'],UPLOAD_PATH."/".$newname);
	                    if ($ban){
							mysql_query("UPDATE ".$maintable." SET ".$key."='".$newname."' where ".$maintable."_id=$id");
						}
	                    break;
					    default:
					    move_uploaded_file($value['tmp_name'],UPLOAD_PATH."/".$newname);
					break;
			    }

		    }
	    }
        if (isset($_SESSION['ultimabusqueda'][$pathprocess->bf])){
            $redirect=ADMIN_FOLDER.$pathprocess->bf."?parameters=".$_SESSION['ultimabusqueda'][$pathprocess->bf];
        }else{
            $redirect=ADMIN_FOLDER."".$pathprocess->bf;
        }
        if (isset($_SESSION['ultimojoin'][$pathprocess->bf])){
            $redirect=ADMIN_FOLDER."".$pathprocess->bf."?join=".$_SESSION['ultimojoin'][$pathprocess->bf];
        }
    }else{
	    echo mysql_error();
	    $msg=$cfg_actionerror;
	    $redirect=ADMIN_FOLDER."/".$pathprocess->bf."/".$action;
	    if($action=='edit'){
		    $redirect.="?".$pathprocess->bf."_id=".$_POST[$pathprocess->bf."_id"];
	    }
    }
}elseif(isset($_REQUEST['iddel'])){
    $id = $_REQUEST['iddel'];
    foreach($fields as $KEY=>$fie){
        if(($fie[1]=='file')||($fie[1]=='imagen')){
            $qs=mysql_query("SELECT * FROM ".$maintable." WHERE ".$maintable."_id=".$id.";");
            $row_del=mysql_fetch_array($qs);
            if($fie[1]=='file'){
               unlink(ABS_PATH."/upload/".$row_del[$maintable."_file"]);
            }
            if($fie[1]=='imagen'){
                $crops=explode('|',$fie[3]['crop']);
                foreach($crops as $KEY=>$dir){
                   unlink(ABS_PATH."/upload/".$dir."/".$row_del[$maintable."_image"]);
               }
            }
        }
    }
    $mainquery='Delete from '.$maintable.' where '.$maintable.'_id='.$id.';';
    mysql_query($mainquery);
    if (isset($childtables))
    {
        for ($i=0;$i<=count($childtables)-1;$i++)
        {
            $query='Delete from '.$childtables[$i].' where '.$maintable.'_id='.$id.';';
            mysql_query($query);
        }
    }

    $redirect=ADMIN_FOLDER."".$pathprocess->bf;
        if (isset($_SESSION['ultimabusqueda'][$pathprocess->bf]))
        {
            $redirect=ADMIN_FOLDER."".$pathprocess->bf."?parameters=".$_SESSION['ultimabusqueda'][$pathprocess->bf];
        }
        else
        {
            $redirect=ADMIN_FOLDER."".$pathprocess->bf;
        }

}elseif(isset($_REQUEST['filefield'])){
    $id = $_REQUEST['id'];
    $sql=mysql_query("UPDATE ".$maintable." SET ".$_REQUEST['filefield']." = '' where ".$maintable."_id=".$id.";");
    unlink(ABS_PATH."/upload/".$_REQUEST['value']);
    $redirect=ADMIN_FOLDER."".$pathprocess->bf."/edit?".$pathprocess->bf."_id=$id";
}else{
      // echo mysql_error();
       $msg="No ha seleccionado una opci�n valida";
       $redirect=ADMIN_FOLDER."".$pathprocess->bf;
}


		/*****************************************************
		 * MANEJO DE RESTRICCIONES PARA USUARIOS DE SISTEMA
		 *****************************************************/
		if((isset($_POST[$maintable."_id"]))&&($_POST[$maintable."_id"]!=0)){
				$userid=$_POST[$maintable."_id"];
		}else{
				$userid=mysql_insert_id();
		}
	$sqlsecciones=mysql_query("SELECT * FROM menuadmin");
		while ($rowsecciones=mysql_fetch_array($sqlsecciones)) {
			$permisodeseccion=(isset($_REQUEST[$rowsecciones['menuadmin_id']."_permiso"]))?$_REQUEST[$rowsecciones['menuadmin_id']."_permiso"]:1;
			if((isset($_POST[$maintable."_id"]))&&($_POST[$maintable."_id"]!=0)){
				$tienepermiso=mysql_query("SELECT * FROM rel_usuariomenuadmin WHERE fk_usuario_id=".$userid." AND fk_menuadmin_id=".$rowsecciones['menuadmin_id'])  or die("302:".mysql_error());
			}
			if((isset($_POST[$maintable."_id"]))&&($_POST[$maintable."_id"]!=0)&&(mysql_num_rows($tienepermiso)>0)){
				$guardorestriccion=mysql_query("UPDATE rel_usuariomenuadmin SET fk_tipopermiso_id=".$permisodeseccion." WHERE fk_usuario_id=".$userid." AND fk_menuadmin_id=".$rowsecciones['menuadmin_id']) or die("305:".mysql_error());
			}else{
				$guardorestriccion=mysql_query("INSERT INTO rel_usuariomenuadmin SET fk_usuario_id='".$userid."', fk_menuadmin_id='".$rowsecciones['menuadmin_id']."', fk_tipopermiso_id='".$permisodeseccion."'") or die("307:".mysql_error());
			}
        }
        /*******************************************************
		 * FIN MANEJO DE RESTRICCIONES PARA USUARIOS DE SISTEMA
		 *******************************************************/

?>
<script type="text/javascript">
<?if((isset($msg))&&($msg!='')){?>
alert("<?=$msg?>");
<?}?>
document.location="<?=$redirect?>";
</script>
