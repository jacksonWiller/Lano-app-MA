<?php

namespace App\Controller;

use App\Entity\Ideia;
use App\Form\IdeiaType;
use App\Repository\IdeiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ideia")
 */
class IdeiaController extends AbstractController
{
    /**
     * @Route("/", name="ideia_index", methods={"GET"})
     */
    public function index(IdeiaRepository $ideiaRepository): Response
    {
        $ideia = $ideiaRepository->findAll();
        

        return $this->render('ideia/index.html.twig', [
            'ideias' => $ideia,
        ]);
    }

    /**
     * @Route("/new", name="ideia_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ideium = new Ideia();
        $form = $this->createForm(IdeiaType::class, $ideium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ideium);
            $entityManager->flush();

            return $this->redirectToRoute('ideia_index');
        }

        return $this->render('ideia/new.html.twig', [
            'ideium' => $ideium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ideia_show", methods={"GET"})
     */
    public function show(Ideia $ideium): Response
    {
        return $this->render('ideia/show.html.twig', [
            'ideium' => $ideium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ideia_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ideia $ideium): Response
    {
        $form = $this->createForm(IdeiaType::class, $ideium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ideia_index');
        }

        return $this->render('ideia/edit.html.twig', [
            'ideium' => $ideium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ideia_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ideia $ideium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ideium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ideium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ideia_index');
    }
}
