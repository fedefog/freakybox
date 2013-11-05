<?
$vs="";
if (isset($querystring['parameters']))
{
    $vs['parameters']=$querystring['parameters'];
    $_SESSION['ultimabusqueda'][$pathprocess->bf]=$querystring['parameters'];
}

if(isset($orden))
{
    $vs['orden']=$orden;
}
if(isset($_REQUEST['ordenlist']))
{
    if($_REQUEST['ordenlist']!="0"){
        $aux_filter="WHERE fk_tipoproducto_id=".$_REQUEST['ordenlist'];
    }
}

$mqs=mysql_query("SELECT * FROM ".$pathprocess->bf." $aux_filter");
if(isset($list)){
    $_fields=$list;
}else{
    $qs_fields=mysql_query("SHOW COLUMNS FROM ".$pathprocess->bf);
    while ($row_fields = mysql_fetch_assoc($qs_fields)) {
        if($row_fields['Field']!=$pathprocess->bf."_id"){
            $_fields[]=$row_fields['Field'];
        }
    }
}
?>

<body>
<?include(ABS_PATH."/system/templates/header.php")?>
<?include(ABS_PATH."/system/templates/menubar.php")?>
<div id="maincontent">
<?if((isset($_REQUEST['parameters']))&&($_REQUEST['parameters']!=null)){
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
}
?>
<h1 class="titulos"><?=$module_title?>&nbsp;<?if(($_SESSION['father']!=null)&&($father!=null)){echo $cfg_fatherfor." ".$_SESSION['father'];}?></h1>
<?foreach($_SESSION['navigationtree'] as $KEY=>$branch){
    if($branch['bf']!=$pathprocess->bf){
        ?><div id="cancelar" class="button" style="margin-left:20px;"><a href="<?=ADMIN_FOLDER.$_SESSION['navigationtree'][$KEY]['bf']?>/<?=$_SESSION['navigationtree'][$KEY]['ac']?>?>"><?=$cfg_back?></a></div><?
        break;
    }
}?>
<div id="agregar" class="button"><a href="<?=ADMIN_FOLDER.$pathprocess->bf?>/new"><?=$cfg_additem?></a></div>
<?if(isset($ordenlist)){
    foreach($ordenlist as $KEY=>$orden){
        $aux_campo=explode("_",$KEY);
        $sql=mysql_query("SELECT * FROM ".$aux_campo[1]);?>
        <div id="ordenlist" class="button" style="margin-right:10px;">
            <script type="text/javascript">
            function changeorder(obj){
                window.location.href = '?ordenlist=' + obj.options[obj.selectedIndex].value;
            }</script>
            <select id="ordenlistselect" style="margin-top:4px;" onchange="javascript:changeorder(this);">
                <option value="0" <?if(!isset($_REQUEST['ordenlist'])){echo "selected";}?>>Todos</option>
                <?while($row_aux=mysql_fetch_array($sql)){?>
                    <option <?if($_REQUEST['ordenlist']==$row_aux[0]){echo "selected";}?> value="<?=$row_aux[0]?>"><?=$row_aux[$aux_campo[1]."_nombre"]?></option>
                <?}?>
            </select>
        </div>
    <?}?>
<?}?>
<div id="container">
<div id="imagecontainer">


<?
    while ($mr=mysql_fetch_array($mqs))
    {
    ?>
    <div class="image">
        <?
            $qsfk=getItem($pathprocess->bf,$pathprocess->bf.'_id',$mr[0]);
        ?>
        <img src="<?=HTML_PATH?>/upload/x100y100/<?=$qsfk[$pathprocess->bf."_imagen"]?>" width="100" height="100">
    <?
    ?>
    <div class="administration">
    <div class="tooltip" style="font-family:arial;font-size:11;color:black;width : 45px;">
        <?=$qsfk[$pathprocess->bf."_name"]?>
    </div>
    <div class="delete">
        <a href="javascript:fcn_deleteconfirm('<?=ADMIN_FOLDER?><?=$pathprocess->bf?>/actions?iddel=<?=$mr[0]?>&accion=d');"><img src="<?=HTML_PATH?>/system/_img/actions/listblue_delete.gif" alt="" width="18" height="18" border="0"></a>
    </div>
    <div class="edit">
        <a href="<?=ADMIN_FOLDER?><?=$pathprocess->bf?>/edit?<?=$pathprocess->bf?>_id=<?=$mr[0]?>"><img src="<?=HTML_PATH?>/system/_img/actions/listblue_edit.gif" alt="" width="18" height="18" border="0"></a>
    </div>
    <?if (isset($listfilters)){
        foreach ($listfilters as $key=>$campo){?>
            <div class="listfilterimagelist">
                <a href="<?=ADMIN_FOLDER?><?=$key?>?parameters=<?=$campo[0]?>:<?=$mr[0]?>"><img src="<?=HTML_PATH?>/system/_img/actions/iconoLupa.png" alt="" width="18" height="18" border="0"></a>
            </div>
        <?}
    }?>
    </div>
    </div>
    <?}?>

    <div id="separador">&nbsp;</div>
</div>
</div>
</div>
</body>
</html>
<script language='JavaScript'>
var newwindow;
function popup(url)
{ newwindow=window.open(url,'name','width=550,height=270,left=200,top=300');
if (window.focus) {newwindow.focus()}
}

</script>
