<?php
namespace Troob\ApiBundle\Services;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class Cors
{
    public function onKernelResponse(FilterResponseEvent $event)
    {   
        $responseHeaders = $event->getResponse()->headers;

        $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $responseHeaders->set('Access-Control-Allow-Origin', '*');
        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, OPTIONS');
    }   
}