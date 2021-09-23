<?php

namespace App\Controller\Backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/backoffice/comment", name="backoffice_comment")
     */
    public function index(): Response
    {
        return $this->render('backoffice/comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }
}
