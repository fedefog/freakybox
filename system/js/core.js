$(document).ready(function(){
	function placeholderize(el){
		var val = el.val();
		var placeholder = el.attr('placeholder');
		if(placeholder != ""){
			if(val == ""){
				el.val(placeholder);
			}
		}
	}
	
	$('input,textarea').each(function(i){
		placeholderize($(this));
	});
	
	$('input,textarea').blur(function(){
		placeholderize($(this));
	});
	
	$('input,textarea').click(function(){
		var val = $(this).val();
		var placeholder = $(this).attr('placeholder');
		if(placeholder != ""){
			if(val == placeholder){
				$(this).val("");
			}
		}
	});
});

function validate_form(form, submit){
		
	form_msg_error = "No se completaron los siguientes campos obligatorios [fields]";
	
	submit = typeof submit !== 'undefined' ? submit : 'undefined';
	
	var invalids = new Array();
	var invalid = false;
	
	// Reseteamos los estilos.
	$(form + ' .required').removeClass('invalid');
			
	var temp = "";
	$(form + ' .required').each(function(i, item) {
		
		var field = $(this);
		var type = $(this).attr('type');
		var name = $(this).attr('name');
		var placeholder = $(this).attr('placeholder');
		var label = typeof $(this).attr('title') !== 'undefined' ? $(this).attr('title') : 'undefined';
		
		if(type != 'radio' && type != 'checkbox'){
			if (field.val().length == 0 || field.val() == placeholder) {

				if (label !== 'undefined') {
					invalids.push(label);
				} 
				
				invalid = true;
				field.addClass('invalid');
			}
		}
		
		if (type == 'radio' || type == 'checkbox') {
			
			var length = $("input[name='" + name + "']:checked").length;
			
			if (length == 0) {
				// Evitamos la doble insersion del item en el alerta.
				if(temp != name){
					temp = name;
					invalids.push(label);
				}
				invalid = true;
				field.addClass('invalid');
			}
		}
		
	});

	if (invalids.length > 0 || invalid == true) {
		
		var invalids_str = "";
		if (invalids.length > 0) {
			var invalids_str = "\n" + invalids.join("\n");
		}
		
		form_msg_error = form_msg_error.replace('[fields]', invalids_str);
		alert(form_msg_error);
		return false;
	} else {
		if(submit === true){
			
			// Reseteamos el valor asi no se envia el placeholder
			$('input,textarea').click(function(){
				var val = $(this).val();
				var placeholder = $(this).attr('placeholder');
				if(placeholder != ""){
					if(val == placeholder){
						$(this).val("");
					}
				}
			});
			
			$(form).submit();
		}
		else{
			return true;
		}
	}
}