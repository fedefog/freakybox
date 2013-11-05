<?php

/**
 * Genera el js basico para enviar un formulario a travez del evento onClick.
 * @param string $id
 * @return string 
 */
function js_submit($id){
	return "document.getElementById('".$id."').submit();";
}
?>