<?php

namespace App\Controller\Backoffice;

use App\Entity\Style;
use App\Form\StyleType;
use App\Repository\StyleRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/style", name="backoffice_style_", requirements={"id": "\d+"})
 */
class StyleController extends AbstractController
{
    /**
    * @Route("/", name="index")
    */
    public function index(StyleRepository $styleRepository): Response
    {
        return $this->render('backoffice/style/index.html.twig', [
            'styles' => $styleRepository->findAll(),]);
    }

    /**
     * @Route("/{id}", name="show")
     * @return Response
     */
    public function show(int $id, StyleRepository $styleRepository)
    {
        $style = $styleRepository->find($id);
        if (!$style) {
            throw $this->createNotFoundException('Le style ' . $id . ' n\'existe pas');
        }
        return $this->render('backoffice/style/show.html.twig', [
            'style' => $style
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @return Response
     */
    public function add(Request $request)
    {
        $style = new Style();
        $form = $this->createForm(StyleType::class, $style);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($style);
            $em->flush();
            $this->addFlash('success', 'Le style ' . $style->getName() . ' a bien été créée');
            return $this->redirectToRoute('backoffice_style_index');
        }
        return $this->render('backoffice/style/add.html.twig', [
            'formView' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @return Response
     */
    public function edit(Style $style, Request $request)
    {
        $form = $this->createForm(StyleType::class, $style);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $style->setUpdatedAt(new DateTimeImmutable());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le style ' . $style->getName() . ' a bien été modifiée');
            return $this->redirectToRoute('backoffice_style_show', ['id' => $style->getId()]);
        }
        return $this->render('backoffice/style/edit.html.twig', ['formView' => $form->createView()]);
    }

    /**
     * @Route("/{id}/delete", name="delete")
     * @return Response
     */
    public function delete(Style $style)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($style);
        $em->flush();
        $this->addFlash('info', 'Le style ' . $style->getName() . ' a bien été supprimée');
        return $this->redirectToRoute('backoffice_style_index');
    }
}