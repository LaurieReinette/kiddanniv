<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/organiser")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="organize")
     */
    public function index()
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * @Route("/creer-un-compte", name="organize_create_account")
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
            $user->setModerate(false);
            $user->setRole('ROLE_USER');
            $roles[] = 'ROLE_USER';
            $user->setRoles($roles);
            $user->setCreatedat(new \Datetime);
            $user->setArchived(false);

            // On reprend le fil ordinaire des choses, en persistant et flush $user
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $id=$user->getId();

            return $this->redirectToRoute('organize_home',
            ['id' => $id, 
            'user' => $user]);
        }

        return $this->render('user/create_account.html.twig', [
            'user' => $user,
            'formView' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mon-compte/{id}", name="organize_home")
     */
    public function accountHomepage(User $user)
    {
        return $this->render('user/organize_home.html.twig', [ 
        'user' => $user]);
    }

    /**
     * @Route("/mes-prestations/{id}", name="organize_list")
     */
    public function listParties(User $user)
    {
        return $this->render('user/organize_list.html.twig', [
            "user" => $user
        ]);
    }

    /**
     * @Route("/send", name="send_email")
     */
    public function send(\Swift_Mailer $mailer)
{
    $message = (new \Swift_Message('Hello Email'))
        ->setFrom('lauriereinette@gmail.com')
        ->setTo('r.narisely@gmail.com')
        ->setBody(
            $this->renderView(
                // templates/hello/email.txt.twig
                'user/send_mail.html.twig'
                
            ),
            'text/html'
        )
    ;
    $mailer->send($message);

    return $this->render('user/index.html.twig');
}

    
}
