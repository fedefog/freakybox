<?php
/*****************************************************
*   base-printfield.php:                             *
*        Es el encargado de imprimir correctamente   *
*	    los campos de acuerdo a su tipo.         *
*****************************************************/

function printField($field_name,$field_component,$row,$pathprocess='',$extra=''){
	global $config;
    global $maintable;
	
	$id = 0;
	if(!empty($row[$maintable.'_id'])){
		$id = $row[$maintable.'_id'];
	}
	
    switch($field_component){
	/*TEXTO*/
        case 'texto':?>
        	<?
        	$table = $maintable;
			$column = $field_name;
        	if($extra['options']['table']){
        		$table = $extra['options']['table'];
        	}
			if($extra['options']['column']){
        		$column = $extra['options']['column'];
        	}
			?>
            <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" class="texto <?=build_rules($extra['validation'])?> <?=($extra['options']['autocomplete'])?'autocomplete':''?>" table="<?=$table?>" column="<?=$column?>" value="<?=htmlentities($row[$field_name], ENT_QUOTES, 'UTF-8')?>" />
            <?
        break;
        
        case 'numero':?>
            <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" class="numero <?=build_rules($extra['validation'])?>" value="<?=$row[$field_name]?>"/>
            <?
        break;
		
		case 'orden':?>
            <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" class="numero orden <?=build_rules($extra['validation'])?>" value="<?=$row[$field_name]?>" min="<?=$extra['options']['min']?>" max="<?=$extra['options']['max']?>"/>
            <?
        break;
    
        case 'natural':?>
            <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" class="natural <?=build_rules($extra['validation'])?>" value="<?=$row[$field_name]?>"/>
            <?
        break;
    
        case 'decimal':?>
            <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" class="decimal <?=build_rules($extra['validation'])?>" value="<?=$row[$field_name]?>" placeholder="0.00" />
            <?
        break;
    
        case 'email':?>
            <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" class="email <?=build_rules($extra['validation'])?>" value="<?=$row[$field_name]?>" placeholder="usuario@gmail.com"/>
            <?
        break;
    
        case 'url':?>
            <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" class="url <?=build_rules($extra['validation'])?>" value="<?=$row[$field_name]?>" placeholder="http://www.google.com"/>
            <?
        break;

        case 'slug':?>
        	<? $val = !empty($row[$field_name]) ? $row[$field_name] : $extra["default"];?>
            <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" value="<?=stripslashes($val)?>" placeholder="texto-de-ejemplo"/>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("<?=$extra["listenfield"]?>").change(function(){
                        var fields = "<?=$extra["listenfield"]?>";
                        fields = fields.split(',');

                        var fks = new Array();

                       $.each(fields, function(index, value) {
                           var fk = this.replace(/^\s+/g,'').replace(/\s+$/g,'');
                           if(fk.substring(1,3) == "fk"){
                               fks[index] = $(fk+" option[value='"+$(fk).val()+"']").text().replace(/^\s+/g,'').replace(/\s+$/g,'');
                           }
                           else{
                               fks[index] = $(fields[index]).val().replace(/^\s+/g,'').replace(/\s+$/g,'');
                           }
                       });

                        $.ajax({
                           type: "POST",
                           url: "<?=HTML_PATH?>/system/_ajax/functions.php",
                           data: "function=slug&str="+fks.join('-'),
                           success: function(msg){
                             $("#<?=$field_name?>").val(msg);
                           }
                         });
                    });
                });
            </script>
            <?
        break;

	/*PASSWORD*/
        case 'password':?>
        	<?
        	$password = "";
			$encode_key = $config->get('encode_key');
        	if(function_exists('mcrypt_decrypt') && !empty($encode_key) && !empty($row[$field_name])){
        		$password = decrypt($row[$field_name], $encode_key);
			}
			?>
            <input type="password" name="<?=$field_name?>" id="<?=$field_name?>" value="<?=$password?>" class="password"/>
            <input type="checkbox" class="showpass"/><span style="width:110px;" class="label"> Mostrar contraseña</span>
            <?
        break;
		
		case 'tabla':?>
        	<?
        	$columns = $extra['options']['columns'];
			$labels = $extra['options']['labels'];
			$modify = $extra['options']['modify'];
			$textarea = $extra['options']['textarea'];
			$records = json_decode($row[$field_name]);
			
			if(count($labels) > 0){
				$rows = count($labels)+1;
			}
			else{
				$rows = count($records);
			}
			?>
			<table class="multirow">
				<tbody>
					<tr class="head">
						<? foreach($columns as $column){ ?>
						<td><?=$column?></td>
						<? } ?>
						<? if($modify !== false){ ?>
						<td class="control"><a class="addrow" href="#" title="Agregar Fila">Agregar</a></td>
						<? } ?>
					</tr>
					<? if($row[$field_name]){ ?>
						<? for($r = 1; $r < $rows; $i++){ ?>
						<tr class="<?=($r == 1)?'clonerow':''?>">
							<? for($c = 0; $c < count($columns); $c++){ ?>
							<td>
								<? if(count($labels) > 0){?>
									<label><?php echo $labels[$r-1]?></label>
								<? } ?>
								<? if($textarea == false){ ?>
								<input type="text" name="<?=$field_name?>[]" value="<?=$records[$r][$c]?>"/>
								<? }else{ ?>
								<textarea name="<?=$field_name?>[]"><?=$records[$r][$c]?></textarea>
								<? }?>
							</td>
							<? $f++; ?>
							<? } ?>
							<? if($modify !== false){ ?>
							<td class="control"><a class="remrow" href="#" title="Borrar Fila">Borrar</a></td>
							<? } ?>
						</tr>
						<? $r++; } ?>
					<? }else{ ?>
						<tr class="clonerow">
							<? foreach($columns as $column){ ?>
							<td>
								<? if(count($labels) > 0){?>
									<label><?php echo $labels[0]?></label>
								<? } ?>
								<? if($textarea == false){ ?>
								<input type="text" name="<?=$field_name?>[]"/>
								<? }else{ ?>
								<textarea name="<?=$field_name?>[]"></textarea>
								<? }?>
							</td>
							<? } ?>
							<? if($modify !== false){ ?>
							<td class="control"><a class="remrow" href="#" title="Borrar Fila">Borrar</a></td>
							<? } ?>
						</tr>
					<? } ?>
					
				</tbody>
			</table>
            <?
        break;
		
	case 'carrito':
			$cart = json_decode($row[$field_name], true);
			$subtotal = 0;
			$labels = $extra['options']['labels'];
			$tables = array();
			foreach($cart as $item){
				foreach($item['options'] as $key => $val){
					$tables[$key] = $key;
				}
			}
			$values = array();
			foreach($tables as $table => $result){
				$items = getResult("SELECT * FROM $table");
				if(count($items) > 0){
					foreach($items as $item){
						$values[$table][$item[$table."_id"]] = $item[$table."_nombre"];
					}
				}
			}
			?>
			<table class="carrito">
				<thead>
					<tr>
						<td>ID</td>
						<td>Código</td>
						<td>Nombre</td>
						<td>Cantidad</td>
						<td>Precio</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($cart as $item){ ?>
					<?php $subtotal =+ floatval($item['price']); ?>
					<?php $options = array(); ?>
					<tr>
						<td><?php echo $item['id']; ?></td>
						<td><?php echo $item['code']; ?></td>
						<td><?php echo $item['title']; ?>
							<?php if(count($item['options'])>0){ ?>
								<br>
								<small>
								<?php foreach($labels as $key => $val){
									if(!empty($values[$key][$item['options'][$key]])){
										$options[] = $val.": ".$values[$key][$item['options'][$key]];
									}
								} 
								echo implode(' - ', $options);
								?>
								</small>
							<?php } ?>
						</td>
						<td><?php echo $item['quantity']; ?></td>
						<td class="numero"><?php echo $item['price']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td>Subtotal:</td>
						<td colspan="3">&nbsp;</td>
						<td class="numero"><?php echo number_format($subtotal, 2); ?></td>
					</tr>
				</tfoot>
			</table>
			<?php
		break;

	/*LISTAMULTIPLE*/
        case 'listamultiple':
        $fk_table_arr=explode("_",$field_name);
        $vs="";
        if(isset($extra['listtable'])){
            $fk_table=$extra['listtable'];
            if(isset($extra['listcondition'])){
                $stringcondition="";
                foreach($extra['listcondition'] as $condition){
                    if($stringcondition!="")
                        $stringcondition.=";";
                    $stringcondition.=$condition;
                }
                $vs['parameters']=$stringcondition;
            }
        }else{
            $fk_table=$fk_table_arr[1];
        }

	    /*Al aplicar el select veo que si ya existe en el arbol la clase padre que estoy listando
	     debe aparecer como ya seleccionada. Por como se va sucediendo el arbol el fk del padre se encuentra en la posicion
	     1 del array navigationtree en el campo qs.	Siempre que el formato sea parameters=fk_.._id:x va a funcionar	*/
	    $str=explode(":",$_SESSION['navigationtree'][1]['qs']);
	    $id_padre=$str[1];//id del padre
		if(isset($extra['listorden'])){
			$vs['orden']=" ORDER BY ".$extra['listorden'];
		}else{
	    	$vs['orden']=" ORDER BY ".$fk_table."_nombre";
		}
		$name_used=$field_name;
    	?>
        <select multiple name="<?=$name_used?>[]" id="<?=$name_used?>" class="postname" height="10">
	        <option value=""><?=$GLOBALS['cfg_selectlist']?></option>
	        <?
	        $fk_qs=$mqs=getList($fk_table,$vs);
	        $nombresEnLista=explode("-",$row[$field_name]);
	        while ($fk_row=mysql_fetch_array($fk_qs)){?>
	            <option value="<?=$fk_row[$fk_table."_id"]?>" <?
		        	if(isset($row[$field_name])){
		            	if (in_array($fk_row[$fk_table."_nombre"],$nombresEnLista)){
		                	echo "selected";
		                }
		        	}else{
		                if(isset($_SESSION['ultimabusqueda'][$pathprocess])){
		                	$var = explode(":",$_SESSION['ultimabusqueda'][$pathprocess]);
		                    if (($fk_row[$fk_table."_nombre"]==$var[1])&&($var[0]==$field_name))
		                        echo "selected";
		                }
		            }?>><?
	                if(isset($extra['listlabel'])){
		                foreach($extra['listlabel'] as $label){
		                	$explode=explode("_",$label);
		                	if($explode[0]=='fk'){
			                		$vst['parameters']="".$explode[1]."_id=".$fk_row[$label];
			                		$padre=getList($explode[1],$vst);
			                		$padrerow=mysql_fetch_array($padre);
				                	if(isset($padrerow[$explode[1]."_nombre"])){
										if($padrerow[$explode[1]."_nombre"]!='')
					                    	echo ">> ".$padrerow[$explode[1]."_nombre"];
					                }else{
					                	if($padrerow[$explode[1]."_name"]!='')
					                    	echo ">> ".$padrerow[$explode[1]."_name"];
					                }
		                	}else{
		                		echo $fk_row[$label]." ";
		                	}
		                }
	                }else{
		                if(isset($fk_row[$fk_table."_nombre"])){
		                    echo $fk_row[$fk_table."_nombre"];
		                }else{
		                    echo $fk_row[$fk_table."_name"];
		                }
	            	}?>
	            </option>
	        <?}?>
        </select>
	    <? echo "<br>Current stored values:'".$row[$field_name]."'";
        break;
	/*LISTA*/
        case 'lista':
        $fk_table_arr=explode("_",$field_name);
        $vs="";
        if(isset($extra['options']['listtable'])){
            $fk_table=$extra['options']['listtable'];
        }else{
            $fk_table=$fk_table_arr[1];
        }
		
		if(isset($extra['listcondition'])){
			$stringcondition="";
            foreach($extra['listcondition'] as $condition){
                if($stringcondition!=""){
                    $stringcondition.=";";
				}
                $stringcondition.=$condition;
            }
            $vs['parameters']=$stringcondition;
        }
		
		$join = '';
		if($extra['options']['join']){
			$join = $extra['options']['join'];
		}
				
		$where = array();
		if($extra['options']['filter']){
			if(is_array($extra['options']['filter'])){
				foreach($extra['options']['filter'] as $filter){
					$where[] = $filter;
				}
			}
			else{
				$where[] = $extra['options']['filter'];
			}
		}
			
		$where_sql = "";
		if(count($where) > 0){
			$where_sql = "WHERE ".implode(' AND ', $where);
		}
		
		if(isset($extra['options']['orden']) && $extra['options']['orden'] != 'parent'){
			$vs['orden']=" ORDER BY ".$extra['options']['orden'];
		}
        else{
        	$vs['orden']=" ORDER BY ".$fk_table."_nombre";
		}
		
		if($_GET['DEBUG']){
			echo "SELECT * FROM $fk_table $join $where_sql $order";
		}
		$options = getResult("SELECT * FROM $fk_table $join $where_sql $order");

	    /*Al aplicar el select veo que si ya existe en el arbol la clase padre que estoy listando
	     debe aparecer como ya seleccionada. Por como se va sucediendo el arbol el fk del padre se encuentra en la posicion
	     1 del array navigationtree en el campo qs.	Siempre que el formato sea parameters=fk_.._id:x va a funcionar	*/
	    $str=explode(":",$_SESSION['ultimabusqueda'][$pathprocess]);
	    $id_padre = '0';//id del padre
	    if($str[0] == $field_name){
	    	$id_padre = $str[1];//id del padre
	    }
		
		if($pathprocess->ac=='list'){
			foreach($options as $fk_row){
				if ($fk_row[$fk_table."_id"]==$row[$field_name]){
				$name = $fk_row[$fk_table."_nombre"];
                                    if(!empty($extra['options']['formato'])){
                                        $name = $extra['options']['formato'];
                                        foreach($fk_row as $key => $value){
                                           $name = str_replace("{".$key."}", $fk_row[$key], $name); 
                                        }
                                    }
		                    echo $name;
							
				}
			}
			return;
    	}else{
    		$name_used=$field_name;
    	}	?>
        <select name="<?=$name_used?>" id="<?=$name_used?>" class="lista <?=build_rules($extra['validation'])?>">
	        <option value="">Seleccione una opción</option>
	        <?

                
                if($extra['options']['orden'] == 'parent'){
                    $options = sortParent($options, $fk_table."_id", "fk_".$fk_table."_id");
                }
                
	        foreach($options as $fk_row){?>
	            <option <?
                    if($extra['options']['orden'] == 'parent'){
                        if($fk_row["fk_".$fk_table."_id"] == 0){
                            echo 'class="parent"';
                        }else{
                            echo 'class="child"';
                        }
                    }
                    ?> value="<?=$fk_row[$fk_table."_id"]?>" <?
		        	if(isset($row[$field_name])){
		            	if ($fk_row[$fk_table."_id"]==$row[$field_name]){
		                	echo "selected";
		                }
		        	}else{
		                if(isset($_SESSION['ultimabusqueda'][$pathprocess])){
		                	if($fk_row[$fk_table."_id"] == $id_padre){
								echo "selected";
							}
		                }
		            }?>><?
	                if(isset($extra['listlabel'])){
	                	if(isset($extra['listlabelformat'])){
	                		$conformato=$extra['listlabelformat'];
	                		foreach($extra['listlabel'] as $label){
	                			//falta implementar si lo que llega es un fk
	                			$conformato=str_replace($label,$fk_row[$label],$conformato);
	                		}
	                		echo $conformato;
	                	}else{
			                foreach($extra['listlabel'] as $label){
			                	$explode=explode("_",$label);
			                	if($explode[0]=='fk'){
				                		$vst['parameters']="".$explode[1]."_id=".$fk_row[$label];
				                		$padre=getList($explode[1],$vst);
				                		$padrerow=mysql_fetch_array($padre);
					                	if(isset($padrerow[$explode[1]."_nombre"])){
											if($padrerow[$explode[1]."_nombre"]!='')
						                    	echo ">> ".$padrerow[$explode[1]."_nombre"];
						                }else{
						                	if($padrerow[$explode[1]."_name"]!='')
						                    	echo ">> ".$padrerow[$explode[1]."_name"];
						                }
			                	}else{
			                		echo $fk_row[$label]." ";
			                	}
			                }
	                	}
	                }else{
		                $name = $fk_row[$fk_table."_nombre"];
                                    if(!empty($extra['options']['formato'])){
                                        $name = $extra['options']['formato'];
                                        foreach($fk_row as $key => $value){
                                           $name = str_replace("{".$key."}", $fk_row[$key], $name); 
                                        }
                                    }
		                    echo $name;
	            	}?>
	            </option>
	        <?}?>
        </select>
	    <?
        break;
	case 'color':
        ?>
            <input type="text" value="<?=$row[$field_name]?>" class="postname <?=$field_name?>" name="<?=$field_name?>" id="<?=$field_name?>" style="width:60px;"/><div id="color<?=$field_name?>" style="width: 60px; height: 22px; float: right; background-color: #<?=$row[$field_name];?>"></div>
            <a class="color-icon" id="<?=$field_name?>_selector" href="javascript:void(0)">Color</a>
            <script type="text/javascript">
                $('#<?=$field_name?>_selector').ColorPicker({
                    color: '#'+$('#<?=$field_name?>').val(),
                    onShow: function (colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                    },
                    onHide: function (colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                    },
                    onChange: function (hsb, hex, rgb) {
                            $('#<?=$field_name?>').val(hex);
                            $('#color<?=$field_name?>').css('backgroundColor', '#' + hex);
                    }
                });
                $('#<?=$field_name?>').bind('change', function(){
                    $('#<?=$field_name?>_selector').ColorPickerSetColor($(this).val());
                    $('#color<?=$field_name?>').css('backgroundColor', '#' + $(this).val());
                });
            </script>
        <?
        break;
	/*IMAGEN*/
        case 'imagen':
	        ?>
            
                <?
                $medidas = explode("|",$extra['crop']);
                $crops = array();
	        for ($i=0;$i<count($medidas);$i++){
                    $y = explode("y",$medidas[$i]);
	            $x = explode("x",$y[0]);
                    $crops[$i]['id'] = $i;
                    $crops[$i]['size'] = $x[1]."_".$y[1];
                    $crops[$i]['name'] = "Recortar a: x".$x[1]." y".$y[1];
	        }
                ?>
            
            
	        <input id="upload_<?=$field_name?>" type="file" name="<?=$field_name?>[]" class="postname" style="clear:both;" <?=($extra["options"]["multiple"])?"multiple":""?>/>
                <div id="progess_<?=$field_name?>" class="progressbar"></div>

                <span id="status_<?=$field_name?>"></span>

                <ul id="files_<?=$field_name?>" class="imagelist <?=($extra["options"]["full"] == true)?'full':'normal'?>">
                    <?
                    if($extra["options"]["secondary"]){
                        $secondary = $extra["options"]["secondary"];
                        if($id > 0){
                            $pics_qr = mysql_query("SELECT * FROM ".$secondary." WHERE fk_".$maintable."_id = '".$id."' ORDER BY ".$secondary."_orden;");
                            while($imgrow = mysql_fetch_assoc($pics_qr)){?>
                                <li>
                                    <div class="holder">
                                        <div class="controls">
                                            <a href="#" class="remove" data-id="<?=$imgrow[$secondary.'_id']?>" data-hash="<?=md5($imgrow[$secondary.'_imagen'])?>" data-table="<?=$secondary?>" title="Borrar"></a>
                                            <a href="<?=ADMIN_FOLDER.$pathprocess?>/crop?secondary=<?=$secondary?>&<?=$secondary?>_id=<?=$imgrow[$secondary.'_id']?>&mainfield=<?=$field_name?>&mainid=<?=$row[$maintable."_id"]?>" class="crop"  title="Cropear"></a>
                                        </div>
                                        <input type="hidden" name="<?=$field_name?>[]" value="<?=$imgrow[$secondary.'_imagen']?>" />
                                        <a href="<?=upload_path($imgrow[$secondary.'_imagen']);?>" rel="shadowbox[<?=$field_name?>]">
                                            <img src="<?=upload_path($imgrow[$secondary.'_imagen'], 'x100y100');?>"/>
                                        </a>
                                    </div>
                                    <? if($extra["options"]["full"] == true){?>
                                    <div class="infoholder">
                                        <label>Titulo</label>
                                        <input type="text" name="<?=$field_name?>_nombre[]" value="<?=$imgrow[$secondary.'_nombre']?>" />
                                        <label>Orden</label>
                                        <input class="numero" type="text" name="<?=$field_name?>_orden[]" value="<?=$imgrow[$secondary.'_orden']?>"/>
                                    </div>
                                    <?}?>
                                </li>
                            <?}
                        }
                    }
                    elseif ($row[$field_name]!='' && file_exists(UPLOAD_PATH.'/x100y100/'.$row[$field_name])){?>
                        <li>
                            <div class="holder">
                                <div class="controls">
                                    <a href="#" class="remove" data-id="<?=$row[$maintable."_id"]?>" data-table="" data-hash="<?=md5($row[$maintable."_id"])?>" data-field="<?=$field_name?>" title="Borrar"></a>
                                    <a href="<?=ADMIN_FOLDER.$pathprocess?>/crop?table=<?=$maintable?>&<?=$maintable?>_id=<?=$row[$maintable."_id"]?>&mainfield=<?=$field_name?>&mainid=<?=$row[$maintable."_id"]?>" class="crop"  title="Cropear"></a>
                                </div>
                                <input type="hidden" name="<?=$field_name?>[]" value="<?=$row[$field_name]?>" data-hash="<?=md5($row[$field_name])?>"/>
                                <a href="<?=upload_path($row[$field_name]);?>" rel="shadowbox">
                                    <img src="<?=HTML_UPLOAD_PATH.'x100y100/'.$row[$field_name]?>"/>
                                </a>
                            </div>
                        </li>
                    <?}?>
                </ul>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#upload_<?=$field_name?>').fileupload({
                            dataType: 'json',
                            url: '<?=ADMIN_FOLDER?><?=$pathprocess?>/ajax',
                            formData: {"action":"upload"},
                            singleFileUploads: false,
                            multiFileRequest: true,
                            send: function (e, data) {
                                $("#progess_<?=$field_name?>").progressbar({
                                    value: 0
                                }).show();
                            },
                            progressall: function (e, data) {
                                var progress = parseInt(data.loaded / data.total * 100, 10);
                                $("#progess_<?=$field_name?>").progressbar({
                                    value: progress
                                });
                            },
                            done: function (e, data) {
                                <? if(!$extra["options"]["multiple"]){ ?>
                                    $("#files_<?=$field_name?>").html("");
                                <? } ?>
                                $.each(data.result, function (index, file) {
                                    
                                    var itm = '';
                                    itm += '<div class="holder">';
                                        itm += '<div class="controls">';
                                            itm += '<a href="#" class="remove" title="Borrar"> </a>';
                                        itm += '</div>';
                                        itm += '<input type="hidden" name="<?=$field_name?>[]" value="'+file.name+'">';
                                        itm += '<a href="'+file.url+'" rel="shadowbox[<?=$field_name?>]">';
                                            itm += '<img src="'+file.thumbnail_url+'"/>';
                                        itm += '</a>';
                                    itm += '</div>';
                                    <? if($extra["options"]["full"] == true){?>
                                    itm += '<div class="infoholder">'
                                    itm += '<label>Titulo</label>';
                                    itm += '<input type="text" name="<?=$field_name?>_nombre[]">';
                                    itm += '<label>Orden</label>';
                                    itm += '<input class="numero" type="text" name="<?=$field_name?>_orden[]" value="0">';
                                    itm += '</div>';
                                    <? } ?>    
                                    
                                    
                                    $('<li/>').html(itm).appendTo("#files_<?=$field_name?>");
                                });
                                $("#progess_<?=$field_name?>").progressbar({
                                    value: 100
                                }).hide('slow');
                            }
                            
                        });
                    });
                </script>
	        <?

        break;

	/*TEXTO LARGO*/
        case 'textarea':?>
            <textarea name="<?=$field_name?>" rows="4" cols=""><?=htmlentities($row[$field_name], ENT_QUOTES, 'UTF-8')?></textarea>
        <?
        break;

        /*BOOL*/
        case 'boolean':
    	if($pathprocess->ac=='list'){?>
                <? $cheked = (($row[$field_name]=='1' && !empty($row[$field_name])) || ($extra['default']=='1' && empty($row[$field_name]))) ? 'checked="checked"' : '';?>
                <input type="hidden" name="<?=$field_name."-".$row[$pathprocess->bf."_id"]?>" value="0"/><!-- Fuerza a que llegue un valor en el post -->
       			<input type="checkbox" name="<?=$field_name."-".$row[$pathprocess->bf."_id"]?>" value="1" <?=$cheked?>>
    	<?}else{?>
                <? $cheked = (($row[$field_name]=='1') || ($extra['default'] == '1' && empty($row[$field_name]))) ? 'checked="checked"' : '';?>
                <? $uncheked = (($row[$field_name]!='1') || ($extra['default']=='0' && empty($row[$field_name]))) ? 'checked="checked"' : '';?>
                <div class="checkcontainer">
                	<input class="radio <?=$field_name?> <?=build_rules($extra['validation'])?>" rel="<?=$field_name?>" type="radio" name="<?=$field_name?>" value="1" <?=$cheked?>><span class="label">Si</span>
                </div>
                <div class="checkcontainer">
                	<input class="radio <?=$field_name?> <?=build_rules($extra['validation'])?>" rel="<?=$field_name?>" type="radio" name="<?=$field_name?>" value="0" <?=$uncheked?>><span class="label">No</span>
                </div>
    	<?}
        break;
        
        /*BOOLEANS*/
        case "radio":
            if($pathprocess->ac=='list'){?>
                <select name="<?=$field_name."-".$row[$pathprocess->bf."_id"]?>" class="postname">
                    <?foreach($extra['options'] as $val => $name){?>
                        <option value="<?=$val?>" <?if($val==$row[$field_name]) echo "selected";?>><?=$name?></option>
                    <?}?>
                </select>
             <? } else { ?>
            <div class="checkcontainer">
    			<? foreach($extra['options'] as $val => $name){
                    $text = explode(":",$campo);
                    $cheked = (($row[$field_name]==$val && !empty($row[$field_name])) || ($extra['default']==$val && empty($row[$field_name]))) ? "checked" : "";?>
                    <div class="checkcontainer">
                    	<input class="radio <?=$field_name?> <?=build_rules($extra['validation'])?>" rel="<?=$field_name?>" type="radio" value="<?=$val?>" name="<?=$field_name?>" <?=$cheked?>/><span class="label"><?=$name?></span><br/>
                    </div>
            	<? } ?>
            </div>
            <?}
        break;

	/*LISTA NUMERICA*/
        case 'listanumerica':
        if($pathprocess->ac=='list'){
			$name_used=$field_name."-".$row[$pathprocess->bf."_id"];
    	}else{
    		$name_used=$field_name;
    	}     ?>
        <select name="<?=$name_used?>" class="postname" style="width:50px;">
                <option value="0">..</option>
            <?for($ii=$extra['minval'];$ii<=$extra['maxval'];$ii++){?>
                <option value="<?=$ii?>" <?if($ii==$row[$field_name]) echo "selected";?>><?=$ii?></option>
            <?}?>
        </select>
        <?
        break;

	/*CALENDARIO*/
        case 'calendario':
            $fecha = ($row[$field_name])?$row[$field_name]:$extra['default'];
            $fecha=explode("-",$fecha);
            if((count($fecha)>0)&&($row[$field_name]!='')){
                $dia=$fecha[2];
                $mes=$fecha[1];
                $anio=$fecha[0];
            }else{
                $dia=date('d');
                $mes=date('m');
                $anio=date('Y');
            }
            $formato = (!empty($extra['options']['format']))?$extra['options']['format']:'dd/mm/yy';
            $formateada = str_replace(array('yy', 'mm', 'dd'), array($anio, $mes, $dia), $formato);
            ?>
        <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" value="<?=$formateada?>" format="<?=$formato?>" class="calendariowdgt" />
        <?
        break;

	/*HORA*/
        case 'hora':
            $hora = ($row[$field_name])?$row[$field_name]:$extra['default'];
            ?>
        <input type="text" name="<?=$field_name?>" id="<?=$field_name?>" value="<?=$hora?>" class="timewdgt" />
        <?
        break;
        
        /*MAPA*/
        case 'mapa':?>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        
        <div class="small"> 				    
            <label class="clearfix" for="local_calle">Dirección:</label>
            <input type="text" class="<?=$field_name?>_dir" id="<?=$field_name?>_dir" />
        </div>
        <div class="small"> 				    
            <label class="clearfix" for="local_calle">Latitud:</label>
            <input type="text" class="<?=$field_name?>_lat" name="<?=$field_name?>lat" id="<?=$field_name?>lat" value="<?=$row[$field_name.'lat']?>" />
        </div>
        <div class="small"> 				    
            <label class="clearfix" for="local_calle">Longitud:</label>
            <input type="text" class="<?=$field_name?>_lon" name="<?=$field_name?>lon" id="<?=$field_name?>lon" value="<?=$row[$field_name.'lon']?>" />
        </div>
        <br/>        
        <div id="map_canvas" style="width: 620px;height: 400px;clear:both;"></div>
        
        <script type="text/javascript">
        var geocoder;
        var map;
        var marker;

        $(document).ready(function(){

            var latlng = new google.maps.LatLng(41.659,-4.714);
            var options = {
                zoom: 16,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map_canvas"), options);

            //GEOCODER
            geocoder = new google.maps.Geocoder();

            marker = new google.maps.Marker({
                map: map,
                draggable: true
            });

            if(($("#<?= $field_name ?>lat").val() != '') && ($("#<?= $field_name ?>lon").val() != '')){
                var location = new google.maps.LatLng($("#<?= $field_name ?>lat").val(), $("#<?= $field_name ?>lon").val());
                marker.setPosition(location);
                map.setCenter(location);
            }

            $("#<?= $field_name ?>_dir").autocomplete({
                //This bit uses the geocoder to fetch address values
                source: function(request, response) {
                    geocoder.geocode( {'address': request.term }, function(results, status) {
                        response($.map(results, function(item) {
                            return {
                                label:  item.formatted_address,
                                value: item.formatted_address,
                                latitude: item.geometry.location.lat(),
                                longitude: item.geometry.location.lng()
                            }
                        }));
                    })
                },
                //This bit is executed upon selection of an address
                select: function(event, ui) {
                    $("#<?= $field_name ?>lat").val(ui.item.latitude);
                    $("#<?= $field_name ?>lon").val(ui.item.longitude);
                    var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
                    marker.setPosition(location);
                    map.setCenter(location);
                }
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#<?= $field_name ?>_dir').val(results[0].formatted_address);
                            $('#<?= $field_name ?>lat').val(marker.getPosition().lat());
                            $('#<?= $field_name ?>lon').val(marker.getPosition().lng());
                        }
                    }
                });
            });
        });
        </script>
        <?
        break;
        
        case 'horarios':
            $doble = ($extra['doble'] === true) ? true : false;
            $json = array('');
            if($row[$field_name] != ''){
                $json = json_decode($row[$field_name], true);
            }
            ?>

        <div id="first_<?=$field_name?>" style="display:none;">
            Dia: <input type="text" name="<?=$field_name?>_dia[]" value="<?=$day['dia']?>" />
            Desde:
            <?$desde = explode(':', $day['hora_desde']);?>
            <select name="<?=$field_name?>_hora_inicio_desde[]" class="postname" style="width:50px;">
                    <option value="">hh</option>
                <?for($ii=0;$ii<=23;$ii++){?>
                    <option value="<?=($ii<10)?"0".$ii:$ii;?>"><?=($ii<10)?"0".$ii:$ii;?></option>
                <?}?>
            </select>
            <select name="<?=$field_name?>_min_inicio_desde[]" class="postname" style="width:50px;">
                <option value="">mm</option>
                <?for($ii=0;$ii<60;$ii++){?>
                    <option value="<?=($ii<10)?"0".$ii:$ii;?>"><?=($ii<10)?"0".$ii:$ii;?></option>
                <?}?>
            </select>
            Hasta:
            <?$hasta = explode(':', $day['hora_hasta']);?>
            <select name="<?=$field_name?>_hora_inicio_hasta[]" class="postname" style="width:50px;">
                    <option value="">hh</option>
                <?for($ii=0;$ii<=23;$ii++){?>
                    <option value="<?=($ii<10)?"0".$ii:$ii;?>"><?=($ii<10)?"0".$ii:$ii;?></option>
                <?}?>
            </select>
            <select name="<?=$field_name?>_min_inicio_hasta[]" class="postname" style="width:50px;">
                <option value="">mm</option>
                <?for($ii=0;$ii<60;$ii++){?>
                    <option value="<?=($ii<10)?"0".$ii:$ii;?>"><?=($ii<10)?"0".$ii:$ii;?></option>
                <?}?>
            </select>
            <?if($doble === true){?>
                    y Desde:
                    <?$desde_doble = explode(':', $day['hora_doble_desde']);?>
                        <select name="<?=$field_name?>_hora_fin_desde[]" class="postname" style="width:50px;">
                            <option value="">hh</option>
                            <?for($ii=0;$ii<=23;$ii++){?>
                                <option value="<?=($ii<10)?"0".$ii:$ii;?>"><?=($ii<10)?"0".$ii:$ii;?></option>
                            <?}?>
                        </select>
                        <select name="<?=$field_name?>_min_fin_desde[]" class="postname" style="width:50px;">
                            <option value="">mm</option>
                            <?for($ii=0;$ii<60;$ii++){?>
                                <option value="<?=($ii<10)?"0".$ii:$ii;?>"><?=($ii<10)?"0".$ii:$ii;?></option>
                            <?}?>
                        </select>
                    Hasta:
                    <?$hasta_doble = explode(':', $day['hora_doble_hasta']);?>
                                <select name="<?=$field_name?>_hora_fin_hasta[]" class="postname" style="width:50px;">
                            <option value="">hh</option>
                        <?for($ii=0;$ii<=23;$ii++){?>
                            <option value="<?=($ii<10)?"0".$ii:$ii;?>"><?=($ii<10)?"0".$ii:$ii;?></option>
                        <?}?>
                    </select>
                    <select name="<?=$field_name?>_min_fin_hasta[]" class="postname" style="width:50px;">
                        <option value="">mm</option>
                        <?for($ii=0;$ii<60;$ii++){?>
                            <option value="<?=($ii<10)?"0".$ii:$ii;?>"><?=($ii<10)?"0".$ii:$ii;?></option>
                        <?}?>
                    </select>
                <?}?>
                    <br/>
        </div>

        <div>
            <?foreach($json as $day){
             $search = array('u00e1', 'u00e9', 'u00ed', 'u00f3', 'u00fa');
            $replace = array('á','é', 'í', 'ó', 'ú');
            $day['dia'] = str_replace($search, $replace, $day['dia']);
                ?>
            Dia: <input type="text" name="<?=$field_name?>_dia[]" value="<?=$day['dia']?>" />
            Desde:
            <?$desde = explode(':', $day['hora_desde']);?>
            <select name="<?=$field_name?>_hora_inicio_desde[]" class="postname" style="width:50px;">
                    <option value="">hh</option>
                <?for($ii=0;$ii<=23;$ii++){?>
                    <option value="<?=($ii<10)?"0".$ii:$ii;?>" <?if($ii==$desde[0]) echo "selected";?>><?=($ii<10)?"0".$ii:$ii;?></option>
                <?}?>
            </select>
            <select name="<?=$field_name?>_min_inicio_desde[]" class="postname" style="width:50px;">
                <option value="">mm</option>
                <?for($ii=0;$ii<60;$ii++){?>
                    <option value="<?=($ii<10)?"0".$ii:$ii;?>" <?if($ii==$desde[1]) echo "selected";?>><?=($ii<10)?"0".$ii:$ii;?></option>
                <?}?>
            </select>
            Hasta:
            <?$hasta = explode(':', $day['hora_hasta']);?>
            <select name="<?=$field_name?>_hora_inicio_hasta[]" class="postname" style="width:50px;">
                    <option value="">hh</option>
                <?for($ii=0;$ii<=23;$ii++){?>
                    <option value="<?=($ii<10)?"0".$ii:$ii;?>" <?if($ii==$hasta[0]) echo "selected";?>><?=($ii<10)?"0".$ii:$ii;?></option>
                <?}?>
            </select>
            <select name="<?=$field_name?>_min_inicio_hasta[]" class="postname" style="width:50px;">
                <option value="">mm</option>
                <?for($ii=0;$ii<60;$ii++){?>
                    <option value="<?=($ii<10)?"0".$ii:$ii;?>" <?if($ii==$hasta[1]) echo "selected";?>><?=($ii<10)?"0".$ii:$ii;?></option>
                <?}?>
            </select>
                <?if($doble === true){?>
                    y Desde:
                    <?$desde_doble = explode(':', $day['hora_doble_desde']);?>
                        <select name="<?=$field_name?>_hora_fin_desde[]" class="postname" style="width:50px;">
                            <option value="">hh</option>
                            <?for($ii=0;$ii<=23;$ii++){?>
                                <option value="<?=($ii<10)?"0".$ii:$ii;?>" <?if($ii==$desde_doble[0]) echo "selected";?>><?=($ii<10)?"0".$ii:$ii;?></option>
                            <?}?>
                        </select>
                        <select name="<?=$field_name?>_min_fin_desde[]" class="postname" style="width:50px;">
                            <option value="">mm</option>
                            <?for($ii=0;$ii<60;$ii++){?>
                                <option value="<?=($ii<10)?"0".$ii:$ii;?>" <?if($ii==$desde_doble[1]) echo "selected";?>><?=($ii<10)?"0".$ii:$ii;?></option>
                            <?}?>
                        </select>
                    Hasta:
                    <?$hasta_doble = explode(':', $day['hora_doble_hasta']);?>
                                <select name="<?=$field_name?>_hora_fin_hasta[]" class="postname" style="width:50px;">
                            <option value="">hh</option>
                        <?for($ii=0;$ii<=23;$ii++){?>
                            <option value="<?=($ii<10)?"0".$ii:$ii;?>" <?if($ii==$hasta_doble[0]) echo "selected";?>><?=($ii<10)?"0".$ii:$ii;?></option>
                        <?}?>
                    </select>
                    <select name="<?=$field_name?>_min_fin_hasta[]" class="postname" style="width:50px;">
                        <option value="">mm</option>
                        <?for($ii=0;$ii<60;$ii++){?>
                            <option value="<?=($ii<10)?"0".$ii:$ii;?>" <?if($ii==$hasta_doble[1]) echo "selected";?>><?=($ii<10)?"0".$ii:$ii;?></option>
                        <?}?>
                    </select>
                <?}?>
                    <br/>
            <?}?>
            </div>
        <div class="dias_<?=$field_name?>">
        </div>
            <br/>
            <a class="add_day_<?=$field_name?>" href="javascript:void();">Agregar Dia</a>
            <script type="text/javascript">
                $(".add_day_<?=$field_name?>").click(function(){
                   $('#first_<?=$field_name?>').clone().insertAfter(".dias_<?=$field_name?>").show();
                });
            </script>
        <?
        break;

	/*MULTISELECT*/
        case "multiselect":
            $array = array();
            $array2 = array();
            $i=0;
            //divide en 2 el field_name, cada registro es un nombre de la tabla
            $rel= explode("-",$field_name);
			
			$first = $rel[0];
			$second = $rel[1];
			
			//recibe el id de $row, que esta variable hab?a levantado de la base de datos.
            $id = $row[$first.'_id'];
			
			if($extra['options']['invert']){
				//recibe el id de $row, que esta variable hab?a levantado de la base de datos.
            	$id = $row[$second.'_id'];
			}
            
            if ($id !=null){
                //realiza una query donde pide todos los registros correspondientes a la tabla relacional
	            $sql = 'SELECT fk_'.$second.'_id FROM rel_'.$first.$second.' WHERE fk_'.$first.'_id = '.$id.';';

				if($extra['options']['invert']){
					$sql = 'SELECT fk_'.$first.'_id FROM rel_'.$first.$second.' WHERE fk_'.$second.'_id = '.$id.';';
				}
				if($_GET['DEBUG']){
					echo '<div style="background:#FFFFC0; padding:10px; clear:both;">'.$sql.'</div>';
				}
	            //echo $sql;
	            $resultado = mysql_query($sql);
	            while ($recordset = mysql_fetch_array($resultado))
	            {
	                //carga en un array los id correspondientes
	                $array[$i]= $recordset['fk_'.$second.'_id'];
					if($extra['options']['invert']){
						$array[$i]= $recordset['fk_'.$first.'_id'];
					}
	                $i++;
	            }
	            mysql_free_result($resultado);
            }
			
			$where = array();
			if($extra['options']['filter']){
				$filters = str_replace(':', '=', $extra['options']['filter']);
				$filters = explode(';', $filters);
				foreach($filters as $filter){
					$where[] = $filter;
				}
			}
			
			$where_sql = "";
			if(count($where) > 0){
				$where_sql = "WHERE ".implode(' AND ', $where);
			}
			
			$query2 ="SELECT * FROM $second $where_sql;";
			if($extra['options']['invert']){
				$query2 ="SELECT * FROM $first $where_sql;";
			}

            $res = mysql_query($query2);
            $i = 0;
            $mat=0;
			
			if(mysql_num_rows($res) == '0'){
				?><p class="error">No hay opciones disponibles para el campo. Asegúrese que hayan datos cargados.</p><?
			}else{ ?>
				<div class="fullcheck">
                <input name="<?=$field_name?>[0]" type="checkbox" class="checkbox fullchecker" rel="<?=$field_name?>" title="Marcar Todos"/><span class="label" style="width:150px;" title="Marcar Todos">Todos</span>
                </div>
			<? }
			
            while ($rs = mysql_fetch_array($res))
            {
                if(($rel[1]=='categoria')&&($mat!=$rs['fk_tipocategoria_id'])){
                    $tcqs=getItem('tipocategoria','tipocategoria_id',$rs['fk_tipocategoria_id']);
                    ?><div style="width:800px; height:20px; float:none;" class="clearfix"></div>
                    <div style="width:800px; float:none;" class="clearfix"><strong><?=$tcqs['tipocategoria_nombre']?></strong></div><?
                    $mat=$rs['fk_tipocategoria_id'];
                }
                ?><div class="checkcontainer"><?
                $ban=0;
                for ($j=0;$j<=count($array)-1;$j++)
                {   //recorres todos los c?digos de la tabla para ver si se encuentra una coincidencia de id
                	$rel_id = $rs[$second.'_id'];
                	if($extra['options']['invert']){
                		$rel_id = $rs[$first.'_id'];
					}
					
                    if ($rel_id == $array[$j])
                    {
                        $ban++;
                    }
                }
                ?>
                <? if($extra['options']['invert']){ ?>
					<input name="<?=$field_name?>[<?=$rs[$first.'_id']?>]" <?=($ban !=0)?"checked":"";?> rel="<?=$field_name?>" type="checkbox" value="<?=$rs[$first.'_id']?>" class="checkbox <?=build_rules($extra['validation'])?> <?=$field_name?>"/><span><?=stripslashes($rs[$first.'_nombre'])?></span>                	
                <? }else{ ?>
                    <input name="<?=$field_name?>[<?=$rs[$second.'_id']?>]" <?=($ban !=0)?"checked":"";?> rel="<?=$field_name?>" type="checkbox" value="<?=$rs[$second.'_id']?>" class="checkbox <?=build_rules($extra['validation'])?> <?=$field_name?>"/><span><?=stripslashes($rs[$second.'_nombre'])?></span>
				<? } ?>
                    </div><?
            }
        break;
        
        /*TAGS*/
        case "tags":
            $array = array();
            $array2 = array();
            $i=0;
            //divide en 2 el field_name, cada registro es un nombre de la tabla
            $rel= explode("-",$field_name);
            //recibe el id de $row, que esta variable hab?a levantado de la base de datos.
            $id = $row[''.$rel[0].'_id'];
            if ($id !=null){
                //realiza una query donde pide todos los registros correspondientes a la tabla relacional
            $sql = 'SELECT fk_'.$rel[1].'_id from rel_'.$rel[0].$rel[1].' where fk_'.$rel[0].'_id = '.$id.';';
            //echo $sql;
            $resultado = mysql_query($sql);
            while ($recordset = mysql_fetch_array($resultado))
            {
                //carga en un array los id correspondientes
                $array[$i]= $recordset['fk_'.$rel[1].'_id'];
                $i++;
            }
            mysql_free_result($resultado);
            }

            $secondary = $rel[1];
			if($extra['options']['secondary']){
				$secondary = $extra['options']['secondary'];
			}  
			
            $query2 ='SELECT * FROM '.$secondary.';';
            $res = mysql_query($query2) or die(mysql_error());
            $options = array();
            while ($rs = mysql_fetch_assoc($res)){
                $options[] = $rs;
            }?>
                    
            <script type="text/javascript">
                var <?=str_replace('-', '', $field_name)?> = <?=json_encode($options)?>;
            </script>
            <? $filter = (isset($extra['options']['filter'])) ? str_replace('=', ':', $extra['options']['filter']):""; ?>
            <input class="tagsearch" table="<?=$secondary?>" field="<?=$field_name?>" filter="<?=$filter?>" type="text" />
            <div class="tagholder">
            <?
            foreach($options as $rs){?>
                <?
                if(in_array($rs[$secondary.'_id'], $array)){?>
                    <span class="tag"><input name="<?=$field_name?>[<?=$rs[$secondary.'_id']?>]" type="hidden" value="<?=$rs[$secondary.'_id']?>"/><?=stripslashes($rs[$secondary.'_nombre'])?><a href="#" class="removetag" title="Quitar">x</a></span>
                <?}
            }
            ?>
            </div>
            <?
        break;

	/*LISTBOX*/
        case "listbox":
            if (strstr($field_name,"_")==TRUE)
            {
                $rel=explode("_",$field_name);
            }
            if (isset($rel))
            {
                $sql = "SELECT ".$rel[1]."_id,".$rel[1]."_nombre,".$rel[1]."_apellido,".$rel[1]."_email1 FROM ".$rel[1].";";
                $resultado = mysql_query($sql);
                $i=0;
                while($fila=mysql_fetch_array($resultado))
                {
                    if ($i!=0)
                    {
                        ?><option value="<?=$fila[$rel[1]."_id"]?>"><?=$fila[$rel[1]."_nombre"]." ".$fila[$rel[1]."_apellido"]." | ".$fila[$rel[1]."_email1"]?></option>
                    <?
                    }
                    else
                    {?>
                        <input type="text" name="<?=$field_name?>_filtro" id="<?=$field_name?>_filtro"><input type="button" name="<?=$field_name?>_botonfiltro" id="<?=$field_name?>_botonfiltro">
                        <select name="<?=$field_name?>[]" id="<?=$field_name?>" size="4" multiple="multiple">
                        <option value="<?=$fila[$rel[1]."_id"]?>"><?=$fila[$rel[1]."_nombre"]." ".$fila[$rel[1]."_apellido"]." | ".$fila[$rel[1]."_email1"]?></option>
                    <?}
                    $i++;
                }
                if ($i!=0)
                {
                    ?>
                    </select>
                    <a href="javascript:llenar('<?=$field_name?>','<?=$field_name?>total')">LLenar</a>
                    <select name="<?=$field_name?>total[]" id="<?=$field_name?>total" size="4" multiple="multiple">

                    </select>
                    <script language="JavaScript">
                    function llenar(selectorigen,selectdestino)
                    {
                        var optionseleccionado = document.getElementById(selectorigen);
                        var optionallenar = document.getElementById(selectdestino);
                        for (var i = 0; i < optionseleccionado.length; i++)
                        {
                            if (optionseleccionado.options[i].selected)
                            {
                                var ban = 0;
                                for (var j = 0;j < optionallenar.length;j++)
                                {
                                    if (optionseleccionado.options[i].value == optionallenar.options[j].value)
                                    {
                                        ban++;
                                    }
                                }
                                if (ban==0)
                                {
                                    var opcion = new Option(optionseleccionado.options[i].text,optionseleccionado.options[i].value);
                                    var dimension = optionallenar.options.length;
                                    optionallenar.options[dimension] = opcion;
                                }
                            }
                        }
                    }
                        //inicializamos el script jquery
                             //a?adimos el evento click al bot?n del formulario
                            var data="";
                            $("#<?=$field_name?>_botonfiltro").click(function ()
                            {
                                var texto=document.getElementById("<?=$field_name?>_filtro");
                                var varstring = texto.value;
                                //creamos un objeto ajax
                                data = $.ajax
                                (
                                {
                                    contentType: "application/x-www-form-urlencoded",
                                    type: "GET",
                                    url: "<?=HTML_PATH?>/system/_ajax/ajaxprocess.php",
                                    data: "string=" + $('#<?=$field_name?>_filtro').val(),
                                    success: function(datos2)
                                    {
                                        alert("<?=$cgf_ajaxprocces?>");
                                        procesodatos(datos2);
                                    }
                                }).responseText;

                            }
                            );
                            function procesodatos(datos)
                            {
                                        var info = datos.split('|||');
                                        var optionorigen = document.getElementById('<?=$field_name?>')
                                        optionorigen.options.length=0;
                                        for (var i=0;i<info.length;i++)
                                        {
                                            var contenido = info[i].split('---');
                                            var opcion = new Option(contenido[0],contenido[1]);
                                            var dimension = optionorigen.options.length;
                                            optionorigen.options[dimension] = opcion;
                                        }

                                        /* el html de jquery es la representaci?n de innerHTML seg?n Javascript */
                            }
                    </script>
                    <?
                }

            }
        break;

	/*SET TEXTO*/
        case "settexto":
            //campo de texto con checks
            $dbc=new Database();
            $dbc->SetQuery("SELECT * FROM ".$extra['listtable']." ORDER BY ".$extra['listtable']."_nombre");
            $qs=$dbc->ExecuteQuery();
            while($rowset=mysql_fetch_array($qs)){
                $arrayval=explode(",",$row[$field_name]);
                if(in_array($rowset[$extra['listtable'].'_id'],$arrayval)){
                    $ckd="checked='checked'";
                }else{
                    $ckd="";
                }
                ?><input type="checkbox" name="<?=$field_name?>[]" value="<?=$rowset[$extra['listtable'].'_id']?>" <?=$ckd?> /> <?=stripslashes($rowset[$extra['listtable'].'_nombre'])?><br/><?
            }
        break;

	/*BASES*/
        case "bases":
            //campo de texto con checks
            $dbc=new Database();
            $dbc->SetQuery("SELECT * FROM base WHERE tipo='B' ORDER BY orden");
            $qs=$dbc->ExecuteQuery();
            while($rowset=mysql_fetch_array($qs)){
                $arrayval=explode(",",$row[$field_name]);
                if(in_array($rowset['base_id'],$arrayval)){
                    $ckd="checked='checked'";
                }else{
                    $ckd="";
                }
                ?><input type="checkbox" name="<?=$field_name?>[]" value="<?=$rowset['base_id']?>" <?=$ckd?> /> <?=stripslashes($rowset['base_nombre'])?><br/><?
            }
        break;

	/*tinymce*/
        case 'tinymce':?>
            <textarea class="tinymce" name="<?=$field_name?>" style="width:100%;"><?=stripslashes($row[$field_name])?></textarea>
        <?
        break;

	/*FILE*/
        case "archivo":?>

                <input id="upload_<?=$field_name?>" type="file" name="<?=$field_name?>[]" class="postname" style="clear:both;" multiple />
                <div id="progess_<?=$field_name?>" class="progressbar"></div>

                <span id="status_<?=$field_name?>"></span>

                <ul id="files_<?=$field_name?>" class="filelist filelist">
                    <?if ($row[$field_name]!='' && file_exists(UPLOAD_PATH.'/'.$row[$field_name])){?>
                        <li>
                            <a href="#" class="remove del-icon" data-id="<?=$row[$maintable."_id"]?>" data-table="" data-file="<?=current(explode('.',$row[$field_name]))?>" data-field="<?=$field_name?>" title="Borrar"></a>
                            <a href="<?=upload_path($row[$field_name]);?>" target="_blank"><?=$row[$field_name]?></a>
                        </li>
                    <?}elseif($extra["secondary"]){
                        if($id > 0){
                            $pics_qr = mysql_query("SELECT * FROM ".$extra["secondary"]." WHERE fk_".$maintable."_id = '".$id."';");
                            while($imgrow = mysql_fetch_assoc($pics_qr)){?>
                                <li>
                                    <a href="#" class="remove del-icon" data-id="<?=$imgrow[$extra["secondary"].'_id']?>" data-table="<?=$extra["secondary"]?>" data-file="<?=current(explode('.',$imgrow[$extra["secondary"].'_archivo']))?>" data-field="<?=$field_name?>" title="Borrar"></a>
                                    <a href="<?=upload_path($imgrow[$extra["secondary"].'_archivo']);?>" target="_blank"><?=$imgrow[$extra["secondary"].'_archivo']?></a>
                                </li>
                            <?}
                        }
                    }?>
                </ul>

                <div id="hiddens_<?=$field_name?>">
                    <?if ($row[$field_name]!=''){?>
                        <input id="<?=$field_name?><?=current(explode('.',$row[$field_name]))?>" type="hidden" name="<?=$field_name?>[]" value="<?=$row[$field_name]?>" />
                    <?}elseif($extra["secondary"]){
                        if($id > 0){
                            $pics_qr = mysql_query("SELECT * FROM ".$extra["secondary"]." WHERE fk_".$maintable."_id = '".$id."';");
                            while($row = mysql_fetch_assoc($pics_qr)){?>
                                <input id="<?=$field_name?><?=current(explode('.',$imgrow[$extra["secondary"].'_archivo']))?>" type="hidden" name="<?=$field_name?>[]" value="<?=$row[$extra["secondary"].'_archivo']?>" />
                            <?}
                        }
                    }?>
                </div>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#upload_<?=$field_name?>').fileupload({
                            dataType: 'json',
                            url: '<?=ADMIN_FOLDER?><?=$pathprocess?>/ajax',
                            formData: {"action":"upload"},
                            singleFileUploads: false,
                            multiFileRequest: true,
                            send: function (e, data) {
                                $("#progess_<?=$field_name?>").progressbar({
                                    value: 0
                                }).show();
                            },
                            progressall: function (e, data) {
                                var progress = parseInt(data.loaded / data.total * 100, 10);
                                $("#progess_<?=$field_name?>").progressbar({
                                    value: progress
                                });
                            },
                            done: function (e, data) {
                                $.each(data.result, function (index, file) {
                                    var fil = $('<a/>').attr('href', '<?=UPLOAD_PATH.'/'?>'+file.name).text(file.name);
                                    var rem = $('<a/>').attr('href', '#').attr('title','Borrar').addClass('remove del-icon').text(" ");
                                    $('<li/>').append(rem).append(fil).appendTo("#files_<?=$field_name?>");
                                    
                                    var hid = $('<input/>').attr('type', 'hidden').attr('name', '<?=$field_name?>[]').val(file.name);
                                    $("#hiddens_<?=$field_name?>").append(hid);
                                });
                                $("#progess_<?=$field_name?>").progressbar({
                                    value: 100
                                }).hide('slow');
                            }
                            
                        });
                    });
                </script>
	        <?
        break;

	/*OCULTO*/
        case 'oculto':
            if(isset($_SESSION['ultimabusqueda'][$pathprocess])){
                $var = explode(":",$_SESSION['ultimabusqueda'][$pathprocess]);
                if ($var[0]==$field_name)
                    $valor=$var[1];
                else
                    $valor=stripslashes($row[$field_name]);
            }elseif(!empty($row[$field_name])){
                $valor=stripslashes($row[$field_name]);
            }
            else{
                $valor = $extra["default"];
            }
        ?>
            <input type="hidden" name="<?=$field_name?>" value="<?=$valor?>" />
            <?
        break;

	/*SISTEMA*/
        case 'sistema':?>
            <input type="hidden" name="<?=$field_name?>" value="<?=$pathprocess->sysid?>" />
            <?
        break;

	/*FIJO*/
        case 'fijo':?>
            <input type="hidden" name="<?=$field_name?>" value="<?=$extra['defaultvalue']?>" />
            <?
        break;

	/*DESTINOS*/
        case 'destinos':
            ?><select name="pais_<?=$field_name?>" id="pais_<?=$field_name?>">
                <option>Seleccione una opcion</option>
                <?
                $dbc=new Database();
                $dbc->SetQuery("SELECT * FROM pais ORDER BY pais_nombre");
                $qs=$dbc->ExecuteQuery();
                while($rowpais=mysql_fetch_array($qs)){
                    ?><option value="<?=$rowpais['pais_id']?>"><?=htmlentities($rowpais['pais_nombre']);?></option><?
                }
                ?>
            </select>
            <select name="ciudad_<?=$field_name?>" id="ciudad_<?=$field_name?>">
                <option value="">Seleccione una opcion</option>
            </select>
            <input type="button" value="Agregar" id="agregar_<?=$field_name?>">
            <input type="hidden" value="<?=$row[$field_name]?>" name="<?=$field_name?>" id="<?=$field_name?>" />
            <div id="muestra_<?=$field_name?>"></div>
            <script type="text/javascript">
             var <?=$field_name?>ides=new Array();
             var <?=$field_name?>nombres=new Array();
             function quitar_<?=$field_name?>(a,b){
                 var aux=new Array();
                 var auxn=new Array();
                 for(i=0;i<<?=$field_name?>ides.length;i++){
                        if(parseInt(a)!=parseInt(<?=$field_name?>ides[i])){
                            aux.push(<?=$field_name?>ides[i]);
                            auxn.push(<?=$field_name?>nombres[i]);
                        }
                    }
                    <?=$field_name?>ides=aux;
                    <?=$field_name?>nombres=auxn;
                    update_<?=$field_name?>();
                }
                function update_<?=$field_name?>(){
                 var aux=new Array();

                 ciudades='';
                 for(i=0;i<<?=$field_name?>ides.length;i++){
                     ciudades+=<?=$field_name?>nombres[i] + " <a href='javascript:quitar_<?=$field_name?>("+<?=$field_name?>ides[i]+",<?=$field_name?>)'>quitar</a><br/>";
                 }
                 $('#muestra_<?=$field_name?>').html(ciudades);
                 $("#<?=$field_name?>").val(<?=$field_name?>ides.toString());
                }
             $(document).ready(function() {
                $('#pais_<?=$field_name?>').change(function(){
                    $.ajax({
                      url: "<?=HTML_PATH?>/system/_ajax/paisdestino.php",
                      async:false,
                      data: "idp="+$(this).val(),
                      success: function(data){
                        j=data.split(";;");
                        var options = '';
                            for (var i = 0; i < j.length; i++) {
                                splitj=j[i].split(":");
                                options += '<option value="' + splitj[0] + '">' + splitj[1] + '</option>';
                            }
                            $("#ciudad_<?=$field_name?>").html(options);/**/
                        }
                    });
                });
                $("#agregar_<?=$field_name?>").click(function(){

                   var ide=$("#ciudad_<?=$field_name?>").val();
                   var texto=$("#ciudad_<?=$field_name?> option[value='"+ide+"']").text();
                   var valorstring=$("#<?=$field_name?>").val();


                   if(valorstring!=''){
                        <?=$field_name?>ides=valorstring.split(",");
                   }

                    if(ide!=0){
                        encontro=0;
                        for(a=0;a<<?=$field_name?>ides.length;a++){
                            if(parseInt(<?=$field_name?>ides[a])==parseInt(ide)){
                                encontro=1;
                            }
                        }
                        if(encontro!=1){
                            <?=$field_name?>ides.push(ide);
                            <?=$field_name?>nombres.push(texto);
                            update_<?=$field_name?>();
                            $("#<?=$field_name?>").val(<?=$field_name?>ides.toString());
                        }
                    }
                });
                    //CARGA INICIAL
                    <?
                    $ciudades="";
                    if($row[$field_name]!=''){
                        $valorinicial=explode(",",$row[$field_name]);
                        foreach($valorinicial as $valor){
                            $it=getItem("ciudad","ciudad_id",$valor);?>
                            <?=$field_name?>ides.push(<?=$valor?>);
                            <?=$field_name?>nombres.push('<?=$it['ciudad_nombre']?>');
                        <?
                        }?>
                        update_<?=$field_name?>();
                        <?
                    }
                    ?>
            });
            </script>
            <?
        break;
		
		case 'include':
			$path = abs_path($extra['file']);
			if(file_exists($path)){
				extract($extra['options']['vars']);
				include_once($path);
			}
        break;
	/*DEFAULT*/
        default:?>
            <input type="text" name="<?=$field_name?>" value="<?=stripslashes($row[$field_name])?>" />
            <?
        break;
    }
    if($extra['fatherof']){
        ?>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#<?=$field_name?>').change('click', function(event) {
                alert('<?=$extra['fatherof']?>');
            });
        });
        </script>
        <?
    }
}
?>