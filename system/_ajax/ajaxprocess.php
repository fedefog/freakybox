<?php
    include("../../system.php");
    if (isset($_GET['string']))
    {
        
        $string="";
        $query = "select contacto_id,contacto_nombre,contacto_apellido,contacto_email1,contacto_email2 from contacto where contacto_apellido LIKE '%".$_REQUEST['string']."%' OR contacto_categoria1 LIKE '%".$_REQUEST['string']."%' OR contacto_categoria2 LIKE '%".$_REQUEST['string']."%'";
        $resultado = mysql_query($query);
        while($row=mysql_fetch_array($resultado))
        {
            if (strlen($string)==0)
            {
                $id = $row['contacto_id'];
                $strapnom = $row['contacto_nombre']." ".$row['contacto_apellido']." | ".$row['contacto_email1'];
                $string ="$strapnom---$id";
            }
            else
            {
                $id = $row['contacto_id'];
                $strapnom = $row['contacto_nombre']." ".$row['contacto_apellido']." | ".$row['contacto_email1'];;
                $string .="|||$strapnom---$id";
            } 
        }
    echo "$string";
    }
    else
    {
        echo "MAAAAAAAAAAAAAAAAAAAL";
    }
?>
