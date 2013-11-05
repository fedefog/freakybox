<?php

$tipodepermiso = 1;
// $sections viene del conf main.php
foreach ($sections as $seccion_nombre => $seccion) {
    foreach($seccion['sections'] as $info){
        if ($info['conf'] == $maintable) {
            $tipodepermiso = $info['permissions'];
            break(2);
        }
    }
}
/* cabe preguntar si es root y pisar los permisos */
if ($userhierarchy == 1) {
    $tipodepermiso = 4;
}
?>