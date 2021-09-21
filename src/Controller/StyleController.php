<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StyleController extends AbstractController
{
    /**
     * @Route("/style", name="style")
     */
    public function index(): Response
    {
        return $this->render('style/index.html.twig', [
            'controller_name' => 'StyleController',
        ]);
    }
}
