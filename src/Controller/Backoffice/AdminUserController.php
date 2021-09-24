<?php

namespace App\Controller\Backoffice;

use App\Entity\AdminUser;
use App\Repository\AdminUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/backoffice/admin/user", name="backoffice_admin_user_")
*/
class AdminUserController extends AbstractController
{
    
    /**
     * catch all adminusers
     * 
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(AdminUserRepository $adminUserRepository): Response
    {
        return $this->render('backoffice/admin_user/index.html.twig', [
            'adminusers' => $adminUserRepository->findAll(),
        ]);
    }

    /**
     * catch one adminuser by id
     * 
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(AdminUser $adminUser): Response
    {
        return $this->render('backoffice/admin_user/show.html.twig', [
            'adminuser' => $adminUser
        ]);
    }
}
