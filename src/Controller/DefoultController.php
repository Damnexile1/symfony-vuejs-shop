<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefoultController extends AbstractController
{
    /**
     * @Route("/", name="home Page")
     */
    public function index(): Response
    {
        return $this->render('main/defoult/index.html.twig', []);
    }
}
