<?php

namespace App\Controller\Backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StyleController extends AbstractController
{
    /**
     * @Route("/backoffice/style", name="backoffice_style")
     */
    public function index(): Response
    {
        return $this->render('backoffice/style/index.html.twig', [
            'controller_name' => 'StyleController',
        ]);
    }
}
