<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExceptionSubscriber implements EventSubscriberInterface
{
    /**
 * This function is triggered when an exception occurs in the application.
 *
 * @param ExceptionEvent $event The exception event
 */
public function onKernelException(ExceptionEvent $event): void
{
    $exception = $event->getThrowable();

    if ($exception instanceof HttpException) {
        $data = [
            'status' => $exception->getStatusCode(),
            'message' => $exception->getMessage()
        ];

        $event->setResponse(new JsonResponse($data));
    } else {
        $data = [
            'status' => 500, // The status does not exist because this is not an HTTP exception, so we set it to 500 by default.
            'message' => $exception->getMessage()
        ];

        $event->setResponse(new JsonResponse($data));
    }
}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
