<?php

namespace App\Controller\Backoffice;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/comment", name="backoffice_comment_", requirements={"id": "\d+"})
 */
class CommentController extends AbstractController
{
    /**
    * @Route("/", name="index")
    */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('backoffice/comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),]);
    }

    /**
     * @Route("/{id}", name="show")
     * @return Response
     */
    public function show(int $id, CommentRepository $commentRepository)
    {
        $comment = $commentRepository->find($id);
        if (!$comment) {
            throw $this->createNotFoundException('Le commentaire ' . $id . ' n\'existe pas');
        }
        return $this->render('backoffice/comment/show.html.twig', [
            'comment' => $comment
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @return Response
     */
    public function add(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Le commentaire ' . $comment->getName() . ' a bien été créée');
            return $this->redirectToRoute('backoffice_comment_index');
        }
        return $this->render('backoffice/comment/add.html.twig', [
            'formView' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @return Response
     */
    public function edit(Comment $comment, Request $request)
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUpdatedAt(new DateTimeImmutable());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le commentaire ' . $comment->getName() . ' a bien été modifiée');
            return $this->redirectToRoute('backoffice_comment_show', ['id' => $comment->getId()]);
        }
        return $this->render('backoffice/comment/edit.html.twig', ['formView' => $form->createView()]);
    }

    /**
     * @Route("/{id}/delete", name="delete")
     * @return Response
     */
    public function delete(Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();
        $this->addFlash('info', 'Le commentaire ' . $comment->getName() . ' a bien été supprimée');
        return $this->redirectToRoute('backoffice_comment_index');
    }
}