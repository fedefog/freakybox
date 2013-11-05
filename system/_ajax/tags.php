<?php
include("../../system.php");

$term = $_GET['term'];
$table = mysql_real_escape_string($_GET['table']);

$where = array();
if($_GET['term']){
	$where[] = $table."_nombre LIKE '%".mysql_real_escape_string($_GET['term'])."%'";
}

if($_GET['filter']){
	$filters = str_replace(':', '=', $_GET['filter']);
	$filters = explode(';', $filters);
	foreach($filters as $filter){
		$where[] = $filter;
	}
	
}

$where_sql = "";
if(count($where) > 0){
	$where_sql = "WHERE ".implode(' AND ', $where);
}

$sql = "SELECT * FROM $table $where_sql";

$res = mysql_query($sql);
$options = array();
while ($rs = mysql_fetch_assoc($res)) {
    $options[] = array('id' => $rs[$table.'_id'], 'nombre' => $rs[$table.'_nombre']);
}
die(json_encode($options));
?>