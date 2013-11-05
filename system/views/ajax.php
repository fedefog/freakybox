<?php
$response = array();

$field = $_REQUEST['field'];

$secondary = $_REQUEST['secondary'];
$id = $_REQUEST['id'];

$action = $_REQUEST['action'];
$subaction = $_REQUEST['subaction'];
switch ($action) {
    case 'upload':
            foreach ($_FILES as $key => $value) {
                $files = count($value['name'])+1;
                for ($i = 0; $i < $files; $i++) {
                    //key es el nombre del campo
                    //value trae tmp_name - name - type - error - size
                    if (isset($fields[$key]['fieldcomponent'])) {
                        $ext = explode(".", $value['name'][$i]);
                        $newname = $key . "_" . $id . "_" . time() . "." . $ext[count($ext) - 1];
                        switch ($fields[$key]['fieldcomponent']) {
                            case 'imagen':
                                if ((isset($fields[$key]['crop'])) && ($fields[$key]['crop'] != "")) {
                                    $ban = create_resized_copies($value['tmp_name'][$i], UPLOAD_PATH . "/" . $newname, $fields[$key]['crop'] . "|o|x900|x100y100");
                                }
                                else {
                                    $ban = create_resized_copies($value['tmp_name'][$i], UPLOAD_PATH . "/" . $newname, "o|x900|x100y100");
                                }
                                if ($ban) {
                                    $response[] = array(
                                        'name' => $newname, 
                                        'size' => filesize(UPLOAD_PATH . "/" . $newname), 
                                        'url' => HTML_UPLOAD_PATH . "/" . $newname, 
                                        'thumbnail_url' => HTML_UPLOAD_PATH . "/x100y100/" . $newname
                                    );
                                }
                                break;
                            case 'archivo':
                                if ((isset($fields[$key]['originalname'])) && (strtoupper($fields[$key]['originalname']) == 'Y')) {
                                    //parche 7-5-2010 no cambiar nombre a files
                                    $newname = $value['name'][$i];
                                }
                                $ban = move_uploaded_file($value['tmp_name'][$i], UPLOAD_PATH . "/" . $newname);
                                if ($ban) {
                                    $response[] = array('name' => $newname, 'size' => filesize(UPLOAD_PATH . "/" . $newname), 'url' => HTML_UPLOAD_PATH . "/" . $newname);
                                }
                                break;
                            default:
                                move_uploaded_file($value['tmp_name'][$i], UPLOAD_PATH . "/" . $newname);
                                break;
                        }
                    }
                }
            }
        break;

    case 'file':
        switch ($subaction) {
            case 'delete':

            break;

            default:
            break;
        }
        break;
    break;

    case 'gallery':
        switch ($subaction) {
            case 'delete':
                $id = $_REQUEST['id'];
                $sql=mysql_query("UPDATE ".$maintable." SET ".$_REQUEST['filefield']." = '' where ".$maintable."_id=".$id.";");
                @unlink(ABS_PATH."/upfiles/".$_REQUEST['value']);
            break;

            case 'list':
            default:
                if(!empty($secondary)){
                    $img_qr = mysql_query("SELECT * FROM ".$secondary." WHERE fk_".$maintable."_id = '$id';");
                }
                else{
                    $img_qr = mysql_query("SELECT * FROM ".$maintable." WHERE ".$maintable."_id = '$id';");
                }

                $images = array();
                while($img = mysql_fetch_assoc($img_qr)){
                    $images[] = $img;
                }
                $response = array('error' => 0, 'images' => $images);
            break;
        }
        break;
    default:
        break;
}

die(json_encode($response));