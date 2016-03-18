<?php

namespace StudioSite\ApiClientGeneratorBundle;

use StudioSite\ApiClientGeneratorBundle\DependencyInjection\Compiler\TemplateCompilerPass;
use StudioSite\ApiClientGeneratorBundle\DependencyInjection\StudioSiteApiClientGeneratorExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class StudioSiteApiClientGeneratorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TemplateCompilerPass());
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new StudioSiteApiClientGeneratorExtension();
        }

        return $this->extension;
    }
}
