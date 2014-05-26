// JavaScript Document of Freakybox

$(document).ready(function() {

	/* CAROUSEL */

	$('.carousel').carousel({
	  interval: false
	})

	/* Like bt */
	
	$('.like-update a').click(function (e) {
	  e.preventDefault();
	  $(this).toggleClass("active");
    });
		
	/* DESPLEGABLE PARA PROJECTS STATES */
	
	$('.all-projects-states').click(function (e) {
	  e.preventDefault();
	  $('.other-projects-states').toggleClass("visible");
    });

	setTimeout(function() {
    $('.other-projects-states .edit-project').filter(function(index){
	 return (index%5 == 4);
	}).addClass('last');
	}, 1000);
	
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
	
	/* COMPANY NAME */
	
	/* DESPLEGABLE PARA SUBTASKS */
	
	$('#company-name-edit').click(function (e) {
	  e.stopPropagation();
	  e.preventDefault();
	  /*$('#company-name').removeAttr('disabled');*/
	  $('.company-wrapper').addClass("active");
    });
	
	/*$('html').click(function() {
		$('#company-name').attr('disabled','disabled');
	  	$('.company-wrapper').removeClass("active");
	});*/
	
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
		 /* codigo para arreglar el alto de los tasks */
		 if(($(this).width() >=768)) {
		 	 var tasks_height = $('body').height() -352;
             $('.list-tasks-generic').css({ maxHeight: tasks_height + 'px' })
		 }
      })
      .resize();
});
