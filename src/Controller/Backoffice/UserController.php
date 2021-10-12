<?php

namespace App\Controller\Backoffice;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
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
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('backoffice/user/index.html.twig', [
            'users' => $userRepository->findAll(),]);
    }

    

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        if (!$user) {
            throw $this->createNotFoundException('L\'utilisateur  ' . $id . ' n\'existe pas');
        }
        return $this->render('backoffice/user/show.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET","POST"})
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
            $this->addFlash('success', 'L\'utilisateur  ' . $user->getName() . ' a bien été créée');
            return $this->redirectToRoute('backoffice_user_index');
        }
        return $this->render('backoffice/user/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->getName();/* setUpdatedAt(new DateTimeImmutable()) */

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\'utilisateur ' . $user->getName() . ' a bien été modifié');

            return $this->redirectToRoute('backoffice_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/user/edit.html.twig', [
            'user' => $user,
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     */
    public function delete(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $this->addFlash('info', 'L\'utilisateur  ' . $user->getName() . ' a bien été supprimé');
        return $this->redirectToRoute('backoffice_user_index');
    }
}
