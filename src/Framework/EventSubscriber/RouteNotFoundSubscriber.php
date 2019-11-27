<?php
declare(strict_types=1);

namespace Framework\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

final class RouteNotFoundSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents() : array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(GetResponseForExceptionEvent $event) : void
    {
        $exception = $event->getException();

        if ($exception instanceof NotFoundHttpException) {
            $event->setResponse(
                new JsonResponse(['error' => 'Not Found'], 404)
            );
        }
    }
}
