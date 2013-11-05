<?

if (isset($maintable)) {
    $mt = $maintable;
} 
else {
    $mt = $pathprocess->bf;
}
		
echo("ACTUALIZANDO DATOS...<br>");

$delete = $_POST['delete'];
unset($_POST['delete']);

foreach($delete as $id){
	if(isset($actions["papelera"]) && ($actions["papelera"] == 1)){
		mysql_query("UPDATE ".$mt." SET ".$mt."_papelera = '1' WHERE ".$mt."_id='".$id."'");
	}
	else{
		mysql_query("DELETE FROM ".$mt." WHERE ".$mt."_id='".$id."'");
	}
	
	if($_POST['force_restore'] == '1'){
		mysql_query("UPDATE ".$mt." SET ".$mt."_papelera = '0' WHERE ".$mt."_id='".$id."'");
	}
	if($_POST['force_delete'] == '1'){
		mysql_query("DELETE FROM ".$mt." WHERE ".$mt."_id='".$id."'");
	}
}

foreach($_POST as $key => $value){
    $parts = explode('-', $key);
    $id = end($parts);
    $field = reset($parts);
    $query = mysql_query("UPDATE ".$mt." SET ".$field." = '".$value."' WHERE ".$mt."_id='".$id."'");
}

$string="";
if(isset($_SESSION['filters_for_actions'])){
	foreach($_SESSION['filters_for_actions'] as $filter){
		$string.="&".$filter['name']."=".$filter['value'];		
	}
}

	?>
<script type="text/javascript">
	window.location.href ="<?=ADMIN_FOLDER.$mt?>/list?<?=$_SESSION['navigationtree'][$KEY]['qs']?>&navigation=back";
    exit();
</script>