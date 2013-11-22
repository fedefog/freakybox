// JavaScript Document of Proyecto Happy

$(document).ready(function() {
		
	/* Slider */
	
		$('#steps').cycle({
			fx:      'scrollRight',
			next:   '#right-step', 
			prev:   '#left-step',
			 timeout: 4000
		});
	
	/* END */
		
});