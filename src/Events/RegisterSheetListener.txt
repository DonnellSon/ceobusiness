<?php

namespace App\Events;

use App\Entity\User;
use App\Event\UserRegisteredEvent;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserRegistrationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'doctrine.orm.entity_manager.post_persist' => 'onUserRegistration',
        ];
    }

    public function onUserRegistration(LifecycleEventArgs $args)
    {
        
    }

   

}
