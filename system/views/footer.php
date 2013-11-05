        <script type="text/javascript">
            $(document).ready(function() {
                Shadowbox.init();
                
                $("input, textarea").placeholder();
                
                $("#mainform").validationEngine();
                
                $(".tooltip").tooltip({
					position: {
						my: "center bottom-20",
						at: "center top",
						using: function( position, feedback ) {
							$( this ).css( position );
							$( "<div>" )
							.addClass( "arrow" )
							.addClass( feedback.vertical )
							.addClass( feedback.horizontal )
							.appendTo( this );
						}
					}
				});
				
				$("#del-chk").click(function(){
					if($(this).is(':checked')){
						$(".del-chk").attr("checked", "checked");
					}
					else{
						$(".del-chk").removeAttr("checked");
					}
				});
				
				$('.fullchecker').click(function(){
					var selector = $(this).attr("rel");
					if($(this).is(':checked')){
						$("." + selector).attr("checked", "checked");
					}
					else{
						$("." + selector).removeAttr("checked");
					}
				});
                
                $(".alert").delay(3000).fadeOut(300);
                
                $("#modulosleft, #modulosright").sortable({
                    placeholder: "drop",
                    connectWith: ".modulos",
                    start: function(event, ui) {
                        $('.drop').append('<div></div>');
                    },
                    stop: function(event, ui) {
                        var left = $("#modulosleft").sortable("toArray");
                        var right = $("#modulosright").sortable("toArray");
                        $.post('<?=ADMIN_FOLDER?>', {'left':left, 'right':right});
                    }
				}).disableSelection();
                
                $(".showpass").click(function(){
                	var old_field = $(this).prev('.password');
                	var new_field = old_field.clone();
                	if($(this).is(':checked')){
                		new_field.attr("type", "text");
						new_field.insertBefore(old_field);
						old_field.remove();
                	}
                	else{
                		new_field.attr("type", "password");
						new_field.insertBefore(old_field);
						old_field.remove();
                	}
                });
                                                
                $(".orden").each(function(){
                	var val = $(this).val();
                	var min = $(this).attr('min');
                	var max = $(this).attr('max');

                	if(val == ''){
                		$(this).val('0');
                	}
                	if(min == ''){
                		$(this).attr('min', 0);
                	}
                	if(max == ''){
                		$(this).attr('max', 1000);
                	}
                	
                	var updown = '<div class="updown"><a href="#" class="upval">Up</a><a href="#" class="downval">Down</a></div>';
                	$(this).after(updown);
                });
                
                $(".upval").live('click', function(e){
                	var input = $(this).parent().parent().find('input');
                	var val = Number(input.val());
                	var max = input.attr('max');

                	if(val < max){
                		input.val(val + Number(1));
                	}
                	else{
                		alert("Se alcanzó el máximo valor disponible.");
                	}
                	e.preventDefault();
                });
                
                $(".downval").live('click', function(e){
                	var input = $(this).parent().parent().find('input');
                	var val = Number(input.val());
                	var min = input.attr('min');

                	if(val > min){
                		input.val(val - Number(1));
                	}
                	else{
                		alert("Se alcanzó el minimo valor disponible.");
                	}
                	e.preventDefault();
                });
                                                                
                $(".editable").live('dblclick', function(){
                     var strId = $(this).attr("item");
                     var field = $(this).attr("field");
                     var strEditText = $(this).text();
                     $(this).after("<input item='" + strId + "' field='" + field + "' type='text' value='" + strEditText + "' />   <a href='#' class='editsave'>Guardar</a>   <a href='#' class='editcancel'>Cancelar</a>");
                     $(this).hide();
                      return false;
                 });
                                                                   
                $(".editsave").live('click', function(){
                    var id = $(this).prev().attr('item');
                    var field = $(this).prev().attr('field');
                    var field_id = $(this).prev().attr('field').split('_');
                    var content = $(this).prev().val();

                    $.ajax({
                      type: "POST",
                      url: "<?=ADMIN_FOLDER?><?=$pathprocess->bf?>/actions",
                      data: field_id[0]+"_id="+id+"&"+field+"="+content
                    }).done(function() {
                      alert("Elemento guardado correctamente.");
                    });
                    
                    $(this).next().remove();
                    $(this).prev().remove();
                    $(this).prev().text(content);
                    $(this).prev().show();
                    $(this).remove();
                    return false;
                });
                
                $('.editcancel').live('click', function(){
                    $(this).prev().remove();
                    $(this).prev().remove();
                    $(this).prev().show();
                    $(this).remove();
                    return false;
                });
                
                $(".autocomplete").each(function() {
                    var el = $(this);
                    el.autocomplete({
						source: "/system/_ajax/autocomplete.php?table="+el.attr('table')+"&column="+el.attr('column'),
						minLength: 1,
						select: function( event, ui ) {
                            el.val(ui.item.value);
							return false;
						}
					});
                 });
                 
                
                $(".tagsearch").each(function() {
                    var el = $(this);
                    el.autocomplete({
                        source: "/system/_ajax/tags.php?table="+el.attr('table')+"&filter="+el.attr('filter'),
                        minLength: 1,
                        select: function(event, ui) {
                            var tag = '<span class="tag"><input name="'+el.attr('field')+'['+ui.item.id+']" type="hidden" value="'+ui.item.id+'"/>'+ui.item.nombre+'<a href="#" class="removetag" title="Quitar">x</a></span>';
                            el.val("");
                            el.next().append(tag);
			return false;
			}
                    }).data( "autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a>" + item.nombre + "</a>" )
				.appendTo( ul );
                    };
                    // whatever else you want to do with the element
                });
                
                $(".tagsearch").keypress(function (e){
                    if (e.which == 13) {
                        e.preventDefault();
                        var tag = '<span class="tag"><input name="'+$(this).attr('field')+'[0][]" type="hidden" value="'+$(this).val()+'"/>'+$(this).val()+'<a href="#" class="removetag" title="Quitar">x</a></span>';
                        $(this).next().append(tag);
                        $(this).val("");
                        return false;
                    }
                });
                
                $('.removetag').live('click', function(){
                    $(this).parent().remove();
                    return false;
                });
                
                $('a.addrow').click(function(e){
                	e.preventDefault();
                	var tr = $(this).parent().parent().parent().find('.clonerow');
                	var table = $(this).parent().parent().parent();
					var clone = tr.clone();
					clone.find(':text').val('');
					table.append(clone.removeClass('clonerow'));
                });
                
                $('a.remrow').live('click', function(e){
                	e.preventDefault();
                	var tr = $(this).parent().parent();
                	if(tr.hasClass('clonerow') == false){
                		tr.remove();
                	}
                	
                });
                
                tinyMCE.init({
                    entity_encoding : "raw",
                    // General options
                    mode : "textareas",
                    editor_selector : "tinymce",
                    theme : "advanced",
                    skin : "o2k7",
                    skin_variant : "silver",
                    plugins : "pagebreak,style,layer,table,save,advhr,imageupload,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
					relative_urls : false,

                    // Theme options
                    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
                    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,imageupload,image,cleanup,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                    theme_advanced_buttons3 : "",
                    theme_advanced_buttons4 : "",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_resizing : false,

                    // Drop lists for link/image/media/template dialogs
                    template_external_list_url : "js/template_list.js",
                    external_link_list_url : "js/link_list.js",
                    external_image_list_url : "js/image_list.js",
                    media_external_list_url : "js/media_list.js"
                });

                $('.timewdgt').timepicker();

                $('.calendariowdgt').each(function(index) {
                    var format = $(this).attr('format');
                    $(this).datepicker({
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 1,
                        dateFormat: format,
                        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
                            'Junio', 'Julio', 'Agosto', 'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr',
                            'May', 'Jun', 'Jul', 'Ago',
                            'Sep', 'Oct', 'Nov', 'Dic']  
                    });
                });
                               
                $('.imagelist li div.holder').live('mouseover', function(){
                    $(this).children('div.controls').show();
                })
                $('.imagelist li div.holder').live('mouseout', function(){
                    $(this).children('div.controls').hide();
                });
                
                $('.imagelist li div.holder div.controls a.remove').live('click', function(){
                    var el = $(this);
                    var id = $(this).attr('data-id');
                    var hash = $(this).attr('data-hash');
                    var table = $(this).attr('data-table');
                    var field = $(this).attr('data-field');

                    if(table != ''){
                        var url = "delsec=1&id="+id+"&table="+table;
                    }
                    else{
                        var url = "filefield="+field+"&id="+id;
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?= ADMIN_FOLDER ?><?= $pathprocess->bf ?>/actions",
                        data: url
                    }).done(function() {
                        el.parent().parent().parent().remove();
                        $('input[data-hash="'+hash+'"]').remove();
                    });
                    return false;
                });
                
                $('.filelist li a.remove').live('click', function(){
                    var el = $(this);
                    var id = $(this).attr('data-id');
                    var file = $(this).attr('data-file');
                    var table = $(this).attr('data-table');
                    var field = $(this).attr('data-field');

                    if(table != ''){
                        var url = "delsec=1&id="+id+"&table="+table;
                    }
                    else{
                        var url = "filefield="+field+"&id="+id;
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?= ADMIN_FOLDER ?><?= $pathprocess->bf ?>/actions",
                        data: url
                    }).done(function() {
                        el.parent().remove();
                        $("#"+field+file).remove();
                    });
                    return false;
                });
                
            });
        </script>
    </body>
</html>