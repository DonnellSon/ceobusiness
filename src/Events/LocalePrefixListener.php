<?php

namespace App\Events;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocalePrefixListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            ViewEvent::class => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event)
    {
        // $request = $event->getRequest();
        // $locale = $request->attributes->get('_locale');
     
        // // Vérifie si le préfixe de localisation n'est pas déjà présent
        // if (!$locale || '/' === $locale) {
        //     $locale = 'fr';
        //     $request->setLocale($locale);
        // }
    }
}