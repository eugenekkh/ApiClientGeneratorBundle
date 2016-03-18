<?php

namespace StudioSite\ApiClientGeneratorBundle\Template\PHP;

use StudioSite\ApiClientGeneratorBundle\Template\Template;
use StudioSite\ApiClientGeneratorBundle\Template\TemplateInterface;

class PHPTemplate extends Template implements TemplateInterface
{
    protected $config = array();
    protected $namespace;
    protected $name;
    protected $description;

    public function generate()
    {
        $this->renderFile('php/api.php.twig', 'src/Api.php', array(
            'auth' => $this->auth,
            'namespace' => $this->namespace,
            'methods' => $this->getMethods()
        ));

        $this->renderFile('php/composer.json.twig', 'composer.json', array(
            'name' => $this->name,
            'namespace' => $this->namespace,
            'description' => $this->description
        ));
    }

    public function setConfig(array $config)
    {
        $this->config = $config;

        if (isset($this->config['namespace']))
            $this->namespace = $this->config['namespace'];

        if (isset($this->config['name']))
            $this->name = $this->config['name'];

        if (isset($this->config['description']))
            $this->description = $this->config['description'];
    }
}
