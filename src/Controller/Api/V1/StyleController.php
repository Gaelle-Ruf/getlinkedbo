<?php

namespace App\Controller\Api\V1;

use App\Entity\Style;
use App\Repository\StyleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/v1/styles", name="api_v1_style")
 */
class StyleController extends AbstractController
{
     /**
     * URL : /api/v1/styles
     * Route : api_v1_styles_index
     * 
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(StyleRepository $styleRepository): Response
    {
        $styles = $styleRepository->findAll();
        // dd($styles);

        return $this->json($styles, 200, [], ['groups' => 'styles_list']);
    }


    /**
     * 
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, StyleRepository $styleRepository)
    {
        $style = $styleRepository->find($id);
        
        if(!$style) {
            return $this->json([
                'error' => 'Le style musical ' . $id . ' n\'existe pas'
            ], 404);
        }
        // dd($style);

        return $this->json($style, 200, [], ['groups' => 'style_detail']
    );
    // 'groups' => 'style_detail'
    }

    /**
     * 
     * URL : /api/v1/styles/
     * 
     * @Route("/", name="add", methods={"POST"})
     * 
     */
    public function add(Request $request, SerializerInterface $serialiser, ValidatorInterface $validator)
    {
        // We get the json information
        $jsonData = $request->getContent();

        

        //We turn json data in object
        $style = $serialiser->deserialize($jsonData, Style::class, 'json');        
        
        // dd($style);

        //To save we call the manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($style);
        $em->flush();

        // dd($jsonData, $style);

        //We return an answer telling the ressource has been created with the 201 code.
        return $this->json($style, 201, [], []);

    }

    /**
     * Style update according to the id
     * 
     * @Route("/{id}", name="update", methods={"PUT", "PATCH"})
     *
     * @return void
     */
    public function update(int $id, StyleRepository $styleRepository, Request $request, SerializerInterface $serialiser)
    {
        // We get datas received in JSON format
        $jsonData = $request->getContent();

        // We get the music style for which the ID is $id
        $style = $styleRepository->find($id);

        if (!$style) {
            // if the music style doesn't exist
            // We retrune the 404 page not found
            return $this->json(
                [
                    'errors' => [
                        'message' => 'Le style musical ' . $id . ' n\'existe pas'
                    ]
                ],
                404
            );
        }


        $serialiser->deserialize($jsonData, Style::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $style]);

        // We call the manager to update de database
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->json([
            'message' => 'Le style musical ' . $style->getName() . ' a bien été mis à jour'
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function delete(int $id, StyleRepository $styleRepository)
    {
        $style = $styleRepository->find($id);

        if (!$style) {
            // This musical style doesn't exist
            return $this->json(
                [
                    'errors' => ['message' => 'Le style musical ' . $id . ' n\'existe pas']
                ],
                404
            );
        }

        // We call the manager to delete the selected style
        $em = $this->getDoctrine()->getManager();
        $em->remove($style);
        $em->flush();

        return $this->json([
            'message' => 'Le style musical ' . $style->getName() . ' a bien été supprimé'
        ]);
    }
}
