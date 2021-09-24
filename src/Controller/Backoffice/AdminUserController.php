<?php

namespace App\Controller\Backoffice;

use App\Entity\AdminUser;
use App\Form\AdminUserType;
use App\Repository\AdminUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * create a new adminuser
     * 
     * @Route("/new", name="new", methods={"GET","POST"})
     * 
     * */
    public function new(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $adminuser = new AdminUser();
        $form = $this->createForm(AdminUserType::class, $adminuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* hash password  */
            $adminuser->setPassword(
                $passwordHasher->hashPassword(
                    $adminuser,
                    $form->get('plainPassword')->getData()
                )
            );





            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adminuser);
            $entityManager->flush();

            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/admin_user/new.html.twig', [
            'adminuser' => $adminuser,
            'form' => $form,
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
