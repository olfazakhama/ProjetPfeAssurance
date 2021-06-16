<?php

namespace App\Controller;

use App\Entity\Prime;
use App\Form\PrimeType;
use App\Repository\PrimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prime")
 */
class PrimeController extends AbstractController
{
    /**
     * @Route("/", name="prime_index", methods={"GET"})
     */
    public function index(PrimeRepository $primeRepository): Response
    {
        return $this->render('prime/index.html.twig', [
            'primes' => $primeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prime_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $prime = new Prime();
        $form = $this->createForm(PrimeType::class, $prime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annee=$prime->getAnnee();
            switch ($annee) {
                case 1:
                    $bonus = 5;
                    break;
                case 2:
                    $bonus =10;
                    break;
                case 3:
                    $bonus =15;
                    break;

                case 4:
                    $bonus =20;
                    break;
                case 5:
                    $bonus =24;
                    break;
                case 6:
                    $bonus =28;
                    break;


                case 7:
                    $bonus =32;
                    break;
                case 8:
                    $bonus =36;
                    break;
                case 9:
                    $bonus =40;
                    break;
                case 10:
                    $bonus =43;
                    break;
                case 11:
                    $bonus =46;
                    break;
                case 12:
                    $bonus =49;
                    break;
                case 13:
                    $bonus =50;
                    break;
            }
            $montant = ($prime->getMontantInitiale()*$bonus)/100 ;
            $prime->setMontantPayer($montant);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prime);
            $entityManager->flush();

            return $this->redirectToRoute('prime_index');
        }

        return $this->render('prime/new.html.twig', [
            'prime' => $prime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prime_show", methods={"GET"})
     */
    public function show(Prime $prime): Response
    {
        return $this->render('prime/show.html.twig', [
            'prime' => $prime,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prime_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Prime $prime): Response
    {
        $form = $this->createForm(PrimeType::class, $prime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annee=$prime->getAnnee();
            switch ($annee) {
                case 1:
                    $bonus = 5;
                    break;
                case 2:
                    $bonus =10;
                    break;
                case 3:
                    $bonus =15;
                    break;

                case 4:
                    $bonus =20;
                    break;
                case 5:
                    $bonus =24;
                    break;
                case 6:
                    $bonus =28;
                    break;


                case 7:
                    $bonus =32;
                    break;
                case 8:
                    $bonus =36;
                    break;
                case 9:
                    $bonus =40;
                    break;
                case 10:
                    $bonus =43;
                    break;
                case 11:
                    $bonus =46;
                    break;
                case 12:
                    $bonus =49;
                    break;
                case 13:
                    $bonus =50;
                    break;
            }
            $montant = ($prime->getMontantInitiale()*$bonus)/100 ;
            $prime->setMontantPayer($montant);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prime_index');
        }

        return $this->render('prime/edit.html.twig', [
            'prime' => $prime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="prime_delete")
     */
    public function delete( Prime $prime): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prime);
            $entityManager->flush();
        

        return $this->redirectToRoute('prime_index');
    }
}
