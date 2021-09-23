<?php

namespace App\Controller\Backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/backoffice/event", name="backoffice_event")
     */
    public function index(): Response
    {
        return $this->render('backoffice/event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
}
