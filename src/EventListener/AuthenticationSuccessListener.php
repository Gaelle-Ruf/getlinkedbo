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
            'type' =>  $user->getType(),
            'name' =>  $user->getName(),
            'firstname' =>  $user->getFirstname(),
            'lastname' =>  $user->getLastname(),
            'picture' =>  $user->getPicture(),
            'description' =>  $user->getDescription(),
            'schedule' =>  $user->getSchedule(),
            'nbMembers' =>  $user->getNbMembers(),
            'address' =>  $user->getAddress(),
            'website' =>  $user->getWebsite(),
            'facebook' =>  $user->getFacebook(),
            'instagram' =>  $user->getInstagram(),
            'twitter' =>  $user->getTwitter(),
            'email' =>  $user->getEmail(),
            'password' =>  $user->getPassword(),
            'slug' =>  $user->getSlug(),
            'createdAt' =>  $user->getCreatedAt(),
            'updatedAt' =>  $user->getUpdatedAt(),
            'events' =>  $user->getEvents(),
            'category' =>  $user->getCategory(),
            'style' =>  $user->getStyle(),
            'comment' =>  $user->getComment(),
            'participation' =>  $user->getParticipation(),
        );

        $event->setData($data);
    }
}