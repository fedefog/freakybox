<?php

class output{

    var $headers;
	var $output;
	
    function __construct() {
        
    }
	
	function load($file, $vars, $return = false){
		
		if (is_array($vars) && count($vars) > 0) {
            extract($vars, EXTR_OVERWRITE);
        }
		
		if(!file_exists($file)){
			return;
		}
		
		$output = '';
		
        ob_start();
        include($file);
        $output = ob_get_contents();
        @ob_end_clean();

		if($return === true){
			return $output;
		}
		
		$this->append_output($output);
	}
	
	function append_output($data) {
        if (!empty($data)) {
            $this->output .= $data;
        }
    }
	
	function add_header($header, $value){
		$this->headers[$header] = $value;
	}
	
	function display(){
		// There is any server header to add?
		if (!headers_sent() && count($this->headers) > 0) {
            foreach ($this->headers as $header => $value) {
                @header($header, $value);
            }
        }
		
		echo $this->output;
	}
}
?>