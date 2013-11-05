<?php

class Input{
    
    public function __construct() {
        
    }
    
    public function get($key){
        return $_GET[$key];
    }
    
    public function post($key){
        return $_POST[$key];
    }
    
}