<?php

class Config{
	
	private $sql = "SELECT * FROM config";
	private $cache = 15;
	private $values = array();
	private $file = "";
    
    public function __construct() {
    	$this->file = abs_path('/cache/config.json');			
		
		$data = array();
		// Si el archivo existe lo levantamos
		if (file_exists($this->file) && (filemtime($this->file) > (time() - 60 * $this->cache)) && ($this->cache > 0)) {
			$json = file_get_contents($this->file);
		   	$values = json_decode($json, true);
		} 
		// Sino generamos la consulta y guardamos el archivo
		else {
			$result = mysql_query($this->sql);
		   	if (mysql_num_rows($result) > 0) {
		       	while ($row = mysql_fetch_assoc($result)) {
		        	$this->values[$row['config_key']] = $row['config_val'];
		       	}
		   	}
		   	// Si el cache esta activo lo guardamos
			if($this->cache > 0){
		   		$json = json_encode($this->values);
				file_put_contents($this->file, $json, LOCK_EX);
		   	}
		}
    }
    
    public function get($key){
        return $this->values[$key];
    }
	
	public function merge($array){
		$this->values = array_merge($this->values, $array);
		
		// Si el cache esta activo lo guardamos
		if($this->cache > 0){
			$json = json_encode($this->values);
			file_put_contents($this->file, $json, LOCK_EX);
		}
	}
}