<?php
namespace App\Service;

use Doctrine\Orm\EntityManagerInterface;
use App\Entity\TextContent;

class TextContentManager extends BaseEntityManager
{

    public function __construct(EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, TextContent::class);
        
    }

    public function update(TextContent &$text_content)
    {
        $this->saveEntity($text_content);
    }

    public function findTextContentByName(string $name) : ?TextContent
    {
        $repository = $this->manager->getRepository($entity_class);

        return $repository->findOne(['name' => $name]);
    }
}