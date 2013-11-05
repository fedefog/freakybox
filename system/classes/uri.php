<?php

class uri{

    var $path;
	var $segments;

    function __construct() {
        if ((isset($_GET['uri'])) && ($_GET['uri'] != '')) {
            $path = trim($_GET['uri'], '/');
        }

		// Limpiamos la url de caracteres especiales y los convertimos a simples.
		$find = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','Ā','ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','Ļ','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','Ż','ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǎ','ǎ','Ǐ','ǐ','Ǒ','ǒ','Ǔ','ǔ','Ǖ','ǖ','Ǘ','ǘ','Ǚ','ǚ','Ǜ','ǜ','Ǻ','ǻ','Ǽ','ǽ','Ǿ','ǿ');
		$replace = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
		$path = str_replace($find, $replace, $path);
		
		//removemos la extension php que sera agregada luego en index.
		$path = str_replace('.php', '', $path);
		
		// Lo que no se pudo convertir lo sacamos afuera.
		$this->path = preg_replace('#[^A-Za-z0-9-./]#', '', $path);

		// Obtenemos las partes de las urls.
		if(strlen($this->path) > 0){
			$this->segments = explode('/', $this->path);
		}
    }
	
	 /**
     * Return the current path.
     * @return string
     */
    function path(){
        return $this->path;
    }

    /**
     * Return the selected segment.
     * @param integer $index
     * @return string
     */
    function segment($index){
        $index = $index - 1;
        $segment = "";
        if(isset($this->segments[$index])){
            $segment = $this->segments[$index];
        }
        return $segment;
    }
	
    /**
     * Retorna el path removiendo los ultimos segmentos seleccionados.
     * @param integer $escape
     * @return string
     */
	function pop_segment($escape = 0){
		if(count($this->segments) > 1){
			$parts = $this->segments;
			for($i = 0; $i < $escape; $i++){
				array_pop($parts);
			}
		}
		return implode('/', $parts);
	}
	
	/**
     * Retorna el path removiendo los primeros segmentos seleccionados.
     * @param integer $escape
     * @return string
     */
	function shift_segment($escape = 0){
		if(count($this->segments) > 1){
			$parts = $this->segments;
			for($i = 0; $i < $escape; $i++){
				array_shift($parts);
			}
		}
		return implode('/', $parts);
	}
	
	/**
     * Procesa que archivo debe mostrar de manera "inteligente" buscando el path verdadero.
     * @param string $folder
     * @return string
     */
	function template($folder = "/templates/"){
		$parts = $this->segments;
		if(count($this->segments) == 0){
			return abs_path($folder.'index.php');
		}
		for($i = 0; $i < count($this->segments); $i++){
			$template = abs_path($folder.implode('/', $parts).'.php');
			if(file_exists($template) && is_file($template)){
				return $template;
			}
			array_pop($parts);
		}
		return abs_path($folder.'404.php');
	}
}
?>