<?php

namespace ContainerG8YAVZc;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_PMbOvsAService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.PMbOvsA' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.PMbOvsA'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'requestBodyDTO' => ['privates', 'App\\DTO\\TestRequestBodyDTO', 'getTestRequestBodyDTOService', true],
        ], [
            'requestBodyDTO' => 'App\\DTO\\TestRequestBodyDTO',
        ]);
    }
}
