<?php

namespace StudioSite\ApiClientGeneratorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class StudioSiteApiClientGeneratorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if (isset($config['nelmio_api_doc']))
            $this->nelmioApiDoc($container, $config['nelmio_api_doc']);

        if (isset($config['php']))
            $this->php($container, $config['php']);

        if (isset($config['route_prefix']))
            $container->setParameter('ss_api_client_gen.route_prefix', $config['route_prefix']);

        if (isset($config['auth']))
            $container->setParameter('ss_api_client_gen.auth', $config['auth']);

    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'ss_api_client_gen';
    }

    protected function nelmioApiDoc(ContainerBuilder $container, $config)
    {
        if (isset($config['extractor']))
            $container->setParameter(
                'ss_api_client_gen.nelmio_api_doc.extractor',
                $config['extractor']
            );
    }

    protected function php(ContainerBuilder $container, $config)
    {
        if (isset($config['class']))
            $container->setParameter(
                'ss_api_client_gen.php.class',
                $config['class']
            );
        $container->setParameter(
            'ss_api_client_gen.php.config',
            $config
        );
    }
}
