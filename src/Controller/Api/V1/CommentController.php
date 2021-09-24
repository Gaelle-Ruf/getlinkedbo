<?php

namespace App\Controller\Api\V1;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
* @Route("/api/v1/comments", name="api_v1_comment")
*/
class CommentController extends AbstractController
{
     /**
     * URL : /api/v1/styles
     * Route : api_v1_comments_index
     * 
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findAll();
        // dd($comments);

        return $this->json($comments, 200,[], []);
    }

    /**
     * 
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, CommentRepository $commentRepository)
    {
        $comment = $commentRepository->find($id);
        
        if(!$comment) {
            return $this->json([
                'error' => 'Le commentaire ' . $id . ' n\'existe pas'
            ], 404);
        }
        // dd($comment);

        return $this->json($comment, 200, [], []
    );
    // 'groups' => 'comment_detail'
    }

    /**
     * 
     * URL : /api/v1/comments/
     * 
     * @Route("/", name="add", methods={"POST"})
     * 
     */
    public function add(Request $request, SerializerInterface $serialiser, ValidatorInterface $validator)
    {
        // We get the json information
        $jsonData = $request->getContent();

        

        //We turn json data in object
        $comment = $serialiser->deserialize($jsonData, Comment::class, 'json');        
        
        // dd($comment);

        //To save we call the manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        // dd($jsonData, $comment);

        //We return an answer telling the ressource has been created with the 201 code.
        return $this->json($comment, 201, [], []);

    }

    /**
     * Comment update according to the id
     * 
     * @Route("/{id}", name="update", methods={"PUT", "PATCH"})
     *
     * @return void
     */
    public function update(int $id, CommentRepository $commentRepository, Request $request, SerializerInterface $serialiser)
    {
        // We get datas received in JSON format
        $jsonData = $request->getContent();

        // We get the comment for which the ID is $id
        $comment = $commentRepository->find($id);

        if (!$comment) {
            // if the comment doesn't exist
            // We retrune the 404 page not found
            return $this->json(
                [
                    'errors' => [
                        'message' => 'Le commentaire ' . $id . ' n\'existe pas'
                    ]
                ],
                404
            );
        }


        $serialiser->deserialize($jsonData, Comment::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $comment]);

        // We call the manager to update de database
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->json([
            'message' => 'Le commentaire ' . $comment->getId() . ' a bien été mis à jour'
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function delete(int $id, CommentRepository $commentRepository)
    {
        $comment = $commentRepository->find($id);

        if (!$comment) {
            // This comment doesn't exist
            return $this->json(
                [
                    'errors' => ['message' => 'Le commentaire ' . $id . ' n\'existe pas']
                ],
                404
            );
        }

        // We call the manager to delete the selected comment
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->json([
            'message' => 'Le commentaire ' . $comment->getId() . ' a bien été supprimé'
        ]);
    }
}
