<?php

namespace App\Controller\Backoffice;

use App\Repository\Api\V1\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * 
 */
class SecurityController extends AbstractController
{
    /**
     * 
     */
    public function login(AuthenticationUtils $authenticationUtils, UserRepository $userRepository, Request $request, int $id): Response 
    {
        /* if ($this->getUser()) {
             return $this->redirectToRoute('target_path');
        } */

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // TODO return token infos users

        
        $apiToken = $request->headers->get('X-AUTH-TOKEN');
        if (null === $apiToken) {
            // The token header was empty, authentication fails with HTTP Status
            // Code 401 "Unauthorized"
            throw new CustomUserMessageAuthenticationException('No API token provided', [401]);
        } else {
            
           

            $user = $userRepository->find($id);

            

            return $this->json([
                'user'=>$user,
                'token'=>$apiToken
            ], 200);
        }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
