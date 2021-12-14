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
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('backoffice/comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, CommentRepository $commentRepository)
    {
        $comment = $commentRepository->find($id);
        if (!$comment) {
            throw $this->createNotFoundException('Le commentaire n\'existe pas');
        }
        return $this->render('backoffice/comment/show.html.twig', [
            'comment' => $comment
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET","POST"})
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
            $this->addFlash('success', 'Le commentaire a bien été créé');
            return $this->redirectToRoute('backoffice_comment_index');
        }
        return $this->render('backoffice/comment/add.html.twig', [
            'formView' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Comment $comment, Request $request)
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $comment->getComment();/* setUpdatedAt(new DateTimeImmutable()) */

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le commentaire a bien été modifié');

            return $this->redirectToRoute('backoffice_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     */
    public function delete(Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();
        $this->addFlash('info', 'Le commentaire a bien été supprimé');
        return $this->redirectToRoute('backoffice_comment_index');
    }
}