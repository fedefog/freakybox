<?php
function elipsis($string, $start, $end){
	
	if (mb_strlen($string) <= $end){
		return $string;
	}
	
	$out = mb_substr($string, $start, $end);
	
	if (mb_strpos($string,' ') === FALSE){
		return $out."&hellip;";
	}
	
	return preg_replace('/\w+$/','',$out).'&hellip;';
}
?>