<?php
namespace App\Service;

use Doctrine\Orm\EntityManagerInterface;

class BaseEntityManager
{

    protected $entity_manager;
    protected $entity_class;

    public function __construct(EntityManagerInterface $entity_manager, $entity_class)
    {
        $this->entity_manager = $entity_manager;
        $this->entity_class = $entity_class;
    }

    public function getAll()
    {
        $repository = $this->manager->getRepository($entity_class);

        return $repository->findAll();
    }

    protected function getEntityById(int $id)
    {
        $repository = $this->manager->getRepository($entity_class);

        return $repository->find($id);
    }

    protected function saveEntity(&$entity)
    {
        $entity_manager->flush();
    }

    protected function createEntity(&$entity)
    {
        $entity_manager->persist($entity);
        $entity_manager->flush();
    }


}