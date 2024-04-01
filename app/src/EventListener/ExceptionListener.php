<?php

namespace App\EventListener;

use Doctrine\ORM\Exception\EntityIdentityCollisionException;
use InvalidArgumentException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


#[AsEventListener(event: ExceptionEvent::class, method: 'onKernelException' )]

class ExceptionListener
{
    #[AsEventListener(event: ExceptionEvent::class)]
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse();

//        if ($exception instanceof EntityIdentityCollisionException) {
//            if ($exception->getCode() === 404) {
//                $response->setContent("Не найдено сущности по указанному идентификатору");
//            }
//        }
//
//      else if ($exception instanceof InvalidArgumentException) {
//            dd($exception);
//        }
        $response->setContent($this->exceptionToJson($exception));

        $event->setResponse($response);
    }

    public function exceptionToJson(\Throwable $exception): string
    {
        return json_encode(
            [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]
        );
    }
}
