<?php

namespace App\Controller\Backoffice;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/user", name="backoffice_user_", requirements={"id": "\d+"})
 */
class UserController extends AbstractController
{
    /**
    * @Route("/", name="index")
    */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('backoffice/user/index.html.twig', [
            'users' => $userRepository->findAll(),]);
    }

    /**
     * @Route("/{id}", name="show")
     * @return Response
     */
    public function show(?User $user, UserRepository $userRepository)
    {
        if (!$user) {
            throw $this->createNotFoundException('L\'utilisateur n\'existe pas');
        }
        return $this->render('backoffice/user/show.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @return Response
     */
    public function add(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'L\'utilisateur ' . $user->getName() . ' a bien été créée');
            return $this->redirectToRoute('backoffice_user_index');
        }
        return $this->render('backoffice/user/add.html.twig', [
            'formView' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @return Response
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt(new DateTimeImmutable());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\utilisateur ' . $user->getName() . ' a bien été modifiée');
            return $this->redirectToRoute('backoffice_user_show', ['id' => $user->getId()]);
        }
        return $this->render('backoffice/user/edit.html.twig', ['formView' => $form->createView()]);
    }

    /**
     * @Route("/{id}/delete", name="delete")
     * @return Response
     */
    public function delete(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $this->addFlash('info', 'L\utilisateur ' . $user->getName() . ' a bien été supprimée');
        return $this->redirectToRoute('backoffice_user_index');
    }
}