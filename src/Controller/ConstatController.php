<?php

namespace App\Controller;

use App\Entity\Constat;
use App\Form\ConstatType;
use App\Repository\ConstatRepository;
use App\Repository\DemandeCreationContratRepository;
use App\Repository\ContratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/constat")
 */
class ConstatController extends AbstractController
{
    /**
     * @Route("/", name="constat_index", methods={"GET"})
     */
    public function index(ConstatRepository $constatRepository): Response
    {
        return $this->render('constat/index.html.twig', [
            'constats' => $constatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="constat_neww", methods={"GET","POST"})
     */
    public function neww($id,Request $request, DemandeCreationContratRepository $demandeCreationContratRepository,ContratRepository $contratRepository): Response
    {

        $contrat = $contratRepository->find($id);

        $constat = new Constat();
        $form = $this->createForm(ConstatType::class, $constat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageschoc = $form->get('Choc')->getData();
            foreach ($imageschoc as $imagestech) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $imagestech->guessExtension();
                // On copie le fichier dans le dossier uploads
                $imagestech->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On crée l'image dans la base de données
                $constat->setPointchoc($fichier);

            }
            $constat->setcontrat($contrat);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($constat);
            $entityManager->flush();

            return $this->redirectToRoute('constat_new');
        }

        return $this->render('constat/new.html.twig', [
            'constat' => $constat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/nedw/{id}", name="constat_new", methods={"GET","POST"})
     */
    public function new($id,Request $request, DemandeCreationContratRepository $demandeCreationContratRepository,ContratRepository $contratRepository): Response
    {
       
        $contrat = $contratRepository->find($id);

        $constat = new Constat();
        $form = $this->createForm(ConstatType::class, $constat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageschoc = $form->get('Choc')->getData();
            foreach ($imageschoc as $imagestech) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $imagestech->guessExtension();
                // On copie le fichier dans le dossier uploads
                $imagestech->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On crée l'image dans la base de données
                $constat->setPointchoc($fichier);

            }
            $constat->setcontrat($contrat);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($constat);
            $entityManager->flush();

            return $this->redirectToRoute('demande_creation_contrat_show_mademende' , ['id'=>$id]);
        }

        return $this->render('constat/new.html.twig', [
            'constat' => $constat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="constat_show", methods={"GET"})
     */
    public function show(Constat $constat): Response

    {
        return $this->render('constat/show.html.twig', [
            'constat' => $constat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="constat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Constat $constat): Response
    {
        $form = $this->createForm(ConstatType::class, $constat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demande_creation_contrat_show_mademende',['id' => $constat->getId()]);
        }

        return $this->render('constat/edit.html.twig', [
            'constat' => $constat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="constat_delete")
     */
    public function delete(Constat $constat): Response
    {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($constat);
            $entityManager->flush();


        return $this->redirectToRoute('demande_creation_contrat_show_mademende',['id' => $constat->getId()]);
    }


}
