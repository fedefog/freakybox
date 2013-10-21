// JavaScript Document of Freakybox

$(document).ready(function() {
		
	
		
	
	/* END */
		
});


/* FUNCION PARA ARREGLAR HEIGHT Y WIDTH DE ALGUNOS BLOQUES */

$(function(){
     $(window).resize(function(){
		 /* Codigo para arreglar el alto del sidebar */
		 if(($(this).width() >=768)) {
             $('.row.workspace-wrapper').height($('body').height() -232);
		 }
		 /* Codigo para arreglar el alto de los mensajes */
		 if(($(this).width() >=768)) {
             $('.teams-updates').height($('body').height() -369);
		 }
      })
      .resize();
});
