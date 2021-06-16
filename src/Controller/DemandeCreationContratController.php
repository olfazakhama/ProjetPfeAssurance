<?php

namespace App\Controller;
use Symfony\Component\Form\FormError;

use App\Entity\DemandeCreationContrat;
use App\Entity\Contrat;
use App\Entity\FrequencePeriodicite;
use App\Form\DemandeCreationContratType;
use App\Repository\ConstatRepository;
use App\Repository\DemandeCreationContratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Form\ContratType;
use App\Repository\ContratRepository;
use Symfony\Component\Security\Core\User\User;

/**
 * @Route("/demande/creation/contrat")
 */
class DemandeCreationContratController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="demande_creation_contrat_index", methods={"GET"})
     */
    public function index(DemandeCreationContratRepository $demandeCreationContratRepository): Response
    {

        return $this->render('demande_creation_contrat/index.html.twig', [
            'demande_creation_contrats' => $demandeCreationContratRepository->findAll(),
        ]);
    }


    /**
     * @Route("/de", name="demande_creation_contrat_index1", methods={"GET"})
     */
    public function index1(DemandeCreationContratRepository $demandeCreationContratRepository): Response
    {

        return $this->render('demande_creation_contrat/index1.html.twig', [
            'demande_creation_contrats' => $demandeCreationContratRepository->findAll(),
        ]);
    }

    /**
     * @Route("/demande", name="demande_creation_contrat_indexx", methods={"GET"})
     */
    public function indexx(DemandeCreationContratRepository $demandeCreationContratRepository, ContratRepository $contratRepository)
    {
        $user = $this->getUser();
        $val = "En cours";
        $demenades = array();
        $cantrat = array();
        $demandeencours = $demandeCreationContratRepository->findBy(['user' => $user]);
        foreach ($demandeencours as $demandeencours) {
            if ($demandeencours->getEtat() == "En cours") {
                array_push($demenades, $demandeencours);
            }
            if ($demandeencours->getEtat() == "refusée") {
                array_push($demenades, $demandeencours);
            }
            if ($demandeencours->getEtat() == "acceptée"){

                $cc = $contratRepository->findBy(['demandeCreationContrat'=>$demandeencours]);
            array_push($cantrat, $cc);
        }
    }
            dump($cantrat);
return $this->render('demande_creation_contrat/indexx.html.twig', ['demande_creation_contrats' => $demenades,'contrat' => $cantrat]);
}





/**
 * @Route("/mademande/{id}", name="demande_creation_contrat_show_mademende", methods={"GET"})
 */
public
function mademande( $id ,DemandeCreationContratRepository $demandeCreationContratRepository,ConstatRepository $constatRepository, ContratRepository $contratRepository): Response
{
    $contrat = $contratRepository->find($id);
    $constat =$constatRepository->findby(array('contrat' => $contrat));

    $demande = $demandeCreationContratRepository->find($contrat->getDemandeCreationContrat()->getId());
    return $this->render('demande_creation_contrat/showmademande.html.twig', [
        'demande_creation_contrat' => $demande,'contrat' => $contrat, 'constats'=>$constat

    ]);
}


/**
 * @Route("/new", name="demande_creation_contrat_new", methods={"GET","POST"})
 */
public
function new(Request $request): Response
    {
        $demandeCreationContrat = new DemandeCreationContrat();
        $form = $this->createForm(DemandeCreationContratType::class, $demandeCreationContrat);
        $form->get('cin')->addError(new FormError('error message'));
        $user = $this->getUser();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imagescin = $form->get('Uploadcin')->getData();
            $imagesper = $form->get('Uploadpermis')->getData();
            $imagescart = $form->get('UploadCartegrise')->getData();
            $imagesprofi = $form->get('UploadProfil')->getData();
            $imagesvig = $form->get('UploadVignette')->getData();
            $imagestech = $form->get('UploadVisitetechnique')->getData();

            foreach ($imagestech as $imagestech) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $imagestech->guessExtension();
                // On copie le fichier dans le dossier uploads
                $imagestech->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On crée l'image dans la base de données
                $demandeCreationContrat->setVistite_technique($fichier);

            }

            foreach ($imagesvig as $imagesvig) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $imagesvig->guessExtension();
                // On copie le fichier dans le dossier uploads
                $imagesvig->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On crée l'image dans la base de données
                $demandeCreationContrat->setvignette($fichier);

            }

            foreach ($imagesprofi as $imagesprofi) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $imagesprofi->guessExtension();
                // On copie le fichier dans le dossier uploads
                $imagesprofi->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On crée l'image dans la base de données
                $demandeCreationContrat->setfileProfil($fichier);

            }

            foreach ($imagescart as $imagescart) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $imagescart->guessExtension();
                // On copie le fichier dans le dossier uploads
                $imagescart->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On crée l'image dans la base de données
                $demandeCreationContrat->setCarte_grise($fichier);

            }
            foreach ($imagesper as $imagesper) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $imagesper->guessExtension();
                // On copie le fichier dans le dossier uploads
                $imagesper->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On crée l'image dans la base de données
                $demandeCreationContrat->setfilepermis($fichier);

            }
            foreach ($imagescin as $imagescin) {
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $imagescin->guessExtension();
                // On copie le fichier dans le dossier uploads
                $imagescin->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On crée l'image dans la base de données
                $demandeCreationContrat->setFilecin($fichier);
            }
            $demandeCreationContrat->setUser($user);
            $demandeCreationContrat->setEtat("En cours");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demandeCreationContrat);
            $entityManager->flush();



            return $this->render('demande_creation_contrat/show.html.twig', [
                'demande_creation_contrat' => $demandeCreationContrat,
            ]);
        }

        return $this->render('demande_creation_contrat/new.html.twig', [
            'demande_creation_contrat' => $demandeCreationContrat,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="demande_creation_contrat_show", methods={"GET"})
     */
    public function show(DemandeCreationContrat $demandeCreationContrat): Response
{
    return $this->render('demande_creation_contrat/show.html.twig', [
        'demande_creation_contrat' => $demandeCreationContrat,
    ]);
}

    /**
     * @Route("/{id}/edit", name="demande_creation_contrat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DemandeCreationContrat $demandeCreationContrat): Response
{
    $form = $this->createForm(DemandeCreationContratType::class, $demandeCreationContrat);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('demande_creation_contrat_index');
    }

    return $this->render('demande_creation_contrat/edit.html.twig', [
        'demande_creation_contrat' => $demandeCreationContrat,
        'form' => $form->createView(),
    ]);
}

    /**
     * @Route("/{id}", name="demande_creation_contrat_delete", methods={"DELETE"})

     */
    public function delete(Request $request, DemandeCreationContrat $demandeCreationContrat): Response
{
    if ($this->isCsrfTokenValid('delete' . $demandeCreationContrat->getId(), $request->request->get('_token'))) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($demandeCreationContrat);
        $entityManager->flush();
    }

    return $this->redirectToRoute('demande_creation_contrat_index');
}

    /**
     * @Route("/{id}/accepte", name="demande_creation_contrat_accepter", methods={"POST","GET"})
     */
    public function accepter(Request $request, $id)
{
    $demandeCreationContrat = $this->getDoctrine()
        ->getRepository(DemandeCreationContrat::class)
        ->find($id);


    $demandeCreationContrat->setEtat("acceptée");

    $entityManager = $this->getDoctrine()->getManager();
    //$entityManager->persist($demandeCreationContrat);
    $entityManager->flush();

    $contrat = new Contrat();
    $contrat->setNom($demandeCreationContrat->getNom());
    $contrat->setPrenom($demandeCreationContrat->getPrenom());
    $contrat->setClause($demandeCreationContrat->getClause());
    $contrat->setCin($demandeCreationContrat->getCin());
    $contrat->setage($demandeCreationContrat->getage());
    $contrat->setEmail($demandeCreationContrat->getEmail());
    $contrat->setNomVoiture($demandeCreationContrat->getNomVoiture());
    $contrat->setTypeVoiture($demandeCreationContrat->getTypeVoiture());
    $contrat->setCompanie($demandeCreationContrat->getCompanie());
    $contrat->setKilometre($demandeCreationContrat->getKilometre());
    $contrat->setImmatriculation($demandeCreationContrat->getImmatriculation());
    $contrat->setGrantie($demandeCreationContrat->getGrantie());
    $contrat->setModePaiement($demandeCreationContrat->getModePaiement());
    $contrat->setFrequencePeriodicite($demandeCreationContrat->getFrequencePeriodicite());
    $contrat->setTypeContrat($demandeCreationContrat->getTypeContrat());
    $contrat->setFrequencePeriodicite($demandeCreationContrat->getFrequencePeriodicite());
    $contrat->setDemandeCreationContrat($demandeCreationContrat);

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
     * @Route("/{id}/refuser", name="demande_creation_contrat_refuser", methods={"GET"})
     */
    public function refuser(Request $request, $id)
{
    $demandeCreationContrat = $this->getDoctrine()
        ->getRepository(DemandeCreationContrat::class)
        ->find($id);
    $demandeCreationContrat->setEtat("refusée");

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($demandeCreationContrat);
    $entityManager->flush();

    $contrat = $this->getDoctrine()
        ->getRepository(Contrat::class)
        ->findBy(array('demandeCreationContrat' => $demandeCreationContrat));
    if ($contrat) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($contrat[0]);
        $entityManager->flush();

    }


    return $this->redirectToRoute('demande_creation_contrat_index');
}
}
