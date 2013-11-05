<?php
include("../../system.php");

$term = $_GET['term'];
$table = mysql_real_escape_string($_GET['table']);
$column = mysql_real_escape_string($_GET['column']);

$where = array();
if($_GET['term']){
	$where[] = $column." LIKE '%".mysql_real_escape_string($_GET['term'])."%'";
}

$where_sql = "";
if(count($where) > 0){
	$where_sql = "WHERE ".implode(' AND ', $where);
}

$sql = "SELECT * FROM $table $where_sql GROUP BY $column";

$res = mysql_query($sql);
$options = array();
while ($rs = mysql_fetch_assoc($res)) {
    $options[] = array('value' => $rs[$column]);
}
die(json_encode($options));
?>