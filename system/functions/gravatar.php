<?php
function gravatar($email, $size = 48, $default = 'identicon'){
	return "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode( $default ) . "&s=" . $size;
}
?>
