<?php
namespace App\Service;

use Doctrine\Orm\EntityManagerInterface;
use App\Entity\File;
use App\Exception\NoFileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager extends BaseEntityManager
{

    public function __construct(EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, File::class);
        
    }

    public function saveTextConent(TextContent &$text_content)
    {
        $this->saveEntity($text_content);
    }

    public function findTextContentByName(string $name) : TextContent
    {
        $repository = $this->manager->getRepository($entity_class);
    }

    public function saveFile($file, $directory)
    {
        if (!$file instanceof UploadedFile) {
            throw new NoFileException("file is not an instance of UploadedFile", 1);
        }        
        
        $fileName = $file->getClientOriginalName();
        $originalName = $file->getClientOriginalName();
        $originalExtension = $file->getClientOriginalExtension();
        $fileName = sha1(random_bytes(20));
        $type = $this->getFileType($originalExtension);

        $fileEntity = new File($fileName, $originalExtension, $originalName, $originalExtension, $type);        
        $file->move($directory, $fileName . '.' . $originalExtension);

        $this->createEntity($fileEntity);

        return $fileEntity;        

    }

    private function getFileType(string $extenstion) : string
    {
        switch($extenstion)
        {
            case 'pdf':
                return 'pdf';
            default: 
                return 'image';
        }
    }
}