<?php

namespace App\Controller;

use App\Entity\Encaissement;
use App\Form\EncaissementType;
use App\Repository\EncaissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/encaissement")
 */
class EncaissementController extends AbstractController
{
    /**
     * @Route("/", name="encaissement_index", methods={"GET"})
     */
    public function index(EncaissementRepository $encaissementRepository): Response
    {
        return $this->render('encaissement/index.html.twig', [
            'encaissements' => $encaissementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="encaissement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $encaissement = new Encaissement();
        $form = $this->createForm(EncaissementType::class, $encaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($encaissement);
            $entityManager->flush();

            return $this->redirectToRoute('encaissement_index');
        }

        return $this->render('encaissement/new.html.twig', [
            'encaissement' => $encaissement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="encaissement_show", methods={"GET"})
     */
    public function show(Encaissement $encaissement): Response
    {
        return $this->render('encaissement/show.html.twig', [
            'encaissement' => $encaissement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="encaissement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Encaissement $encaissement): Response
    {
        $form = $this->createForm(EncaissementType::class, $encaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('encaissement_index');
        }

        return $this->render('encaissement/edit.html.twig', [
            'encaissement' => $encaissement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="encaissement_delete")
     */
    public function delete( Encaissement $encaissement): Response
    {
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($encaissement);
            $entityManager->flush();
       

        return $this->redirectToRoute('encaissement_index');
    }
}
