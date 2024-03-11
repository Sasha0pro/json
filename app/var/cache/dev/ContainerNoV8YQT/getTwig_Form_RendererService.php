<?php

namespace ContainerNoV8YQT;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTwig_Form_RendererService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'twig.form.renderer' shared service.
     *
     * @return \Symfony\Component\Form\FormRenderer
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/form/FormRendererInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/form/FormRenderer.php';

        $a = ($container->privates['twig.form.engine'] ?? $container->load('getTwig_Form_EngineService'));

        if (isset($container->privates['twig.form.renderer'])) {
            return $container->privates['twig.form.renderer'];
        }

        return $container->privates['twig.form.renderer'] = new \Symfony\Component\Form\FormRenderer($a, ($container->privates['security.csrf.token_manager'] ?? $container->load('getSecurity_Csrf_TokenManagerService')));
    }
}
