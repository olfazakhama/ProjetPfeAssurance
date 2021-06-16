<?php

namespace App\Controller;

use App\Entity\Assure;
use App\Form\AssureType;
use App\Repository\AssureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/assure")
 */
class AssureController extends AbstractController
{
    /**
     * @Route("/", name="assure_index", methods={"GET"})
     */
    public function index(AssureRepository $assureRepository): Response
    {
        return $this->render('assure/index.html.twig', [
            'assures' => $assureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="assure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $assure = new Assure();
        $form = $this->createForm(AssureType::class, $assure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($assure);
            $entityManager->flush();

            return $this->redirectToRoute('assure_index');
        }

        return $this->render('assure/new.html.twig', [
            'assure' => $assure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="assure_show", methods={"GET"})
     */
    public function show(Assure $assure): Response
    {
        return $this->render('assure/show.html.twig', [
            'assure' => $assure,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="assure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Assure $assure): Response
    {
        $form = $this->createForm(AssureType::class, $assure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('assure_index');
        }

        return $this->render('assure/edit.html.twig', [
            'assure' => $assure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="assure_delete")
     */
    public function delete( Assure $assure): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($assure);
            $entityManager->flush();


        return $this->redirectToRoute('assure_index');
    }


}
