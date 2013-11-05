<?php
/**
 * array_unshift no permite agregar keys.
 * 
 * @param array &$arr
 * @param string $key
 * @param mixed $val
 * @return array 
 */
function array_unshift_assoc(&$arr, $key, $val){
    $arr = array_reverse($arr, true);
    $arr[$key] = $val;
    return array_reverse($arr, true);
} 
?>