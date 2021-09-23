<?php

namespace App\Controller\Backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipationController extends AbstractController
{
    /**
     * @Route("/backoffice/participation", name="backoffice_participation")
     */
    public function index(): Response
    {
        return $this->render('backoffice/participation/index.html.twig', [
            'controller_name' => 'ParticipationController',
        ]);
    }
}
