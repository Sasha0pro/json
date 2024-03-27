<?php

namespace ContainerBwIyZSP;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAccessTokenServiceService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Service\AccessTokenService' shared autowired service.
     *
     * @return \App\Service\AccessTokenService
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Service/AccessTokenService.php';

        return $container->privates['App\\Service\\AccessTokenService'] = new \App\Service\AccessTokenService();
    }
}
