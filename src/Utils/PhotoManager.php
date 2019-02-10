<?php

namespace App\Utils;

use App\Exception\NoFileException;


class PhotoManager 
{
    public function resizePhoto(string $file_name, string $base_directory, array $sizes)
    {
        if(!file_exists($base_directory . '' . $file_name))
        {
            throw new NoFileException("File does not exists", 2);
        }

        foreach($sizes as $thumb_name => $resolution)
        {
            if(!(isset($resolution[0]) && isset($resolution[1]))) {
                throw new NoResulutionException("Resolution for file is not set", 3);
            }

            $thumb_file_name = $base_directory . $thumb_name . '/' . $file_name;
            if(file_exists($thumb_file_name)) {
                unlink($thumb_file_name);
            }

            $this->GenerateThumbnail($base_directory . $file_name, $thumb_file_name, $resolution[0], $resolution[1]);
        }
    }

    protected function GenerateThumbnail($im_filename, $th_filename, $max_width = 400, $max_height = 800, $quality = 1.0)
    {
        if(file_exists($th_filename)) {
            unlink($th_filename);
        }
        $thumb=new Imagick($im_filename);

        //Work out new dimensions
        list($newX,$newY)=$this->scaleImage(
            $thumb->getImageWidth(),
            $thumb->getImageHeight(),
            $max_width,
            $max_height);

        //Scale the image
        $thumb->thumbnailImage($newX,$newY);

        //Write the new image to a file
        $thumb->writeImage($th_filename);     
        return $th_filename;
    }
    
    private function scaleImage($x,$y,$cx,$cy) {
        //Set the default NEW values to be the old, in case it doesn't even need scaling
        list($nx,$ny)=array($x,$y);

        //If image is generally smaller, don't even bother
        if ($x>=$cx || $y>=$cx) {

            //Work out ratios
            if ($x>0) $rx=$cx/$x;
            if ($y>0) $ry=$cy/$y;

            //Use the lowest ratio, to ensure we don't go over the wanted image size
            if ($rx>$ry) {
                $r=$ry;
            } else {
                $r=$rx;
            }

            //Calculate the new size based on the chosen ratio
            $nx=intval($x*$r);
            $ny=intval($y*$r);
        }    

        //Return the results
        return array($nx,$ny);
    }
}