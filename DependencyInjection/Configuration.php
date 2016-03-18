<?php

namespace StudioSite\ApiClientGeneratorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ss_api_client_gen');

        $rootNode
            ->children()
                ->arrayNode('nelmio_api_doc')
                    ->children()
                        ->scalarNode('extractor')->end()
                    ->end()
                ->end()
                ->scalarNode('route_prefix')
                    ->info('The prefix what be removed from uri before building method names')
                ->end()
                ->enumNode('auth')
                    ->values(array('basic'))
                ->end()
                ->arrayNode('php')
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('namespace')->end()
                        ->scalarNode('name')->end()
                        ->scalarNode('description')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
