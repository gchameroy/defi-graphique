<?php

namespace App\DataFixtures;


use App\DataFixtures\Helper\FixtureHelper;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends FixtureHelper
{
    /** @var UserPasswordEncoderInterface */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        parent::__construct();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUser($manager);
    }

    private function loadUser(ObjectManager $manager)
    {
        $user = (new User())
            ->setEmail('user@test.fr')
            ->setPlainPassword('user');
        $password = $this->encoder
            ->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password)
            ->eraseCredentials();
        $this->setReference('user-user', $user);
        $manager->persist($user);
        $manager->flush();
    }
}