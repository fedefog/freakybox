<?php

$main_id = $_GET['mainid'];

if($_GET['table']){
    $table = $_GET['table'];
    $id = $_GET[$table.'_id'];
    $field = $_GET['mainfield'];
}

if($_GET['secondary']){
    $table = $_GET['secondary'];
    $id = $_GET[$table.'_id'];
    $field = $table.'_imagen';
}

$img_qr = mysql_query("SELECT $field FROM $table WHERE ".$table."_id = '$id'") or die(mysql_error());
$row = mysql_fetch_array($img_qr);

$crop = $fields[$_GET['mainfield']]['crop'];
$dimensions = array();

$crops = explode('|', $crop);
foreach($crops as $c){
    $name = str_replace('m', '', $c);
    $name1 = str_replace('x', '', $name);
    $name2 = str_replace('y', ' x ', $name1);
    $size = $crops = explode(' x ', $name2);
    $dimensions[] = array('original' => $c, 'name' => $name2, 'w' => ($size[0])?$size[0]:50, 'h' => ($size[1])?$size[1]:50);
}

$realsize = getimagesize(ABS_PATH."/upfiles/".$row[0]);

if(isset($list)){
    $_fields=$edita;
}else{
    $_fields=getFileds($pathprocess->bf);
}
?>
<body>
<script language="Javascript">
    $(document).ready(function() {
        var jcrop_api;

        jcrop_api = $.Jcrop('#cropbox',{
            /*onChange: showPreview,
            onSelect: showPreview,*/
            minSize:     [<?=(!empty($querystring['x']))?$querystring['x']:'50'?>, <?=(!empty($querystring['y']))?$querystring['y']:'50'?>],
            onSelect:    showCoords,
            bgColor:     'black',
            bgOpacity:   .4,
            setSelect:   [0, 0, 50, 50]
        });
                    // Our simple event handler, called from onChange and onSelect
            // event handlers, as per the Jcrop invocation above
            
        $('.rdopt').click(function(){
            var w = $(this).attr('w');
            var h = $(this).attr('h');

            $('.cropsend').val($(this).attr('crop'));

			if(h>50){
            	jcrop_api.setOptions({
            		minSize:[w, h],
                	aspectRatio: w/h,
                	setSelect: [0,0,w,h]
            	});
           	}
			else{
           		jcrop_api.setOptions({
           			minSize:[w, 50],
           			aspectRatio: 0,
                	setSelect: [0,0,w,h]
            	});
           	}
        });
    });
    
    
    function showCoords(c){
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#x2').val(c.x2);
        $('#y2').val(c.y2);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }                               
    
    function showPreview(coords){
        var rx = 100 / coords.w;
        var ry = 100 / coords.h;

        $('#preview').css({
            width: Math.round(rx * 500) + 'px',
            height: Math.round(ry * 370) + 'px',
            marginLeft: '-' + Math.round(rx * coords.x) + 'px',
            marginTop: '-' + Math.round(ry * coords.y) + 'px'
        });
    }
</script>
<?include(ABS_PATH."/system/views/header.php")?>
<?include(ABS_PATH."/system/views/menubar.php")?>
<div id="maincontent">
            <div class="head-content">
                <h1 class="titulos">Cropear</h1>
                <div class="clearfix" style="width:100%"></div>
            </div>
<div class="form" id="container">
        <form action="<?=ADMIN_FOLDER?><?=$pathprocess->bf?>/resizecrop" method="post" name="form1" id="form1" enctype="multipart/form-data">
                    
        <fieldset title="">
            <div class="formfield boolean"> 				    
                <label class="clearfix" for="libro_activo">Dimensiones:</label>
                <?foreach($dimensions as $dimension){?>
                    <input class="rdopt" type="radio" name="dimension" crop="<?=$dimension['original']?>" w="<?=$dimension['w']?>" h="<?=$dimension['h']?>"/><span class="label"><?=$dimension['name']?></span>
                <?}?>
            </div>
            
            <div class="formfield">
                <img src="<?=upload_path($row[0])?>" id="cropbox" width="<?=$realsize[0]?>" height="<?=$realsize[1]?>" />
                <input type="hidden" size="4" id="x" value="0" name="x"/>
                <input type="hidden" size="4" id="y" value="0" name="y"/>
                <input type="hidden" size="4" id="name" value="<?=$row[0]?>" name="name"/>
                <input type="hidden" size="4" id="x2" value="<?=$querystring['x']?>" name="x2"/>
                <input type="hidden" size="4" id="y2" value="<?=$querystring['y']?>" name="y2"/>
                <input type="hidden" size="4" id="w" value="<?=$querystring['x']?>" name="w"/>
                <input type="hidden" size="4" id="h" value="<?=$querystring['y']?>" name="h"/>
                <input type="hidden" size="4" id="originalsizex" value="<?=$realsize[0]?>" name="originalsizex"/>
                <input type="hidden" size="4" id="originalsizey" value="<?=$realsize[1]?>" name="originalsizey"/>
            </div>
        </fieldset>

        <table cellspacing="0" cellpadding="2" border="0" width="100%">
            <tbody><tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right" colspan="2">
                        <button tabindex="4" id="save-post" name="save" type="submit">Guardar</button>&nbsp;
                        <button onclick="document.location='/admin/tag/list?ch=1&amp;navigation=back'" class="button-cancel" tabindex="4" value="" id="save-post" name="save" type="button">Cancelar</button>
                    </td>
                </tr>
            </tbody></table>
        <input type="hidden" value="<?=$row[0]?>" name="name"/>
        <input class="cropsend" type="hidden" value="0" name="crop"/>
        <input type="hidden" value="<?=$main_id?>" name="<?=$pathprocess->bf?>_id"/>
    </form>
</div>

</div>
</body>
</html>
