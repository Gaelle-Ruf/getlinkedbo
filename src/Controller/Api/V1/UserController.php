<?php

namespace App\Controller\Api\V1;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/v1/users", name="api_v1_user")
 */
class UserController extends AbstractController
{
    /**
     * URL : /api/v1/users
     * @Route : api_v1_user_index
     * 
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        
        $users = $userRepository->findAll();
        
        return $this->json($users, 200, [], []
        
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

        return $this->json($user, 200, [], []
    );
    }

     /**
     * 
     * URL : /api/v1/users/
     * 
     * @Route("/", name="add", methods={"POST"})
     * 
     * @return void
     */
    public function add(Request $request, SerializerInterface $serialiser, ValidatorInterface $validator)
    {
        // We get the json information
        $jsonData = $request->getContent();

        //We turn json data in object
        $user = $serialiser->deserialize($jsonData, User::class, 'json');

        //To save we call the manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        //We return an answer telling the ressource has been created with the 201 code.
        return $this->json($user, 201, [], []);

    
    }

}
