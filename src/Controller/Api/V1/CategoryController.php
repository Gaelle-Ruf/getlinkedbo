<?php

namespace App\Controller\Api\V1;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/v1/categories", name="api_v1_category")
 */
class CategoryController extends AbstractController
{
 
    /**
     * URL : /api/v1/categories
     * Route : api_v1_categories_index
     * 
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        // dd($categories);

        return $this->json($categories, 200, [], []
        );
        // 'groups' => 'categories_list'
    }

    /**
     * 
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);
        
        if(!$category) {
            return $this->json([
                'error' => 'La categorie ' . $id . ' n\'existe pas'
            ], 404);
        }
        // dd($category);

        return $this->json($category, 200, [], []
    );
    // 'groups' => 'user_detail'
    }

     /**
     * 
     * URL : /api/v1/users/
     *
     * 
     * @Route("/", name="add", methods={"POST"})
     * 
     * 
     */
    public function add(Request $request, SerializerInterface $serialiser, ValidatorInterface $validator)
    {
        // We get the json information
        $jsonData = $request->getContent();

        

        //We turn json data in object
        $category = $serialiser->deserialize($jsonData, Category::class, 'json');        
        
        // dd($category);

        //To save we call the manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        // dd($jsonData, $category);

        //We return an answer telling the ressource has been created with the 201 code.
        return $this->json($category, 201, [], []);

    }
    /**
     * Category update according to the id
     * 
     * @Route("/{id}", name="update", methods={"PUT", "PATCH"})
     *
     * @return void
     */
    public function update(int $id, CategoryRepository $categoryRepository, Request $request, SerializerInterface $serialiser)
    {
        // We get datas received in JSON format
        $jsonData = $request->getContent();

        // We get the category for which the ID is $id
        $category = $categoryRepository->find($id);

        if (!$category) {
            // if the category doesn't exist
            // We retrune the 404 page not found
            return $this->json(
                [
                    'errors' => [
                        'message' => 'La categorie ' . $id . ' n\'existe pas'
                    ]
                ],
                404
            );
        }


        $serialiser->deserialize($jsonData, Category::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $category]);

        // We call the manager to update de database
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->json([
            'message' => 'La categorie ' . $category->getName() . ' a bien été mise à jour'
        ]);
    }

      /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function delete(int $id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        if (!$category) {
            // This category doesn't exist
            return $this->json(
                [
                    'errors' => ['message' => 'La categorie ' . $id . ' n\'existe pas']
                ],
                404
            );
        }

        // We call the manager to delete the selected category
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->json([
            'message' => 'La categorie ' . $category->getName() . ' a bien été supprimée'
        ]);
    }
}

