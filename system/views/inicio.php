<?
/*****************************************************
*   inicio.php:                                      *
*        Aqui se continua (y termina) la construcci�n*
*           de la p�gina que comenz� con el head.php *
*****************************************************/

if($input->post('left') || $input->post('right')){
    $left = $input->post('left');
    foreach($left as $position => $module){
        $data = array(
            'modulo_orden' => $position,
            'modulo_position' => 'left'
        );
        $database->where('modulo_id', substr($module, 5))->update($data, 'modulo');
    }
    
    $right = $input->post('right');
    foreach($right as $position => $module){
        $data = array(
            'modulo_orden' => $position,
            'modulo_position' => 'right'
        );
        $database->where('modulo_id', substr($module, 5))->update($data, 'modulo');
    }
}

$query = $database->where('modulo_activo', '1')->order_by('modulo_orden')->get('modulo');
$mods = $query->row_array;

$left = array();
$right = array();

if(count($mods)>0){
    foreach($mods as $modulo){
        if($modulo['modulo_position'] == 'right'){
        $right[] = $modulo;
        }
        else{
            $left[] = $modulo;
        }
    }
}
?>

<body>
    <?//Agrego el header.php con el logo, fecha, etc.?>
    <?include(ABS_PATH."/system/views/header.php")?>

    <?//Agrego menubar.php que es el top men� de administra?>
    <?include(ABS_PATH."/system/views/menubar.php")?>

    <div id="maincontent">
        <div class="head-content">
        <h1 class="titulos"><?=$html_title?></h1>
        </div>
        <div class="clearfix" style="height: 1px; width: 100%"></div>
        <div id="container">
            <? if(count($mods) > 0){ ?>
            <ul id="modulosleft" class="modulos">
            <? foreach($left as $modulo){ ?>
                <li id="item_<?=$modulo['modulo_id']?>" class="left"><? include(ABS_PATH.'/system/modules/'.$modulo['modulo_archivo']); ?></li>
            <? } ?>
            </ul>
            <ul id="modulosright" class="modulos">
            <? foreach($right as $modulo){ ?>
                <li id="item_<?=$modulo['modulo_id']?>" class="right"><? include(ABS_PATH.'/system/modules/'.$modulo['modulo_archivo']); ?></li>
            <? } ?>
            </ul>
            <? } ?>
        </div>
    </div>

<? include_once('footer.php') ?>
