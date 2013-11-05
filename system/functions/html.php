<?php

/**
 * Genera un input de texto.
 * @param type $name
 * @param type $value
 * @param type $properties
 * @return string 
 */
function input($name, $value = '', $properties = array()) {
    $default['type'] = 'text';
    $default['name'] = $name;
    $default['value'] = $value;
    $properties = array_merge($default, $properties);

    $html = '';
    $html .= '<input ';
    foreach ($properties as $key => $value) {
        $html .= $key . '="' . $value . '" ';
    }
    $html .= '/>';
    return $html;
}

/**
 * Genera un input de password.
 * @param type $name
 * @param type $value
 * @param type $properties
 * @return string 
 */
function password($name, $value = '', $properties = array()) {
    $properties['type'] = 'password';
    return $this->input($name, $value, $properties);
}

/**
 * Genera un textarea.
 * @param type $name
 * @param type $value
 * @param type $properties
 * @return string 
 */
function textarea($name, $value, $properties = array()) {
    $html = '';
    $html .= '<textarea ';
    $html .= 'name="' . $name . '" ';
    foreach ($properties as $key => $value) {
        $html .= $key . '="' . $value . '" ';
    }
    $html .= '>' . $value . '</textarea>';
    return $html;
}

/**
 * Genera un input hidden.
 * @param type $name
 * @param type $value
 * @param type $properties
 * @return string 
 */
function hidden($name, $value = '', $properties = array()) {
    $properties['type'] = 'hidden';
    return $this->input($name, $value, $properties);
}

/**
 * Genera un checkbox.
 * @param type $name
 * @param type $value
 * @param type $properties
 * @return string 
 */
function checkbox($name, $value, $checked = false, $properties = array()) {
    $properties['type'] = 'checkbox';
    if ($checked === true) {
        $properties['checked'] = 'checked';
    }
    return $this->input($name, $value, $properties);
}

/**
 * Genera un radio.
 * @param type $name
 * @param type $value
 * @param type $properties
 * @return string 
 */
function radio($name, $value, $checked = false, $properties = array()) {
    $properties['type'] = 'radio';
    if ($checked === true) {
        $properties['checked'] = 'checked';
    }
    return $this->input($name, $value, $properties);
}

/**
 * Genera un select.
 * @param type $name
 * @param type $value
 * @param type $properties
 * @return string 
 */
function select($name, $options, $default, $properties = array()) {
    $html = '';
    $html .= '<select ';
    $html .= 'name="' . $name . '" ';
    foreach ($properties as $key => $value) {
        $html .= $key . '="' . $value . '" ';
    }
    $html .= '>';
    foreach ($options as $value => $name) {
        $selected = set_selected($value, $default);
        $html .= '<option value="' . $value . '" ' . $selected . '>' . $name . '</option>';
    }
    $html .= '</select>';
    return $html;
}

/**
 * Setea el valor enviado o el por defecto.
 * @param string $field
 * @param string $default
 * @return string 
 */
function set_value($field, $default=null){
    return (!empty($_POST[$field])) ? $_POST[$field] : $default;
}

/**
 * Selecciona el item correspondiente.
 * @param string $val1
 * @param string $val2 
 */
function set_selected($val1, $val2){
    echo ($val1 == $val2) ? 'selected="selected"' : '';
}

/**
 * Selecciona el item correspondiente.
 * @param type $val1
 * @param type $val2 
 */
function set_checked($val1, $val2){
	if(is_array($val2)){
		echo in_array($val1, $val2) ? 'checked="checked"' : '';
	}
    echo ($val1 == $val2) ? 'checked="checked"' : '';
}
?>
