<?php

class Lang {
    
    var $data = array();
    
    public function __construct($language = 'es') {
        $language = strtolower($language);
        if(file_exists(ABS_PATH."/system/lang/".$language.".php")){
            include_once(ABS_PATH."/system/lang/".$language.".php");
        }
        $this->data = $lang;
    }
    
    public function get($key){
        return $this->data[$key];
    }
    
}