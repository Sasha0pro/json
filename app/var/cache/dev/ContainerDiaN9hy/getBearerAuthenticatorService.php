<?php

namespace ContainerDiaN9hy;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getBearerAuthenticatorService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Security\BearerAuthenticator' shared autowired service.
     *
     * @return \App\Security\BearerAuthenticator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Authenticator/AuthenticatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Authenticator/AbstractAuthenticator.php';
        include_once \dirname(__DIR__, 4).'/src/Security/BearerAuthenticator.php';
        include_once \dirname(__DIR__, 4).'/src/Service/AccessTokenService.php';

        return $container->privates['App\\Security\\BearerAuthenticator'] = new \App\Security\BearerAuthenticator(($container->privates['App\\Repository\\UserRepository'] ?? $container->load('getUserRepositoryService')), ($container->privates['App\\Repository\\TokenRepository'] ?? $container->load('getTokenRepositoryService')), ($container->services['doctrine'] ?? self::getDoctrineService($container)), ($container->privates['App\\Service\\AccessTokenService'] ??= new \App\Service\AccessTokenService()));
    }
}
