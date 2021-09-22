<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\C

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

    public function show(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/V1/UserController.php',
        ]);
    }
}
/**  *@ORM\Column(type="string", length=64, nullable=true)
     */
    private $category;

    public function getCategory(): ?string{
        return $this->category;
    }

    setCateory(?string $catgory): self
    {
        $his->category = $category;

        return $this;
    }

    public function get