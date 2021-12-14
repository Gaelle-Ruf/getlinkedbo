<?php

namespace App\Controller\Backoffice;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/category", name="backoffice_category_", requirements={"id": "\d+"})
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('backoffice/category/index.html.twig', [
            'categorys' => $categoryRepository->findAll(),]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);
        if (!$category) {
            throw $this->createNotFoundException('La categorie ' . $id . ' n\'existe pas');
        }
        return $this->render('backoffice/category/show.html.twig', [
            'category' => $category
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET","POST"})
     */
    public function add(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            $this->addFlash('success', 'L\'événement ' . $category->getName() . ' a bien été créée');

            return $this->redirectToRoute('backoffice_category_index');
        }
        return $this->render('backoffice/category/add.html.twig', [
            'formView' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $category->getName();/* setUpdatedAt(new DateTimeImmutable()) */

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\événement ' . $category->getName() . ' a bien été modifié');

            return $this->redirectToRoute('backoffice_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/category/edit.html.twig', [
            'category' => $category,
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     */
    public function delete(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        $this->addFlash('info', 'L\événement ' . $category->getName() . ' a bien été supprimé');
        return $this->redirectToRoute('backoffice_category_index');
    }
}