<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Usuario;
use App\Entity\Ideia;

class IdeiaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->IdeiaData() as [$titulo, $autor_id, $descricao]) {
            $ideia = new Ideia();
            

            $ideia-> setTitulo($titulo);  
            $ideia-> setDescricao($descricao);
            
            
            $autor = $manager->getRepository(Usuario::class)->find($autor_id);

            $ideia-> setAutor($autor);
            

            $manager->persist($ideia);
        }
        $manager->flush();
    }

    private function IdeiaData()
    {
        return [

            ['REDES COMUNITÁRIAS INCENTIVADAS COM USO DE BLOCKCHAIN ', '7', 'Em um mundo onde o acesso à internet se tornou crucial, 
                comunidades que não possuem acesso a ela podem ter seu desenvolvimento atrasado. 
                Tendo em vista esse problema.'],

            ['Estudo de caso da utilização de Gherkin para automatização de testes e obtenção de métricas de cobertura de requisitos ', '8', 'O presente trabalho apresenta o 
                estudo de caso da utilização da linguagem Gherkin como alternativa a documentação tradicionalmente utilizada pelo Laboratório Bridge.'],
                
                ['REDES COMUNITÁRIAS INCENTIVADAS COM USO DE BLOCKCHAIN ', '9', 'Em um mundo onde o acesso à internet se tornou crucial, 
                comunidades que não possuem acesso a ela podem ter seu desenvolvimento atrasado. 
                Tendo em vista esse problema.'],

            ['Estudo de caso da utilização de Gherkin para automatização de testes e obtenção de métricas de cobertura de requisitos ', '7', 'O presente trabalho apresenta o 
                estudo de caso da utilização da linguagem Gherkin como alternativa a documentação tradicionalmente utilizada pelo Laboratório Bridge.']
            
        ];
    }
}
