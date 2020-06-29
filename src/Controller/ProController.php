<?php

namespace App\Controller;

use App\Entity\Pro;
use App\Form\ProType;
use App\Repository\ProRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/prestataire")
 */
class ProController extends AbstractController
{
    /**
     * @Route("/", name="service_provider")
     */
    public function index()
    {
        return $this->render('pro/index.html.twig');
    }

     /**
     * @Route("/creer-un-compte", name="service_provider_create_account")
     */
    public function creatAccount(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $manager): Response
    {
        $pro = new Pro();
        $form = $this->createForm(ProType::class, $pro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On a besoin d'hasher le mot de passe avant de le stocker en base de données
            // On récupère donc le mot de passe dans $pro
            $password = $pro->getPassword();
            // On va hasher le mot de passe
            $encodedPassword = $passwordEncoder->encodePassword($pro, $password);
            // Puis on replace le mot de passe hashé dans $pro
            $pro->setPassword($encodedPassword);
            $pro->setRole('ROLE_PREST');
            $roles[] = 'ROLE_PREST';
            $pro->setRoles($roles);
            $pro->setCreatedat(new \Datetime);
            $pro->setArchived(false);

            // On reprend le fil ordinaire des choses, en persistant et flush $pro
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pro);
            $entityManager->flush();

            return $this->redirectToRoute('pro_home');
        }

        return $this->render('pro/create_account.html.twig', [
            'pro' => $pro,
            'formView' => $form->createView(),
        ]);
    }

     /**
     * @Route("/mon-compte/{id}", name="pro_home")
     */
    public function accountHomepage(Pro $pro)
    {
        return $this->render('user/organize_home.html.twig', [
            "pro" => $pro
        ]);
    }

}
