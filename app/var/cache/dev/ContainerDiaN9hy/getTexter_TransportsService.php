<?php

namespace ContainerDiaN9hy;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTexter_TransportsService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'texter.transports' shared service.
     *
     * @return \Symfony\Component\Notifier\Transport\Transports
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/notifier/Transport/TransportInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/notifier/Transport/Transports.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/notifier/Transport.php';

        return $container->privates['texter.transports'] = (new \Symfony\Component\Notifier\Transport(new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['notifier.transport_factory.null'] ?? $container->load('getNotifier_TransportFactory_NullService'));
        }, 1)))->fromStrings([]);
    }
}
