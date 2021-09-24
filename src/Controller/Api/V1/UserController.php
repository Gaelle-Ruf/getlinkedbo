<?php

namespace App\Controller\Api\V1;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/v1/users", name="api_v1_user")
 */
class UserController extends AbstractController
{
    /**
     * URL : /api/v1/users
     * Route : api_v1_user_index
     * 
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        
        $users = $userRepository->findAll();
        // dd($users);
        return $this->json($users, 200, [], ['groups' => 'users_list']
    );
    }

    /**
     * 
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        
        if(!$user) {
            return $this->json([
                'error' => 'L\'utilisateur ' . $id . ' n\'existe pas'
            ], 404);
        }

        return $this->json($user, 200, [], ['groups' => 'user_detail']
    );
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
        $user = $serialiser->deserialize($jsonData, User::class, 'json');        
        
        // dd($user);

        //To save we call the manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // dd($jsonData, $user);

        //We return an answer telling the ressource has been created with the 201 code.
        return $this->json($user, 201, [], []);

    }

    /**
     * User update according to the id
     * 
     * @Route("/{id}", name="update", methods={"PUT", "PATCH"})
     *
     * @return void
     */
    public function update(int $id, UserRepository $userRepository, Request $request, SerializerInterface $serialiser)
    {
        // We get datas reveived in JSON format
        $jsonData = $request->getContent();

        // We get the user for whom the ID is $id
        $user = $userRepository->find($id);

        if (!$user) {
            // if the user doesn't exist
            // We retrune the 404 page not found
            return $this->json(
                [
                    'errors' => [
                        'message' => 'L\'utilisateur ' . $id . ' n\'existe pas'
                    ]
                ],
                404
            );
        }


        $serialiser->deserialize($jsonData, User::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $user]);

        // We call the manager to update de database
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->json([
            'message' => 'L\'utilisateur ' . $user->getName() . ' a bien été mise à jour'
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function delete(int $id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);

        if (!$user) {
            // The user doesn't exist
            return $this->json(
                [
                    'errors' => ['message' => 'L\'utilisateur ' . $id . ' n\'existe pas']
                ],
                404
            );
        }

        // We call the manager to delete the selected user
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->json([
            'message' => 'L\'utilisateur ' . $user->getName() . ' a bien été supprimée'
        ]);
    }

}
