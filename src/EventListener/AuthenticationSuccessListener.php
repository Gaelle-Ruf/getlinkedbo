<?php 

namespace App\EventListener;

use App\Entity\AdminUser;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AuthenticationSuccessListener{

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof AdminUser && !$user instanceof User) {
            return;
        }

        $data['data'] = array(
            'email' =>  $user->getEmail(),
            'firstname' =>  $user->getFirstname(),
            'lastname' =>  $user->getLastname(),
        );

        $event->setData($data);
    }
}