<?
$vs = "";
if (isset($querystring['parameters'])) {
    $vs['parameters'] = $querystring['parameters'];
    $_SESSION['ultimabusqueda'][$maintable] = $querystring['parameters'];
}

if (isset($orden)) {
    $vs['orden'] = $orden;
}
if(isset($sqlfiltro)){
	$vs['parameters'] = str_replace(' AND ',';',$sqlfiltro);
}

$mqs = getList($maintable, $vs);
if (isset($listexport)) {
    $_fields = $listexport;
} else {
    $qs_fields = mysql_query("SHOW COLUMNS FROM " . $maintable) or die(mysql_error());
    while ($row_fields = mysql_fetch_assoc($qs_fields)) {
        if ($row_fields['Field'] != $maintable . "_id") {
            $_fields[] = $row_fields['Field'];
        }
    }
}
?>


<table width="900" border="0" cellspacing="0" cellpadding="4" align="center" id="listtable">
    <tr>

        <?
        if ($maintable != "mail") {
            ?>
            <th align="left" width="20">ID</th>
            <?
        }
        foreach ($_fields as $_field) {
            ?>
            <th align="left"><?
        if (isset($fields))
            echo utf8_decode($fields[$_field]['fieldlabel']);
        else
            echo str_replace("mail_", "", $_field);
            ?></th>
        <? } ?>
    </tr>
    <?
    while ($mr = mysql_fetch_array($mqs)) {
        ?>
        <tr class="contenttr">
            <?
            if ($maintable != "mail") {
                ?>
                <td align="left"><?= $mr[0] ?></td>
                <?
            }
            foreach ($_fields as $_field) {
                ?>
                <td align="left"><?
        if (substr($_field, 0, 3) == 'fk_') {
            $table = str_replace("fk_", "", $_field);
            $table = str_replace("_id", "", $table);
            $qsfk = getItem($table, $table . '_id', $mr[$_field]);
            echo utf8_decode($qsfk[$table . "_nombre"]);
        } 
        elseif($fields[$_field]['fieldcomponent'] == 'boolean' ) {
            if($mr[$_field] == '1'){
                echo "Si";
            }
            else{
                echo "No";
            }
        }
        elseif($fields[$_field]['fieldcomponent'] == 'radio' ) {
            echo utf8_decode($fields[$_field]['options'][$mr[$_field]]);
        }
        else {
            echo utf8_decode($mr[$_field]);
        }
                ?></td>
            <? }
            ?>
        </tr>
    <? } ?>
</table>
