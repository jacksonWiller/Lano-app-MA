<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Work;

class WorkFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->WorkData() as [$name, $area, $topic, $description, $user_id]) {
            $work = new Work();
            

            $work-> setName($name);  
            $work-> setArea($area);
            $work-> setTopic($topic);
            $work-> setDescription($description);

            
            
            $user = $manager->getRepository(User::class)->find($user_id);

           $work-> setUser($user);
            

            $manager->persist($work);
        }
        $manager->flush();
    }

    private function WorkData()
    {
        return [

            ['name ', 'electrical engineer', 'magnetic waves', 'this a description of a work',15]
            
        ];
    }
}
