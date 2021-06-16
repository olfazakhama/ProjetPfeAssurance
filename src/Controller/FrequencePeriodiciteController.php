<?php

namespace App\Controller;

use App\Entity\FrequencePeriodicite;
use App\Form\FrequencePeriodiciteType;
use App\Repository\FrequencePeriodiciteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/frequence/periodicite")
 */
class FrequencePeriodiciteController extends AbstractController
{
    /**
     * @Route("/", name="frequence_periodicite_index", methods={"GET"})
     */
    public function index(FrequencePeriodiciteRepository $frequencePeriodiciteRepository): Response
    {
      //  $fs = $frequencePeriodiciteRepository->findAll();
        //var_dump($fs);
        return $this->render('frequence_periodicite/index.html.twig', [
            'frequence_periodicites' => $frequencePeriodiciteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="frequence_periodicite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $frequencePeriodicite = new FrequencePeriodicite();
        $form = $this->createForm(FrequencePeriodiciteType::class, $frequencePeriodicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($frequencePeriodicite);
            $entityManager->flush();

            return $this->redirectToRoute('frequence_periodicite_index');
        }

        return $this->render('frequence_periodicite/new.html.twig', [
            'frequence_periodicite' => $frequencePeriodicite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="frequence_periodicite_show", methods={"GET"})
     */
    public function show(FrequencePeriodicite $frequencePeriodicite): Response
    {
        return $this->render('frequence_periodicite/show.html.twig', [
            'frequence_periodicite' => $frequencePeriodicite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="frequence_periodicite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FrequencePeriodicite $frequencePeriodicite): Response
    {
        $form = $this->createForm(FrequencePeriodiciteType::class, $frequencePeriodicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('frequence_periodicite_index');
        }

        return $this->render('frequence_periodicite/edit.html.twig', [
            'frequence_periodicite' => $frequencePeriodicite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="frequence_periodicite_delete")
     */
    public function delete(FrequencePeriodicite $frequencePeriodicite): Response
    {
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($frequencePeriodicite);
            $entityManager->flush();
        

        return $this->redirectToRoute('frequence_periodicite_index');
    }
}
