<?php
namespace App\Service;

use Doctrine\Orm\EntityManagerInterface;

class BaseEntityManager
{

    const SLUG_ARRAY = array(
        'Ą' => 'A',
        'Ć' => 'C',
        'Ę' => 'E',
        'Ł' => 'L',
        'Ń' => 'N',
        'Ó' => 'O',
        'Ś' => 'S',
        'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a',
        'ć' => 'c',
        'ę' => 'e',
        'ł' => 'l',
        'ń' => 'n',
        'ó' => 'o',
        'ś' => 's',
        'ź' => 'z',
        'ż' => 'z',
        ' ' => '-',
        '!' => '-',
        '?' => '-',
        '#' => '-',
        '@' => '-',
        '$' => '-',
        '%' => '-',
        '^' => '-',
        '&' => '-',
        '*' => '-',
        '=' => '-',
        '+' => '-',
        '/' => '-',
        '\\' => '-',
        '"' => '',
        '`' => '',
        '\'' => '',
        '“' => '',
        '”' => '',
        '<br>' => '',
        '<br/>' => '',
    );

    protected $entity_manager;
    protected $entity_class;

    public function __construct(EntityManagerInterface $entity_manager, $entity_class)
    {
        $this->entity_manager = $entity_manager;
        $this->entity_class = $entity_class;
    }

    public function getAll()
    {
        $repository = $this->entity_manager->getRepository($this->entity_class);

        return $repository->findAll();
    }

    protected function getEntityById(int $id)
    {
        $repository = $this->entity_manager->getRepository($this->entity_class);

        return $repository->find($id);
    }

    protected function saveEntity(&$entity)
    {
        $this->entity_manager->flush();
    }

    protected function createEntity(&$entity)
    {
        $this->entity_manager->persist($entity);
        $this->entity_manager->flush();
    }

    protected function slugify($text)
    {
        $strtr = strtr(trim($text), self::SLUG_ARRAY);
        return strtolower($strtr);

    }


}