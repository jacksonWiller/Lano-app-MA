<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $password_encoder)
    {
        $this->password_encoder = $password_encoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$email, $roles, $password, $registration, $name, $profiler]) {
            $user = new User();
            $user->setEmail($email);
            $user->setRoles($roles);
            $user->setPassword($this->password_encoder->encodePassword($user, $password));
            $user->setRegistration($registration);
            $user->setName($name);
            $user->setProfile($profiler);

            $manager->persist($user);
        }
        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            ['jw@symf4.loc', ['ROLE_ADMIN'], 'passw', 23432, 'John', 'Advisor'],
            ['jw@symf5.loc', ['ROLE_USER'], 'passw', 23434, 'John', 'Student'],
            ['jw@symf6.loc', ['ROLE_PROFESSOR'], 'passw', 23435, 'John', 'Professor']
        ];
    }
}
