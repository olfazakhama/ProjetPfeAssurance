<?php

namespace App\Controller;

use App\Entity\Clause;
use App\Form\ClauseType;
use App\Repository\ClauseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clause")
 */
class ClauseController extends AbstractController
{
    /**
     * @Route("/all", name="clause_index", methods={"GET"})
     */
    public function index(ClauseRepository $clauseRepository): Response
    {
        return $this->render('clause/index.html.twig', [
            'clauses' => $clauseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="clause_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $clause = new Clause();
        $form = $this->createForm(ClauseType::class, $clause);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($clause);
            $entityManager->flush();

            return $this->redirectToRoute('clause_index');

        }

        return $this->render('clause/new.html.twig', [
            'clause' => $clause,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="clause_show", methods={"GET"})
     */
    public function show(Clause $clause): Response
    {
        return $this->render('clause/show.html.twig', [
            'clause' => $clause,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="clause_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Clause $clause): Response
    {
        $form = $this->createForm(ClauseType::class, $clause);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clause_index');
        }

        return $this->render('clause/edit.html.twig', [
            'clause' => $clause,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="clause_delete")
     */
    public function delete(Clause $clause): Response
    {
      
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($clause);
            $entityManager->flush();
        

        return $this->redirectToRoute('clause_index');
    }
}
