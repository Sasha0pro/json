<?php

namespace App\EventListener;

use App\DTO\DtoInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\Serializer\Exception\PartialDenormalizationException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\SerializerInterface;

 class ControllerArgumentsListener
{
     private ?object $class = null;

    public function __construct
    (
        private readonly ValidatorInterface $validator,
        private readonly SerializerInterface $serializer,
    ){}

     #[AsEventListener(event: ControllerArgumentsEvent::class)]
    public function onKernelControllerArguments(ControllerArgumentsEvent $event): void
    {
        $arguments = $event->getArguments();
        $this->defineClass($arguments);

        if ($this->class !== null) {
            $request = $event->getRequest();
            $this->denormalizeAndValidate($request);
        }
    }

    public function defineClass($arguments): void
    {
        foreach ($arguments as $argument) {
            if ($argument instanceof DtoInterface) {
                $this->class = $argument;

                break;
            }
        }
    }

    public function denormalizeAndValidate(Request $request): void
    {
        $violations = new ConstraintViolationList();
        try {
            $this->serializer->denormalize($request->request->all(), $this->class::class,'array',
                [AbstractNormalizer::OBJECT_TO_POPULATE => $this->class,DenormalizerInterface::COLLECT_DENORMALIZATION_ERRORS => true]);
        } catch (PartialDenormalizationException $e) {
            foreach ($e->getErrors() as $exception) {
                $message = sprintf('The type must be one of "%s" ("%s" given).', implode(', ', $exception->getExpectedTypes()), $exception->getCurrentType());
                $parameters = [];
                if ($exception->canUseMessageForUser()) {
                    $parameters['hint'] = $exception->getMessage();
                }
                $violations->add(new ConstraintViolation($message, '', $parameters, null, $exception->getPath(), null));
            }
        }
        $error = $this->validator->validate($this->class);
        $violations->addAll($error);

        if ($violations->count() !== 0){
            throw new ValidationFailedException(null, $violations);
        }
    }
}