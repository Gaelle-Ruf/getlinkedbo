<?php

namespace App\Controller\Api\V1;

use App\Repository\ParticipationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/participations/status", name="api_v1_participation")
 */
class ParticipationController extends AbstractController
{
    
    /**
     * URL : /api/v1/participations/status
     * Route : api_v1_participations_status_index
     * 
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ParticipationRepository $participationRepository): Response
    {
        $status = $participationRepository->findAll();
        return $this->json($participationRepository, 200, [], []);
    }
}
