<?
include("../../system.php");
if (isset ($_REQUEST['default']) && $_REQUEST['default']!="")
    $str=":".$_REQUEST['default'];
else
    $str=":..";
    
if(isset($_REQUEST['maintable']) && isset($_REQUEST['condition']) ){
    $maintable=$_REQUEST['maintable'];
    $condition=str_replace(":", "=", $_REQUEST['condition']);
    
    $sql="SELECT ".$maintable."_id, ".$maintable."_nombre FROM $maintable WHERE $condition ORDER BY ".$maintable."_nombre";
    
    $qs=mysql_query($sql);
    
    while($row=mysql_fetch_array($qs)){
        if($str!='') 
            $str.=";;";
        $str.=$row[$maintable.'_id'].":".htmlentities($row[$maintable.'_nombre']);
    }
}
echo $str;
?>