<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/v1/users", name="api_v1_user")
 */
class UserController extends AbstractController
{
    /**
     * URL : /api/v1/users
     * @Route : api_v1_user_index
     * 
     * @Route("/",)
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/V1/UserController.php',
        ]);
    }
}
