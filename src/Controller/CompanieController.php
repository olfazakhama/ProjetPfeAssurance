<?php

namespace App\Controller;

use App\Entity\Companie;
use App\Form\CompanieType;
use App\Repository\CompanieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/companie")
 */
class CompanieController extends AbstractController
{
    /**
     * @Route("/", name="companie_index", methods={"GET"})
     */
    public function index(CompanieRepository $companieRepository): Response
    {
        return $this->render('companie/index.html.twig', [
            'companies' => $companieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="companie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $companie = new Companie();
        $form = $this->createForm(CompanieType::class, $companie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($companie);
            $entityManager->flush();

            return $this->redirectToRoute('companie_index');
        }

        return $this->render('companie/new.html.twig', [
            'companie' => $companie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="companie_show", methods={"GET"})
     */
    public function show(Companie $companie): Response
    {
        return $this->render('companie/show.html.twig', [
            'companie' => $companie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="companie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Companie $companie): Response
    {
        $form = $this->createForm(CompanieType::class, $companie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('companie_index');
        }

        return $this->render('companie/edit.html.twig', [
            'companie' => $companie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="companie_delete")
     */
    public function delete( Companie $companie): Response
    {
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($companie);
            $entityManager->flush();
        

        return $this->redirectToRoute('companie_index');
    }

}
