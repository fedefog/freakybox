<?php
 /******************************************************
 *  files-create_resized_copies.php:                   *
 *                                                     *
 ******************************************************/

  function create_resized_copies($src_file,$new_file=NULL,$rstring=NULL,$x=0,$y=0,$w=0,$h=0,$crop=0){
    if(!$src_file or !$new_file){
        return NULL;
    }
    if(!$rstring){
        //Copy original size
        if(move_uploaded_file($src_file, $new_file))
            return true;
        else
            return "Error al intentar copiar el archivo.";
    }else{
        if (is_array($rstring))
        {
            foreach ($rstring as $key=>$campo)
            {
                if ($key=="crop")
                {
                    $arr_copies = explode("|",$campo);
                }
            }
            if (count($arr_copies)==0)
            {
                $arr_copies[]="o";
            }
        }
        else
        {
            $rstring = "x100y100|x50y50|".$rstring;
            $arr_copies = explode('|',$rstring);
        }
        //Resized copies
        $prefixes= array("","t","m");
        if(count($arr_copies)){
            //1)Get info of source file
            $ext = end(explode('.',  strtolower($new_file)));

            if(!in_array($ext, array('gif','bmp','jpg','jpeg','png'))){
                return false;
            }
            
            $img_src = imagecreatefromstring(file_get_contents($src_file));

            //2)Build the copies
            if($crop==0){
                $src_w=imagesx($img_src);
                $src_h=imagesy($img_src);
            }else{
                $src_w=$w;
                $src_h=$h;
            }

            foreach($arr_copies as $i=>$copy){

                //Decode the copy-string: the first charater indicates the mode
                $c=substr($copy,0,1);

                //m: use the greatest (max) dimension to limit size


                //Crop Rectangle default size and position
                $crop_x=$x;
                $crop_y=$y;
                $crop_h=$src_h;
                $crop_w=$src_w;


                //Resize image using height ("y") or width ("x")
                switch($c) {
                    case "x":
                        //case x y: resize and crop canvas
                        if(($height_pos=strpos($copy,"y"))!==false){
                            $new_w =(int)substr($copy,1,$height_pos-1);
                            $new_h=(int)substr($copy,$height_pos+1);

                            //CALCULATE CROP Rectangle)
                            //The dest. dimension wich is nearest to the img src
                            //will be kept.
                            $dif_w=($src_w / $new_w);    //works even when dest is bigger than src (don't use abs)
                            $dif_h=($src_h / $new_h);

                            if($dif_w < $dif_h) {
                                //Keep width of source, and crop height
                                $crop_w=$src_w;
                                $crop_h=ceil($src_w*($new_h/$new_w));
                                //$crop_h=round(($src_h*$crop_w)/$src_w);

                                //Rectangle position
                                if($crop==0){
                                    $crop_y=round(abs(($src_h-$crop_h)/2));
                                    $crop_x=0; //was almsgready in 0
                                }
                            }else{
                                //Keep height of source, and crop width
                                $crop_h=$src_h;
                                $crop_w=ceil($src_h*($new_w/$new_h));
                                //$crop_w=round($src_w*$crop_h/$src_h);

                                //Rectangle position
                                if($crop==0){
                                    $crop_x=round(abs(($src_w-$crop_w)/2));
                                    $crop_y=0; //was almsgready in 0
                                }
                            }

                        }else{//end if mode x-y
                            $new_w = (int) substr($copy,1);
                            $new_h = (int) $src_h * ( ((float) $new_w)/((float)$src_w));

                        }
                    break;
                    case "m":
                        $crop = substr($copy,1);
                        
                        if($src_w < $src_h){
                            $new_h = $crop;
                            
                            $ratio = $src_w / $src_h;  
                            $new_w = $crop * $ratio;  
                            
                            $crop_x = 0;
                            $crop_y = $crop_y / 2;
                        }
                        if($src_w > $src_h){
                            $new_w = $crop;
                            
                            $ratio = $src_h / $src_w;  
                            $new_h = $crop * $ratio; 
                            
                            $crop_x = $crop_x / 2;
                            $crop_y = 0;
                        }
                        if($src_w == $src_h){
                            $new_h = $crop; 
                            $new_w = $crop;
                            $crop_y = 0;
                            $crop_x = 0;
                        }

                    break;
                    case "y"://fix y (height) dimension, and calculate the width
                        $y = (int) substr($copy,1);
                        $new_h = $y;
                        $new_w = (int) $src_w * ( ((float) $y)/((float)$src_h));
                    break;
                    case "o"://keep Original size
                        $new_w = imagesx($img_src);
                        $new_h = imagesy($img_src);
                    break;
                }

                $img_dest = imagecreatetruecolor($new_w,$new_h)
                        or die("Uploader: Error - imagecreatetruecolor(). Sizes: $new_w,$new_h");

				if($ext=='png'){
					imagealphablending($img_dest, false);
					imagesavealpha($img_dest, true);
					$transparent = imagecolorallocatealpha($img_dest, 255, 255, 255, 127);
					imagefilledrectangle($img_dest, 0, 0, $new_w, $new_h, $transparent);
				}

            imagecopyresampled($img_dest,$img_src,0,0,$crop_x,$crop_y,$new_w,$new_h,$crop_w,$crop_h)
                        or die("Uploader: Error - imagecopyresampled()");
            //create dir and make writable if doesn't exists
            //request_writable_dir(dirname($dest_file));
            //echo "imagejpeg($img_dest,$dest_file,100)<br>";
            if (!file_exists(dirname($new_file)."/".$copy) && $copy!="o")
            {
                $dest_file = dirname($new_file)."/".$copy."/".basename($new_file);
                mkdir(dirname($dest_file));
                chmod(dirname($dest_file), 0777);
            }
            elseif($copy !="o")
            {
                $dest_file =  dirname($new_file)."/".$copy."/".basename($new_file);
            }
            else
            {
                $dest_file = $new_file;
            }

            switch($ext){
                case "gif":
                    if(!($img_src = imagecreatefromgif($src_file) ))
                        return "No se pudo reconocer el formato de archivo.";
                break;

                case "jpg":
                case "jpeg":
		            imagejpeg($img_dest,$dest_file,100)
		                or die("Uploader: Error - imagejpeg()");
                break;

                case "png":

		            imagepng($img_dest,$dest_file)
		                or die("Uploader: Error - imagepng()");
                break;
                default:
                    die("S�lo se aceptan im�genes <b>.gif</b> o .<b>jpg</b>");
            }


            chmod($dest_file, 0777);
            imagedestroy($img_dest);
            }//end foreach copy

        }//end if count copies

    }//end else (if !$rstring)


return true;
}//end function
?>