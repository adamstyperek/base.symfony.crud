<?php

namespace App\Service;

use App\Entity\File;

interface EntityWithPhotoManagerInterface
{
    public function create(&$entity, File $photo);
    public function update(&$entity, File $photo);
    public function getBasePhotoDirectory() : string;
    public function getThumbSizes() : array;
}