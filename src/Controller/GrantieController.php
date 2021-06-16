<?php

namespace App\Controller;

use App\Entity\Grantie;
use App\Form\GrantieType;
use App\Repository\GrantieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/grantie")
 */
class GrantieController extends AbstractController
{
    /**
     * @Route("/", name="grantie_index", methods={"GET"})
     */
    public function index(GrantieRepository $grantieRepository): Response
    {
        return $this->render('grantie/index.html.twig', [
            'granties' => $grantieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="grantie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $grantie = new Grantie();
        $form = $this->createForm(GrantieType::class, $grantie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grantie);
            $entityManager->flush();

            return $this->redirectToRoute('grantie_index');
        }

        return $this->render('grantie/new.html.twig', [
            'grantie' => $grantie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="grantie_show", methods={"GET"})
     */
    public function show(Grantie $grantie): Response
    {
        return $this->render('grantie/show.html.twig', [
            'grantie' => $grantie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="grantie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Grantie $grantie): Response
    {
        $form = $this->createForm(GrantieType::class, $grantie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('grantie_index');
        }

        return $this->render('grantie/edit.html.twig', [
            'grantie' => $grantie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="grantie_delete")
     */
    public function delete( Grantie $grantie): Response
    {
      
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($grantie);
            $entityManager->flush();
        
        return $this->redirectToRoute('grantie_index');
    }
}
