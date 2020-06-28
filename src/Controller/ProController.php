<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProController extends AbstractController
{
    /**
     * @Route("/prestataire", name="service_provider")
     */
    public function index()
    {
        return $this->render('pro/index.html.twig', [
            
        ]);
    }
}
