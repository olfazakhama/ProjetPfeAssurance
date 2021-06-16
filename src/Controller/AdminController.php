<?php

namespace App\Controller;



use App\Entity\Constat;
use App\Form\ConstatType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/", name="homeadmin", methods={"GET"})
     */

    public function index(){
        $user = $this->getUser();
       // var_dump($user);
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/stats", name="stats")
     */

    public function statistique(){
        
        return $this->render('contrat/stat.html.twig');
    }




}
