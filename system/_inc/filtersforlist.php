<?
//************************************************************************
//**********************************FILTROS******************************

if ((isset($filtercomp)) && (count($filtercomp) > 0)) {
    ?>
    <div id="filters" >
        <?/*<div id="filter-colapse" class="head-container">Filtros:</div>*/?>
        <?
        $show = false;
        foreach ($filtercomp as $filter => $options) {
        	if(isset($_REQUEST[$options['filtername']])){
        		$show = true;
        	}
		}
        ?>
        <div id="filter-list" class="container" style="display:<?=($show)?'block':'none'?>;">
            <form class="formfiltro" name="formfiltro" accion="<?= ADMIN_FOLDER . $pathprocess->bf ?>" method="get" >
                <?
                $padre_de = "";
                $_SESSION['filters_for_actions'] = "";
                $str_for_order = "";
                foreach ($filtercomp as $filter => $options) {
                    $campos = explode(",", $filter);
                    switch ($options['filtertype']) {
                        case 'lista':
                            if ((isset($_REQUEST[$options['filtername']])) && ($_REQUEST[$options['filtername']] != '')) {
                                foreach ($campos AS $campofiltro) {
                                    if ((isset($sqlfiltro)) && ($sqlfiltro != ''))
                                        $sqlfiltro.=";";
                                    $sqlfiltro.=$campofiltro . ":'" . $_REQUEST[$options['filtername']] . "'";
                                }
                            }
                            ?>
                            <div class="formfield">
                            	<label><?= $options['filterlabel'] ?>:</label>
                                <select name="<?= $options['filtername'] ?>" class="postname">
                                    <option value=""><?= $GLOBALS['cfg_selectlist'] ?></option>
                                    <?
                                    $fk_table_arr = explode("_", $filter);
                                    $fk_table = $fk_table_arr[1];
                                    if ((isset($options['filterjoin'])) && ($options['filterjoin'] != '')) {
                                        $campos_a_traer = explode(",", $options['filterjoin']['camposresultado']);
                                        foreach ($campos_a_traer as $c) {
                                            if (isset($campos_para_traer))
                                                $campos_para_traer.=",";
                                            $campos_para_traer.=$mt . "." . $c;
                                        }

                                        $fk_qs = mysql_query("SELECT DISTINCT " . $campos_para_traer . " FROM " . $mt . " INNER JOIN " . $options['filterjoin']['tablajoin'] . " as se ON " . $mt . "." . $mt . "_id=se." . $options['filterjoin']['campojoin']);
                                    }else {
                                        $opts = "";
                                        $fk_qs = getList($fk_table, $opts);
                                    }

                                    $extra = $options;

                                    $options = array();
                                    while ($fk_row = mysql_fetch_array($fk_qs)) {
                                        $options[] = $fk_row;
                                    }

                                    if ($extra['listorden'] == 'parent') {
                                        $options = sortParent($options, $fk_table . "_id", "fk_" . $fk_table . "_id");
                                    }

                                    foreach ($options as $fk_row) {
                                        ?>
                                        <option 
                                        <?
                                        if ($extra['listorden'] == 'parent') {
                                            if ($fk_row["fk_" . $fk_table . "_id"] == 0) {
                                                echo 'class="parent"';
                                            } else {
                                                echo 'class="child"';
                                            }
                                        }
                                        ?>
                                            value="<?= $fk_row[$fk_table . "_id"] ?>" <?
                        if (!empty($_REQUEST[$extra['filtername']])) {
                            if (($fk_row[$fk_table . "_id"] == $_REQUEST[$extra['filtername']]) || ($fk_row[$fk_table . "_nombre"] == $_SESSION['father'])) {
                                echo 'selected';
                                $padre_de = $fk_row[$fk_table . "_nombre"];
                            }
                        }
                                        ?>><?
                            if (isset($fk_row[$fk_table . "_nombre"])) {
                                $name = $fk_row[$fk_table . "_nombre"];
                                if (!empty($extra['formato'])) {
                                    $name = $extra['formato'];
                                    foreach ($fk_row as $key => $value) {

                                        $name = str_replace("{" . $key . "}", $fk_row[$key], $name);
                                    }
                                }
                                echo $name;
                            } else {
                                echo $fk_row[$fk_table . "_name"];
                            }
                                        ?></option>
                            <? } ?>
                                </select>
                            </div>
                            <?
                            break;

                        case 'multiselect':
                        	?>
							<div class="formfield">
								<label><?= $options['filterlabel'] ?>:</label>
							<?
                            $rel = explode("-", $options['filterfield']);

                            
                            $array2 = array();
                            $i = 0;
                            //divide en 2 el field_name, cada registro es un nombre de la tabla
                            //echo $sql;
                            $selected = array();
                            if (!empty($_REQUEST[$options['filtername']])) {
                                foreach ($_REQUEST[$options['filtername']] as $val) {
                                    $selected[] = $val;
                                }
                            }

                            $items = array();
                            if (!empty($selected)) {
                                $items_sql = "SELECT fk_" . $rel[0] . "_id FROM rel_" . $rel[0] . $rel[1] . " WHERE fk_" . $rel[1] . "_id IN ('" . implode("','", $selected) . "');";
                                $items_qr = mysql_query($items_sql);

                                while ($row = mysql_fetch_array($items_qr)) {
                                    $items[] = $row[0];
                                }
                            }

                            if (!empty($items)) {
                                if ((isset($sqlfiltro)) && ($sqlfiltro != '')) {
                                    $sqlfiltro.=";";
                                    $sqlfiltro.=" ";
                                }
                                $sqlfiltro .= $rel[0] . "_id IN ('" . implode("','", $items) . "')";
                            }

                            //realiza una query donde pide todos los registros de la tabla destino
                            if ($rel[1] == 'categoria') {
                                $source = $rel[1] . " ORDER BY fk_tipocategoria_id, categoria_nombre";
                            } else {
                                $source = $rel[1];
                            }
                            $query2 = 'SELECT * FROM ' . $source . ';';

                            $res = mysql_query($query2);
                            $i = 0;
                            $mat = 0;
                            while ($rs = mysql_fetch_array($res)) {
                                if (($rel[1] == 'categoria') && ($mat != $rs['fk_tipocategoria_id'])) {
                                    $tcqs = getItem('tipocategoria', 'tipocategoria_id', $rs['fk_tipocategoria_id']);
                                    ?><div style="width:800px; height:20px; float:none;float:none;pading-bottom:10px;"></div>
                                    <div style="width:800px; float:none;"><strong><?= $tcqs['tipocategoria_nombre'] ?></strong></div><?
                        $mat = $rs['fk_tipocategoria_id'];
                    }
                                ?><?
                    $ban = 0;
                    for ($j = 0; $j <= count($items) - 1; $j++) {   //recorres todos los c�digos de la tabla para ver si se encuentra una coincidencia de id
                        if ($rs[$rel[1] . '_id'] == $items[$j]) {
                            $ban++;
                        }
                    }
                                ?>
                                    <input name="<?= $options['filtername'] ?>[]" <?= ($ban != 0) ? "checked" : ""; ?> type="Checkbox" value="<?= $rs[$rel[1] . '_id'] ?>" /><span class="label"><?= $rs['' . $rel[1] . '_nombre'] ?></span>

                                <?
                }
				?>
				</div>
				<?
                break;

            case 'texto':
                            ?><div class="formfield">
                            	<label><?= $options['filterlabel'] ?>:</label>
                            	
                            	<?
                if ((isset($_REQUEST[$options['filtername']])) && ($_REQUEST[$options['filtername']] != '') && ($_REQUEST[$options['filtername']] != ' ')) {
                    if ((isset($sqlfiltro)) && ($sqlfiltro != ''))
                        $sqlfiltro.=";";
                    $sqlfiltro.='(';
                    $x = 0;
                    foreach ($campos AS $campofiltro) {
                        if ($x > 0)
                            $sqlfiltro.=" OR ";
                        $sqlfiltro.=$campofiltro . " LIKE '%" . trim($_REQUEST[$options['filtername']]) . "%'";
                        $x++;
                    }
                    $sqlfiltro.=')';
                }
                            ?>
                                <input name="<?= $options['filtername'] ?>" value="<?= $_REQUEST[$options['filtername']] ?>" type="text"/>
                            </div>
                            <?
                            break;

                        case 'boolean':
                            ?>
                            <div class="formfield">
                            	<label><?= $options['filterlabel'] ?>:</label>
                                <?
                                if ((isset($_REQUEST[$options['filtername']])) && ($_REQUEST[$options['filtername']] != '') && ($_REQUEST[$options['filtername']] != ' ')) {
                                    foreach ($campos AS $campofiltro) {
                                        if ((isset($sqlfiltro)) && ($sqlfiltro != ''))
                                            $sqlfiltro.=";";
                                        $sqlfiltro.=$campofiltro . ":'" . $_REQUEST[$options['filtername']] . "'";
                                    }
                                }
                                foreach (array("1" => "Si", "0" => "No") as $key => $val) {
                                    ?>
                                    <input name="<?= $options['filtername'] ?>" value="<?= $key ?>" <? if ($_REQUEST[$options['filtername']] == $key) echo "checked"; ?> type="radio"/>
                                    <span class="label"><?= $val ?></span>
                                <? }
                                ?>
                            </div>
                            <?
                            break;

                        case 'radio':
                            ?>
                            <div class="formfield">
                            	<label><?= $options['filterlabel'] ?>:</label>
                                <?
                                if ((isset($_REQUEST[$options['filtername']])) && ($_REQUEST[$options['filtername']] != '') && ($_REQUEST[$options['filtername']] != ' ')) {
                                    foreach ($campos AS $campofiltro) {
                                        if ((isset($sqlfiltro)) && ($sqlfiltro != ''))
                                            $sqlfiltro.=";";
                                        $sqlfiltro.=$campofiltro . ":'" . $_REQUEST[$options['filtername']] . "'";
                                    }
                                }
                                foreach ($options['options'] as $key => $val) {
                                    ?>
                                    <input name="<?= $options['filtername'] ?>" value="<?= $key ?>" <? if ($_REQUEST[$options['filtername']] == $key) echo "checked"; ?> type="radio"/>
                                    <span class="label"><?= $val ?></span>
                                <? }
                                ?>
                            </div>
                            <?
                            break;

                        case 'select':
                            ?>
                            <div class="formfield">
                            	<label><?= $options['filterlabel'] ?>:</label>
                                <select name="<?= $options['filtername'] ?>">
                                <?
                                if ((isset($_REQUEST[$options['filtername']])) && ($_REQUEST[$options['filtername']] != '') && ($_REQUEST[$options['filtername']] != ' ')) {
                                    foreach ($campos AS $campofiltro) {
                                        if ((isset($sqlfiltro)) && ($sqlfiltro != ''))
                                            $sqlfiltro.=";";
                                        $sqlfiltro.=$campofiltro . ":'" . $_REQUEST[$options['filtername']] . "'";
                                    }
                                }
                                foreach ($options['options'] as $key => $val) {
                                    ?>
                                    <option value="<?= $key ?>" <? 
                                    if ($_REQUEST[$options['filtername']] == $key) echo "selected"; ?>><?= $val ?></option>
                                <? }
                                ?>
                                </select>
                            </div>
                            <?
                            break;

                        case 'libre':
                            if ((isset($_REQUEST[$options['filtername']])) && ($_REQUEST[$options['filtername']] != '') && ($_REQUEST[$options['filtername']] != ' ')) {
                                if ((isset($sqlfiltro)) && ($sqlfiltro != ''))
                                    $sqlfiltro.=";";
                                $sqlfiltro.=stripslashes($_REQUEST[$options['filtername']]);
                            }
                            ?>
                            <input name="<?= $options['filtername'] ?>" value="<?= $options['filterquery'] ?>" <? if (isset($_REQUEST[$options['filtername']])) echo "checked"; ?> type="checkbox" />
                            <?= $options['filtertext'] ?>
                            <? break;
                    }
                    ?>

                    <?
                    $_SESSION['filters_for_actions'][] = array('name' => $options['filtername'], 'value' => $_REQUEST[$options['filtername']]);
                    if (!empty($_REQUEST[$options['filtername']])) {
                        $str_for_order.="&" . $options['filtername'] . "=" . $_REQUEST[$options['filtername']];
                    }
                }
                ?>
				<div style="width:100%; display:block; clear:both;">
                	<input class="filtersubmit" type="submit" value="Filtrar" />
                	<input class="filterclear" type="button" onclick="ClearFilter();" value="Reset" />
                </div>
                
            </form>

        </div>
    </div>
    <script type="text/javascript">
        $("#filter-colapse").click(function(){
            $("#filter-list").slideToggle("slow");
        });

	    function ClearFilter(){
	        window.location = "<?=ADMIN_FOLDER."".$pathprocess->bf?>";
	    }
    </script>
<?
}?>