<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/organiser", name="organize")
     */
    public function index()
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * @Route("/organiser/creer-un-compte", name="organize_create_account")
     */
    public function createAccount(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $manager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On a besoin d'hasher le mot de passe avant de le stocker en base de données
            // On récupère donc le mot de passe dans $user
            $password = $user->getPassword();
            // On va hasher le mot de passe
            $encodedPassword = $passwordEncoder->encodePassword($user, $password);
            // Puis on replace le mot de passe hashé dans $user
            $user->setPassword($encodedPassword);

            // On reprend le fil ordinaire des choses, en persistant et flush $user
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('organize_home');
        }

        return $this->render('user/create_account.html.twig', [
            // 'user' => $user,
            'formView' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mon-compte", name="organize_home")
     */
    public function accountHomepage()
    {
        return $this->render('user/organize_home.html.twig');
    }

    
}
