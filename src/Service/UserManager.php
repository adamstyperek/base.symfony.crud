<?php
namespace App\Service;

use Doctrine\Orm\EntityManagerInterface;
use App\Entity\User;

class UserManager extends BaseEntityManager
{
    private $manager;
    private $encoder;

    public function __construct(EntityManagerInterface $entity_manager)
    {
        parent::__construct($entity_manager, User::class);
    }   

    public function createUser(User $user)
    {
        $this->createEntity($user);
    }

}