<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Security\UsersAuthenticatotAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UsersAuthenticatotAuthenticator $authenticator): Response
    {

        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            if($form->get('statut')->getData()==="Admin")
            {
                $user->setRoles(['ROLE_ADMIN']);
            }
            if($form->get('statut')->getData()==="Manager")
            {
                $user->setRoles(['ROLE_MANAGER']);
            }
            if($form->get('statut')->getData()==="Souscripteur")
            {
                $user->setRoles(['ROLE_SOUSCRIPTEUR']);
            }
            if($form->get('statut')->getData()==="Agent")
            {
                $user->setRoles(['ROLE_AGENT']);
            }

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email
            return $this->redirectToRoute('app_login');


        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);


}}
