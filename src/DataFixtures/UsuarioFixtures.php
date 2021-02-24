<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Usuario;

class UsuarioFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $password_encoder)
    {
        $this->password_encoder = $password_encoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getUsuarioData() as [$email, $roles, $password, $nome, $perfil]) {
            $usuario = new Usuario();
            $usuario->setEmail($email);
            $usuario->setRoles($roles);
            $usuario->setPassword($this->password_encoder->encodePassword($usuario, $password));
            $usuario->setNome($nome);
            $usuario->setPerfil($perfil);
            $manager->persist($usuario);
        }
        $manager->flush();
    }

    private function getUsuarioData(): array
    {
        return [
            ['admin@smail.loc', ['ROLE_ADMIN'], 'admin', 'Admilson Araujo', '0'],
            ['roberto@smail.loc', ['ROLE_USER'], 'passw', 'Roberto Garcia', '1'],
            ['jn@smail.loc', ['ROLE_PROFESSOR'], 'passw', 'John Nunes', '2']
        ];
    }
}
