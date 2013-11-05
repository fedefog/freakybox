<?php
/**
 * Filtra la variables y devuelve integers.
 * @param mixed $variable
 * @return integer 
 */
function integer($variable){
    return filter_var($variable, FILTER_SANITIZE_NUMBER_INT);
}

/**
 * Filtra la variables y devuelve floats.
 * @param mixed $variable
 * @return float 
 */
function float($variable){
    return filter_var($variable, FILTER_SANITIZE_NUMBER_FLOAT);
}

/**
 * Filtra la variables y devuelve strings.
 * @param mixed $variable
 * @return string 
 */
function string($variable){
    return filter_var($variable, FILTER_SANITIZE_STRING);
}