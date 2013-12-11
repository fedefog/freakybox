// JavaScript Document of Freakybox

$(document).ready(function() {
		
	/* DESPLEGABLE PARA PROJECTS STATES */
	
	$('.all-projects-states').click(function (e) {
	  e.preventDefault();
	  $('#other-projects-states').toggleClass("visible");
    });
	
	/* DESPLEGABLE PARA SUBTASKS */
	
	$('a.view-subtask').click(function (e) {
	  e.preventDefault();
	  $(this).parent().parent().find('.subtask-wrapper').toggleClass("visible");
	  $(this).parent().parent().toggleClass("active");
    });
		
	/* CLOSE SIDEBAR */	
	
	$('a.close-sidebar').click(function (e) {
	  e.preventDefault();
	  $('.sidebar').toggleClass("no-visible");
	  $('.app-content').toggleClass("full-width");
    });
	
	/* DATAPICKER */
	
	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy'
	});
	
	/* COLOR PICKER */
	
	/*$('.colorpicker-control').colorpicker();*/
	
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
