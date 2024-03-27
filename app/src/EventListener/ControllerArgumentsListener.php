<?php

namespace App\EventListener;

use App\DTO\DtoInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use ReflectionClass;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class ControllerArgumentsListener
{
    public function __construct
    (
        private ValidatorInterface $validator,
        private DenormalizerInterface $denormalizer
    ){}

    /**
     * @throws \ReflectionException
     * @throws ExceptionInterface
     */
    #[AsEventListener(event: ControllerArgumentsEvent::class)]
    public function onKernelControllerArguments(ControllerArgumentsEvent $event): void
    {
        $class = $this->defineClass($event->getArguments());

        if ($class !== null) {
            $request = $event->getRequest();

            $this->deserializeAndSave($request, $class);

            $this->validate($class);

        }
    }

    public function defineClass($arguments): ?DtoInterface
    {
        $class = null;

        foreach ($arguments as $property) {
            if ($property instanceof DtoInterface) {
                $class = $property;
            }
        }
        return $class;
    }

    public function validate(DtoInterface $class): void
    {
        $errors = $this->validator->validate($class);

        if (count($errors) > 0) {
            throw new BadRequestHttpException((string) $errors);
        }
    }

    /**
     * @throws ExceptionInterface
     * @throws \ReflectionException
     */
    public function deserializeAndSave(Request $request, DtoInterface $class): void
    {
       $denormalizeClass =  $this->denormalizer->denormalize($request->request->all(), $class::class);

       $reflectionDenormalizeClass = new ReflectionClass($denormalizeClass);

        $reflection = new ReflectionClass($class);

        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $nameProperty = $property->getName();
            $property->setValue($class, $reflectionDenormalizeClass->getProperty($nameProperty)->getValue($class));
        }
    }

}