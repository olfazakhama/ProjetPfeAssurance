<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Entity\DemandeCreationContrat;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/Reclamation")
 */
class ReclamationController extends AbstractController
{
    /**
     * @Route("/", name="Reclamation_index", methods={"GET"})
     */
    public function index(ReclamationRepository $ReclamationRepository): Response
    {

        return $this->render('Reclamation/index.html.twig', [
            'Reclamation' => $ReclamationRepository->findAll(),
        ]);

    }

    /**
     * @Route("/Rec", name="Reclamation_indexx", methods={"GET"})
     */
    public function indexx(ReclamationRepository $ReclamationRepository): Response
    {

        return $this->render('Reclamation/indexx.html.twig', [
            'Reclamation' => $ReclamationRepository->findAll(),
        ]);

    }

    /**
     * @Route("/new", name="Reclamation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $Reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Reclamation);
            $entityManager->flush();
            $this ->addFlash( 'info' , 'Réclamation envoyée!');

        }

        return $this->render('Reclamation/new.html.twig', [
            'Reclamation' => $Reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $Reclamation): Response
    {
        return $this->render('Reclamation/show.html.twig', [
            'Reclamation' => $Reclamation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Reclamation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $Reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $Reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Reclamation_index');
        }

        return $this->render('Reclamation/edit.html.twig', [
            'Reclamation' => $Reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="Reclamation_delete")
     */
    public function delete(Reclamation $Reclamation): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($Reclamation);
        $entityManager->flush();


        return $this->redirectToRoute('Reclamation_index');
    }

    /**
     * @Route("/{id}/pdf", name="Reclamation_pdf", methods={"GET"})
     */
    public function pdf(Reclamation $Reclamation): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('Reclamation/pdf.html.twig', [
            'Reclamation' => $Reclamation,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Reclamation.pdf", [
            "Attachment" => true
        ]);
    }

    /**
     * @Route("/{id}/refuser", name="Reclamation_refuser", methods={"GET"})
     */
    public function refuser(Request $request, $id)
    {
        $Reclamation = $this->getDoctrine()
            ->getRepository(Reclamation::class)
            ->find($id);


        $Reclamation->setEtat("refusée");

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($Reclamation);
        $entityManager->flush();

return $this->redirectToRoute('Reclamation_index');
}

    /**
     * @Route("/{id}/valider", name="Reclamation_valider", methods={"GET"})
     */
    public function Valider (Request $request, $id)
    {
        $Reclamation = $this->getDoctrine()
            ->getRepository(Reclamation::class)
            ->find($id);


        $Reclamation->setEtat("validée");

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($Reclamation);
        $entityManager->flush();
        return $this->redirectToRoute('Reclamation_index');

    }

    /**
     * @Route("/CAl/cal", name="Calender_index", methods={"GET"})
     */
    public function cal()
    {
        return $this->render('calendar/index.html.twig', [
            'Calenders' => 'ReclamationController',
        ]);
    }
}
