<?php
// Echo
function _e($string){
	echo $string;
}

function sortParent($array, $id, $parent){
    $newArray = array();
    $parent_id = 0;
    foreach($array as $parentItem){
        if($parentItem[$parent] == 0){
            $parent_id = $parentItem[$id];
            $newArray[$parentItem[$id]] = $parentItem;
            foreach($array as $childItem){
                if($childItem[$parent] == $parent_id){
                    $newArray[$childItem[$id]] = $childItem;
                }
            }
        }
        
    }
    return $newArray;
}

function prepareJSON($input) {
   
    //This will convert ASCII/ISO-8859-1 to UTF-8.
    //Be careful with the third parameter (encoding detect list), because
    //if set wrong, some input encodings will get garbled (including UTF-8!)
    $imput = mb_convert_encoding($input, 'UTF-8', 'ASCII,UTF-8,ISO-8859-1');
   
    //Remove UTF-8 BOM if present, json_decode() does not like it.
    if(substr($input, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) $input = substr($input, 3);
   
    return $input;
}