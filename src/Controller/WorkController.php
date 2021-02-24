<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Work;
use Symfony\Component\HttpFoundation\Response;

class WorkController extends AbstractController
{
    /**
     * @Route("/work", name="work")
     */
    public function index()
    {
        $work = new Work();
            
        $work-> setName('Nome do Trabalho');  
        $work-> setArea('Area do Trabalho');
        $work-> setTopic('Topco do Trabalho');
        $work-> setDescription('Descrição do Trabalho');

        $user = $this->getDoctrine()
         ->getRepository(User::class)
         ->find(15);
            

         $work-> setUser($user);
            

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($work);
        $entityManager->flush();

        return new Response(
            'Saved new product with id: '.$work->getId()
        );
    }
}
