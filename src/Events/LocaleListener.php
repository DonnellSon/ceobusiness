<?php

// src/EventListener/LocaleListener.php

namespace App\Events;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;

class LocaleListener
{
    private $router;
    private $requestStack;
    private $defaultLocale;

    public function __construct(RouterInterface $router, RequestStack $requestStack, string $defaultLocale)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $locale = $request->attributes->get('_locale');
     
        if (!$locale) {
            $defaultUrl = $this->router->generate('home', ['_locale' => $this->defaultLocale]); // Change 'homepage' to the name of your default route
            $response = new RedirectResponse($defaultUrl);
            $event->setResponse($response);
        }
    }
}