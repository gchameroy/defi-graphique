<?php
namespace App\Service\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method UserRepository getRepository()
 * @method User           getNew()
 * @method User|null      get(int $id, bool $check = true)
 * @method User[]         getList()
 * @method User           save(User $user)
 * @method void           remove(User $user)
 * @method void           checkEntity(?User $user)
 */
class UserManager extends EntityManager
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, User::class);
    }
}
