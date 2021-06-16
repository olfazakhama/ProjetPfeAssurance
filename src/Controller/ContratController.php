<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Entity\Prime;
use App\Form\ContratType;
use App\Form\PrimeType;
use App\Repository\ContratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * @Route("/contrat")
 */
class ContratController extends AbstractController
{
    /**
     * @Route("/", name="contrat_index", methods={"GET"})
     */
    public function index(ContratRepository $contratRepository): Response
    {
        return $this->render('contrat/index.html.twig', [
            'contrats' => $contratRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="contrat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $contrat = new contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contrat);
            $entityManager->flush();

            return $this->redirectToRoute('contrat_index');
        }

        return $this->render('contrat/new.html.twig', [
            'contrat' => $contrat,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="contrat_show", methods={"GET"})
     */
    public function show(Contrat $contrat): Response
    {
        return $this->render('contrat/show.html.twig', [
            'contrat' => $contrat,
        ]);
    }
     /**
     * @Route("/{id}/pdf", name="contrat_pdf", methods={"GET"})
     */
    public function pdf(Contrat $contrat): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('contrat/pdf.html.twig', [
            'contrat' => $contrat,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("contrat.pdf", [
            "Attachment" => true
        ]);
    }
     /**
     * @Route("/{id}/edit", name="contrat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contrat $contrat): Response
    {
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contrat_index');
        }

        return $this->render('contrat/edit.html.twig', [
            'contrat' => $contrat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="contrat_delete")
     */
    public function delete( Contrat $contrat): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contrat);
            $entityManager->flush();
        

        return $this->redirectToRoute('contrat_index');
    }




}
