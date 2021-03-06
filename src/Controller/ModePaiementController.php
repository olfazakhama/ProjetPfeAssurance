<?php

namespace App\Controller;

use App\Entity\ModePaiement;
use App\Form\ModePaiementType;
use App\Repository\ModePaiementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mode/paiement")
 */
class ModePaiementController extends AbstractController
{
    /**
     * @Route("/", name="mode_paiement_index", methods={"GET"})
     */
    public function index(ModePaiementRepository $modePaiementRepository): Response
    {
        return $this->render('mode_paiement/index.html.twig', [
            'mode_paiements' => $modePaiementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mode_paiement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $modePaiement = new ModePaiement();
        $form = $this->createForm(ModePaiementType::class, $modePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modePaiement);
            $entityManager->flush();

            return $this->redirectToRoute('mode_paiement_index');
        }

        return $this->render('mode_paiement/new.html.twig', [
            'mode_paiement' => $modePaiement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mode_paiement_show", methods={"GET"})
     */
    public function show(ModePaiement $modePaiement): Response
    {
        return $this->render('mode_paiement/show.html.twig', [
            'mode_paiement' => $modePaiement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mode_paiement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ModePaiement $modePaiement): Response
    {
        $form = $this->createForm(ModePaiementType::class, $modePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mode_paiement_index');
        }

        return $this->render('mode_paiement/edit.html.twig', [
            'mode_paiement' => $modePaiement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="mode_paiement_delete")
     */
    public function delete( ModePaiement $modePaiement): Response
    {
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($modePaiement);
            $entityManager->flush();
        

        return $this->redirectToRoute('mode_paiement_index');
    }
}
