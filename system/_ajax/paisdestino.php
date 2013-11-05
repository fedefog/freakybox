<?
include("../../system.php");
$str="0:Seleccione una opcion";
if(isset($_REQUEST['idp'])){
    $sql="SELECT * FROM ciudad WHERE fk_pais_id=".$_REQUEST['idp'];
    $dbc=new Database();
    $dbc->SetQuery($sql);
    $qs=$dbc->ExecuteQuery();
    
    while($row=mysql_fetch_array($qs)){
        if($str!='') 
            $str.=";;";
        $str.=$row['ciudad_id'].":".htmlentities($row['ciudad_nombre']);
    }
}
echo $str;
?>