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
* @Route("/backoffice/adminuser", name="backoffice_adminuser_")
*/
class AdminUserController extends AbstractController
{
    
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(AdminUserRepository $adminUserRepository): Response
    {
        return $this->render('backoffice/adminuser/index.html.twig', [
            'adminusers' => $adminUserRepository->findAll(),]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * 
     */
    public function show(int $id, AdminUserRepository $adminUserRepository)
    {
        $adminuser = $adminUserRepository->find($id);
        if (!$adminuser) {
            throw $this->createNotFoundException('L\administrateur ' . $id . ' n\'existe pas');
        }
        return $this->render('backoffice/adminuser/show.html.twig', [
            'adminuser' => $adminuser
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET","POST"})
     */
    public function add(Request $request)
    {
        $adminuser = new AdminUser();
        $form = $this->createForm(AdminUserType::class, $adminuser);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($adminuser);
            $em->flush();

            $this->addFlash('success', 'L\administrateur ' . $adminuser->getFirstname() . $adminuser->getLastname() .' a bien été créé');

            return $this->redirectToRoute('backoffice_adminuser_index');
        }

        return $this->render('backoffice/adminuser/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(AdminUser $adminuser, Request $request)
    {
        $form = $this->createForm(AdminUserType::class, $adminuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $adminuser->getFirstname();
            /* setUpdatedAt(new DateTimeImmutable()) */

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\administrateur ' . $adminuser->getFirstname() . $adminuser->getLastname() . ' a bien été modifié');

            return $this->redirectToRoute('backoffice_adminuser_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/adminuser/edit.html.twig', [
            'adminuser' => $adminuser,
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     */
    public function delete(AdminUser $adminuser)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($adminuser);
        $em->flush();
        $this->addFlash('info', 'L\'administrateur ' . $adminuser->getFirstname() . $adminuser->getLastname() . ' a bien été supprimé');
        return $this->redirectToRoute('backoffice_adminuser_index');
    }

    

}
