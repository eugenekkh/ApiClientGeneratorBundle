<?php

namespace StudioSite\ApiClientGeneratorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class TemplateCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ss_api_client_gen.template_manager')) {
            return;
        }

        $definition = $container->findDefinition(
            'ss_api_client_gen.template_manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'ss_api_client_gen.template'
        );
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $description = '';
                if (isset($attributes['description']))
                    $description = $attributes['description'];
                if (isset($attributes['alias']))
                    $definition->addMethodCall(
                        'add',
                        array($attributes['alias'], new Reference($id), $description)
                    );
            }
        }
    }
}
