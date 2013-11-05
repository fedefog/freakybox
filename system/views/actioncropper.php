<?php
    if (isset($_POST[$pathprocess->bf."_id"]))
    {
        $id = $_POST[$pathprocess->bf."_id"];

        $name=$_POST['name'];
        
        $ban = create_resized_copies(UPLOAD_PATH."/".$name,UPLOAD_PATH."/".$name,"x100y100|".$_POST['crop'],$_POST['x'],$_POST['y'],$_POST['w'],$_POST['h'],1);
        
        $redirect = ADMIN_FOLDER.$pathprocess->bf."/edit?".$pathprocess->bf."_id=$id";
        if ($ban)
        {
            ?>
            <script type="text/javascript">
                alert("Imagen Croppeada.");
                document.location='<?=$redirect?>';
            </script>
            <?

        }
        else
        {
            ?>
            <script type="text/javascript">
                alert("Error en crop.");
                document.location='<?=$redirect?>';
            </script>
            <?
        }
    }
?>
