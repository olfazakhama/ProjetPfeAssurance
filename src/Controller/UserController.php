<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use App\Form\ResetPassType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UsersRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new Users();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(Users $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="user_delete")
     */
    public function delete(Users $user): Response
    {
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
      

        return $this->redirectToRoute('user_index');
    }

 //////////////////////////////
  /**
 * @Route("/login/oubli-pwd", name="app_forgotten_password")
 */
public function oubliPassq(Request $request): Response
{
    $form = $this->createForm(ResetPassType::class);
    $form->handleRequest($request);

    // Si le formulaire est valide
    if ($form->isSubmitted() && $form->isValid()) {
       
        $donnees = $form->getData();
        return $this->redirectToRoute('app_login');
    }

    return $this->render('security/forgotten_password.html.twig',['emailForm' => $form->createView()]);
}
 /**
 * @Route("/login/oubli-passq", name="app_forgotten_passwordq")
 */
public function oubliPass(Request $request, UsersRepository $usersRepository, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator
): Response
{
    // On initialise le formulaire
    $form = $this->createForm(ResetPassType::class);

    // On traite le formulaire
    $form->handleRequest($request);

    // Si le formulaire est valide
    if ($form->isSubmitted() && $form->isValid()) {
        // On récupère les données
        $donnees = $form->getData();

        // On cherche un utilisateur ayant cet e-mail
        $user = $usersRepository->findOneByEmail($donnees['email']);

        // Si l'utilisateur n'existe pas
        if ($user === null) {
            // On envoie une alerte disant que l'adresse e-mail est inconnue
            $this->addFlash('danger', 'Cette adresse e-mail est inconnue');
            
            // On retourne sur la page de connexion
            return $this->redirectToRoute('app_login');
        }

        // On génère un token
        $token = $tokenGenerator->generateToken();

        // On essaie d'écrire le token en base de données
        try{
            $user->setResettoken($token);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (\Exception $e) {
            $this->addFlash('warning', $e->getMessage());
            return $this->redirectToRoute('app_login');
        }

        // On génère l'URL de réinitialisation de mot de passe
        $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

        // On génère l'e-mail
        $message = (new \Swift_Message('Mot de passe oublié'))
            ->setFrom('votre@adresse.fr')
            ->setTo($user->getEmail())
            ->setBody(
                "Bonjour,<br><br>Une demande de réinitialisation de mot de passe a été effectuée pour le site Nouvelle-Techno.fr. Veuillez cliquer sur le lien suivant : " . $url,
                'text/html'
            )
        ;

        // On envoie l'e-mail
        $mailer->send($message);

        // On crée le message flash de confirmation
        $this->addFlash('message', 'E-mail de réinitialisation du mot de passe envoyé !');

        // On redirige vers la page de login
        return $this->redirectToRoute('app_login');
    }

    // On envoie le formulaire à la vue
    return $this->render('security/forgotten_password.html.twig',['emailForm' => $form->createView()]);
}

/**
 * @Route("/login/reset_pass/{token}", name="app_reset_password")
 */
public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
{
    // On cherche un utilisateur avec le token donné
    $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['reset_token' => $token]);

    // Si l'utilisateur n'existe pas
    if ($user === null) {
        // On affiche une erreur
        $this->addFlash('danger', 'Token Inconnu');
        return $this->redirectToRoute('app_login');
    }

    // Si le formulaire est envoyé en méthode post
    if ($request->isMethod('POST')) {
        // On supprime le token
        $t="";
        $user->setResettoken($t);

        // On chiffre le mot de passe
        $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

        // On stocke
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // On crée le message flash
        $this->addFlash('message', 'Mot de passe mis à jour');

        // On redirige vers la page de connexion
        return $this->redirectToRoute('app_login');
    }else {
        // Si on n'a pas reçu les données, on affiche le formulaire
        return $this->render('security/reset_password.html.twig', ['token' => $token]);
    }

}

}